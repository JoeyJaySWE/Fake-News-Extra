<?php
declare(strict_types=1);

include "../data.php";
include "../functions.php";

session_start();

$query = 'INSERT INTO posts (title, story, author, publish_date) VALUES
                            (:title, :story, :author, :publish_date)';

$data = [
    'title' => $_POST['news_title'],
    'story' => $_POST['news_story'],
    'author' => $_SESSION['user'],
    'publish_date' => date('d-m-Y') 
];         

$add_story = db()->prepare($query);

// die(var_dump($_SESSION['user']));

$add_story->execute($data);

            header('location:'. __DIR__  . "/");



?>