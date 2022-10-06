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

  // Metodo responsável por retornar os detalhes de paginação
  protected static function getPagination($request, $obPagination){
    //Query Params
    $queryParams = $request->getQueryParams();

    //Pagina
    $pages = $obPagination->getPages();

    // Retorno
    return [
      'pageAtual' => isset($queryParams['page']) ? (int)$queryParams['page'] : '1',
      'quantityPages' => !empty($pages) ? count($pages) : 1
    ];
  }
}