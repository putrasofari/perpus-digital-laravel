<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Kelas;
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
        $query = Borrowing::with(['book', 'user.kelas']);

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($query) use ($search) {

                $query->whereHas('book', function ($q) use ($search) {

                    $q->where('judul', 'like', "%{$search}%")
                        ->orWhere('penulis', 'like', "%{$search}%")
                        ->orWhere('penerbit', 'like', "%{$search}%");
                })->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('nis_nip', 'like', "%{$search}%")
                        // relasi lagi ke kelas
                        ->orWhereHas('kelas', function ($kelas) use ($search) {
                            $kelas->where('name', 'like', "%{$search}%");
                        });
                });
            });
        }

        $borrowings = $query->latest()->paginate(10)->withQueryString();
        return view('admin.borrowings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Sistem menerima request peminjaman buku.
     */
    public function approved(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'description' => 'nullable|max:225'
        ]);

        $borrowing->update([
            'approved_at' => now(),
            'status' => 'diterima',
            'description' => $validated['description'] ?? null,
        ]);

        $borrowing->load('user', 'book');
        $borrowing->user->notify(

            new BorrowingNotification(
                title: 'Permintaan Peminjaman Diterima',
                message: "Peminjaman buku'{$borrowing->book->judul} kamu diterima'.",
                url: route('user.borrowings.show', $borrowing),
                icon: '✅',
                borrowingId: $borrowing->id
            )
        );
        return redirect()->route('admin.borrowings.index')->with('success', 'Request berhasil diterima.');
    }
    /**
     * Sistem menolak request peminjaman buku.
     */
    public function rejected(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'description' => 'required|min:3|max:225'
        ]);

        $borrowing->update([
            'description' => $validated['description'],
            'status' => 'ditolak',
            'approved_at' => now()
        ]);

        $borrowing->load('user', 'book');
        $borrowing->user->notify(

            new BorrowingNotification(
                title: 'Permintaan Peminjaman Ditolak',
                message: "Peminjaman buku'{$borrowing->book->judul} kamu ditolak'.",
                url: route('user.borrowings.show', $borrowing),
                icon: '❌',
                borrowingId: $borrowing->id
            )
        );

        return redirect()->route('admin.borrowings.index')->with('success', 'Berhasil menolak request.');
    }
    /**
     * Sistem menerima request peminjaman buku.
     */
    public function borrowed(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'due_date' => 'required|after:now',
            'description' => 'nullable'
        ]);

        if ($validated['due_date'] < today()) {
            return back()->with('error', 'Jatuh tempo tidak boleh kurang dari hari ini!');
        }

        $borrowing->update([
            'borrow_date' => today(),
            'due_date' => $validated['due_date'],
            'description' => $validated['description'] ?? null,
            'status' => 'dipinjam',
        ]);

        $borrowing->load('user', 'book');
        $borrowing->user->notify(

            new BorrowingNotification(
                title: 'Transaksi Peminjaman Berhasil',
                message: "Peminjaman buku'{$borrowing->book->judul} berhasil!'.",
                url: route('user.borrowings.show', $borrowing),
                icon: '✅',
                borrowingId: $borrowing->id
            )
        );

        return redirect()->route('admin.borrowings.index')->with('success', 'Transaksi peminjaman berhasil.');
    }
    /**
     * Sistem menerima request peminjaman buku.
     */
    public function returned(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'description' => 'nullable|max:225'
        ]);
        $borrowing->update([
            'status' => 'dikembalikan',
            'returned_at' => today(),
            'description' => $validated['description'] ?? null
        ]);

        $borrowing->load('user', 'book');
        $borrowing->user->notify(

            new BorrowingNotification(
                title: 'Buku telah dikembalikan',
                message: "Terimakasih sudah mengembalikan buku '{$borrowing->book->judul}!'.",
                url: route('user.borrowings.show', $borrowing),
                icon: '✅',
                borrowingId: $borrowing->id
            )
        );

        return redirect()->route('admin.borrowings.index')->with('success', 'Buku telah dikembalikan.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        return view('admin.borrowings.show', compact('borrowing'));
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
    public function destroy(string $id)
    {
        //
    }
}
