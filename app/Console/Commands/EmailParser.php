<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMimeMailParser\Parser;
use GuzzleHttp\Client;
use App\Sender;
use App\FaxJob;
use App\Fax;
use App;
use Carbon\Carbon;
use App\Mail\OutgoingFaxConfirmation;
use Illuminate\Support\Facades\Mail;


class EmailParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse incoming email';

    protected $attach_dir = '/home/vagrant/Code/Faxsmile/storage/outgoing_fax';
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
        require_once __DIR__.'/../../../vendor/autoload.php';

        $Parser = new Parser();
        $Parser->setStream(fopen("php://stdin", "r"));

        // Once we've indicated where to find the mail, we can parse out the data
        $addressesTo = $Parser->getAddresses('to'); //Return an array : [[test, test@example.com, false],[test2, test2@example.com, false]]
        $addressesFrom = $Parser->getAddresses('from'); //Return an array : test, test@example.com, false

        $subject = $Parser->getHeader('subject');

        $text = $Parser->getMessageBody('text');

        $html = $Parser->getMessageBody('html');
        $htmlEmbedded = $Parser->getMessageBody('htmlEmbedded'); //HTML Body included data

        $stringHeaders = $Parser->getHeadersRaw();  // Get all headers as a string, no charset conversion
        $arrayHeaders = $Parser->getHeaders();      // Get all headers as an array, with charset conversion

        // Pass in a writeable path to save attachments
        $attach_dir = '/home/vagrant/Code/Faxsmile/storage/outgoing_fax';
        $Parser->saveAttachments($attach_dir);

        // Get an array of Attachment items from $Parser
        $attachments = $Parser->getAttachments();

        // Support faxes been set to multiple address
        foreach ($addressesTo as $key => $value ) {

            // Get the sentToFaxNumber
            $sendFaxTo = explode('@',$value['display']);
            $sendFaxToNumber = $sendFaxTo[0];

            // TODO: verify that is a valid number
//            $sendFaxToNumber = '7864886196';

            // Get the senders Fax DID
            $addressesFrom = $addressesFrom[0]['address'];
            if (App::environment('local')) {
                $addressesFrom = 'lesterm@gmail.com';
            }
            $sender = Sender::where('email', $addressesFrom)->first();
            $senderName = $sender->name;
            $senderFaxDID = $sender->fax->number;

            // Get Attachments and fax them
            if (count($attachments) > 0) {
                foreach ($attachments as $attachment) {
                    if (str_contains($attachment->getContentType(), "officedocument"))
                    {
                        $this->sendfax($addressesFrom, $sendFaxToNumber,$senderName,$senderFaxDID,$attachment->getFilename());

                        $file = fopen("/tmp/postfixtest1", "a");

                        $log = "Attachments \n";
                        $log .= "addressesTo: ". $sendFaxToNumber ."\n";
                        $log .= "filename: " . $attachment->getFilename() ."\n";
                        $log .= "content type: " . $attachment->getContentType() ."\n";

                        fwrite($file, $log);
                        fclose($file);
                    }
                }
            }
        }

    }

    public function sendfax($addressesFrom, $sendFaxToNumber, $sendFaxToName, $sendFaxFromDid, $attachment) {
        $client = new Client();

        $username = 'lestermesa';
        $company = '37049';
        $password = 'laravel123';

        $attach_dir = '/home/vagrant/Code/Faxsmile/storage/outgoing_fax';

        $file = $attach_dir.$attachment;

        $fh = fopen($file, "r");
        $fdata = fread($fh, filesize($file));
        fclose($fh);

        $b64data = base64_encode($fdata);

        $response = $client->request('POST', 'https://www.faxage.com/httpsfax.php', [
            'debug' => true,
            'form_params' => [
                'username' => $username,
                'company' => $company,
                'password' => $password,
                'callerid' => $sendFaxFromDid,
                'faxno' => $sendFaxToNumber,
                'recipname' => $sendFaxToName,
                'operation' => 'sendfax',
//                'tagname' => $tagname,
//                'tagnumber' => $tagnumber,
                'faxfilenames[0]' => $file,
                'faxfiledata[0]' => $b64data
            ]
        ]);

        $logfile = fopen("/tmp/postfixtest", "a");

        $log = "Script successfully ran at ".date("Y-m-d H:i:s")."\n";
        $log .= "attach_dir: $attach_dir \n";
        $log .= "attachment: $attachment \n";
        $log .= "file: $file \n";
        $log .= "response: ". $response->getBody() . "\n";

        fwrite($logfile, $log);
        fclose($logfile);

        $job_id = explode(" " ,$response->getBody())[1];

        $fax = Fax::where('number', $sendFaxFromDid)->first();
        FaxJob::create([
            'job_id'    => $job_id,
            'fax_id'       => $fax->id,
            'fax_from'  => $sendFaxFromDid,
            'fax_to'    => $sendFaxToNumber,
            'timestamp' => Carbon::now(),
            'action'    => 'outgoing'
        ]);

        Mail::to($addressesFrom)
            ->queue(new OutgoingFaxConfirmation([
                'job_id'        => $job_id,
                'fax_id'        => $fax->id,
                'fax_from'      => $sendFaxFromDid,
                'fax_to'        => $sendFaxToNumber,
                'from_email'    => $addressesFrom,
                'timestamp'     => Carbon::now(),
                'attach'        => $attach_dir .'/'. $attachment
            ]));
    }
}
