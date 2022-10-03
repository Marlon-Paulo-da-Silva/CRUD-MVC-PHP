<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Page {

  // Metodo responsável por retornar o conteúdo (view) da estrutura de páginas
  public static function getPage($title, $content){
    return View::render('admin/page',[
      'title' => $title,
      'content' => $content
    ]);
  }
}