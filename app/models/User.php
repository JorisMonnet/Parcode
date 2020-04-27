<?php

require('Model.php');

class User extends Model
{
    private $name;
    private $pass;


    public function getName(){
      return $this->name;
    }
    // the password will be hash in the final project, we have begun the research on the password_hash and password_verify functions
    public function getPass(){
      return $this->pass;
    }
    
    public function setName($value){
      $this->name = $value;
    }

    public function setPass($value){
      $this->pass=$value;
    }
    public static function getParam(){
      return [
        "name" => PDO::PARAM_STR,
        "pass" => PDO::PARAM_STR,
        "id" => PDO::PARAM_INT
      ];
    }

    public function getAttributes(){
      return [
        "name" => $this->getName(),
        "pass" => $this->getPass()
      ];
    }

}
