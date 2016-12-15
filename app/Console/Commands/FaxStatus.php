<?php

namespace App\Console\Commands;

use App\Fax;
use App\Mail\FaxStatusChange;
use Illuminate\Console\Command;
use App\FaxJob;
use GuzzleHttp\Client;
use App\Sender;
use Illuminate\Support\Facades\Mail;

class FaxStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fax:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check fax job statuses';

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
        //
        $fax_jobs = FaxJob::where('status',null)->orWhereNotIn('status',['status','delivered'])
            ->get();

        foreach ($fax_jobs as $fax_job) {
            $this->getFaxJobStatus($fax_job['job_id']);
        }
    }

    public function getFaxJobStatus($fax_job_id) {
        $client = new Client();

        $username = 'lestermesa';
        $company = '37049';
        $password = 'laravel123';

        $response = $client->request('POST', 'https://www.faxage.com/httpsfax.php', [
            'debug' => false,
            'form_params' => [
                'username'  => $username,
                'company'   => $company,
                'password'  => $password,
                'operation' => 'status',
                'jobid'     => $fax_job_id,
                'viewtype'  => 'pdf'
            ],
            'save_to' => '/home/vagrant/Code/Faxsmile/storage/fax_incoming/'. $fax_job_id
        ]);

        $body = $response->getBody();

        while (!$body->eof()) {
            $fax_job = preg_split('/[\t]/', $body->read(1024));

            $saved_fax_job = FaxJob::where('job_id', $fax_job_id)->first();

            if (($saved_fax_job->status != 'success' && $fax_job[4] == 'success') ||
                ($saved_fax_job->status != 'failure' && $fax_job[4] == 'failure')) {

                $fax    = Fax::find($saved_fax_job->fax_id);
                $sender = Sender::where('fax_id', $fax->id)->first();

                Mail::to($sender->email)
                    ->queue(new FaxStatusChange([
                        'job_id'                => $fax_job_id,
                        'status'                => $fax_job[4],
                        'status_description'    => $fax_job[5],
                        'fax_id'                => $fax->id,
                        'fax_from'              => $saved_fax_job->fax_from,
                        'fax_to'                => $saved_fax_job->fax_to,
                        'email_from'            => $sender->email,
                        'sendtime'              => $saved_fax_job->sendtime,
                        'completetime'          => $fax_job[6] ? $fax_job[6] : null,
                        'xmittime'              => trim($fax_job[8]),
                    ]));
            }

            $saved_fax_job->update([
                'status'                => $fax_job[4],
                'status_description'    => $fax_job[5],
                'sendtime'              => $fax_job[6] ? $fax_job[6] : null,
                'completetime'          => $fax_job[7] != '0000-00-00 00:00:00' ? $fax_job[7] : null,
                'xmittime'              => trim($fax_job[8])
            ]);
        }

        return $response;
    }
}
