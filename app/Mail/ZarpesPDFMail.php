<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ZarpesPDFMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject;
    public $data;
    public $view;
    public $pdf;

    public function __construct($subject,$data, $view, $pdf)
    {
        $this->subject=$subject;
        $this->data=$data;
        $this->view=$view;
        $this->pdf=$pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->subject)
            ->with($this->data)
            ->with(['from'=>env('MAIL_FROM_ADDRESS')])
            ->markdown($this->view)
        ->attachData($this->pdf, 'solicitud.pdf', [
        'mime' => 'application/pdf',
    ]);
    }
}
