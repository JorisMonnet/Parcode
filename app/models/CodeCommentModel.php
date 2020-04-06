<?php
require_once('User.php');
abstract class CodeCommentModel extends Model
{
    public function asHTMLTableRow(){
        return $this->strWithoutAuthor().$this->strAuthor();
    }
    public static function fetchAllComments($sort,$order,$id){
        $dbh = App::get('dbh');
        $statement = $dbh->prepare("select * from ".get_called_class()." WHERE codes= ? ORDER BY ".$sort." ".$order);
        $statement->bindParam(1,$id,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, get_called_class());
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
        //$str .= "<a href=\"code?id=".urlencode($this->id)."\">".htmlentities($this->id) ." </a><br><br>";
        $str .= htmlentities($this->content)."<br><br>";
        $str .= date("j F Y H:i:s",strtotime($this->date))."<br>";
        return $str;
    }
    private function strAuthor(){
        $authorName = User::fetchSomething($this->author,"id");
        return htmlentities($authorName->getName())."</div>";
    }
}