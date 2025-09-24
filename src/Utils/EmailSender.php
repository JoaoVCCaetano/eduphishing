<?php
namespace App\Utils;

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

class EmailSender {
    public static function sendVerification($to, $token) {
        $client = new SesClient([
            'version' => 'latest',
            'region'  => getenv('AWS_REGION'),
            'credentials' => [
                'key'    => getenv('AWS_ACCESS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $subject = 'Confirme seu e-mail';
        $body = 'Clique no link para confirmar seu e-mail: ' . getenv('APP_URL') . '/verify-email?token=' . $token;

        $sourceEmail = getenv('AWS_SOURCE_EMAIL');
        if (!$sourceEmail) {
            error_log('AWS_SOURCE_EMAIL não definido');
            return false;
        }
        try {
            $result = $client->sendEmail([
                'Source' => $sourceEmail,
                'Destination' => [
                    'ToAddresses' => [$to],
                ],
                'Message' => [
                    'Subject' => [
                        'Data' => $subject,
                        'Charset' => 'UTF-8',
                    ],
                    'Body' => [
                        'Text' => [
                            'Data' => $body,
                            'Charset' => 'UTF-8',
                        ],
                    ],
                ],
            ]);
            return true;
        } catch (AwsException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
