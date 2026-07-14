<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use App\Notifications\BorrowingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Borrowing::with('book')->where('user_id', auth()->user()->id);

        if ($request->filled('search')) {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('judul', 'like', "%{$request->search}%")
                    ->orWhere('penulis', 'like', "%{$request->search}%")
                    ->orWhere('penerbit', 'like', "%{$request->search}%");
            });
        }

        $borrowings = $query->latest()->paginate(10)->withQueryString();
        return view('user.borrowings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        return view('user.borrowings.create', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|min:1',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if ($validated['quantity'] > $book->available_stock) {
            return back()
                ->withErrors([
                    'quantity' => 'Jumlah buku yang diminta melebihi stok yang tersedia.'
                ])
                ->withInput();
        }

        $validated['requested_at'] = today();
        $validated['status'] = 'menunggu';

        $exists = Borrowing::where('user_id', auth()->user()->id)
            ->where('book_id', $validated['book_id'])
            ->whereIn('status', [
                'menunggu',
                'diterima',
                'dipinjam',
            ])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'book' => 'Kamu masih memiliki peminjaman aktif untuk buku ini.'
            ]);
        }

        $borrowing = Borrowing::create($validated);
        $borrowing->load('user', 'book');

        $admins = User::where('role', 'admin')->get();
        Notification::send(
            $admins,

            new BorrowingNotification(
                title: 'Permintaan Peminjaman',
                message: "{$borrowing->user->name} mengajukan peminjaman buku '{$borrowing->book->judul}'.",
                url: route('admin.borrowings.show', $borrowing),
                icon: '📚',
                borrowingId: $borrowing->id
            )
        );
        return redirect()->route('user.borrowings.index')->with('success', 'Peminjaman berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== auth()->id()) {
            abort(403);
        }
        return view('user.borrowings.show', compact('borrowing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->user_id != auth()->user()->id) {
            abort(403);
        }

        if ($borrowing->status !== 'menunggu') {
            abort(403);
        }

        $borrowing->delete();

        return redirect()
            ->route('user.borrowings.index')
            ->with('success', 'Permintaan berhasil dibatalkan.');
    }
}
