<?php

require "app/models/User.php";
require "core/Logger.php";

class LoginController
{
  public function logout(){
    Logger::addLogEvent($_SESSION['user'].' disconnected.');
    $_SESSION=array();
    session_destroy();
    $path = App::get('config')['install_prefix'];
    header("Location: /{$path}/".$_SESSION['currentPage']);
    exit();
  }
  public function loginPage(){
    return require('app/views/login.view.php');
  }
  public function login(){
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    	if(isset($_POST['user']) && isset($_POST['pass'])){
			$connection = User::fetchSomething($_POST['user'],"name",PDO::PARAM_STR,PDO::FETCH_ASSOC);
			if(password_verify($_POST['pass'],$connection['pass'])){
				$_SESSION['user'] = $_POST['user'];
				$_SESSION['userid'] = $connection['id'];

				Logger::addLogEvent($_SESSION['user'].' logged in');

				$path = App::get('config')['install_prefix'];
				header("Location: /{$path}/".$_SESSION['currentPage']);
				exit();
			} else {
				Logger::addLogEvent('connection attempt: failed');
				return require('app/views/login.view.php');
			}
      	} else 
        	throw new Exception('user or password not set', 1);
    else 
      	throw new Exception('Bad server method', 1);
  }
}
