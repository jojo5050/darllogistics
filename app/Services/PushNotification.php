<?php

namespace App\Services;

use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class PushNotification
{
    protected $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    /**
     * Send a push notification to a specific FCM token.
     *
     * @param string $token
     * @param string $title
     * @param string $body
     * @param array  $data (optional key-value data)
     * @return mixed
     */
    public function sendToToken(string $token, string $title, string $body)
    {
        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('token', $token)
            ->withNotification($notification);
            // ->withData($data);

        return $this->messaging->send($message);
    }
}
