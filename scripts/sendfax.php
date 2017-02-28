#!/usr/bin/php -q
<?php
// NOTE - The use of the command-line curl
// in this example is sufficient for testing.
// However, most operating systems impose
// a maximum command-line length that makes
// a libcurl implementation more practical
// for larger files to be faxed.
// See:
// http://php.net/manual/en/book.curl.php
//
$url = "https://www.faxage.com/httpsfax.php";

$args = $_SERVER['argv'];
$src = $args[1];
$dst = $args[2];
$file = $args[3];

$username = "lestermesa";
$company = "37049";
$password = "laravel123";

$tagname="Testing";
$tagnumber="1.303.555.1212";

$fh = fopen($file, "r");
$fdata = fread($fh, filesize($file));
fclose($fh);

$b64data = base64_encode($fdata);

$post_data = "username=$username&company=$company&password=$password&";
$post_data .= "callerid=$src&faxno=$dst&recipname=Test&operation=sendfax&";
$post_data .= "tagname=$tagname&tagnumber=$tagnumber&faxfilenames[0]=$file&";
$post_data .= "faxfiledata[0]=$b64data";

$curl_cmd = "/usr/bin/curl -k -d \"$post_data\" $url 2>/dev/null";

$result = `$curl_cmd`;

$results = explode('\n', $result);

while(list($key, $val) = each($results)) {
    # Do something useful here
    echo "$val\n";
}
?>
