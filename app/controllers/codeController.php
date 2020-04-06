<?php

require "app/models/Codes.php";
require "core/Logger.php";

class CodeController
{
    public function index(){
        $codes = Codes::fetchAll();

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
            $code = Codes::fetchSomething($_GET["id"],"id");
            if($code == null)
                throw new Exception("CODE NOT FOUND.", 1);
        }
        else 
            throw new Exception("CODE NOT FOUND.", 1);

        return Helper::view("showCode",[
                'currentCode' => $code,
                'user' => $_SESSION['userid']
            ]);
    }

    public function parseUpdate(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if( isset($_POST['id']) && isset($_POST['content']) && ctype_digit($_POST['id'])) {
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
            // utilisez la session pour passer des messages; affichez (avec echappement)
            // ces messages dans le partial/header.php et effacez-les, c'est plus sur et
            // generique.
            // ca pourrait etre un helper, non? ces 3 lignes?
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
                $code->setAuthor($_SESSION['userid']);
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
                Logger::addLogEvent($_SESSION['user'].' added code number"'.$_POST['id']);
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
            &&Codes::delete($_POST['id']))
            Logger::addLogEvent($_SESSION['user'].' deleted code number'.$_POST['id'] );
        else
          throw new Exception("Code don't exist", 1);
        $path = App::get('config')['install_prefix'];
        header("Location: /{$path}");
        exit();
      }
    }
}
