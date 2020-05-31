<?php
session_start();
require_once('core/Router.php');
require_once('core/Request.php');
require_once('core/App.php');
require_once('core/database/Connection.php');
require_once('helpers/Helper.php');

App::load_config("config.php");

//use the App tab to create the connection named dbh
App::set('dbh', Connection::make(App::get('config')['database']));
