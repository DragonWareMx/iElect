<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Elector;

class NewSimpMail extends Mailable
{
    use Queueable, SerializesModels;
    private $idElector;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idElector)
    {
        //
        $this->idElector = $idElector;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $elector = Elector::findOrFail($this->idElector);
        return $this->subject('Gracias por participar en iElect')->view('emails.newsimpmail', ['elector' => $elector]);
    }
}