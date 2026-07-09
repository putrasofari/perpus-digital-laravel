<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
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
}
