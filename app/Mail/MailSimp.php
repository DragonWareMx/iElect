<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Elector;

class MailSimp extends Mailable
{
    use Queueable, SerializesModels;
    private $idElector;
    private $mensaje;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idElector, $mensaje, $subject)
    {
        //
        $this->idElector = $idElector;
        $this->mensaje = $mensaje;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $elector = Elector::findOrFail($this->idElector);
        return $this->subject($this->subject)->view('emails.simpmail', ['elector' => $elector,'mensaje'=>$this->mensaje]);
    }
}
