<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use App\Notifications\NewOrderNotification;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewOrderNotification implements ShouldQueue
{
    public function handle(NewOrderCreated $event)
    {
        $order = $event->order;

        // Kirim notifikasi ke semua admin
        Admin::all()->each(function (Admin $admin) use ($order) {
            $admin->notify(new NewOrderNotification($order));
        });
    }
}
