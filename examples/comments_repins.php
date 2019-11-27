<?php

require __DIR__ . '/../vendor/autoload.php';

use seregazhuk\PinterestBot\Factories\PinterestBot;

$comments = ['Nice!', 'Cool!', 'Very beautiful!', 'Amazing!'];

$bot = PinterestBot::create();

$bot->auth->login( getenv('USERNAME'),  getenv('PASS'));

//echo(getenv('USERNAME'));
$board = $bot->boards->info('pawelterlecki', 'Finance Tips');

$pins = $bot->pins->search('finance tips')->take(1)->toArray();
//$pins = $bot->pins->feed(5);
    
foreach ($pins as $pin) {
    // repin to our board
    $bot->pins->repin($pin['id'], $board['id']);
    // write a comment
    //$comment = $comments[array_rand($comments)];
    foreach ($pin as $p) {
        print_r($p);
    }
    $bot->pinners->follow($pin['username']);
    $info = $bot->boards->info($pin['username'], $pin['board']['name']);
    print_r($info);
    //$bot->comments->create($pin['id'], $comment);
    sleep(5);
}
