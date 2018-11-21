<?php

namespace App\Controllers;

require 'app/helpers/entropie_include.php';


class HuffmanControler {

  public $text;

  public $span;
  public $occurences;
  public $total;
  public $entropy;

  public $binary_values;
  public $hoffman;
  public $compressed;


  public function control() {
    if (isset($_POST["text"])) {
      $text = $_POST["text"];
      if ($text) {
        $this->init();
      }
    }
    require "views/huffman.view.php";
  }

  private function init() {
    $this->count_occurences();
    $this->compute_entropy();
    $this->binary_value();
    $this->huffman();
    $this->compress();
  }

  private function count_occurences() {
    $this->text = $_POST["text"];
    list($this->occurences, $this->total) = occurences($_POST["text"]);
    $this->span = $this->occurences;
  }

  private function compute_entropy() {
    $this->entropy = calculer_entropie($this->occurences, $this->total);
  }


  private function last_key_value() {
    $val = end($this->occurences);
    $key = key($this->occurences);
    array_pop($this->occurences);
    return [$key, $val];
  }

  private function update_arrays($a, $b) {
    $this->occurences[$a[0] . $b[0]] = $b[1] + $b[1];
    $this->binary_values[$a[0]] = 0;
    $this->binary_values[$b[0]] = 1;
  }

  private function binary_value() {
    while (count($this->occurences) > 1) {

      arsort($this->occurences);

      $this->update_arrays($this->last_key_value(), $this->last_key_value());
    }
  }

  private function huffman() {
    $this->hoffman = array_reverse($this->binary_values);

    foreach ($this->binary_values as $letters => $bin) {

      $splitted = str_split($letters);

      if (count($splitted) > 1) {
        foreach ($splitted as $letter) {
          $this->hoffman[$letter] = $bin . $this->hoffman[$letter];
        }
        unset($this->hoffman[$letters]);
      }
    }
  }

  private function compress() {
    $this->compressed = "";
    $splitted = str_split($this->text);
    foreach ($splitted as $letter) {
      $this->compressed = $this->compressed . $this->hoffman[$letter];
    }
  }


  /**
   * @param string à échapper
   *
   * @return string échappée
   */
  public function html_protect($string) {
    return (ctype_graph($string)
      ? htmlentities($string, ENT_HTML5, "UTF-8")
      : "ASC " . join(", ", array_map("ord", str_split($string))));
  }

  /**
   * @param array[string]string $a tableau associatif à afficher, suppose
   *                               que $value est déjà échappé
   */
  public function dump($array) {
    foreach ($array as $key => $value) {
      echo "<li><code>" . $this->html_protect($key) . ": " . $value . "</code></li>";
    }
  }
}

