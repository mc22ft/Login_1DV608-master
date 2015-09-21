<?php

namespace model;

class SessionHolder{

    private $sessionHolderId;
    
    public function __construct($sessionHolderId) {
		$this->sessionHolderId = $sessionHolderId;
		//make sure we have a session
		assert(isset($_SESSION));
	}

    /**
	* @return sessionObj or null      GET????
	*/
	public function load() {
		    if (isset($_SESSION[$this->sessionHolderId])) {
            //var_dump("session load sessionholder!!!!");
			return $_SESSION[$this->sessionHolderId];
		}
         return NULL;
	}

    /**
	* @param set user
	*/
	public function save(User $user) {
        //var_dump("session saved sessionholder!!!!");
		$_SESSION[$this->sessionHolderId] = $user;
	}

     /**
	* unset session
	*/
    public function delete() {
        //var_dump("Session unset in sessionholder");
		unset($_SESSION[$this->sessionHolderId]);
        //var_dump($_SESSION[$this->sessionHolderId]);
	}

    //return bool
    public function set() {
        if (isset($_SESSION[$this->sessionHolderId])) {
            //var_dump("Session set in sessionholder True");
            return TRUE;
		}
        return FALSE;
	}
}

?>

