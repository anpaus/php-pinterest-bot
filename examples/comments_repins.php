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
    //print_r($pin['pinner']);
    //print_r($pin['board']);
    /*foreach ($pin as $p) {
        print_r($p);
        echo("<br>");
    }*/
    $bot->pinners->follow($pin['pinner']['username']);
    $info = $bot->boards->info($pin['pinner']['username'], $pin['board']['name']);
    print_r($info['id']);
    //$bot->comments->create($pin['id'], $comment);
    sleep(5);
}
