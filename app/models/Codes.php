<?php

require('Model.php');
/**
* The Task class
*/
class Codes extends Model
{
    // Attributes
	private $content;
	private $date;
  	private $author;

  // Getters and Setters

	public function getContent(){
		return $this->content;
	}

  public function setContent($value){
        $this->content = $value;
    }

  public function getDate(){
		return $this->date;
	}

  public function setDAte($value){
        $this->date = $value;
    }

	public function getAuthor(){
		return $this->author;
	}

	public function setAuthor($value){
		$this->author = $value;
	}

  public static function getParam(){
    return [
      "content" => PDO::PARAM_STR,
      "date" => PDO::PARAM_STR,
		"author" => PDO::PARAM_STR,
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

  public function asHTMLTableRow(){
      $str = "";

          // initalize $checked as an empty string
    	$checked = "";

		$str .= "<div>";
      		$str .= "<a href=\"task?id=" . urlencode($this->id) . "\">" . htmlentities($this->id) ." ". "</a><br>";
    		$str .= "<code>" . htmlentities($this->content) . "</code><br>";
			$str .= date("j F Y", strtotime($this->date))."<br>";
			$str .= htmlentities($this->author);
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
