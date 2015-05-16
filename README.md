# NotificationBundle
Provides a notification bundle for Symfony2

## Installation
Install it via composer with:

```
composer require joubjoub/notification-bundle dev-master
```

You should create entities `UserNotification`, `Notification`, and implements the `NotifiableInterface` for your User entity.


## Usage
And then, you should be able to add a notification with the service `joubjoub.notification` like this:

```php
// $users can be an array of NotifiableInterface object, or a NotifiableInterface object
$this->get('joubjoub.notification')->addNotification($users, $notification);
```
## License
This bundle is under MIT License.

## Unit test
Unit tests will come soon.