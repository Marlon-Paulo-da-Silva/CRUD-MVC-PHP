<?php

require __DIR__ . '/vendor/autoload.php';

define('URL', 'http://localhost/mvc-php');

use App\Controller\Pages\Home;
use App\Http\Response;
use App\Http\Router;


$obRouter = new Router(URL); 

$obRouter->get('/',[
  function(){
    return new Response(200, Home::getHome());
  }
]);



$obRouter->run()->sendResponse();
