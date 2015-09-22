<?php

namespace controller;

class LoginController{

    private $users;

    public function __construct(\model\users $users){
        $this->users = $users;
       }

    //Bool
    public function doLoginUser($username, $password){
        //1.Hämta en user modelen
        $selected = $this->users->loginUser($username, $password);
         //2.Kolla om den är null eller inte
         //var_dump($selected);
        if($selected != NULL){
            
            //sätt user i modelen
            $this->users->setselectUser($selected);
            
           
            //Sätter session
            $this->users->saveSessionUser();
           
            return TRUE;
        }
        return FALSE;
    }

    public function doSessionLogin(){
        $sessionUser = $this->users->getSessionUser();
        
    }

    public function doLogout(){
        $this->users->unsetSessionUser();
        $this->users->logout();
    }


}
?>
