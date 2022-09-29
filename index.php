<?php

require __DIR__ . '/vendor/autoload.php';
use App\Http\Router;
use App\Utils\Uri;
use App\Utils\View;
use App\Utils\Environment;

//LOAD ENVIRONMENT VARS FROM FILE ON ROOT
Environment::load(__DIR__);

//GET ENVIRONMENT VAR
echo getenv('DB_HOST');


$base = new URI();
$base =  strtolower($base->base());

// define('URL', 'http://localhost/mvc-php');
define('URL', $base);

// Define o valor padrão das variáveis
View::init([
  'URL' => URL
]);

// echo '<br><br>BASE URL: ';
// echo '<pre>';
// print_r(URL);
// echo '</pre>';
// die();

// inicia o Router
$obRouter = new Router(URL); 


include __DIR__ . '/app/Routes/pages.php';

$obRouter->run()->sendResponse();
