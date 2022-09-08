<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Model\Entity\Organization;

class Home extends Page {
  public static function getHome(){

    $obOrganization = new Organization;

    // echo '<pre>';
    // print_r($obOrganization);
    // exit;

    $content = View::render('pages/home', [
      'name' => $obOrganization->name,
      'site' => $obOrganization->site,
      'description' => $obOrganization->description
    ]);

    return parent::getPage('Marlon Titulo',$content);
  }
}