<?php

abstract class Model{

	protected $id;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	abstract public static function getParam();
	abstract public function getAttributes();
	
	//allows to fetch any row of the DB instead of using fetchId/fetchName
	public static function fetchSomething($entry,$stringParam,$type = PDO::PARAM_INT,$arrayResult=null){
		$dbh = App::get('dbh');
		$req = "SELECT * FROM ".get_called_class()." WHERE ".$stringParam." = ?";
		$statement = $dbh->prepare($req);
		$statement->bindParam(1, $entry, $type);
		$statement->setFetchMode(PDO::FETCH_CLASS, get_called_class());
		$statement->execute();
		return $statement->fetch($arrayResult);
	}
	
	// Method useful for the view when showing all codes
	public static function fetchAll($sort,$order){
		$dbh = App::get('dbh');
		$statement = $dbh->prepare("select * from ".get_called_class()." ORDER BY ".$sort." ".$order);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS, get_called_class());
	}

	//update something in the called class
	public static function update($entry){
		$dbh = App::get('dbh');
		$param = get_called_class()::getParam(); //getting the bindings of all params for the called class
		$req = "UPDATE ".get_called_class()." SET ";
		$i = 0;
		$id = $entry['id'];
		unset($entry['id']);

		foreach ($entry as $key => $row) { //construct the request with all params
			$i++;
			$req .= $key." =:$key";
			$i < (sizeof($entry))? $req .= ", ":$req .= " ";
		} 
		$req .= "WHERE id=:id ";

		$entry['id'] = $id;

		$statement = $dbh->prepare($req);
		foreach ($param as $row => $binding)
			$statement->bindParam($row, $entry[$row], $binding);
		
		$statement->execute();
	}

	//insert something in the called class
	public function save(){
		$dbh = App::get('dbh');
		$values = $this->getAttributes();
		$param = get_called_class()::getParam();
		unset($param['id']);
		$req = "INSERT INTO ". get_called_class() ."(";
		$req.=join(",",array_map(null,array_keys($param))).") VALUES (";
		$req.=join(",",array_map(function($key){return ":".$key;},array_keys($param))).")";
		$statement = $dbh->prepare($req);
		foreach ($param as $key => $value) // prepared statement with name placeholders 
			$statement->bindParam($key, $values[$key], $value);
		
		$statement->execute();
	}
	
	public static function delete($id){
		$dbh = App::get('dbh');
		$req = "DELETE FROM ". get_called_class(). " WHERE id = ?";
		$statement = $dbh->prepare($req);
		$statement->bindParam(1, $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->rowCount()!=0;
	}
}