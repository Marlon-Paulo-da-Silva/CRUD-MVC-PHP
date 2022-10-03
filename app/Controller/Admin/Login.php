<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\User;

class Login extends Page{
  
  //Metodo retornar a renderização da página de login
  public static function getLogin($request, $errorMessage = null){

    //Status
    $status = !is_null($errorMessage) ? View::render('admin/login/status', [
      'message' => $errorMessage
    ]) : '';

    // Conteudo da página de login
    $content = View::render('admin/login', [
      'status' => $status
    ]);

    //Retorna a página completa

    return parent::getPage('Login - Sistma', $content);
  }

  //Metodo responsável por definir o login do ususáreio
  public static function setLogin($request){

    // postVars que estão os dados vindo do POST
    $postVars = $request->getPostVars();
    $email = $postVars['email'] ?? '';
    $passwrd = $postVars['passwrd'] ?? '';


    // Busca o usuário pelo e-mail
    $obUser = User::getUserByEmail($email);
    if (!$obUser instanceof User) {
      return self::getLogin($request, 'E-mail ou senha inválidos');
    }

    // Verifica a senha do Usuário
    if(!password_verify($passwrd, $obUser->passwrd)){
      return self::getLogin($request, 'E-mail ou senha inválidos');
    }
    
    // // Conteudo da página de login
    // $content = View::render('admin/login', [

    // ]);

    // //Retorna a página completa

    // return parent::getPage('Login - Sistma', $content);
  }
}