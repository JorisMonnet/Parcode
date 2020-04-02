<?php

require('Codes.php');
/**
* The Comments class
*/
class Comments extends CodeCommentModel
{
    // Attributes
	private $content;
	private $date;
    private $author;
    private $codes;

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

    public function getCodes(){
        return $this->codes;
    }
  	public function setDate($value){
        $this->date = $value;
    }

	public function getAuthor(){
		return $this->author;
	}

	public function setAuthor($value){
		$this->author = $value;
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

  	public function asHTMLTableRow(){
      	return $this->strWithoutAuthor().$this->strAuthor();
    }

  	public function asHTMLTableRowWithEdit($user){
		$str = $this->strWithoutAuthor();
		if($this->author===$user)
			$str .= '</div><button id="buttonEditComment" type="button" onclick="showForm()">edit Code</button>';
		else
			$str.=$this->strAuthor();
        return $str;
	}
	private function strWithoutAuthor(){
		$str = "<div>";
		$str .= "<a href=\"code?id=".urlencode($this->id)."\">".htmlentities($this->id) ." </a><br><br>";
		$str .= "<code>".nl2br(htmlentities($this->content))."</code><br><br>";
		$str .= date("j F Y H:i:s",strtotime($this->date))."<br>";
		return $str;
	}
	private function strAuthor(){
		$authorName = User::fetchSomething($this->author,"id");
		return htmlentities($authorName->getName())."</div>";
	}
}
