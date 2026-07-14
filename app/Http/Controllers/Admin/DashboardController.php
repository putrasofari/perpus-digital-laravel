<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\FeedBack;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalUsers = User::count();
        $inactiveUsers = User::where('is_active', false)->count();
        $totalBooks = Book::count();
        $borrowedBooks = Borrowing::where('status', 'dipinjam')->count();
        $pendingBorrowings = Borrowing::where('status', 'menunggu')->count();
        $lateBorrowings = Borrowing::where('status', 'dipinjam')->where('due_date', '<', now())->count();
        $totalFeedbacks = FeedBack::count();
        $waitingFeedback = FeedBack::whereNull('reply')->count();

        $borrowings = Borrowing::with('user', 'book')
            ->latest()
            ->take(5)
            ->get();

        $feedbacks = FeedBack::with('user')
            ->latest()
            ->take(5)
            ->get();

        $users = User::latest()
            ->take(5)
            ->get();

        $borrowings = $borrowings->map(function ($borrowing){
            return [
                'icon' => '📚',
                'title' => 'Permintaan Peminjaman',
                'message' => "{$borrowing->user->name} mengajukan buku '{$borrowing->book->judul}'.",
                'url' => route('admin.borrowings.show', $borrowing),
                'created_at' => $borrowing->created_at
            ];
        });
        $feedbacks = $feedbacks->map(function ($feedback){
            return [
                'icon' => '💬',
                'title' => 'Kritik & Saran Baru',
                'message' => "{$feedback->user->name} mengirim kritik dan saran baru.",
                'url' => route('admin.feedbacks.show', $feedback),
                'created_at' => $feedback->created_at
            ];
        });
        $users = $users->map(function ($user){
            return [
                'icon' => '👤',
                'title' => 'Pendaftaran Akun Baru',
                'message' => "{$user->name} telah mendaftarkan akun baru.",
                'url' => route('admin.users.index'),
                'created_at' => $user->created_at
            ];
        });

        $activities = $borrowings->concat($feedbacks)->concat($users)->sortByDesc('created_at')->take(5)->values();
        return view('admin.dashboard', compact('totalUsers', 'totalBooks', 'borrowedBooks', 'totalFeedbacks', 'pendingBorrowings', 'inactiveUsers', 'lateBorrowings', 'waitingFeedback', 'activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
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
