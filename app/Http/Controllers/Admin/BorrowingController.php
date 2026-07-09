<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Kelas;
use Illuminate\Http\Request;

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
    public function approved(Borrowing $borrowing)
    {
        $borrowing->update([
            'status' => 'diterima',
            'approved_at' => now(),
        ]);

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

        return redirect()->route('admin.borrowings.index')->with('success', 'Berhasil menolak request.');
    }
    /**
     * Sistem menerima request peminjaman buku.
     */
    public function borrowed(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'due_date' => 'required',
            'description' => 'nullable'
        ]);

        if ($validated['due_date'] < today()){
            return back()->with('error', 'Jatuh tempo tidak boleh kurang dari hari ini!');
        }

        $borrowing->update([
            'borrow_date' => today(),
            'due_date' => $validated['due_date'],
            'description' => $validated['description'],
            'status' => 'dipinjam',
        ]);

        return redirect()->route('admin.borrowings.index')->with('success', 'Transaksi peminjaman berhasil.');
    }
    /**
     * Sistem menerima request peminjaman buku.
     */
    public function returned(Borrowing $borrowing)
    {
        $borrowing->update([
            'status' => 'dikembalikan',
            'returned_at' => today()
        ]);

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
