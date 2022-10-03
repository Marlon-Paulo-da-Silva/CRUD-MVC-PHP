<?php

namespace App\Model\Entity;

use App\Db\Database;

class User{
 public $id_client;
 public $client_name;
 public $username;
 public $passwrd;
 

 public static function getUserByEmail($email){
  return (new Database('authentication'))->select('email = "'. $email .'"')->fetchObject(self::class);
 }



}