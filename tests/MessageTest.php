<?php

namespace NotificationChannels\Karix\Tests;

use Orchestra\Testbench\TestCase;
use Bitfumes\KarixNotificationChannel\KarixMessage;

class MessageTest extends TestCase
{
    public $message;

    public function setup()
    {
        parent::setUp();
        $this->message = new KarixMessage();
    }

    /**
     * @test
     */
    public function it_can_set_message_content()
    {
        $content = 'Hello World';
        $this->message->content($content);
        $this->assertEquals($this->message->content, $content);
    }

    /**
     * @test
     */
    public function it_can_set_message_to()
    {
        $number = '+919090909090';
        $this->message->to($number);
        $this->assertEquals($this->message->to, [$number]);
    }

    /**
     * @test
     */
    public function it_can_set_message_from()
    {
        $from = '+919090909090';
        $this->message->from($from);
        $this->assertEquals($this->message->from, $from);
    }

    /**
     * @test
     */
    public function it_can_set_message_api_version()
    {
        $api = '1.0';
        $this->message->version($api);
        $this->assertEquals($this->message->version, $api);
    }

    /**
     * @test
     */
    public function it_can_set_message_timezone()
    {
        $timezone = 'New Timezone';
        $this->message->timezone($timezone);
        $this->assertEquals($this->message->timezone, $timezone);
    }
}
