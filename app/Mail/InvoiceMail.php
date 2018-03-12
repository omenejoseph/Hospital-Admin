<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $bill;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bill)
    {
        //

        $this->bill = $bill;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Bill from Hospital Admin')->markdown('emails.invoice');
        // ->view('view.name');
        // ->to(config('mail.from.address'))
        // ->subject('Your Website Inquiry')
        // ->view('emails.invoice');
        return redirect('/admin/patients');
    }
}
