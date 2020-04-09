<?php

require "app/models/Codes.php";
require "app/models/Comments.php";
require "core/Logger.php";

class CodeController
{
    public function index(){
        $codes = Codes::fetchAll($_SESSION['codesSort']??"date",$_SESSION['codeOrder']??"DESC");

        $codeAddSuccess = "0"; 
        $codeAddFailure = "";
        if (isset($_SESSION['codeUpdated']) &&  ctype_digit($_SESSION['codeUpdated'])){
               $codeAddSuccess = $_SESSION['codeUpdated'];
               $_SESSION['codeUpdated']="0";
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'GET'&& isset($_GET['delay_failed'])) 
            $codeAddFailure = "submission too fast";

        return Helper::view("showCodes",[
                'codes' => $codes,
                'codeAddSuccess' => $codeAddSuccess,
                'codeAddFailure' => $codeAddFailure,
            ]);
    }

    public function show(){
        if(isset($_GET["id"]) && ctype_digit($_GET["id"])){
            $code = Codes::fetchSomething($_GET["id"],"id");
            $comments = Comments::fetchAllComments("date","DESC",$code->getId());
        } else 
            throw new Exception("CODE NOT FOUND.", 1);
        if($code == null)
            throw new Exception("CODE NOT FOUND.", 1);
        return Helper::view("showCode",[
                'currentCode' => $code,
                'user' => $_SESSION['userid'],
                'comments' => $comments
            ]);
    }
    public function showEdit(){
        if(isset($_GET["id"]) && ctype_digit($_GET["id"])){
            $code = Codes::fetchSomething($_GET["id"],"id");
            $comments = Comments::fetchAllComments("date","DESC",$code->getId());
        } else 
            throw new Exception("CODE NOT FOUND.", 1);
        if($code == null)
            throw new Exception("CODE NOT FOUND.", 1);
        return Helper::view("showCodeEdit",[
                'currentCode' => $code,
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
                  'id' => $_POST['id']
                ];
                Codes::update($entry);
            }
            else
                throw new Exception("Some data are missing...", 1);
            $code = Codes::fetchSomething($_POST["id"],"id");
            Logger::addLogEvent($_SESSION['user'].' updated: code number: '. $code->getId());
            $_SESSION['codeUpdated']="2";
            Helper::redirect(true);
        }
    }

    public function showAddView(){
        return Helper::view('addCode');
    }

    public function showUpdateView(){
        return Helper::view('update_view');
    }

    public function parseAdd(){
        if ($this->authorIsConnected()&&$_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['content'])) {
                $code = new Codes;
                $code->setContent($_POST['content']);
                $code->setAuthor($_SESSION['userid']);
                $code->setDate(date('Y-m-d-H-i-s'));

                $allowInsert = true;
                if (isset($_COOKIE['code_per_min_counter']))
                    if ($_COOKIE['code_per_min_counter'] > 90)
                        $allowInsert = false;
                    else
                        setcookie("code_per_min_counter",$_COOKIE['code_per_min_counter'] + 1);
                else
                   setcookie("code_per_min_counter", 1, time() + 60);
                if ($allowInsert) {
                    $code->save();
                    $_SESSION['codeUpdated']="1";
                    Logger::addLogEvent($_SESSION['user'].' added code number"'.$_POST['id']);
                    Helper::redirect(true);
                }
                else 
                   Helper::redirect(true,true);
            }
            else
            	throw new Exception("Content can't be empty.", 1);
        }
    }

    public function parseDelete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['id'])&&ctype_digit($_POST['id'])
                &&Codes::delete($_POST['id']))
                Logger::addLogEvent($_SESSION['user'].' deleted code number'.$_POST['id'] );
            else
                throw new Exception("Code don't exist", 1);
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
            $_SESSION['codeSort']=$_POST['sort'];
        if(isset($_POST['order']))
            $_SESSION['codeOrder']=$_POST['order'];
        Helper::redirect(true);
    }
}