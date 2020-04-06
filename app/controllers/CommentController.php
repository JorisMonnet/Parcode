<?php

require "app/models/Codes.php";
require "core/Logger.php";

class CodeController
{
    /*public function index(){
        $comments = Comments::fetchAll($_SESSION['commentSort']??"date",$_SESSION['commentOrder']??"DESC");

        $commentAddSuccess = "0"; 
        $commentAddFailure = "";
        if (isset($_SESSION['commentUpdated']) &&  ctype_digit($_SESSION['commentUpdated'])){
               $commentAddSuccess = $_SESSION['commentUpdated'];
               $_SESSION['commentUpdated']="0";
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'GET'&& isset($_GET['delay_failed'])) 
            $commentAddFailure = "submission too fast";

        return Helper::view("showCodes",[
                'codes' => $codes,
                'commentAddSuccess' => $commentAddSuccess,
                'commentAddFailure' => $commentAddFailure,
            ]);
    }*/

    /*public function show(){
        if(isset($_GET["id"]) && ctype_digit($_GET["id"])) {
            $comment = Comments::fetchSomething($_GET["id"],"id");
            if($comment == null)
                throw new Exception("COMMENT NOT FOUND.", 1);
        }
        else 
            throw new Exception("COMMENT NOT FOUND.", 1);

        return Helper::view("showComment",[
                'currentComment' => $comment,
                'user' => $_SESSION['userid']
            ]);
    }*/

    public function parseUpdate(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['id']) && isset($_POST['content']) 
                && isset($_SESSION['userid']) && ctype_digit($_SESSION['userid'])
                && ctype_digit($_POST['id']) && isset($_POST['codesid'])
                &&ctype_digit($_POST['codesid'])) {
                $entry = [
                  'content' => $_POST['content'],
                  'date' => date('Y-m-d-H-i-s'),
                  'author' => $_SESSION['userid'],
                  'codes' => $_POST['codesid'],
                  'id' => $_POST['id']
                ];
                Comments::update($entry);
            }
            else
                throw new Exception("Some data are missing...", 1);
            Logger::addLogEvent($_SESSION['user'].' updated: commment number: '. $_POST['id']);
            $_SESSION['commentUpdated']="2";
            $path = App::get('config')['install_prefix'] . '/code?id='.$_POST['codesid'];
            header("Location: /{$path}");
            exit();
        }
    }

    public function parseAdd(){
        if ($this->authorIsConnected()&&$_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['content'])&&isset($_POST['codesid'])) {
                $comment = new Comments;
                $comment->setContent($_POST['content']);
                $comment->setAuthor($_SESSION['userid']);
                $commment->setDate(date('Y-m-d-H-i-s'));
                $comment->setCodes($_SESSION['codeid']);
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
                    $_SESSION['commentUpdated']="1";
                    $path = App::get('config')['install_prefix'] . '/codes?id='.$_POST['codesid'];
                }
                else 
                   $path = App::get('config')['install_prefix'] . '/codes?delay_failed=1';
                Logger::addLogEvent($_SESSION['user'].' added comment number"'.$_POST['id']);
                header("Location: /{$path}");
                exit();
            }
            else
            	throw new Exception("Content can't be empty.", 1);
        }
    }

    public function parseDelete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['id'])&&ctype_digit($_POST['id'])
                &&Comments::delete($_POST['id']))
                Logger::addLogEvent($_SESSION['user'].' deleted comment number'.$_POST['id'] );
            else
                throw new Exception("Comment don't exist", 1);
            $path = App::get('config')['install_prefix'].'/codes';//return to the good code !!
            header("Location: /{$path}");
            exit();
        }
    }
    public function parseSort(){
        if(isset($_POST['sort']))
            $_SESSION['commentSort']=$_POST['sort'];
        if(isset($_POST['order']))
            $_SESSION['commentOrder']=$_POST['order'];
        $path = App::get('config')['install_prefix']. '/codes';
        header("Location: /{$path}");
        exit();
    }
}