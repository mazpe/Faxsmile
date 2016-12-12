<?php

namespace App\Mail;

use App\Fax;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Blade;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class EmailFaxRecipients extends Mailable
{
    use Queueable, SerializesModels;

    public $settings;
    public $fax_job;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fax_job)
    {
        $this->fax_job = $fax_job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fax = Fax::find($this->fax_job['fax_id']);

        $php = Blade::compileString($fax->client->company->setting->incoming_fax);

        return $this->view('view.name')
            ->attach($this->fax_job['attach'])
            ->with([
                'body'  => $this->render($php, [
                    'job_id'        => $this->fax_job['job_id'],
                    'fax_id'        => $this->fax_job['fax_id'],
                    'fax_from'      => $this->fax_job['fax_from'],
                    'fax_to'        => $this->fax_job['fax_to'],
                    'timestamp'     => $this->fax_job['timestamp'],
                ]),
            ]);
    }

    function render($__php, $__data)
    {
        $obLevel = ob_get_level();
        ob_start();
        extract($__data, EXTR_SKIP);

        try {
            eval('?' . '>' . $__php);
        } catch (Exception $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw new FatalThrowableError($e);
        }

        return ob_get_clean();
    }
}
