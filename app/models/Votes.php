<?php

require_once('Model.php');

class Votes extends Model
{
	private $author;
	private $comments;
	private $value;

	public function getValue(){
		return $this->value;
	}

	public function getAuthor(){
		return $this->author;
	}

	public function getComments(){
		return $this->comments;
	}

	public function setValue($value){
		$this->value = $value;
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
			"id" => PDO::PARAM_INT,
			"value" => PDO::PARAM_INT
		];
	}

	public function getAttributes(){
		return [
			"author" => $this->getAuthor(),
			"comments" => $this->getComments(),
			"value" => $this->getValue()
		];
	}

	//get all the votes as id => value for a comment and user given
	public static function fetchComments($idComments,$user){
		$dbh = App::get('dbh');
		$req = "SELECT id,value FROM Votes WHERE comments = ? AND author = ?";
		$statement = $dbh->prepare($req);
		$statement->bindParam(1, $idComments, PDO::PARAM_INT);
		$statement->bindParam(2, $user, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
}
