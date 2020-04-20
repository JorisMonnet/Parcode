<?php

/**
* The Codes class
*/
require_once("CodeCommentModel.php");
class Codes extends CodeCommentModel
{
  // Getters and Setters

	public static function getParam(){
		return [
			"content" => PDO::PARAM_STR,
			"date" => PDO::PARAM_STR,
			"author" => PDO::PARAM_INT,
			"id" => PDO::PARAM_INT
		];
	}

	public function getAttributes(){
		return [
			'content' => $this->getcontent(),
			'date' => $this->getDate(),
			'author' => $this->getAuthor()
		];
	}
}