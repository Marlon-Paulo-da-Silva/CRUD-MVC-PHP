<?php

namespace App\Http\Middleware;

class Queue {

  // fila de Middlewares à serem executados
  private $middlewares = [];

  // Função de execução do controlador (Closure)
  private $controller;

  // argumentos da função do controlador
  private $controllerArgs = [];

  // Metodo responsável por contruir a classe de fila de Middleware
  public function __construct($middlewares, $controller, $controllerArgs)
  {
    $this->middlewares = $middlewares;
    $this->controller = $controller;
    $this->controllerArgs = $controllerArgs;


  }


  
}