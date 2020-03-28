<?php

require('Model.php');

class User extends Model
{
    private $name;
    private $pass;

    //as we don't create any users for the moment, we don't need setters

    public function getName(){
      return $this->name;
    }

    // the password will be hash in the final project, we have begun the research on the password_hash and password_verify functions
    public function getPass(){
      return $this->pass;
    }

    public static function fetchName($name){
      $dbh = App::get('dbh');
      $req = "SELECT name, id, pass FROM User WHERE name =?";

      $statement = $dbh->prepare($req);
      $statement->bindParam(1, $name, PDO::PARAM_STR);
      $statement->execute();
      $user = $statement->fetch(PDO::FETCH_ASSOC);
      return $user;
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
