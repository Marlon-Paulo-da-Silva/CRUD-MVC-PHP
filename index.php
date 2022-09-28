<?php

require __DIR__ . '/vendor/autoload.php';
use App\Utils\Uri;

$base = new URI();
$base =  $base->base();

define('URL', 'http://localhost/mvc-php');
// define('URL', $base);

use App\Http\Router;

$obRouter = new Router(URL); 


include __DIR__ . '/app/Routes/pages.php';

$obRouter->run()->sendResponse();
