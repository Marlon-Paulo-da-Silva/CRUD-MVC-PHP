<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controller\Pages\Home;
use App\Http\Router;

$obRouter = new Router(''); 

echo '<pre>';
print_r($obRouter);
exit;


echo Home::getHome();