<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Page {

  // Modulos disponíveis no painel
  private static $modules = [
    'home' => [
      'label' => 'Home',
      'link' => URL . '/admin'
    ],
    'testimonies' => [
      'label' => 'Depoimentos',
      'link' => URL . '/testimonies'
    ],
    'users' => [
      'label' => 'Usuários',
      'link' => URL . '/users'
    ],
  ];

  // Metodo responsável por retornar o conteúdo (view) da estrutura de páginas
  public static function getPage($title, $content){
    return View::render('admin/page',[
      'title' => $title,
      'content' => $content
    ]);
  }

  // Metodo responsável por renderizar a view do Menu do painel 
  private static function getMenu($currentModule){

    // Links do Menu
    $links = '';

    //itera os modulos
    foreach(self::$modules as $hash => $module){
      $links .= View::render('admin/menu/link',[
        'label' => $module['label'],
        'link' => $module['link'],
        'current' => $hash == $currentModule ? 'text-danger' : ''
      ]);
    }

    // retorna a renderização do menu
    return View::render('admin/menu/box', [
      'links' => $links
    ]);
  }

  
  /**
   * Metodo responsável por renderizar a view do painel com conteudo dinamico
   * 
   * @param title The title of the panel.
   * @param content The content of the panel.
   * @param currentModule The current module that is being displayed.
   */
  public static function getPanel($title, $content, $currentModule){

    // renderiza a view do painel
    $contentPanel = View::render('admin/panel', [
      'menu' => self::getMenu($currentModule),
      'content' => $content
    ]);

    // retorna a página renderizada
    return self::getPage($title, $contentPanel);
  }
}