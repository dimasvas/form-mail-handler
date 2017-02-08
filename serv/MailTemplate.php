<?php

/**
 * This file is part of Form Handler package
 * (c) Dimitry Vasilenko <dmv.developer@gmail.com>
 */

/**
 * Class MailTemplate
 */
class MailTemplate
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * MailTemplate constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getContent()
    {
        return [
            'subject' => $this->getSubject(),
            'body' => $this->getBody()
        ];
    }

    /**
     * @return string
     */
    private function getSubject()
    {
        return 'Just a simple subject';
    }

    /**
     * @return string
     */
    private function getBody()
    {
        return <<<EOT
        <html>
            <body>
                <table rules="all" width='500px' cellspacing="0" border="0" cellpadding="10">
                    <tr>
                        <td><strong>Name</strong></td>
                        <td class="content">{$this->data['name']}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td class="content">{$this->data['email']}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td class="content">{$this->data['address']}</td>
                    </tr>
                     <tr>
                        <td><strong>Phone</strong></td>
                        <td class="content">{$this->data['phone']}</td>
                    </tr>
                    <tr>
                        <td><strong>Message</strong></td>
                        <td class="content">{$this->data['message']}</td>
                    </tr>
                </table>
            </body>
        </html>
EOT;
    }
}