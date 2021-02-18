<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Elector;

class SimpUpdate extends Mailable
{
    use Queueable, SerializesModels;
    private $idElector;
    private $mensaje;
    private $mensajeEliminacion;
    private $bfotoa;
    private $bfotor;
    private $bfotoe;
    private $bfotod;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idElector, $mensaje, $subject, $mensajeEliminacion, $bfotoa, $bfotor, $bfotoe, $bfotod)
    {
        //
        $this->idElector = $idElector;
        $this->mensaje = $mensaje;
        $this->subject = $subject;
        $this->mensajeEliminacion = $mensajeEliminacion;
        $this->bfotoa = $bfotoa;
        $this->bfotor = $bfotor;
        $this->bfotoe = $bfotoe;
        $this->bfotod = $bfotod;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $elector = Elector::findOrFail($this->idElector);
        return $this->subject($this->subject)->view('emails.simpupdate', ['elector' => $elector,'mensaje'=>$this->mensaje,'bfotoa'=>$this->bfotoa, 'bfotor'=>$this->bfotor, 'bfotoe'=>$this->bfotoe, 'bfotod'=>$this->bfotod, 'mensajeEliminacion'=>$this->mensajeEliminacion]);
    }
}
