<?php

$router->define([
  //'' => 'controllers/index.php',  // by conventions all controllers are in 'controllers' folder
  '' => 'IndexController',
  'index' => 'IndexController',
  'index.php' => 'IndexController',
  'codes' => 'CodeController',
  'code' => 'CodeController@show',
  'addCodes' => 'CodeController@showAddView',
  'parse_add_form' => 'CodeController@parseInput',
  'parse_update_form' => 'CodeController@parseUpdate',
  'delete_form' => 'CodeController@parseDelete',
  'login' => 'LoginController@login',
  'logout' => 'LoginController@logout'
]);
