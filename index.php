<?php

include __DIR__ . '/includes/app.php';
use App\Http\Router;

// inicia o Router
$obRouter = new Router(URL); 

include __DIR__ . '/app/Routes/pages.php';

$obRouter->run()
          ->sendResponse();