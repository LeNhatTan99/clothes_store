<?php

namespace App\Listeners;

use App\Events\CreateOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SendMailController;
use App\Mail\SendMailOrder;


class SendMailInfoOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreateOrder  $event
     * @return void
     */
    public function handle(CreateOrder $event)
    {
        Mail::to($event->order->email)->send(
        new sendMailOrder($event->order)
        );
    }

}
