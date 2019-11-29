
<?php
require __DIR__ . '/../vendor/autoload.php';
use seregazhuk\PinterestBot\Factories\PinterestBot;
$comments = ['Nice!', 'Cool!', 'Very beautiful!', 'Amazing!'];
$bot = PinterestBot::create();
$bot->auth->login( getenv('USERNAME'),  getenv('PASS'));
//echo(getenv('USERNAME'));
$board = $bot->boards->info('pawelterlecki', 'Food Recipes');
$pins = $bot->topics->pins('food recipes')->take(5)->toArray();
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
    $bot->boards->follow($info['id']);
    $test = $bot->boards->followers($info['id'])->take(1)->toArray();
    //print_r($test);
    //$bot->comments->create($pin['id'], $comment);
    sleep(1);
}

$board = $bot->boards->info('pawelterlecki', 'Twitch Streamer');

$pins = $bot->topics->pins('twitch')->take(5)->toArray();
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
    $bot->boards->follow($info['id']);
    $test = $bot->boards->followers($info['id'])->take(1)->toArray();
    //print_r($test);
    //$bot->comments->create($pin['id'], $comment);
    sleep(1);
}

