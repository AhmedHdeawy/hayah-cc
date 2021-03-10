<?php
namespace App\Services;

use LaravelFCM\Facades\FCM;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class SendNotification {

    /**
     * @param array $tokens
     * @param array $data
     * @return bool
     * @throws InvalidOptionsException
     */
    public static function send(array $tokens, array $data = [])
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);
        $option = $optionBuilder->build();

        $notificationBuilder = new PayloadNotificationBuilder();
        $notificationBuilder->setTitle($data['title'])
        ->setBody($data['body']);
        $notification = $notificationBuilder->build();

        if (count($tokens)) {

            $downstreamResponse = FCM::sendTo($tokens, $option, $notification);
    
            Log::info('Noti');
            Log::info($downstreamResponse->numberFailure());
            
            return $downstreamResponse->numberFailure() == 0;
        }
        Log::info('No-Noti');
    }
}