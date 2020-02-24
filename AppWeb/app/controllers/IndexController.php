<?php

require "core/Logger.php";

class IndexController
{
    public function index(){
        return Helper::view("index");
    }

}
