<?php

require 'app/Autoloader.php';
App\Autoloader::register();

$huffmanControler = new App\controllers\HuffmanControler();

ob_start();
$huffmanControler->control();
$content = ob_get_clean();
require 'views/templates/default.php';

