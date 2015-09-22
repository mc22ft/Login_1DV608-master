<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once("model/User.php");
require_once("model/Users.php");
require_once("model/SelectedUserDAL.php");
require_once("controller/LoginController.php");
require_once("model/SessionHolder.php");
require_once("model/SessionUser.php");

session_start();


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On'); //Testa med 1


//set up the model
$sessionHolder = new \model\SessionHolder("userSessionHolder");
$dal = new \model\SelectedUserDAL();
$users = new \model\Users($sessionHolder, $dal);
$controller = new \controller\LoginController($users);
$loginView = new \view\LoginView($users, $controller);
$dateTimeView = new \view\DateTimeView();
$layoutView = new \view\LayoutView();


//new user

//$users->add(new \model\User("Admin", password_hash("Password", PASSWORD_BCRYPT))); //DAL?
	
        //Run app
        $truOrFalse = false;

        //Logg in function
        $htmlResponse = $loginView->response();

        //kolla om user är inloggad eller inte 
        if($users->isSessionSet() || $users->getSelectedUser() != NULL){
            $truOrFalse = TRUE;
        }
      
        $layoutView->render($truOrFalse, $htmlResponse, $dateTimeView);



