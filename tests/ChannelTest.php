<?php

namespace NotificationChannels\Karix\Tests;

use Illuminate\Notifications\Notification;
use NotificationChannels\Karix\KarixSms;
use NotificationChannels\Karix\KarixSmsChannel;
use Orchestra\Testbench\TestCase;
use Swagger\Client\Api\MessageApi;

class ChannelTest extends TestCase
{
    public function setup()
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_can_send_a_notification()
    {
        $this->app['config']->set('services.karix.id', 'TrelloId');
        $this->app['config']->set('services.karix.token', 'TrelloToken');

        $this->app->instance(MessageApi::class, FakeMessageApi::class);

        $channel = new KarixSmsChannel();
        $result = $channel->send(new FakeNotifiable(), new FakeNotification());
        $this->assertTrue($result);
    }
}

class FakeNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return int
     */
    public function routeNotificationForKarix()
    {
        return 'sartak@bitfumes.com';
    }
}
class FakeNotification extends Notification
{
    public function toKarix($notifiable)
    {
        return KarixSms::create()->from('+916261686349')
                                ->to('+916261686349')
                                ->content('hello');
    }
}

class FakeMessageApi
{
    public function sendMessage($version, $message)
    {
        return true;
    }
}
