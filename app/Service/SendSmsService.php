<?php

namespace App\Service;

class SendSmsService
{
    public static function sendSms($to, $message): bool
    {
        $twilio = new Client(TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN);
        try {
            $twilio->messages->create(
                $to,
                [
                    'from' => TWILIO_PHONE_NUMBER,
                    'body' => $message
                ]
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}