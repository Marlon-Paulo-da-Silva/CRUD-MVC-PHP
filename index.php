<?php

require __DIR__ . '/vendor/autoload.php';

define('URL', 'http://localhost/mvc-php');

use App\Controller\Pages\Home;
use App\Http\Router;

$obRouter = new Router(URL); 

echo '<pre>';
print_r($obRouter);
exit;


echo Home::getHome();