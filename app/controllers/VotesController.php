<?php

class VotesController
{
    public static function hasVoted($idComment){
        if(isset($_SESSION['userid'])){
            $votes = Votes::fetchAllUsers($idComment);
            return in_array($_SESSION['userid'],$votes);
        }
    }
    public function parseAdd(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_POST['idComments'])&&ctype_digit($_SESSION['userid'])) {
            $vote = new Votes;
            $vote->setAuthor($_SESSION['userid']);
            $vote->setComments($_POST['idComments']);
            $vote->save();
        }
        else
            throw new Exception("idComments can't be empty.", 1);
    }
}