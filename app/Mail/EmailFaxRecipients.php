<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailFaxRecipients extends Mailable
{
    use Queueable, SerializesModels;

    public $fax_job;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fax_job)
    {
        //

        $this->fax_job = $fax_job;

//        dd($this->fax_job);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name')
            ->attach($this->fax_job['attach']);
    }
}
