<?php

namespace NotificationChannels\Karix;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;
use Swagger\Client\Api\MessageApi;
use Swagger\Client\Configuration;
use Swagger\Client\Model\CreateMessage;

class KarixSmsChannel
{
    /**
     * The Karix client instance.
     */
    protected $config;

    /**
     * Create a new Karix channel instance.
     *
     *
     * @param string $from
     *
     * @return void
     */
    public function __construct()
    {
        $this->config = $this->setConfig();
    }

    /**
     * Send the given notification.
     *
     * @param mixed                                  $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('karix', $notification)) {
            return;
        }

        $message_data = $notification->toKarix($notifiable);

        $message = new CreateMessage();
        // Set Timezone
        $this->timezone($message_data->timezone);
        // Set Message Body
        $message->setDestination([$message_data->to]);
        $message->setSource($message_data->from);
        $message->setText($message_data->content);
        // Send Message
        return $this->sendMessage($message_data->version, $message);
    }

    public function timezone($timezone)
    {
        date_default_timezone_set($timezone);
    }

    protected function sendMessage($version, $message)
    {
        $messageApi = app(MessageApi::class);
        $apiInstance = new $messageApi(new Client(), $this->config);

        try {
            $result = $apiInstance->sendMessage($version, $message);

            return $result;
        } catch (Exception $e) {
            echo 'Exception when calling MessageApi->createMessage: ', $e->getMessage(), PHP_EOL;
        }
    }

    protected function setConfig()
    {
        $config = new Configuration();
        $config->setUsername(config('services.karix.id'));
        $config->setPassword(config('services.karix.token'));

        return $config;
    }
}
