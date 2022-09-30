<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Model\Entity\Testimony as EntityTestimony;
use App\Db\Database;

class Testimony extends Page {

  public static function getTestimonyItems(){
    //depoimentos
    $items = '';

    $results = EntityTestimony::getTestimonies(null, 'id DESC');

    // echo "<pre>";
    // print_r($results->fetchObject(EntityTestimony::class));
    // echo "</pre>";
    // exit;

    // Renderiza o item
    while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
      $content = View::render('pages/testimony/item',[
        'name' => $obTestimony->name,
        'date' => date('d/m/Y H:i:s', strtotime($obTestimony->date)),
        'message' => $obTestimony->message
      ]);
      
      $items .= $content;
    }
    // echo "<pre>";
    // print_r($content);
    // echo $items;
    // echo "</pre>";
    // exit;

    // retorna os depoimentos
    return $items;
  }

  public static function getTestimonies(){
    $content = View::render('pages/testimonies', [
      'items' => self::getTestimonyItems()
    ]);

    return parent::getPage('DEPOIMENTOS',$content);
  }

  public static function insertTestimony($request){
    //Dados do post
    $postVars = $request->getPostVars();

    //nova instancia de depoimento
    $obTestimony = new EntityTestimony;
    $obTestimony->name = $postVars['name'];
    $obTestimony->message = $postVars['message'];
    
    $obTestimony->cadastrar();
    
    echo '<pre>';
    //  echo json_encode($request);
    print_r($postVars);
    echo '</pre>';
    exit;
    
    return self::getTestimonies();
  }
  
}