<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestaurantRemoved extends Mailable
{
    use Queueable, SerializesModels;

    public $restaurant;

    public function __construct($removedRestaurant)
    {
        $this ->restaurant = $removedRestaurant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.restaurant-removed');
    }
}
