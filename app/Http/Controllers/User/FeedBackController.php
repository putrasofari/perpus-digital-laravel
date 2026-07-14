<?php

namespace App\Http\Controllers\User;

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
        $query = FeedBack::where('user_id', auth()->user()->id);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $feedbacks = $query->latest()->paginate(10)->withQueryString();
        return view('user.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.feedbacks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:website,koleksi_buku,pelayanan,lainnya',
            'message' => 'required|string|min:3',
        ]);

        $feedback = auth()->user()->feedbacks()->create($validated);

        $feedback->load('user');
        $admins = User::where('role', 'admin')->get();
        Notification::send(
            $admins,

            new FeedbackNotification(
                feedbackId: $feedback->id,
                title: 'Kritik & Saran Baru',
                message: "{$feedback->user->name} mengirim kritik dan saran baru.",
                url: route('admin.feedbacks.show', $feedback),
                icon: '💬',
            )
        );

        return redirect()
            ->route('user.feedbacks.index')
            ->with('success', 'Kritik dan saran berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FeedBack $feedback)
    {
        if ($feedback->user_id !== auth()->user()->id) {
            abort(403);
        }

        $feedback->load('user');
        return view('user.feedbacks.show', compact('feedback'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedBack $feedback)
    {
        if ($feedback->user_id != auth()->user()->id) {
            abort(403);
        }

        if ($feedback->reply) {
            return back()->with(
                'error',
                'Feedback yang sudah dibalas tidak dapat dihapus.'
            );
        }

        $feedback->delete();

        return redirect()
            ->route('user.feedbacks.index')
            ->with('success', 'Feedback berhasil dihapus.');
    }
}
