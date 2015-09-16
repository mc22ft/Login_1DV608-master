<?php

namespace controller;

class LoginController{
    
	
    private $loginView;
    private $dateTimeView;
    private $layoutView;
    //private $userSessionHolder;
    private $users;

    public function __construct(//\view\LoginView $loginView, 
    //                            \view\DateTimeView $dateTimeView,
    //                            \view\LayoutView $layoutView,
                                  \model\sessionHolder $userSessionHolder) 
    {
        //$this->loginView = $loginView;
        //$this->dateTimeView = $dateTimeView;
        //$this->layoutView = $layoutView;
        //$this->userSessionHolder = $userSessionHolder;



        $this->users = new \model\Users($userSessionHolder);
        //CREATE OBJECTS OF THE VIEWS
        $this->loginView = new \view\LoginView($this->users);
        $this->dateTimeView = new \view\DateTimeView();
        $this->layoutView = new \view\LayoutView();

        $this->users->add(new \model\User("Admin", "Password"));
	}

 //    * Facade
	// * @return boolean
	// */
	//public function isLoggedIn() {
	//	return $this->model->isLoggedIn();
	//}
	//
	///** 
	// * Facade
	// * @return \login\model\UserCredentials
	// */
	//public function getLoggedInUser() {
	//	return $this->model->getLoggedInUser();
	//}
	//

 //   public function doPickUser() {
	//	//Get user input
	//	$selected = $this->view->getSelectedUser();
	//	if ($selected != null) {
	//		//Make changes to the model state
	//		$this->model->select($selected);
	//	}
	//}
	//public function getOutput() {
	//	//present the state
	//	$selected = $this->model->getSelectedUser();
	//	return  $this->view->getHTML($selected);
	//}
    
    public function doRunApp(){
        
        $truOrFalse = false;


        //Logg in function
        $htmlResponse = $this->loginView->response();

        //Check if session or cookie is set
        if($this->loginView->isSessionSet()){
            $truOrFalse = TRUE;

        }else if(true){//$this->loginView->isCookieSet()
            
        }
        else{
            $truOrFalse = FALSE;
        }

        

        //$truOrFalse = $this->users->getSessionUser();



        //var_dump($truOrFalse);
        //if(!isset($truOrFalse)){
        //    $truOrFalse = TRUE;
        //}else{
        //    $truOrFalse = true;
        //}

        $this->layoutView->render($truOrFalse, $htmlResponse, $this->dateTimeView);
        
    }



    //Dopickuser
    //public function isUserinTheSystem($username, $password){

    //    //getselected user  saveaelected
    //    $inSystem = $this->model->getThisUser($username, $password);
    //    
    //    //return $this->layoutView->render($inSystem, $this->loginView, $this->dateTimeView);

    //    //Return logged in view 
    //    //om user finns i sys = SetSession!
    //    //if(){
    //        //call model session save!
    //   // }

    //    return $inSystem;
    //}


}





?>
