<?php

$router->define([
  //'' => 'controllers/index.php',  // by conventions all controllers are in 'controllers' folder
  '' => 'IndexController',
  'index' => 'IndexController',
  'index.php' => 'IndexController',
  'codes' => 'CodeController',
  'code' => 'CodeController@show',
  'addCode' => 'CodeController@showAddView',
  'parse_add_form' => 'CodeController@parseAdd',
  'parse_update_form' => 'CodeController@parseUpdate',
  'delete_form' => 'CodeController@parseDelete',
  'login' => 'LoginController@login',
  'logout' => 'LoginController@logout',
  'loginPage' => 'LoginController@loginPage'
]);
