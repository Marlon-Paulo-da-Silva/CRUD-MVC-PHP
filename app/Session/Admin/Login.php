<?php

namespace App\Session\Admin;

class Login {

  // Metodo responsável por iniciar a sessão
  private static function init(){

    // Verifica se a sessão não está ativa
    if(session_status() != PHP_SESSION_ACTIVE){
      session_start();
    }
  }

  //Metodo responsável por criar o login do usuário
  public static function login($obUser){

    self::init();

    // Define a sessão do usuário
    $_SESSION['admin']['usuario'] = [
      'id' => $obUser->id_client,
      'nome' => $obUser->username,
      'email' => $obUser->email
    ];

    // Sucesso
    return true;
  }
}

?>