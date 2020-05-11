<?php

/**
* The Codes class
*/
require_once("CodeCommentModel.php");
class Codes extends CodeCommentModel
{

	private $groups;

  // Getters and Setters

	public static function getParam(){
		return [
			"content" => PDO::PARAM_STR,
			"date" => PDO::PARAM_STR,
			"author" => PDO::PARAM_INT,
			"id" => PDO::PARAM_INT,
			"groups"=> PDO::PARAM_STR
		];
	}


	public function setGroups($value){
		$this->groups=$value;
	}

	public function getGroups(){
		return $this->groups;
	}

	public function addGroups($value){
		$this->groups+= ".".value;
	}

	public function getGroupsArray(){
		return explode(".",$this->getGroups());
	}

	public function getAttributes(){
		return [
			'content' => $this->getcontent(),
			'date' => $this->getDate(),
			'author' => $this->getAuthor(),
			'groups' => $this->getGroups()
		];
	}
}