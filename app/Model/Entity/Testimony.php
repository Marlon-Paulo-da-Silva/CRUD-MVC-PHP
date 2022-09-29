<?php

namespace App\Model\Entity;

use App\Db\Database;

class Testimony{
  public $id;
  public $name;
  public $mensagem;
  public $date;

  public function cadastrar(){

    // define a data
    $this->date = date('Y-m-d H:i:s');
    // TODO 33:28
    $this->id = (new Database('depoimentos'))->insert([]);
    
    echo "<pre>";
    print_r($this);
    echo "</pre>";
    exit;

  }
}

?>