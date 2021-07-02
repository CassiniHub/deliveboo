<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestaurantCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $restaurant;

    public function __construct($restaurant)
    {
        $this -> restaurant = $restaurant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.restaurant-created');
    }
}
