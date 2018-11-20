<?php

/**
 * @param string $t source dont les symboles sont à compter
 * @return array(array[string]integer tableau associatif symbole => occurences,
 *               integer nombre d'occurences totales) tableau
 */
function occurences($t) {
    $a = array_count_values(str_split($t));
    $total = strlen($t);
    

    return array($a, $total);
}

/**
 * @param array[string]integer $o tableau associatif symbole => occurences
 * @param integer $t nombre total d'occurences
 * @return float valeur de l'entropie sur $o
 */
function calculer_entropie($o, $t) {
   $H = 0;
    foreach ($o as $symbol => $count) {
        $Pi = $count/$t;
        $Hi = -log($Pi)/log(2);
        $H += $Pi * $Hi;
    }

   return $H;
}
