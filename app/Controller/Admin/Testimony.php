<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\User;
use App\Session\Admin\Login as SessionAdminLogin;
use App\Model\Entity\Testimony as EntityTestimony;
use App\Db\Pagination;

class Testimony extends Page{

  public static function getTestimonyItems($request, &$obPagination){
    //depoimentos
    $items = '';

    // quantidade total de registros
    $totalQuantity = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtde')->fetchObject()->qtde;

    
    // pagina atual
    $queryParams = $request->getQueryParams();
    $pageAtual = $queryParams['page'] ?? 1;

    //instancia de paginação (define a quantidade total, pagina atual, quant. paginas)
    $obPagination = new Pagination($totalQuantity, $pageAtual, 5);
    
    $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

    // Renderiza o item
    while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
      
      $content = View::render('admin/modules/testimonies/item',[
        'id' => $obTestimony->id,
        'name' => $obTestimony->name,
        'date' => date('d/m/Y H:i:s', strtotime($obTestimony->date)),
        'message' => $obTestimony->message
      ]);
      
      $items .= $content;
    } 

    // retorna os depoimentos
    return $items;
  }
  
  //Metodo responsável por renderizar a view de listagem de depoimentos
  public static function getTestimonies($request){
    // Conteúdo da Home
    $content = View::render('admin/modules/testimonies/index',[
      'itens' => self::getTestimonyItems($request, $obPagination),
      'pagination' => parent::getPagination($request, $obPagination)
    ]);

    // Retorna a pagina completa
    return parent::getPanel('Depoimentos > Inicial', $content,'testimonies');
  }

  

}