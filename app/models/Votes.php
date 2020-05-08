<?php

require('Model.php');

class Votes extends Model
{
    private $author;
    private $comments;


    public function getAuthor(){
      return $this->author;
    }
    
    public function getComments(){
      return $this->comments;
    }
    
    public function setAuthor($value){
      $this->author = $value;
    }

    public function setComments($value){
      $this->comments=$value;
    }
    public static function getParam(){
      return [
        "author" => PDO::PARAM_INT,
        "comments" => PDO::PARAM_INT,
        "id" => PDO::PARAM_INT
      ];
    }

    public function getAttributes(){
      return [
        "author" => $this->getAuthor(),
        "comments" => $this->getComments()
      ];
    }
    public static function fetchAllUsers($idComments){
		$dbh = App::get('dbh');
        $statement = $dbh->prepare("select author from Votes WHERE comments=?");
        $statement->bindparam(1,$idComments,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
	}

}
