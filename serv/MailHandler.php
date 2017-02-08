<?php
require_once 'PHPMailer/PHPMailerAutoload.php';

/**
 * This file is part of Form Handler package
 * (c) Dimitry Vasilenko <dmv.developer@gmail.com>
 */

/**
 * Class MailHandler
 */
class MailHandler extends PHPMailer
{
    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->Subject = $content['subject'];
        $this->Body = $content['body'];

        /**
         * Uncomment if no config provided in host panel
         */
        //$this->setGmailConfig();
    }

    /**
     * @param $name
     */
    public function setFromName($name)
    {
        $this->FromName = $name;
    }

    /**
     * @return string
     */
    public function isSend()
    {
        return parent::Send() ? 'success' : 'error';
    }

    /**
     * @param $files
     */
    public function handleAttachment($files)
    {
        foreach ($files as $item) {
            parent::addAttachment($item['tmp_name'], $item['name'], 'base64', $item['type']);
        }
    }

    /**
     * Set Config method
     * If no email configured in cpanel
     */
    private function setGmailConfig()
    {
        $this->IsSMTP();
        $this->SMTPDebug = 0;
        $this->SMTPAuth = true;
        $this->SMTPSecure = 'ssl';
        $this->Host = "smtp.gmail.com";
        $this->Port = 465; // or 587
        $this->Username = 'username@gmail.com';
        $this->Password = 'password';
    }

}

