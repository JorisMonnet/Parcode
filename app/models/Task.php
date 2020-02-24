<?php

require('Model.php');
/**
* The Task class
*/
class Task extends Model
{
    // Attributes
	private $description;
	private $completed;
	private $deadline;
  private $login;

  // Getters and Setters

	public function getDescription(){
		return $this->description;
	}

  public function setDescription($value){
        $this->description = $value;
    }

  public function getDeadline(){
		return $this->deadline;
	}

  public function setDeadline($value){
        $this->deadline = $value;
    }

	public function isComplete(){
		return $this->completed;
	}

	public function setCompleted($value){
		$this->completed = $value;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}

  public static function getParam(){
    return [
      "description" => PDO::PARAM_STR,
      "completed" => PDO::PARAM_BOOL,
      "deadline" => PDO::PARAM_STR,
			"login" => PDO::PARAM_INT,
      "id" => PDO::PARAM_INT
    ];
  }

	public function getAttributes(){
		return [
			'description' => $this->getDescription(),
			'completed' => $this->isComplete(),
			'deadline' => $this->getDeadline(),
			'login' => $this->getLogin()
		];
	}

  public function asHTMLTableRow(){
      $str = "";

          // initalize $checked as an empty string
    	$checked = "";

			$str .= "<div>";
      $str .= "<a href=\"task?id=" . urlencode($this->id) . "\">" . htmlentities($this->id) ." ". "</a>";
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
      $date = strtotime($this->deadline);
      $str .= date("j F Y", $date);
			$str .= "</div>";
      return $str;
      }

  public function asHTMLTableRowWithEdit(){
        $str = $this->asHTMLTableRow();
				$str .= '<button id="buttonEdit" type="button" onclick="showForm()">edit task</button>';
				//$str .= '<a onclick="showForm()" href="update_task?id=' . $this->id .'">edit task</a>';
        return $str;
  }

}
