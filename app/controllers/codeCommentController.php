<?php

require "app/models/Codes.php";
require "app/models/Comments.php";
require "core/Logger.php";

abstract class CodeCommentController
{
    public function authorIsConnected(){
        if(isset($_SESSION['userid']))
            return true;
        require("app/views/login.view.php");
        return false;
    }
    public function parseDelete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['id'])&&ctype_digit($_POST['id'])
                &&get_called_class()::delete($_POST['id']))
                Logger::addLogEvent($_SESSION['user'].' deleted '.substr(get_class($this),0,-2). 'number : '.$_POST['id'] );
            else
                throw new Exception(substr(get_class($this),0,-2)." don't exist", 1);
            Helper::redirect(false);
        }
    }
}