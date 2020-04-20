<?php

require_once('Codes.php');
/**
* The Comments class
*/
class Comments extends CodeCommentModel
{
    // Attribute
    private $codes;

  	// Getter and Setter
    public function getCodes(){
        return $this->codes;
    }
    public function setCodes($value){
        $this->codes = $value;
	}

	public static function getParam(){
		return [
			"content" => PDO::PARAM_STR,
			"date" => PDO::PARAM_STR,
            "author" => PDO::PARAM_INT,
            "codes" => PDO::PARAM_INT,
			"id" => PDO::PARAM_INT
		];
	}

	public function getAttributes(){
		return [
			'content' => $this->getcontent(),
			'date' => $this->getDate(),
            'author' => $this->getAuthor(),
            'codes' => $this->getCodes()
		];
	}
  	
	public static function fetchAllComments($sort,$order,$id){
		$dbh = App::get('dbh');
		$statement = $dbh->prepare("select * from Comments WHERE codes= ? ORDER BY ".$sort." ".$order);
		$statement->bindParam(1,$id,PDO::PARAM_INT);
		$statement->execute();
	return $statement->fetchAll(PDO::FETCH_CLASS, get_called_class());
	}
  	
}
