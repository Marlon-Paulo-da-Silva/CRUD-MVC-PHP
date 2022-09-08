<?php

namespace App\Utils;

class View {

  private static function getContentView($view){
    $file = __DIR__ . '/../../resources/view/'. $view . '.html';

    return file_exists($file) ? file_get_contents($file) : '';
  }

  public static function render($view, $vars = []){
    $contentView = self::getContentView($view);

    $keys = array_keys($vars);
    $keys = array_map(function($item){
      return '{{'. $item .'}}';
    }, $keys);

    // echo '<pre>';
    // print_r($keys);
    // exit;


    
    // foreach ($vars as $key => $value){
    //   $find[] = "{{$key}}";
    //   $replace[] = $value;
    // }

    return str_replace($keys, array_values($vars), $contentView);
    // return str_replace($find, $replace, $contentView);

    return $contentView;
  }
}