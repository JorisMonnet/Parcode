<?php

require_once("core/Logger.php");

class IndexController
{
    //show the HOME page
    public function index(){
        Helper::view("index");
    }
}
