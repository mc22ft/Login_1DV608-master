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
ini_set('display_errors', 'On'); 

//set up the model
$sessionHolder = new \model\SessionHolder("userSessionHolder");
$dal = new \model\SelectedUserDAL();
$users = new \model\Users($sessionHolder, $dal);
$controller = new \controller\LoginController($users);
$loginView = new \view\LoginView($users, $controller);
$dateTimeView = new \view\DateTimeView();
$layoutView = new \view\LayoutView();


//New user - Add a user in "selected.user" file if its has to reloads 
//$users->add(new \model\User("Admin", password_hash("Password", PASSWORD_BCRYPT)));
	
        //Run app
        $LoggedInOrNot = false;

        //Logg in function
        $htmlResponse = $loginView->response();

        //Check if session is set and if there is a user logged in
        if($users->isSessionSet() || $users->getSelectedUser() != NULL){
            $LoggedInOrNot = TRUE;
        }
        
        //Output
        $layoutView->render($LoggedInOrNot, $htmlResponse, $dateTimeView);



