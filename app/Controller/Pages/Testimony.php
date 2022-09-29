<?php

namespace App\Controller\Pages;

use App\Utils\View;

class Testimony extends Page {
  public static function getTestimonies(){


    $content = View::render('pages/testimony');

    return parent::getPage('DEPOIMENTOS',$content);
  }
}