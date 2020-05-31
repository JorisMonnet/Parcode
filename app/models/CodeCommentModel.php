<?php
require_once('User.php');
require_once('Votes.php');

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
		return $this->strWithoutAuthor(false).$this->strAuthor(0);
	}
	
	//show the author of code and comment and the votes for comments
	private function strAuthor($i){
		$authorName = User::fetchSomething($this->getAuthor(),"id");
		$str = '<span> Authored by '.htmlentities($authorName->getName());
		if(get_class($this)=="Comments"&& isset($_SESSION['userid'])){
			$votes = Votes::fetchComments($this->getId(),$_SESSION['userid']);
			if($votes!=null)
				$add =$i .','.$votes['value'].','.$votes['id'];

			if(!isset($add))
				$add=$i;
			$str.='<span class="idComment hiddenForm" hidden>'.htmlentities($this->getId()).'</span>';
			$str.='<img class="glyphicon_up" src="app/views/partials/images/chevron_up.png" alt="upvote" onload="addVote('.$add.')" onclick="listVotes['.$i.'].upvote()"></img>
					<span class="voteLabel">'.$this->getVotes().'</span>
					<img class="glyphicon_down" src="app/views/partials/images/chevron_down.png" alt="downvote" onclick="listVotes['.$i.'].downvote()"></img>';
		}
		else if(get_class($this)=="Comments")//if user not set, he can't vote but see the votes
			$str.='<span class="voteLabel">Votes: '.$this->getVotes().'</span>';
		return $str.'</span></div>';
	}

	//show a code with Edit/delete button and the hidden update form for comments
	public function asHTMLTableRowWithEdit($user,$i=0){
		$str = $this->strWithoutAuthor(true);
		if($this->getAuthor()===$user)
			if(get_class($this)=="Comments"){
				$str.='<span class="glyphicon_up glyphicon_down voteLabel"></span>';
				$str.='<span class="editDeleteComment"><button class="edit" onclick=showEditComment('.$i.')>Edit Comment</button>';
				$str.='<a class="delete" href="deleteComment?id='.htmlentities($this->getId()).'">Delete Comment</a></span></div>';
				$str.='<form class="hiddenForm" action="updateComment" method="post">
							<label for="contentComment">Edit the comment : </label>
							<textarea class="flex-container" id="contentComment" name="content" required>'.htmlentities($this->getContent()).'</textarea>
							<input class="idComment" type="hidden"  name="id" value="'. htmlentities($this->getId()).'">
							<input type="hidden" name="codesid" value="'. htmlentities($this->getCodes()).'">
							<input type="hidden" name="votes" value="'. htmlentities($this->getVotes()).'">
							<input type="submit" class="button" value="Submit">
						</form>';
			} else{
				$str.='<span class="editDeleteCode"><a class="edit" href="codeUpdate?id='.urlencode($this->getId()).'"> Edit Code </a>';
				$str.='<a class ="delete" href="deleteCode?id='.$this->getId().'">Delete Code</a></span></div>';
			}
		else
			$str.=$this->strAuthor($i);				
		return $str;
	}
	
	//show the code/comment without author
	private function strWithoutAuthor($onlyOne){
		$str = '<div class="flex-container">';
		if(get_class($this)=="Codes"&&!$onlyOne)
			$str .= '<a class="codeIdRef" href="code?id='.urlencode($this->getId()).'">'.htmlentities($this->getId())." : ".htmlentities($this->getTitle()).' </a><hr>';
		$str .= '<code><pre>'.htmlentities($this->getContent()).'</pre></code><hr>';
		$str .= date("j F Y H:i:s",strtotime($this->getDate()));
		return $str;
	}
}