<?php
require './vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

$config = [
   'facebook' => [
  	'token' => 'EAANOvZBXEOzwBAPgubi86sTE5CqhlcqIsFxGZBmIiTtneJxaZAiGa5LKl2eJFWjSroZBPZB1G7ysbVzJZACuYZCqO3yFciCBVfQwIArKUaxGHSEs4eZCDOLIv7sQgZCO0AU1LkdVsE0DmcZC6mcvxuWH0ZAgD3hGdfDupc6zNEjeZCmTmQZDZD',
	'app_secret' => '5bd19fb4829097baac701d0206483c3f',
    'verification'=>'abc_123',
]
];

// Load the driver(s) you want to use
DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

// Create an instance
$botman = BotManFactory::create($config);

// Give the bot something to listen for.
$botman->hears('hello', function (BotMan $bot) {
    $bot->reply('Hello yourself.');
});
$botman->hears('hi', function (BotMan $bot) {
    $bot->reply('huhuhuhu');
});



// Start listening
$botman->listen();
