<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpedientePacienteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfs;

    public function __construct($pdfs)
    {
        $this->pdfs = $pdfs;
    }

    public function build()
    {
        $mail = $this->subject('Expediente Médico del Paciente')
                     ->view('emails.expediente_paciente');

        foreach ($this->pdfs as $pdf) {
            $mail->attach($pdf);
        }

        return $mail;
    }
}
