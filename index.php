<?php

require __DIR__ . '/vendor/autoload.php';

define('URL', 'http://localhost/mvc-php');

use App\Http\Router;

$obRouter = new Router(URL); 

include __DIR__ . '/app/Routes/pages.php';

$obRouter->run()->sendResponse();
