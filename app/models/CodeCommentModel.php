<?php
require_once('User.php');
abstract class CodeCommentModel extends Model
{
    protected $content;
	protected $date;
    protected $author;

    public function getContent(){
		return $this->content;
	}

  	public function setContent($value){
        $this->content = $value;
    }

  	public function getDate(){
		return $this->date;
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
    public function asHTMLTableRow(){
        return $this->strWithoutAuthor().$this->strAuthor();
    }
    private function strAuthor(){
        $authorName = User::fetchSomething($this->getAuthor(),"id");
        return htmlentities($authorName->getName())."</div>";
    }
    public function asHTMLTableRowWithEdit($user){
		$str = $this->strWithoutAuthor();
		if($this->getAuthor()===$user)
            if(get_class($this)=="Comments"){
				$str.='</div><form action='.$_SESSION['currentPage'].' method="post">
                			<input type="hidden" name="idComment" value="'.$this->getId().'"">
                			<input type="submit" class="button" value="Edit Comment">
            			</form>';
            } else
                $str .= "<br><a href=\"codeUpdate?id=".urlencode($this->getId())."\"> Edit Code </a>";
		else
			$str.=$this->strAuthor();
        return $str;
	}
	private function strWithoutAuthor(){
        $str = "<div>";
        if(get_class($this)=="Codes")
		    $str .= "<a href=\"code?id=".urlencode($this->getId())."\">".htmlentities($this->getId()) ." </a><br><br>";
		$str .= "<code><pre>".htmlentities($this->getContent())."</pre></code><br><br>";
		$str .= date("j F Y H:i:s",strtotime($this->getDate()))."<br>";
		return $str;
	}
}