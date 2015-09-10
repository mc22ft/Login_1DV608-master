<?php

namespace controller;

class LoginController{
    
   
	private $model;

    public function __construct(\model\users $users) {
		
		$this->model = $users;
	}


    //Finns anv i systemet?
    function isUserinTheSystem($username, $password){

        $inSystem = $this->model->getThisUser($username, $password);
        return $inSystem;
    }

   
}





?>
