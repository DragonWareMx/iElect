<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Elector;
use App\Models\User;

class NewSimpMail extends Mailable
{
    use Queueable, SerializesModels;
    private $idBrigadista;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idBrigadista)
    {
        //
        $this->idBrigadista = $idBrigadista;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::findOrFail($this->idBrigadista);
        return $this->subject('Solicitud aceptada para convertirte en brigadista de iElect')->view('emails.baceptadomail', ['user' => $user]);
    }
}