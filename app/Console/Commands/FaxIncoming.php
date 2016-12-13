<?php

namespace App\Console\Commands;

use App\Fax;
use App\FaxJob;
use App\Mail\EmailFaxRecipients;
use App\Recipient;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

class FaxIncoming extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fax:incoming';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();

        $username = 'lestermesa';
        $company = '37049';
        $password = 'laravel123';

        $response = $client->request('POST', 'https://www.faxage.com/httpsfax.php', [
            'debug' => false,
            'form_params' => [
                'username' => $username,
                'company' => $company,
                'password' => $password,
                'operation' => 'listfax',
            ]
        ]);

        $incoming_faxes = explode("\n", $response->getBody());

        foreach($incoming_faxes as $fax) {
            $fax = explode("\t", $fax);

            if ($fax[0] == "")
                continue;

            $this->saveFaxJobInDatabase($fax);
            $this->getFaxDetails($fax[0]);
            $this->sendFaxToRecipients($fax);
        }

    }

    public function saveFaxJobInDatabase($fax_job) {
        $fax_from = preg_replace( '/[^0-9]/', '', $fax_job[2] );
        $fax_to = preg_replace( '/[^0-9]/', '', $fax_job[3] );

        $fax = Fax::where('number', $fax_to)->first();

        $fax_id = null;

        if ($fax) {
            $fax_id = $fax->id;
        }

        if (!FaxJob::where('job_id', $fax_job[0])->first()) {
            FaxJob::create([
                'job_id'        => $fax_job[0],
                'fax_id'        => $fax_id,
                'fax_from'      => $fax_from,
                'fax_to'        => $fax_to,
                'timestamp'     => $fax_job[1],
                'action'        => 'incoming'
            ]);
        }
    }

    public function getFaxDetails($fax_id) {
        $client = new Client();

        $username = 'lestermesa';
        $company = '37049';
        $password = 'laravel123';

        $response = $client->request('POST', 'https://www.faxage.com/httpsfax.php', [
            'debug' => false,
            'form_params' => [
                'username' => $username,
                'company' => $company,
                'password' => $password,
                'operation' => 'getfax',
                'faxid' => $fax_id
            ],
            'save_to' => '/home/vagrant/Code/Faxsmile/storage/fax_incoming/'. $fax_id
        ]);

        return $response;
    }

    public function sendFaxToRecipients($fax_job) {
        $fax_from = preg_replace( '/[^0-9]/', '', $fax_job[2] );
        $fax_to = preg_replace( '/[^0-9]/', '', $fax_job[3] );

        $fax = Fax::where('number', $fax_to)->first();

        if ($fax) {
            foreach ($fax->recipients as $recipient) {
                Mail::to($recipient->email)
                    ->queue(new EmailFaxRecipients([
                        'job_id'        => $fax_job[0],
                        'fax_id'        => $fax->id,
                        'fax_from'      => $fax_from,
                        'fax_to'        => $fax_to,
                        'timestamp'     => $fax_job[1],
                        'attach'    => '/home/vagrant/Code/Faxsmile/storage/fax_incoming/'. $fax_job[0]
                    ]));
            }
        }

        return true;
    }

}
