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
		Helper::view("login");
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
					Helper::view("login");
				}
			} else 
				throw new Exception('user or password not set', 1);
		else 
			throw new Exception('Bad server method', 1);
	}

	public function cancel(){
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		Helper::redirectCurrentPage();
	}

	public function showSignUp(){
		Helper::view("signUp");
	}

	public function signUp(){
		if($_SERVER['REQUEST_METHOD'] === 'POST')
			if(isset($_POST['user']) && isset($_POST['pass'])&&isset($_POST['confirmedPassword']))
				if($_POST['confirmedPassword']===$_POST['pass']){
					$connection = User::fetchSomething($_POST['user'],"name",PDO::PARAM_STR,PDO::FETCH_ASSOC);
					if($connection!=null){
						$_SESSION['badSignUp']="User already registered !";
						Helper::view("signUp");
					}else {
						$user = new User();
						$user->setName($_POST['user']);
						$user->setPass(password_hash($_POST['pass'],PASSWORD_DEFAULT));
						$allowInsert = true;
						if (isset($_COOKIE['user_per_min_counter']))
							if ($_COOKIE['user_per_min_counter'] > 90)
								$allowInsert = false;
							else
								setcookie("user_per_min_counter",$_COOKIE['user_per_min_counter'] + 1);
						else
							setcookie("user_per_min_counter", 1, time() + 60);
						if ($allowInsert){
							$user->save();
							Logger::addLogEvent('New User Registered :'.$_POST['user']);
							Helper::view("login");
						} else {
							$_SESSION['badSignUp']="Too fast attempts";
							Helper::view("signUp");
						}
					}
				}else{
					$_SESSION['badSignUp']="Bad Password Confirmation";
					Helper::view("signUp");
				}
			else 
				throw new Exception('user or password or confirmed Password not set', 1);
		else 
			throw new Exception('Bad server method', 1);
	}
}
