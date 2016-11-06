<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMimeMailParser\Parser;
use GuzzleHttp\Client;

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
//        require_once __DIR__.'/../../../vendor/autoload.php';
//
//        $Parser = new Parser();
//        $Parser->setStream(fopen("php://stdin", "r"));
//
//        // Once we've indicated where to find the mail, we can parse out the data
//        $to = $Parser->getHeader('to');             // "test" <test@example.com>, "test2" <test2@example.com>
//        $addressesTo = $Parser->getAddresses('to'); //Return an array : [[test, test@example.com, false],[test2, test2@example.com, false]]
//
//        $from = $Parser->getHeader('from');             // "test" <test@example.com>
//        $addressesFrom = $Parser->getAddresses('from'); //Return an array : test, test@example.com, false
//
//        $subject = $Parser->getHeader('subject');
//
//        $text = $Parser->getMessageBody('text');
//
//        $html = $Parser->getMessageBody('html');
//        $htmlEmbedded = $Parser->getMessageBody('htmlEmbedded'); //HTML Body included data
//
//        $stringHeaders = $Parser->getHeadersRaw();  // Get all headers as a string, no charset conversion
//        $arrayHeaders = $Parser->getHeaders();      // Get all headers as an array, with charset conversion
//
//        // Pass in a writeable path to save attachments
//        $attach_dir = '/path/to/save/attachments/';
//        $Parser->saveAttachments($attach_dir);
//
//        // Get an array of Attachment items from $Parser
//        $attachments = $Parser->getAttachments();
//
//        //  Loop through all the Attachments
//        if (count($attachments) > 0) {
//            foreach ($attachments as $attachment) {
//                echo 'Filename : '.$attachment->getFilename().'<br />'; // logo.jpg
//                echo 'Filesize : '.filesize($attach_dir.$attachment->getFilename()).'<br />'; // 1000
//                echo 'Filetype : '.$attachment->getContentType().'<br />'; // image/jpeg
//                echo 'MIME part string : '.$attachment->getMimePartStr().'<br />'; // (the whole MIME part of the attachment)
//            }
//        }
//
//
//
//        // read from stdin
////        $fd = fopen("php://stdin", "r");
//        $email = "";
//
//        $email .= "\n";
//        $email .= $to ."\n";
//        $email .= $from ."\n";
//        $email .= $subject ."\n";

        $this->sendfax();


    }


    public function sendfax() {
        $client = new Client([
            // You can set any number of default request options.
        ]);

        $username = 'lestermesa';
        $company = '37049';
        $password = 'laravel123';
        $src = '7861112222';
        $dst = '3057262499';
        $sendfaxto = 'Lester';


        $response = $client->request('get', 'https://www.faxage.com/httpsfax.php', [
            'debug' => true,
            'query' => [
                'username' => $username,
                'company' => $company,
                'password' => $password,
                'callerid' => $src,
                'faxno' => $dst,
                'recipname' => $sendfaxto,
                'operation' => 'sendfax',
//                'tagname' => $tagname,
//                'tagnumber' => $tagnumber,
//                'faxfilenames[0]' => $file,
//                'faxfiledata[0]' => $b64data
            ]
        ]);

//        $file = fopen("/tmp/postfixtest", "a");

        $log = "Script successfully ran at ".date("Y-m-d H:i:s")."\n";
        $log .= "response ". $response->getBody() . "\n";
//
//        fwrite($file, $log);
//        fclose($file);

        echo "\nBody\n";
        echo $response->getBody();
        echo "\nBody\n";

        foreach ($response->getHeaders() as $name => $values) {
            echo $name . ': ' . implode(', ', $values) . "\r\n";
        }
    }
}
