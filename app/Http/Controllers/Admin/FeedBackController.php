<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedBack;
use App\Models\User;
use App\Notifications\FeedbackNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class FeedBackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FeedBack::with('user.kelas');

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('nis_nip', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            if ($request->status === 'waiting') {
                $query->whereNull('reply');
            } elseif ($request->status === 'replied') {
                $query->whereNotNull('reply');
            }
        }

        $feedbacks = $query->latest()->paginate(10)->withQueryString();
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Display the specified resource.
     */
    public function show(FeedBack $feedback)
    {
        return view('admin.feedbacks.show', compact('feedback'));
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
    public function reply(Request $request, FeedBack $feedback)
    {

        if ($feedback->reply) {
            return back()->with(
                'error',
                'Feedback ini sudah pernah dibalas.'
            );
        }
        $validated = $request->validate([
            'reply' => 'required|string|min:3'
        ]);

        $feedback->update([
            'reply' => $validated['reply'],
            'replied_at' => now()
        ]);
        $feedback->load('user');

        $feedback->user->notify(
            new FeedbackNotification(
                feedbackId: $feedback->id,
                title: 'Kritik & Saran Baru',
                message: "{$feedback->user->name} mengirim kritik dan saran baru.",
                url: route('user.feedbacks.show', $feedback),
                icon: '💬',
            )
        );

        return redirect()->route('admin.feedbacks.show', $feedback)->with('success', 'Balasan berhasil dikirim.');
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
