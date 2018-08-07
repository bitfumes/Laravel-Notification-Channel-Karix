<?php

namespace NotificationChannels\Karix;

class KarixSms
{
    /**
     * The message to.
     *
     * @var string
     */
    public $to;

    /**
     * The message content.
     *
     * @var string
     */
    public $content;

    /**
     * The phone number the message should be sent from.
     *
     * @var string
     */
    public $from;

    /**
     * Setting Up the app version
     *
     * @var string
     */
    public $version = '1.0';

    /**
     * Setting Up the timezone
     *
     * @var string
     */
    public $timezone = 'UTC';

    /**
     * @param string $name
     *
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Set the message content.
     *
     * @param  string  $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the phone number the message should be sent from.
     *
     * @param  string  $from
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Set the phone number to send message.
     *
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

    public function version($version)
    {
        $this->version = $version;
        return $this;
    }

    public function timezone($zone)
    {
        $this->timezone = $zone;
        return $this;
    }
}
