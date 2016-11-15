<?php

namespace App\Console\Commands;

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

        $i = 0;
        foreach($incoming_faxes as $fax) {
            $fax = explode("\t", $fax);

            if ($fax[0] == "")
                continue;

            $jobs[$i] = $fax[0];
            $i++;
        }

        dd($jobs);
    }
}
