<?php

namespace App\Controller\Api;

class Api {

  // Metodo responsável por retornar os detalhes da API
  public static function getDetails($request){
    return [
      'name' => 'API - CRUD MVC',
      'versão' => 'v1.0.0',
      'author' => 'Marlon Paulo',
      'email' => 'marlon.pauloo@gmail.com'
    ];
  }
}