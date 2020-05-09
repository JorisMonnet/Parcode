<?php
require_once('app/models/Votes.php');
class VotesController
{
    public static function hasVoted($idComment){
        if(isset($_SESSION['userid'])){
            $votes = Votes::fetchAllAuthors($idComment);
            return ($votes==false?false:in_array($_SESSION['userid'],$votes));
        }
    }
    public function parseAdd(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_POST['idComments'])
          &&ctype_digit($_POST['idComments'])&&isset($_POST["value"])) {

            $vote = new Votes;
            $vote->setAuthor($_SESSION['userid']);
            $vote->setComments($_POST['idComments']);
            $vote->setValue($_POST['value']);
            $vote->save();
        } else
            throw new Exception("Problem on Data from voted comment", 1);
    }
    public function parseUpdate(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['id']) && isset($_POST['idComments']) 
            && ctype_digit($_POST['id']) && ctype_digit($_POST['idComments'])
            &&isset($_POST['value'])){
                $entry = [
                  'comments' => $_POST['idComments'],
                  'author' => $_SESSION['userid'],
                  'id' => $_POST['id'],
                  'value' =>$_POST['value']
                ];
                Votes::update($entry);
            } else
                throw new Exception("Some data are missing...", 1);
            Helper::redirectCurrentPage();
        }
    }
    public function parseDelete(){
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
}