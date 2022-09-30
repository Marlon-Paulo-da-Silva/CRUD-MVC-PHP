<?php

namespace App\Http\Middleware;

class Maintenance{

  // Metodo responsável por executar o Middleware
  public function handle($request, $next){
    echo '<pre>';
    print_r($request);
    echo '</pre>';
    exit;
  }
}