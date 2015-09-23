<?php

namespace controller;

class LoginController{

    private $users;

    public function __construct(\model\users $users){
        $this->users = $users;
       }

    //Bool
    //Login
    public function doLoginUser($username, $password){
        //Get user or NULL
        $selected = $this->users->loginUser($username, $password);
        if($selected != NULL){
            //Set user in model
            $this->users->setselectUser($selected);
            //Set session in model
            $this->users->saveSessionUser();
            return TRUE;
        }
        return FALSE;
    }

    //Set
    //Logout
    public function doLogout(){
        $this->users->unsetSessionUser();
        $this->users->logout();
    }
}
?>
