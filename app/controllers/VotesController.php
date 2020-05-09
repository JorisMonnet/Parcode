<?php
require_once('app/models/Votes.php');
class VotesController
{
    public static function hasVoted($idComment){
        if(isset($_SESSION['userid'])){
            $votes = Votes::fetchSomething($idComment,"comments");
            return ($votes==false?false:in_array($_SESSION['userid'],$votes));
        }
    }
    public static function parseAdd($value,$idComments){
            $vote = new Votes;
            $vote->setAuthor($_SESSION['userid']);
            $vote->setComments($idComments);
            $vote->setValue($value);
            $vote->save();
    }
    public static function parseDelete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['id'])&&ctype_digit($_POST['id'])){
                $vote=Votes::fetchSomething($_POST['id'],"id");
                    if(!$vote::delete($_GET['id']))
                        throw new Exception("Vote don't exist", 1);
            }else
                throw new Exception("Vote don't exist", 1);
            Helper::redirectCurrentPage();
        }
    }
    public static function parseUpdate($entry){
        $vote = Votes::fetchSomething($entry['id'],"id");
        if($vote->getValue()+$entry['value']===0)
            if(!$vote::delete($entry['id']))
                throw new Exception("Vote don't exist", 1);
        else
            Votes::update($entry);
    }
}