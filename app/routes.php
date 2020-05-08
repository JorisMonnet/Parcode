<?php

$router->define([
  '' => 'IndexController',
  'index' => 'IndexController',
  'index.php' => 'IndexController',
  'codes' => 'codeController',
  'code' => 'codeController@show',
  'addCode' => 'codeController@showAddView',
  'addForm' => 'codeController@parseAdd',
  'updateForm' => 'codeController@parseUpdate',
  'deleteCode' => 'codeController@parseDelete',
  'login' => 'LoginController@login',
  'logout' => 'LoginController@logout',
  'loginPage' => 'LoginController@loginPage',
  'parseFormSort' => 'codeController@parseSort',
  'addComment' => 'commentController@parseAdd',
  'updateComment' => 'commentController@parseUpdate',
  'deleteComment' => 'commentController@parseDelete',
  'codeUpdate' => 'codeController@showEdit',
  'loginCancel' => 'LoginController@cancel',
  'showSignUp' => 'LoginController@showSignUp',
  'signUpCancel' => 'LoginController@loginPage',
  'signUp' => 'LoginController@signUp',
  'updateVotes' => 'commentController@updateVotes'
]);
