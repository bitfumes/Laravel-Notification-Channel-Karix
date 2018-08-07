# Karix Sms notifications channel for Laravel 5.4+

[![Build Status](https://travis-ci.org/s-sarthak/Laravel-Notification-Channel-KarixSms.svg?branch=master)](https://travis-ci.org/s-sarthak/Laravel-Notification-Channel-KarixSms)
[![StyleCI](https://github.styleci.io/repos/143913511/shield?branch=master)](https://github.styleci.io/repos/143913511)


This package makes it easy to send sms via [Karix.io](https://karix.io) with Laravel 5.4+.

## Installation

You can install the package via composer:
``` bash
composer require laravel-notification-channels/karix-sms
```

### Setting up the Karix id and token

Login to Karix.io and get your ID and Token, put that on your .env file and
add your Karix Id and Token to your `config/services.php`:

```php
// config/services.php
...
    'karix' => [
        'id' => env('KARIX_ID'),
        'token' => env('KARIX_TOKEN'),
    ],
...
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use NotificationChannels\Karix\KarixSmsChannel;
use NotificationChannels\Karix\KarixSms;
use Illuminate\Notifications\Notification;

class YourNotification extends Notification
{
    public function via($notifiable)
    {
        return [KarixSmsChannel::class];
    }

    public function toKarix($notifiable)
    {
        return KarixSms::create()
                        ->to('+1XXXXXXXXXX')
                        ->from('+1XXXXXXXXXX')
                        ->content('Your message comes here');
    }
}
```


In order to let your Notification know that there is a new channel called KarixSmsChannel, add the `routeNotificationForKarix` method to your Notifiable model (probably your user.php file).

This method needs to return email of the user (if it's a private board) and the list ID of the Trello list to add the card to.

```php
public function routeNotificationForKarix()
{
    return $this->email;
}
```

### Available methods

- `version('')`: Accepts a string value for the Karix api version.
- `timezone('')`: Accepts a string value for the TimeZone if you want to set for sms.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email sarthak@bitfumes.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Sarthak Shrivastava](https://github.com/s-sarthak)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.