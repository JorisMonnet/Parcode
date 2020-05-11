<?php
require_once("codeCommentController.php");
class CodeController extends CodeCommentController
{
    public function index(){
        $codes = Codes::fetchAll($_SESSION['codesSort']??"date",$_SESSION['codeOrder']??"DESC");
        $groupCodes = [];
        $groups = [];
        foreach($codes as $code){
            if(isset($_GET['group'])&&in_array($_GET['group'],$code->getGroupsArray()))
                array_push($groupCodes,$code);
            foreach($code->getGroupsArray() as $group)
                if(!in_array($group,$groups))
                    array_push($groups,$group);
        }
        if(isset($_GET['group']))   
            $codes = $groupCodes;
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
                'groups' => $groups,
                'codeAddSuccess' => $codeAddSuccess,
                'codeAddFailure' => $codeAddFailure,
            ]);
    }

    public function show(){
        if(isset($_GET["id"]) && ctype_digit($_GET["id"])){
            $code = Codes::fetchSomething($_GET["id"],"id");
            if($code == null)
                throw new Exception("CODE NOT FOUND.", 1);
            $comments = Comments::fetchAllComments($code->getId());
        } else 
            throw new Exception("CODE NOT FOUND.", 1);
        $entry = array('currentCode' => $code,'comments' => $comments);
        $entry += array('user' =>$_SESSION['userid']??"");
        return Helper::view("showCode",$entry);
    }

    public function showEdit(){
        if(isset($_GET["id"]) && ctype_digit($_GET["id"])&&$this->authorIsConnected()){
            $code = Codes::fetchSomething($_GET["id"],"id");
            if($code == null)
                throw new Exception("CODE NOT FOUND.", 1);
        } else 
            throw new Exception("CODE NOT FOUND.", 1);
        return Helper::view("showCodeEdit",[
                'currentCode' => $code,
                'user' => $_SESSION['userid']
            ]);
    }

    public function parseUpdate(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['id']) && isset($_POST['content']) 
            && ctype_digit($_POST['id']) && isset($_POST['groups'])){
                $entry = [
                  'content' => $_POST['content'],
                  'date' => date('Y-m-d-H-i-s'),
                  'author' => $_SESSION['userid'],
                  'id' => $_POST['id'],
                  'groups' =>$_POST['groups']
                ];
                Codes::update($entry);
            }
            else
                throw new Exception("Some data are missing...", 1);
            $code = Codes::fetchSomething($_POST["id"],"id");
            Logger::addLogEvent($_SESSION['user'].' updated code number : '. $code->getId());
            $_SESSION['codeUpdated']="2";
            Helper::redirectToCodes();
        }
    }

    public function showAddView(){
        return Helper::view('addCode');
    }

    public function parseAdd(){
        if ($this->authorIsConnected()&&$_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['content'])&&isset($_POST['groups'])) {
                $code = new Codes;
                $code->setContent($_POST['content']);
                $code->setAuthor($_SESSION['userid']);
                $code->setDate(date('Y-m-d-H-i-s'));
                $code->setGroups($_POST['groups']);

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
                    Logger::addLogEvent($_SESSION['user'].' added code number '.$code->getId());
                    Helper::redirectToCodes();
                }
                else 
                   Helper::redirectToCodes(true);
            }
            else
            	throw new Exception("Content can't be empty.", 1);
        }
    }

    public function parseSort(){
        if(isset($_POST['sort']))
            $_SESSION['codeSort']=$_POST['sort'];
        if(isset($_POST['order']))
            $_SESSION['codeOrder']=$_POST['order'];
        Helper::redirectToCodes();
    }

}