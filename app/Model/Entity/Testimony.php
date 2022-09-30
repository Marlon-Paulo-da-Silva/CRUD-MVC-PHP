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
    
    // Insere o depoimento no banco de dados
    $this->id = (new Database('depoimentos'))->insert([
      'name' => $this->nome,
      'message' => $this->message,
      'date' => $this->date
    ]);
    
    return true;
  }
}

?>