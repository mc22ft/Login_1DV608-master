<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once("model/User.php");
require_once("model/Users.php");
//require_once("model/SelectedUserDAL.php");
require_once("controller/LoginController.php");

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On'); //Testa med 1

//
//set up the model
//$dal = new \model\SelectedUserDAL();
$users = new \model\Users();
$users->add(new \model\User("Admin", "Password"));

$controller = new \controller\LoginController($users);

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView($controller);
$dtv = new DateTimeView();
$lv = new LayoutView();




$lv->render(false, $v, $dtv);



