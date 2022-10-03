<?php

namespace App\Controller\Admin;
use App\Utils\View;

class Login extends Page{
  
  //Metodo retornar a renderização da página de login
  public static function getLogin($request){

    // Conteudo da página de login
    $content = View::render('admin/login', [

    ]);

    //Retorna a página completa

    return parent::getPage('Login - Sistma', $content);
  }
}