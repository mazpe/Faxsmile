<?php

namespace App\Console\Commands;

use App\Fax;
use App\Faxjob;
use App\Recipient;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

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
            $this->sendFaxToRecipients($fax);
        }

    }

    public function saveFaxJobInDatabase($fax_job) {
        $fax_number = preg_replace( '/[^0-9]/', '', $fax_job[2] );
        $fax = Fax::where('number', $fax_number)->first();

        $fax_id = null;

        if ($fax) {
            $fax_id = $fax->id;
        }

        if (!Faxjob::where('job_id', $fax_job[0])->first()) {
            Faxjob::create([
                'job_id'        => $fax_job[0],
                'fax_id'        => $fax_id,
                'fax_number'    => $fax_number,
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
            ]
        ]);

        dd($response);
    }

    public function sendFaxToRecipients($fax_job) {
        $fax_number = preg_replace( '/[^0-9]/', '', $fax_job[2] );

        $fax = Fax::where('number', $fax_number)->first();

        $recipients = [];

        foreach ($fax->recipients as $recipient) {
            array_push($recipients, $recipient->email);
        }

        dd($recipients);
    }

}
