<?php


session_start();


error_reporting(0);
// Turn off error -- Undefined index: phrase in play.php line 29


require_once 'inc/config.php';
require 'inc/Game.php';
require 'inc/Phrase.php';


  if(isset($_POST['start'])) {
     unset($_SESSION['selected']);
     unset($_SESSION['phrase']);
     $phrase = new Phrase();
   }

$phrase = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_STRING);
  if (!empty($phrase)) {
    session_destroy();
  }

  if (isset($_SESSION['selected']) && isset($_POST['key'])) {
      $_SESSION['selected'][] = $_POST['key'];
  } else {
      $_SESSION['selected'] = [];
  }

//Instantiate phrase class
$phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
$_SESSION['phrase'] = $phrase->currentPhrase;

//Instantiate game class
$game = new Game($phrase);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
<div class="main-container">

  <!-- gradient background snippet from https://www.w3docs.com/snippets/html/how-to-set-background-color-in-html.html-->

<body style="background-image: linear-gradient(to right, #1c87c9, #8ebf42);">


  <h2 class="header">Phrase Hunter</h2>

  <?php

//Display Phrase Block
echo $phrase->addPhraseToDisplay();

//Display Keyboard
echo $game->displayKeyboard();

//Display score/hearts
echo $game->displayScore();

//display when game is over/restart game
echo $game->gameOver();


//var_dump($_SESSION);

   ?>

  <form action="play.php" method="post">
</form>
</div>




</body>
</html>
