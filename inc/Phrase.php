<?php

class Phrase {

  public $currentPhrase;
  public $selected = array();
  public $phrase = [
      "Dream Big",
      "Never Give Up",
      "Not all heroes wear capes",
      "The adventure begins",
      "Dream without fear",
      "Love without limits"
      ];

  public function __construct($phrase = null, $selected = null)
  {
      if(!empty($phrase)) {
      $this->currentPhrase = $phrase;
    } elseif (!isset($phrase))  {
        $random = array_rand($this->phrase);
        $this->currentPhrase = $this->phrase[$random];
      }
      if (!empty ($selected)) {
      $this->selected = $selected;
    }
  }

  public function addPhraseToDisplay(){

  $phrasetxt = " ";
  $phrasetxt = "<div class='section' id='phrase'>";

  $characters = str_split(strtolower($this->currentPhrase));

    foreach ($characters as $character) {
    if (in_array($character, $this->selected)) {
        $phrasetxt .= "<li class=\"show letter\">" . $character . "</li>";
      }elseif ($character == " ") {
          $phrasetxt .= "<li class=\"space\">" . $character . "</li>";
      } else {
        $phrasetxt .= "<li class=\"hide letter\">" . $character . "</li>";
        }
      }

  $phrasetxt .= "</div>";
  return $phrasetxt;
    }

    public function getLetterArray()
    {
        return array_unique(str_split(str_replace(' ', '', strtolower($this->currentPhrase))));
    }

    public function checkLetter($letter)
    {
      if (in_array($letter, $this->getLetterArray())) {
          return true;
      } else {
          return false;
      }
    }
  public function numberLost()
     {
         return count(array_diff($this->selected, $this->getLetterArray()));
     }





}
 ?>
