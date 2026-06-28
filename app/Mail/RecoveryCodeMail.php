<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoveryCodeMail extends Mailable
{
    use SerializesModels;

    public string $codigo;

    public function __construct(string $codigo)
    {
        $this->codigo = $codigo;
    }

    public function build()
    {
        return $this->subject('Código de recuperación - JC Empleos')
                    ->view('emails.recovery-code');
    }
}