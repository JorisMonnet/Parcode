<?php

require_once("CodeCommentController.php");
require_once('VotesController.php');

class CommentController extends CodeCommentController
{
    //update comment
    public function parseUpdate(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['id']) && isset($_POST['content']) 
                && isset($_SESSION['userid']) && ctype_digit($_SESSION['userid'])
                && ctype_digit($_POST['id']) 
                && isset($_POST['codesid'])&& ctype_digit($_POST['codesid'])
                &&isset($_POST['votes'])&&ctype_digit($_POST['votes'])) {
                $entry = [
                  'content' => $_POST['content'],
                  'date' => date('Y-m-d-H-i-s'),
                  'author' => $_SESSION['userid'],
                  'codes' => $_POST['codesid'],
                  'id' => $_POST['id'],
                  'votes' =>$_POST['votes']
                ];
                Comments::update($entry);
            }
            else
                throw new Exception("Some data are missing...", 1);
            Logger::addLogEvent($_SESSION['user'].' updated commment number: '. $_POST['id']);
            Helper::redirectCurrentPage();
        }
    }

    //add comment
    public function parseAdd(){
        if ($this->authorIsConnected()&&$_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['content'])&&isset($_POST['codesid'])&&ctype_digit($_POST['codesid'])) {
                $comment = new Comments();
                $comment->setContent($_POST['content']);
                $comment->setAuthor($_SESSION['userid']);
                $comment->setDate(date('Y-m-d-H-i-s'));
                $comment->setCodes($_POST['codesid']);
                $comment->setVotes(0);
                $allowInsert = true;
                if (isset($_COOKIE['comment_per_min_counter'])){
                    if ($_COOKIE['comment_per_min_counter'] > 90){
                        echo "set false";
                        $allowInsert = false;
                    }else
                        setcookie("comment_per_min_counter",$_COOKIE['comment_per_min_counter'] + 1);
                }
                else
                   setcookie("comment_per_min_counter", 1, time() + 60);
                if ($allowInsert) {
                    $comment->save();
                    Logger::addLogEvent($_SESSION['user'].' added comment number '.$comment->getId());
                }
                Helper::redirectCurrentPage();
            }
            else
            	throw new Exception("Content can't be empty.", 1);
        }
    }
    
    //change the votes of a comment
    public function updateVotes(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'
          &&isset($_POST['votes'])&&isset($_POST['value'])
          &&isset($_POST['idComments'])&&ctype_digit($_POST['idComments'])
          &&isset($_SESSION['userid'])){
            $comment = Comments::fetchSomething($_POST['idComments'],"id");
            if($comment==null)
                throw new Exception("Comment not found", 1);
            Comments::updateVotes($_POST['votes'],$_POST['idComments']);
            Logger::addLogEvent($_SESSION['user'].' voted commment number: '. $_POST['idComments']);
            if(isset($_POST['idVote'])&&ctype_digit($_POST['idVote'])){
                $entry = [
                    'comments' => $_POST['idComments'],
                    'author' => $_SESSION['userid'],
                    'id' => $_POST['idVote'],
                    'value' =>$_POST['value']
                  ];
                  VotesController::parseUpdate($entry);
            } else
                VotesController::parseAdd($_POST['value'],$_POST['idComments']);
        }
        else
            throw new Exception("Problem to vote", 1);
    }
}