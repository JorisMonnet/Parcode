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
	
    private function strAuthor($i=0){
		$authorName = User::fetchSomething($this->getAuthor(),"id");
		$str= '<span> Authored by '.htmlentities($authorName->getName());
		if(get_class($this)=="Comments"&&isset($_SESSION['userid'])&&$this->getAuthor()!==$_SESSION['userid'])
			$str.='<img class="glyphicon_up" src="app/views/partials/chevron_up.png" alt="upvote" onclick="upvote('.$i.')"></img>
					<span class="voteLabel">'.$this->getVotes().'</span>
					<img class="glyphicon_down" src="app/views/partials/chevron_down.png" alt="downvote" onclick="downvote('.$i.')"></img>';
        return $str.'</span></div>';
	}
	
    public function asHTMLTableRowWithEdit($user,$i=0){
		$str = $this->strWithoutAuthor(true);
		if($this->getAuthor()===$user)
            if(get_class($this)=="Comments"){
				$str.='</div></div><span class="editDeleteComment"><button class="edit" onclick=showEditComment('.$i.')>Edit Comment</button>';
				$str.='<a class="delete" href="deleteComment?id='.htmlentities($this->getId()).'">Delete Comment</a></span>';
				$str.='<form class="hiddenForm" action="updateComment" method="post">
							<label for="contentComment">Edit the comment : </label>
							<textarea class="flex-container" id="contentComment" name="content" required>'.htmlentities($this->getContent()).'</textarea>
							<input id="idCommentForm" type="hidden"  name="id" value="'. htmlentities($this->getId()).'">
							<input type="hidden" name="codesid" value="'. htmlentities($this->getCodes()).'">
							<input type="hidden" name="votes" value="'. htmlentities($this->getVotes()).'">
							<input type="submit" class="button" value="Submit">
						</form>';
            } else{
				$str.='<span class="editDeleteCode"><a class="edit" href="codeUpdate?id='.urlencode($this->getId()).'"> Edit Code </a>';
				$str.='<a class ="delete" href="deleteCode?id='.$this->getId().'">Delete Code</a></span></div>';
			}
		else{
			$str.=$this->strAuthor($i);
			if(get_class($this)=="Comments")
				$str.='<span class="hiddenForm"></span>';
		}
        return $str;
	}
	
	private function strWithoutAuthor($onlyOne){
        $str = '<div class="flex-container">';
        if(get_class($this)=="Codes"&&!$onlyOne)
			$str .= '<a class="codeIdRef" href="code?id='.urlencode($this->getId()).'">'.htmlentities($this->getId()) .' </a><hr>';
		$str .= '<code><pre>'.htmlentities($this->getContent()).'</pre></code><hr>';
		$str .= date("j F Y H:i:s",strtotime($this->getDate()));
		return $str;
	}
}