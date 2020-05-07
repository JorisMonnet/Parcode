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
        return $this->strWithoutAuthor(false).$this->strAuthor();
    }
    private function strAuthor(){
        $authorName = User::fetchSomething($this->getAuthor(),"id");
        return " Authored by ".htmlentities($authorName->getName())."</div>";
    }
    public function asHTMLTableRowWithEdit($user){
		$str = $this->strWithoutAuthor(true);
		if($this->getAuthor()===$user)
            if(get_class($this)=="Comments"){
				$str.='</div><form action='.$_SESSION['currentPage'].' method="post" class="buttonEditCode">
                			<input type="hidden" name="idComment" value="'.$this->getId().'"">
                			<input type="submit" style="margin:0px" class="button" value="Edit Comment">
                            </form>';
            } else
                $str .='<a href="codeUpdate?id='.urlencode($this->getId()).'" class="editRef"> Edit Code </a></div>';
		else
			$str.=$this->strAuthor();
        return $str;
	}
	private function strWithoutAuthor($onlyOne){
        $str = "<div class='flex-container'>";
        if(get_class($this)=="Codes"&&!$onlyOne)
		    $str .= '<a style="max-width:50px;min-width:20px" href="code?id='.urlencode($this->getId()).'">'.htmlentities($this->getId()) ." </a><hr>";
		$str .= "<code><pre>".htmlentities($this->getContent())."</pre></code><hr>";
		$str .= date("j F Y H:i:s",strtotime($this->getDate()));
		return $str;
	}
}