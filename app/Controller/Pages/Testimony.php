<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Model\Entity\Testimony as EntityTestimony;

class Testimony extends Page {
  public static function getTestimonies(){


    $content = View::render('pages/testimony');

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