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

    // Le mot de passe n'est pas hasher : Mauvaise pratique !!
    // Mais pour tester le programme sans trop de problèmes, ce n'est pas grave,
    // Lorsque que l'on pourra ajouter un utilisateur, il faudra par contre y remédier:
    // Il ne faut pas stocker de mot de passe en dur dans la bdd !
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
