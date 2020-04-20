<?php

require "app/models/Codes.php";
require "app/models/Comments.php";
require "core/Logger.php";

abstract class CodeCommentController
{
    /**
     * useful to verify if the user connected is the author of the code or comment
     */
    public function authorIsConnected(){
        if(isset($_SESSION['userid']))
            return true;
        require("app/views/login.view.php");
        return false;
    }
}