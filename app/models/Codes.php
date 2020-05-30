<?php

require_once("CodeCommentModel.php");

class Codes extends CodeCommentModel
{
	private $groups;
	private $title;

	public static function getParam(){
		return [
			"content" => PDO::PARAM_STR,
			"date" => PDO::PARAM_STR,
			"author" => PDO::PARAM_INT,
			"id" => PDO::PARAM_INT,
			"groups"=> PDO::PARAM_STR,
			"title" => PDO::PARAM_STR
		];
	}

	public function getGroups(){
		return $this->groups;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($value){
		$this->title = $value;
	}

	public function setGroups($value){
		$this->groups = $value;
	}

	public function getGroupsArray(){
		return explode(".",$this->getGroups());
	}

	public function getAttributes(){
		return [
			"content" => $this->getcontent(),
			"date" => $this->getDate(),
			"author" => $this->getAuthor(),
			"groups" => $this->getGroups(),
			"title" => $this->getTitle()
		];
	}

	public static function fetchGroup($group){
		$dbh = App::get('dbh');
		$statement = $dbh->prepare("select * from Codes WHERE groups= ?");
		$statement->bindParam(1,$group,PDO::PARAM_STR);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS, "Codes");
	}
}