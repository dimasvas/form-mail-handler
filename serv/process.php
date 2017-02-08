<?php
/**
 * This file is part of Form Handler package
 * (c) Dimitry Vasilenko <dmv.developer@gmail.com>
 *
 * Script to process from data and send via email
 */

require_once 'FormHandler.php';
require_once 'MailHandler.php';
require_once 'MailTemplate.php';

/**
 * Recipient Mail
 */
$recipient = 'dmv.testmail@gmail.com';

/**
 * Form fields
 */
$dataFields = [
    'name' => ['require' => false, 'label' => 'Name'],
    'address' => ['require' => false, 'label' => 'Address'],
    'email' => ['require' => true, 'label' => 'Email'],
    'phone' => ['require' => false, 'label' => 'Phone'],
    'message' => ['require' => false, 'label' => 'Message'],
];

$formHandler = new FormHandler($dataFields);
$contentHandler = new MailTemplate($formHandler->getData());
$requestData = $formHandler->getData();
$mailer = new MailHandler($requestData, $contentHandler->getContent());

/**
 * Set Default English err Message
 */
$mailer->setLanguage('en');

/**
 * Set Up Mailer
 */
$mailer->setContent($contentHandler->getContent());
$mailer->handleAttachment($formHandler->getFiles());
$mailer->setFrom($requestData['email']);
$mailer->AddAddress($recipient);
$mailer->isHTML(true);

/**
 * Send request
 */
echo $mailer->isSend();

