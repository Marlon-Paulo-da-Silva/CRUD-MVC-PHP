<?php

namespace App\Controller\Pages;

use App\Utils\View;

class Home extends Page {
  public static function getHome(){
    $content = View::render('pages/home', [
      'name' => 'Marlon',
      'phone' => '1899797494',
      'description' => 'programador'
    ]);

    return parent::getPage('Marlon Titulo',$content);
  }
}