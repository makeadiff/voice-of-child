<?php
require_once "Mail.php";
require_once "Mail/mime.php";
error_reporting(E_ERROR | E_PARSE);

class Email
{
    public $to = '';
    public $subject = '';
    public $html = '';
    public $from = '';
    public $images = [];
    public $attachments = [];

    private $smtp_host = 'smtp.gmail.com';
    private $smpt_username = 'fellowship@makeadiff.in';
    private $smtp_password = 'fellowshipgonemad';

    function send() {
        $headers = [
        	'From' 		=> $this->from,
            'To' 		=> $this->to,
            'Subject'	=> $this->subject
        ];

        $mime = new Mail_mime(array('eol' => "\n"));
        
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $index = 0;
        foreach($this->images as $key => $image) {
        	if($image and file_exists($image)) {
                $mime->addHTMLImage($image, finfo_file($finfo, $image));
                $cid = $mime->_html_images[$index]['cid'];
	            $this->html = str_replace("%CID-$key%", $cid, $this->html);
	            // print "Replaced '%CID-$key%' with '$cid' - $index\n";
	            $index++;
            }
        }
        $mime->setHTMLBody($this->html);

        foreach($this->attachments as $attachment) {
        	if($attachment and file_exists($attachment)) {
                $mime->addAttachment($attachment, finfo_file($finfo, $attachment));
            }
        }
        
        $smtp = Mail::factory('smtp', [
            	'host' 		=> $this->smtp_host,
                'auth' 		=> true,
                'username'	=> $this->smpt_username,
                'password'	=> $this->smtp_password
            ]);

        $body = $mime->get();
        $headers = $mime->headers($headers);

        $mail = $smtp->send($this->to, $headers, $body);

        if (PEAR::isError($mail)) {
            echo("<p>" . $mail->getMessage() . "</p>");
            return false;
        }
        // echo "Sent successfully";
        return true;
    }
}
