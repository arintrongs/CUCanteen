<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Queue\ShouldQueue;


class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    private $username;
    private $email;
    private $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->url = hash('sha512', Config::get('app.APP_KEY').$data['username'].$data['password'].$data['email']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.shipped')
                ->with([
                    'user_username' => $this->username,
                    'user_email' => $this->email,
                    'url' => $this->url,
                ]);
    }
}
