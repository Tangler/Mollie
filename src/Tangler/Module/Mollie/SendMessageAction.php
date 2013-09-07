<?php

namespace Tangler\Module\Mollie;

use Tangler\Core\Interfaces\ActionInterface;
use Tangler\Core\AbstractAction;
use mollie;

class SendMessageAction extends AbstractAction implements ActionInterface
{
    public function Init()
    {
        $this->setKey('new_message');
        $this->setLabel('New message action');
        $this->setDescription('This action sends a new SMS message');


        $this->parameter->defineParameter('username', 'string', 'Username');
        $this->parameter->defineParameter('password', 'string', 'Password');
        $this->parameter->defineParameter('message', 'string', 'Message contents');
        $this->parameter->defineParameter('mobile', 'string', 'Recipient mobile number');
        $this->parameter->defineParameter('originator', 'string', 'Originator');
    }

    public function Run($input)
    {
        $username = $this->resolveParameter('username', $input);
        $password = $this->resolveParameter('password', $input);
        $message = $this->resolveParameter('message', $input);
        $mobile = $this->resolveParameter('mobile', $input);
        $originator = $this->resolveParameter('originator', $input);
        if ($originator == '') {
            $originator = 'Tangler';
        }

        echo "\n### SendMessageAction: " . $message . "\n";

        $sms = new mollie();
        
        // Choose SMS gateway
        $sms->setGateway(1);
        // Set Mollie.nl username and password
        $sms->setLogin($username, $password);
        // Set originator
        $sms->setOriginator($originator);

        $mobile=str_replace("-", "", $mobile);
        $mobile=str_replace(" ", "", $mobile);
        $mobile=str_replace(".", "", $mobile);
        $mobile=str_replace("0031", "31", $mobile);


        $sms->addRecipients($mobile);
        // Add reference (needed for delivery reports)
        // $sms->setReference('1234');
        
        // Send the SMS Message
        $sms->sendSMS($message);
    }
}
