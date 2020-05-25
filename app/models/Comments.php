<?php

require_once('Codes.php');

class Comments extends CodeCommentModel
{
    private $codes;
	private $votes;

    public function getCodes(){
        return $this->codes;
	}
	
    public function setCodes($value){
        $this->codes = $value;
	}

	public function getVotes(){
		return $this->votes;
	}

	public function setVotes($value){
		$this->votes=$value;
	}

	public static function getParam(){
		return [
			"content" => PDO::PARAM_STR,
			"date" => PDO::PARAM_STR,
            "author" => PDO::PARAM_INT,
            "codes" => PDO::PARAM_INT,
			"id" => PDO::PARAM_INT,
			"votes" => PDO::PARAM_INT
		];
	}

	public function getAttributes(){
		return [
			'content' => $this->getcontent(),
			'date' => $this->getDate(),
            'author' => $this->getAuthor(),
			'codes' => $this->getCodes(),
			'votes' => $this->getVotes()
		];
	}
  	
	public static function fetchAllComments($id){
		$dbh = App::get('dbh');
		$statement = $dbh->prepare("SELECT * FROM Comments WHERE codes = ? ORDER BY votes DESC,id DESC");
		$statement->bindParam(1,$id,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS, get_called_class());
	}
	public static function updateVotes($votes,$id){
		$dbh = App::get('dbh');
		$req = "UPDATE Comments SET votes=:votes WHERE id=:id";

		$statement = $dbh->prepare($req);
		$statement->bindParam(":votes", $votes, PDO::PARAM_INT);
		$statement->bindParam(":id", $id, PDO::PARAM_INT);
		$statement->execute();
	}
}
