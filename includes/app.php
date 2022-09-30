<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Utils\Uri;
use App\Utils\View;
use App\Utils\Environment;
use App\Db\Database;

//LOAD ENVIRONMENT VARS FROM FILE ON ROOT
Environment::load(__DIR__.'/../');

// $pagination = new Pagination('');

//Define as configurações do banco de dados
Database::config(
  getenv('DB_HOST'),
  getenv('DB_NAME'),
  getenv('DB_USER'),
  getenv('DB_PASS'),
  getenv('DB_PORT')
);


$base = new URI();
$base =  strtolower($base->base());

// define('URL', 'http://localhost/mvc-php');
define('URL', $base);

// Define o valor padrão das variáveis
View::init([
  'URL' => URL
]);

?>