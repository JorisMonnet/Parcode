<?php

require "core/Logger.php";

class IndexController
{
    public function index(){
        Helper::view("index");
    }
}
