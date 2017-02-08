<?php
require_once 'PHPMailer/PHPMailerAutoload.php';

class MailHandler extends PHPMailer
{
    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->Subject = $content['subject'];
        $this->Body = $content['body'];
    }

    public function isSend()
    {
        return parent::Send() ? 'success' : 'error';
    }

    /**
     * Set Config method
     * If no email configured in cpanel
     */
    private function setGmailConfig()
    {
        $this->IsSMTP();
        $this->SMTPDebug = 1;
        $this->SMTPAuth = true;
        $this->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $this->Host = "smtp.gmail.com";
        $this->Port = 465; // or 587
        $this->Username = 'username@gmail.com';
        $this->Password = 'password';
    }

}

