<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->notifications();

        if ($request->filter == 'unread') {
            $query->whereNull('read_at');
        }
        if ($request->filter == 'read') {
            $query->whereNotNull('read_at');
        }

        $notifications = $query->latest()->paginate(10);

        return view('notifications.index', [
            'notifications' => $notifications,
        ]);
    }

    public function show(DatabaseNotification $notification)
    {
        // Pastikan notification milik user yang login
        abort_if(
            $notification->notifiable_id != auth()->user()->id,
            403
        );

        $notification->markAsRead();

        return redirect($notification->data['url']);
    }

    public function readAll()
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();

        return redirect()->route('notifications.index')->with('success', 'Semua notifikasi telah ditandai sebagai sudah dibaca.');;
    }
}
