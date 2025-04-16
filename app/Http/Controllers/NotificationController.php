<?php

namespace App\Http\Controllers;

use App\Mail\NotificationGestionnaireMail;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;

class NotificationController
{
    /**
     * Envoie une notification à un utilisateur
     */
    public static function notify(User $user, string $type, string $message)
    {
        return $user->notifications()->create([
            'type' => $type,
            'message' => $message,
            'read_at' => null
        ]);
    }


    /**
     * Envoie une notification aux gestionnaires
     */
    public static function notifyManagers($message)
    {
        $managers = User::where('role', 'gestionnaire')->get();

        foreach ($managers as $manager) {
            Mail::to($manager->email)->send(new NotificationGestionnaireMail($message));
        }
    }

    /**
     * Marque une notification comme lue
     */
    public static function markAsRead(Notification $notification)
    {
        if (!$notification->read_at) {
            $notification->update(['read_at' => now()]);
        }
    }
}
