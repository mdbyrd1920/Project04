<?php

class Game
{

  private $phrase;
  private $lives = 5;

  public function __construct($phrase)
    {
      $this->phrase = $phrase;
    }

  public function displayKeyboard()

    {
        $keyboard = " ";

        $keyboard .= "<form action= 'play.php' method= 'POST'>";

        $keyboard .= "<div id=\"qwerty\" class=\"section\">";
        $keyboard .= "<div class=\"keyrow\">";
        $keyboard .= $this->key('q');
        $keyboard .= $this->key('w');
        $keyboard .= $this->key('e');
        $keyboard .= $this->key('r');
        $keyboard .= $this->key('t');
        $keyboard .= $this->key('y');
        $keyboard .= $this->key('u');
        $keyboard .= $this->key('i');
        $keyboard .= $this->key('o');
        $keyboard .= $this->key('p');
        $keyboard .= "</div>";

        $keyboard .= "<div class=\"keyrow\">";
        $keyboard .= $this->key('a');
        $keyboard .= $this->key('s');
        $keyboard .= $this->key('d');
        $keyboard .= $this->key('f');
        $keyboard .= $this->key('g');
        $keyboard .= $this->key('h');
        $keyboard .= $this->key('j');
        $keyboard .= $this->key('k');
        $keyboard .= $this->key('l');
        $keyboard .= "</div>";

        $keyboard .= "<div class=\"keyrow\">";
        $keyboard .= $this->key('z');
        $keyboard .= $this->key('x');
        $keyboard .= $this->key('c');
        $keyboard .= $this->key('v');
        $keyboard .= $this->key('b');
        $keyboard .= $this->key('n');
        $keyboard .= $this->key('m');

        $keyboard .= "</div>";
        $keyboard .= "</div>";
        $keyboard .= "</form>";

//Need to return HTML here
//return
        return $keyboard;
        }


  public function key($letter)
      {
          if (!in_array($letter, $this->phrase->selected)) {
              return "<input id='" . $letter . "' type='submit' name='key' value='" . $letter . "' class='key'>";
          } else {
              if ($this->phrase->checkLetter($letter)) {
                  return "<input id='" . $letter . "' type='submit' name='key' value='" . $letter . "' class='key correct' disabled>";
              } else {
                  return "<input id='" . $letter . "' type='submit' name='key' value='" . $letter . "' class='key incorrect' disabled>";
              }
          }
      }


  public function displayScore()
  {

  $score = " ";
  $score .=  "<div id=\"scoreboard\" class=\"section\">";

    for ($i=1; $i <= $this->phrase->numberLost(); $i++) {
             $score .= '<li class="tries"><img src="images/lostHeart.png" height="35px" width="30px"></li>';
         }
    for ($i = 1; $i <= ($this->lives - $this->phrase->numberLost()); $i++) {
             $score .= '<li class="tries"><img src="images/liveHeart.png" height="35px" width="30px"></li>';
         }
  $score .= "</div>";

    return $score;

  }

  public function checkForLose()
  {
    if ($this->phrase->numberLost() == $this->lives) {
        return true;
    } else {
        return false;
        }
  }


  public function checkForWin()
  {
    if (count(array_intersect($this->phrase->selected,
      $this->phrase->getLetterArray()))
    == count($this->phrase->getLetterArray())) {
        return true;
    } else {
        return false;
          }
  }


  public function gameOver()
  {
    if ($this->checkForLose() == true) {
        return '<h1> The phrase was: "' . $this->phrase->currentPhrase . '". Better luck next time!</h1>
        <form action="play.php" method="POST">
        <input id="btn__reset" type="submit" name="start" value="Play Again?" />
        </form>
        </div>';
    } elseif ($this->checkForWin() == true) {
        return '<h1> Congratulations on guessing: "' . $this->phrase->currentPhrase . '"</h1>
        <form action="play.php" method="POST">
        <input id="btn__reset" type="submit" name="start" value="Play Again?" />
        </form>
        </div>';
    } else {
        return false;
    }
  }




}
 ?>
