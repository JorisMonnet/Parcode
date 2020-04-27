<?php

require "app/models/User.php";
require "core/Logger.php";

class LoginController
{
  public function logout(){
	Logger::addLogEvent($_SESSION['user'].' disconnected.');
	$currentPage = $_SESSION['currentPage']; //we keep the varoable before erasing the session to redirect to the good page
    $_SESSION=array();
	session_destroy();
	$_SESSION['currentPage']=$currentPage;
    Helper::redirectCurrentPage();
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
				Helper::redirectCurrentPage();
			} else {
				Logger::addLogEvent('connection attempt: failed');
				return require('app/views/login.view.php');
			}
      	} else 
        	throw new Exception('user or password not set', 1);
    else 
      	throw new Exception('Bad server method', 1);
  }
  public function Cancel(){
    if($_SERVER['REQUEST_METHOD'] === 'POST')
	  return Helper::redirectCurrentPage();
  }
  public function showSignUp(){
	return require('app/views/signUp.view.php');
  }
  public function signUp(){
	if($_SERVER['REQUEST_METHOD'] === 'POST')
		if(isset($_POST['user']) && isset($_POST['pass'])&&isset($_POST['confirmedPassword']))
			if($_POST['confirmedPassword']===$_POST['pass']){
				$connection = User::fetchSomething($_POST['user'],"name",PDO::PARAM_STR,PDO::FETCH_ASSOC);
				if(isset($connection))
					if(password_verify($_POST['pass'],$connection['pass'])){
						$_SESSION['badSignUp']="User already registered !";
						return require('app/views/signUp.view.php');
					} else {
						/*Logger::addLogEvent('connection attempt: failed');
						return require('app/views/login.view.php');*/
					}
			}else{
				$_SESSION['badSignUp']="Bad Password Confirmation";
				return require('app/views/signUp.view.php');
			}

		else 
			throw new Exception('user or password or confirmed Password not set', 1);
	else 
		throw new Exception('Bad server method', 1);
  }
}
