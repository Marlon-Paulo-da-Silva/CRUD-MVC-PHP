<?php

namespace App\Http\Middleware;

class Api{

  // Metodo responsável por executar o Middleware
  public function handle($request, $next){
    // Altera o CONTENT TYPE para JSON
    $request->getRouter()->setContentType('application/json');
    // $request->getRouter()->redirect('/admin/login');

    // Executa o próximo nível do Middleware
    return $next($request);
  }
}