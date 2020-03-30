<?php

require "app/models/User.php";
require "core/Logger.php";

class LoginController
{

  public function logout(){
    Logger::addLogEvent($_SESSION['user'].' disconnected.');
    $_SESSION=array();
    $path = App::get('config')['install_prefix'];
    header("Location: /{$path}/index");
    exit();
  }

  public function login(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      if(isset($_POST['user']) && isset($_POST['pass'])){
        $user = $_POST['user'];
        $pwd = $_POST['pass'];
        // echo "enter in the Controller <br>";
        $connection = User::fetchSomething($user,"name",PDO::PARAM_STR,PDO::FETCH_ASSOC);
        if($connection['pass'] === $pwd)
        {
          $_SESSION['user'] = $user;
          $_SESSION['userid'] = $connection['id'];

          Logger::addLogEvent($_SESSION['user'].' logged in');

          $path = App::get('config')['install_prefix'];
          header("Location: /{$path}/index");
          exit();
        }
        else {
          Logger::addLogEvent('connection attempt: failed');
          return require('app/views/login.view.php');
        }
      }
      else {
        throw new Exception('user or password not set', 1);
      }
    }
    else {
      throw new Exception('Bad server method', 1);
    }
  }
}
