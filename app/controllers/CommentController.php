<?php

require "app/models/Codes.php";
require "core/Logger.php";

class CodeController
{
    public function index(){
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
    }

    public function show(){
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
    }

    public function parseUpdate(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['id']) && isset($_POST['content']) && ctype_digit($_POST['id'])) {
                $entry = [
                  'content' => $_POST['content'],
                  'date' => date('Y-m-d-H-i-s'),
                  'author' => $_SESSION['userid'],
                  'comments' =>$_POST['commentd'],
                  'id' => $_POST['id']
                ];
                Comments::update($entry);
            }
            else
                throw new Exception("Some data are missing...", 1);
            $comment = Comments::fetchSomething($_POST["id"],"id");
            Logger::addLogEvent($_SESSION['user'].' updated: commment number: '. $comment->getId());
            $_SESSION['commentUpdated']="2";
            Helper::redirect(true);
        }
    }

    /*public function showAddView(){
        return Helper::view('addCode');
    }*/

    public function showUpdateView(){
        return Helper::view('update_view');
    }

    public function parseAdd(){
        if ($this->authorIsConnected()&&$_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['content'])) {
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
                    $code->save();
                    $_SESSION['commentUpdated']="1";
                    $path = App::get('config')['install_prefix'] . '/codes';
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
            Helper::redirect(false);
        }
    }
    public function authorIsConnected(){
        if(isset($_SESSION['userid']))
            return true;
        require("app/views/login.view.php");
        return false;
    }
    public function parseSort(){
        if(isset($_POST['sort']))
            $_SESSION['commentSort']=$_POST['sort'];
        if(isset($_POST['order']))
            $_SESSION['commentOrder']=$_POST['order'];
        Helper::redirect(true);
    }
}