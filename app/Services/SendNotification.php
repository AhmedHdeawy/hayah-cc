<?php
namespace App\Services;

use LaravelFCM\Facades\FCM;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class SendNotification {

    /**
     * @param array $token
     * @param array $data
     * @return bool
     * @throws InvalidOptionsException
     */
    public static function send(array $token, array $data = [])
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);
        $option = $optionBuilder->build();

        $notificationBuilder = new PayloadNotificationBuilder();
        $notificationBuilder->setTitle($data['title'])
        ->setBody($data['body']);
        $notification = $notificationBuilder->build();

        $downstreamResponse = FCM::sendTo($token, $option, $notification);

        Log::info('Noti');
        Log::info($downstreamResponse->numberFailure());

        return $downstreamResponse->numberFailure() == 0;
    }
}