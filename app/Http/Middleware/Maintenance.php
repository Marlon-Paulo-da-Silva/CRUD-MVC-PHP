<?php

namespace App\Http\Middleware;

class Maintenance{

  // Metodo responsável por executar o Middleware
  public function handle($request, $next){
    return $next($request);
    // echo "Estou no handle do Maintenance";
    // exit;
  }
}