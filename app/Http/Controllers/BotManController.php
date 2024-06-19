<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
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

        // Initial greeting with options
        $botman->hears('hello|hi|start', function (BotMan $bot) {
            $question = Question::create('Bonjour! Êtes-vous un voyageur, un bailleur, ou un prestataire?')
                ->addButtons([
                    Button::create('Voyageur')->value('voyageur'),
                    Button::create('Bailleur')->value('bailleur'),
                    Button::create('Prestataire')->value('prestataire'),
                ]);
            $bot->reply($question);
        });

        // Handle button clicks
        $botman->hears('voyageur', function (BotMan $bot) {
            $question = Question::create('Bonjour Voyageur! Comment puis-je vous aider aujourd\'hui?')
                ->addButtons([
                    Button::create('Comment faire une réservation?')->value('Comment faire une réservation?'),
                    Button::create('Quels sont les services disponibles?')->value('Quels sont les services disponibles?'),
                    Button::create('Comment annuler une réservation?')->value('Comment annuler une réservation?'),
                ]);
            $bot->reply($question);
        });

        $botman->hears('bailleur', function (BotMan $bot) {
            $question = Question::create('Bonjour Bailleur! Comment puis-je vous aider aujourd\'hui?')
                ->addButtons([
                    Button::create('Comment ajouter un bien?')->value('Comment ajouter un bien?'),
                    Button::create('Comment gérer mes réservations?')->value('Comment gérer mes réservations?'),
                    Button::create('Quels sont les services de maintenance disponibles?')->value('Quels sont les services de maintenance disponibles?'),
                ]);
            $bot->reply($question);
        });

        $botman->hears('prestataire', function (BotMan $bot) {
            $question = Question::create('Bonjour Prestataire! Comment puis-je vous aider aujourd\'hui?')
                ->addButtons([
                    Button::create('Comment proposer mes services?')->value('Comment proposer mes services?'),
                    Button::create('Comment gérer mes prestations?')->value('Comment gérer mes prestations?'),
                    Button::create('Comment obtenir des contrats?')->value('Comment obtenir des contrats?'),
                ]);
            $bot->reply($question);
        });

        // Handle specific questions
        $botman->hears('Comment faire une réservation?', function (BotMan $bot) {
            $bot->reply('Pour faire une réservation, veuillez visiter notre page de réservation et sélectionner le bien qui vous intéresse.');
        });

        $botman->hears('Quels sont les services disponibles?', function (BotMan $bot) {
            $bot->reply('Nous offrons divers services, y compris le nettoyage, l\'entretien, et l\'assistance à l\'arrivée et au départ. Pour plus de détails, veuillez consulter notre page des services.');
        });

        $botman->hears('Comment annuler une réservation?', function (BotMan $bot) {
            $bot->reply('Pour annuler une réservation, veuillez vous connecter à votre compte et accéder à la section de gestion des réservations.');
        });

        $botman->hears('Comment ajouter un bien?', function (BotMan $bot) {
            $bot->reply('Pour ajouter un bien, veuillez vous connecter à votre compte bailleur et utiliser le formulaire d\'ajout de bien disponible dans le tableau de bord.');
        });

        $botman->hears('Comment gérer mes réservations?', function (BotMan $bot) {
            $bot->reply('Vous pouvez gérer vos réservations via votre tableau de bord bailleur. Connectez-vous à votre compte pour voir toutes vos réservations.');
        });

        $botman->hears('Quels sont les services de maintenance disponibles?', function (BotMan $bot) {
            $bot->reply('Nous offrons divers services de maintenance, y compris la réparation, la peinture, et les travaux de plomberie. Consultez notre page des services pour plus de détails.');
        });

        $botman->hears('Comment proposer mes services?', function (BotMan $bot) {
            $bot->reply('Pour proposer vos services, veuillez créer un compte prestataire et compléter le formulaire de proposition de services disponible dans votre tableau de bord.');
        });

        $botman->hears('Comment gérer mes prestations?', function (BotMan $bot) {
            $bot->reply('Vous pouvez gérer vos prestations via votre tableau de bord prestataire. Connectez-vous à votre compte pour voir toutes vos prestations.');
        });

        $botman->hears('Comment obtenir des contrats?', function (BotMan $bot) {
            $bot->reply('Pour obtenir des contrats, assurez-vous que votre profil est à jour et proposez des services de haute qualité. Les bailleurs peuvent vous contacter directement via notre plateforme.');
        });

        $botman->hears('start conversation', function (BotMan $bot) {
            $bot->startConversation(new ExampleConversation());
        });

        $botman->listen();
    }

    public function widget()
    {
        return view('layouts.chatbot');
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