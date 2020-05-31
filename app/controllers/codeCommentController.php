<?php

require_once("app/models/Codes.php");
require_once("app/models/Comments.php");
require_once("core/Logger.php");

abstract class CodeCommentController
{
    //useful to verify if the user is connected
    public function authorIsConnected(){
        if(isset($_SESSION['userid']))
            return true;
        Helper::view("login");
    }
    
    //delete the code or comment 
    public function parseDelete(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'&&$this->authorIsConnected()){
            if(isset($_GET['id'])&&ctype_digit($_GET['id'])){
                $class = get_class($this)=="CommentController"?"Comments":"Codes";
                $c=$class::fetchSomething($_GET['id'],"id");
                if($_SESSION['userid']==$c->getAuthor())
                    if($class::delete($_GET['id']))
                        Logger::addLogEvent($_SESSION['user'].' deleted '.$class.' number '.$_POST['id'] );
                    else
                        throw new Exception($class." don't exist", 1);
                else
                    throw new Exception("User Not author of this ".$class." !", 1);
            }else
                throw new Exception(get_class($this)." don't exist", 1);
            if(get_class($this)=="CommentController")
                Helper::redirectCurrentPage();
            else
                Helper::redirectToCodes();
        }
    }
}