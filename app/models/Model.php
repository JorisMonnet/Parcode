<?php

abstract class Model{

  protected $id;

  public function getId(){
    return $this->id;
  }

  public function setId($id){
    $this->id = $id;
  }

//return the bindings linked to the attributes of the class
  abstract public static function getParam();

//return the attributes of the object
  abstract public function getAttributes();

  public static function fetchId($id){
    $dbh = App::get('dbh');
    //trouver le nom de la table dans l'objet
    $req = "SELECT * FROM ".strtolower(get_called_class())." WHERE id = ? AND login =". $_SESSION['userid'];
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $statement->setFetchMode(PDO::FETCH_CLASS, get_called_class());
    $statement->execute();
    return $statement->fetch();
  }

  // Method useful for the view

  public static function fetchAll($user){
    $dbh = App::get('dbh');
    $statement = $dbh->prepare("select * from ".strtolower(get_called_class())." WHERE author = ? ORDER BY date ASC");
    $statement->bindParam(1, $user, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS, strtolower(get_called_class()));
  }

//update something in the called class
  public static function update($entry){
    $dbh = App::get('dbh');
    $param = get_called_class()::getParam(); //getting the bindings of all params for the called class
    $req = "UPDATE ".get_called_class()." SET ";
    $i = 0;
    $id = $entry['id'];
    unset($entry['id']);

    foreach ($entry as $key => $row) {
        $i++;
        $req .= $key." =:$key";
        $i < (sizeof($entry))? $req .= ", ":$req .= " ";
    } //construct the request with all params
    $req .= "WHERE id=:id ";

    $entry['id'] = $id;

    $statement = $dbh->prepare($req);
    foreach ($param as $row => $binding) {
        //echo "<br>bindParam(".$i.", ".$entry[$row].", ".$binding.")";
        $statement->bindParam($row, $entry[$row], $binding);
        echo "<br>bindParam(".$row.", ".$entry[$row].", ".$binding.")";
    } //assign param with the correct bindings
    $statement->execute();
  }

//insert something in the called class
  public function save(){
      $dbh = App::get('dbh');
      $values = $this->getAttributes();
      $param = get_called_class()::getParam();
      unset($param['id']);
      $req = "INSERT INTO ". strtolower(get_called_class()) ."(";
      $i=0;
      foreach ($param as $key => $value) {
        $i++;
        $req .= $key;
        $i < (sizeof($param))? $req .= ", ":$req .= ")";
      }
      $req .= " VALUES (";
      $i=0;
      foreach ($param as $row => $binding) {
        $i++;
        $req.= ":$row";
        $i < (sizeof($param))? $req .= ", ":$req .= ")";
      }

      $statement = $dbh->prepare($req);
      foreach ($param as $row => $binding) {
        $statement->bindParam($row, $values[$row], $binding);
      }
      // prepared statement with question mark placeholders (marqueurs de positionnement)
      $statement->execute();
  }

  public static function delete($id){
      $dbh = App::get('dbh');
      $req = "DELETE FROM ". get_called_class(). " WHERE id = ?";
      $statement = $dbh->prepare($req);
      $statement->bindParam(1, $id, PDO::PARAM_INT);

      $statement->execute();
  }

}
