<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once("model/User.php");
require_once("model/Users.php");
//require_once("model/SelectedUserDAL.php");
require_once("controller/LoginController.php");
require_once("model/SessionHolder.php");

session_start();

//if (!isset($_SESSION["visits"]))
//        $_SESSION["visits"] = 0;
//    $_SESSION["visits"] = $_SESSION["visits"] + 1;
// 
//    if ($_SESSION["visits"] > 1)
//    {
//        
//        //you refreshed the page!
//        //var_dump("f5");
//    }
//    else
//    {
//        //  här relodas f5 tangenten
//        header("Location:".$_SERVER['HTTP_REFERER']."");
//        //nothing to do here!
//        //var_dump("else");
//    }

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On'); //Testa med 1

//
//set up the model
//$dal = new \model\SelectedUserDAL();
$sessionHolder = new \model\SessionHolder("userSessionHolder");


$controller = new \controller\LoginController($sessionHolder);
//$controller->isUserinTheSystem(NULL, NULL);
$controller->doRunApp();
//print_r($_SESSION);
//var_dump(isset($_SESSION));

//$isLoogedIn = $sessionHolder->isLoggedIn();

//$lv->render($isLoogedIn, $v, $dtv);



