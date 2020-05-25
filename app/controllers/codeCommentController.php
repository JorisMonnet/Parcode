<?php

require_once("app/models/Codes.php");
require_once("app/models/Comments.php");
require_once("core/Logger.php");

abstract class CodeCommentController
{
    //useful to verify if the user connected is the author of the code or comment
    public function authorIsConnected(){
        if(isset($_SESSION['userid']))
            return true;
        Helper::view("login");
    }
    
    public function parseDelete(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'&&$this->authorIsConnected()){
            if(isset($_GET['id'])&&ctype_digit($_GET['id'])){
                $class = get_class($this)=="commentController"?"Comments":"Codes";
                $c=$class::fetchSomething($_GET['id'],"id");
                if($_SESSION['userid']==$c->getAuthor())
                    if($class::delete($_GET['id']))
                        Logger::addLogEvent($_SESSION['user'].' deleted'.get_class($this).'number '.$_POST['id'] );
                    else
                        throw new Exception(get_class($this)." don't exist", 1);
                else
                    throw new Exception("User Not author of this ".get_class($this)." !", 1);
            }else
                throw new Exception(get_class($this)." don't exist", 1);
            if(get_class($this)=="commentController")
                Helper::redirectCurrentPage();
            else
                Helper::redirectToCodes();
        }
    }
}