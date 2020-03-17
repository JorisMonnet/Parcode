<?php

require "app/models/Codes.php";
require "core/Logger.php";

class CodeController
{
    public function index(){
        $codes = Codes::fetchAll($_SESSION['user']);

        $code_added_success = 0; 

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['updated']) &&  ctype_digit($_GET['updated']))
                $code_added_success = $_GET['updated'];

            $code_added_failure = "";

            if (isset($_GET['delay_failed'])) 
                $code_added_failure = "submission too fast";
        }

        return Helper::view("showCodes",[
                'codes' => $codes,
                'code_added_success' => $code_added_success,
                'code_added_failure' => $code_added_failure,
            ]);
    }

    public function show(){
        if(isset($_GET["id"]) && ctype_digit($_GET["id"])) {
            $code = Codes::fetchId($_GET["id"]);
            if($code == null)
                throw new Exception("CODE NOT FOUND.", 1);
        }
        else 
            throw new Exception("CODE NOT FOUND.", 1);

        return Helper::view("showCode",[
                'currentCode' => $code,
                'username' => $_SESSION['user']
            ]);
    }

    public function update(){
        if(isset($_GET['id']) && ctype_digit($_GET['id'])) {
            $code = Codes::fetchId($_GET["id"]);
            if($code == null)
                throw new Exception("CODE NOT FOUND.", 1);
        }else
            throw new Exception("Error retrieving the code. ID is not valid", 1);
        return Helper::view('update_code',[
                'currentCode' => $code,
            ]);
    }

    public function parseUpdate(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(
                isset($_POST['id']) &&
                ctype_digit($_POST['id']) &&
                isset($_POST['content']) 
                ) {
                $entry = [
                  'content' => $_POST['content'],
                  'date' => date('Y-m-d-H-i-s'),
                  'author' => $_SESSION['user'],
                  'id' => $_POST['id']
                ];
                Codes::update($entry);
            }
            else
                throw new Exception("Some data are missing...", 1);
            // alternative: use the $_SESSION, so you can't make
            // our application say (constrained by number) things
            $code = Codes::fetchId($_POST['id']);
            Logger::addLogEvent($_SESSION['user'].' updated: "'. $code->getContent() . '" (code number: '. $code->getId().')');
            $path = App::get('config')['install_prefix'] . '/codes?updated=2';
            header("Location: /{$path}");
            exit();
        }
    }

    public function showAddView(){
        return Helper::view('addCodes');
    }

    public function showUpdateView(){
        return Helper::view('update_view');
    }

    public function parseInput(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['content'])) {
                $code = new Codes;
                $code->setContent($_POST['content']);
                $code->setAuthor($_SESSION['user']);
                $code->setDate(date('Y-m-d-H-i-s'));

                $allow_insert = true;
                if (isset($_COOKIE['code_per_min_counter'])){
                  if ($_COOKIE['code_per_min_counter'] > 90){
                    echo "set false";
                    $allow_insert = false;
                  }else
                    setcookie("code_per_min_counter",$_COOKIE['code_per_min_counter'] + 1);
                }
                else
                   setcookie("code_per_min_counter", 1, time() + 60);
                if ($allow_insert) {
                    $code->save();
                    $path = App::get('config')['install_prefix'] . '/codes?updated=1';
                }
                else 
                   $path = App::get('config')['install_prefix'] . '/codes?delay_failed=1';
                Logger::addLogEvent($_SESSION['user'].' added "'.$_POST['content'] . '" code');
                header("Location: /{$path}");
                exit();
            }
            else
            	throw new Exception("Content can't be empty.", 1);
        }
    }

    public function parseDelete(){
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['id'])){
          $code = Codes::fetchId($_POST['id']);
          Codes::delete($_POST['id']);
        }
        else
          throw new Exception("Code don't exist", 1);
        Logger::addLogEvent($_SESSION['user'].' deleted '. $code->getContent());
        $path = App::get('config')['install_prefix'];
        header("Location: /{$path}");
        exit();
      }
    }
}