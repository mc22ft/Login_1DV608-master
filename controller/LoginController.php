<?php

namespace controller;

class LoginController{

    private $loginView;
    private $dateTimeView;
    private $layoutView;
    
    private $users;

    public function __construct(\model\sessionHolder $userSessionHolder){

        $dal = new \model\SelectedUserDAL();
        $this->users = new \model\Users($userSessionHolder, $dal);
        $this->loginView = new \view\LoginView($this->users);
        $this->dateTimeView = new \view\DateTimeView();
        $this->layoutView = new \view\LayoutView();
      
        $this->users->add(new \model\User("Admin", password_hash("Password", PASSWORD_BCRYPT, ['cost' => 10]))); //DAL?
	}

    public function doRunApp(){
        
        $truOrFalse = false;

        //Logg in function
        $htmlResponse = $this->loginView->response();

        //kolla om user är inloggad eller inte 
        if($this->users->isSessionSet() || $this->loginView->isCookieSet()){
            $truOrFalse = TRUE;
        }
      
        $this->layoutView->render($truOrFalse, $htmlResponse, $this->dateTimeView);
    }
}
?>
