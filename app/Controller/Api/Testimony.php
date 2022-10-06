<?php

namespace App\Controller\Api;
use App\Model\Entity\Testimony as EntityTestimony;
use App\Db\Pagination;

class Testimony extends Api{

  // Metodo responsável por retornar os depoimentos cadastrados
  public static function getTestimonyItems($request, &$obPagination){

      //depoimentos
      $items = [];
  
      // quantidade total de registros
      $totalQuantity = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtde')->fetchObject()->qtde;
  
            
      // pagina atual
      $queryParams = $request->getQueryParams();
      $pageAtual = $queryParams['page'] ?? 1;
  
      //instancia de paginação (define a quantidade total, pagina atual, quant. paginas)
      $obPagination = new Pagination($totalQuantity, $pageAtual, 5);
      
      //Pagina
      $pages = $obPagination->getPages();

      $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());
  
      // Renderiza o item
      while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
        
        $items[] = [
          'id' => (int)$obTestimony->id,
          'name' => $obTestimony->name,
          'date' => $obTestimony->date,
          'message' => $obTestimony->message
        ];
        
      } 
  
      // retorna os depoimentos
      return $items;

    }
    
    public static function getTestimonies($request){
    
      return [
        'testimonies' => self::getTestimonyItems($request, $obPagination),
        'pagination' => parent::getPagination($request, $obPagination)
      ];
  }
}