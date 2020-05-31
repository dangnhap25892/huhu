<?php
require './vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Messages;
use BotMan\BotMan\Facebook\ElementButton;
use BotMan\BotMan\Facebook\ButtonTemplate;
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
$botman->hears('call me {name}', function (BotMan $bot,$name) {
    $bot->reply('bạn tên :' .$name);
});
$botman->hears('type', function (BotMan $bot) {
    $bot->typesAndWaits(2);
    $bot->reply("Tell me more!");
});
$botman->hears('hi', function (BotMan $bot) {
    $bot->reply(ButtonTemplate::create('Do you want to know more about BotMan?')
	->addButton(ElementButton::create('Tell me more')
	    ->type('postback')
	    ->payload('tellmemore')
	)
	->addButton(ElementButton::create('Show me the docs')
	    ->url('http://botman.io/')
	)
);
});
$botman->hears('info', function (BotMan $bot) {
    $user =$bot->getUser();
    $bot->reply('hello'.$user->getFirstName().' '.$user->getLastName());
    $bot->reply('You user nname ís : '.$user->getUsername());
    $bot->reply('You id'.$user->getId());
});



// Start listening
$botman->listen();