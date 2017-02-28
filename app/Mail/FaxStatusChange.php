<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Blade;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use App\Fax;

class FaxStatusChange extends Mailable
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

        $fax_status_template = Blade::compileString($fax->client->company->setting->fax_status);

        return $this->view('fax.outgoing')
            ->from([
                'address'   => $fax->client->company->setting->from_email,
                'name'      => $fax->client->company->setting->from_name
            ])
            ->subject($fax->client->company->setting->fax_status_subject . ' - ' .
                        $this->fax_job['fax_to'] . ' - '. $this->fax_job['status'])
            ->with([
                'body'  => $this->render($fax_status_template, [
                    'job_id'                => $this->fax_job['job_id'],
                    'fax_id'                => $this->fax_job['fax_id'],
                    'fax_to'                => $this->fax_job['fax_to'],
                    'fax_from'              => $this->fax_job['fax_from'],
                    'email_from'            => $this->fax_job['email_from'],
                    'status'                => $this->fax_job['status'],
                    'status_description'    => $this->fax_job['status_description'],
                    'sendtime'              => $this->fax_job['sendtime'],
                    'completetime'          => $this->fax_job['completetime'],
                ]),
                'signature' => $fax->client->company->setting->signature
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
