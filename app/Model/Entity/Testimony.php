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

  // Método responsável por retornar Depoimentos
  public static function getTestimonies($where = null, $order = null, $limit = null, $field = '*'){
    
    return (new Database('depoimentos'))->select($where, $order, $limit, $field);
  }
}

?>