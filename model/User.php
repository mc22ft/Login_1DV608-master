<?php

namespace model;


class User {

    private $username;
    private $password;

    public function __construct($username, $password) {
			   $this->username = $username;
               $this->password = $password;
	}
    
    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    //Not in use
    public function setUsername($Username){
        $this->username = $Username;
    }

    public function setPassword($Password){
        $this->password = $Password;
    }

}

?>
