<?php

require('Model.php');
/**
* The Codes class
*/
class Codes extends Model
{
    // Attributes
	private $description;
	private $date;
  	private $user;

  // Getters and Setters

	public function getDescription(){
		return $this->description;
	}

  public function setDescription($value){
        $this->description = $value;
    }

  public function getDate(){
		return $this->date;
	}

  public function setDate($value){
        $this->date = $value;
    }

	public function getUser(){
		return $this->user;
	}

	public function setUser($user){
		$this->user = $user;
	}

  public static function getParam(){
    return [
      	"description" => PDO::PARAM_STR,
      	"date" => PDO::PARAM_STR,
		"user" => PDO::PARAM_INT,
      	"id" => PDO::PARAM_INT
    ];
  }

	public function getAttributes(){
		return [
			'description' => $this->getDescription(),
			'date' => $this->getdate(),
			'user' => $this->getuser()
		];
	}

  public function asHTMLTableRow(){
      $str = "";

          // initalize $checked as an empty string
    	$checked = "";

			$str .= "<div>";
      $str .= "<a href=\"Codes?id=" . urlencode($this->id) . "\">" . htmlentities($this->id) ." ". "</a>";
      if($this->completed == true)
      {
          $checked = "checked";
    			$str .= "<strike>" . htmlentities($this->description) . "</strike>";
  		}
  		else
  		{
  			  $str .= htmlentities($this->description);
      }
      $str .= "<input type=\"checkbox\" disabled=\"disabled\" $checked>";
      $date = strtotime($this->date);
      $str .= date("j F Y", $date);
			$str .= "</div>";
      return $str;
      }

  public function asHTMLTableRowWithEdit(){
        $str = $this->asHTMLTableRow();
				$str .= '<button id="buttonEdit" type="button" onclick="showForm()">edit Codes</button>';
				//$str .= '<a onclick="showForm()" href="update_Codes?id=' . $this->id .'">edit Codes</a>';
        return $str;
  }

}
