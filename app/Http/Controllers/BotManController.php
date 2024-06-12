<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Conversations\Conversation;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    public function handle()
    {
        $config = [];
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
        $botman = BotManFactory::create($config);

        // Simple command
        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello! How can I assist you today?');
        });

        // Command with parameter
        $botman->hears('my name is {name}', function (BotMan $bot, $name) {
            $bot->reply('Nice to meet you, ' . $name);
        });

        // Start a conversation
        $botman->hears('start conversation', function (BotMan $bot) {
            $bot->startConversation(new ExampleConversation());
        });

        $botman->listen();
    }
}

class ExampleConversation extends Conversation
{
    protected $name;

    public function askName()
    {
        $this->ask('What is your name?', function (Answer $answer) {
            $this->name = $answer->getText();
            $this->say('Nice to meet you, ' . $this->name);
        });
    }

    public function run()
    {
        $this->askName();
    }
}