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
	* @return sessionObj or null
	*/
	public function load() {
		if (isset($_SESSION[$this->sessionHolderId])) {
			return $_SESSION[$this->sessionHolderId];
		}
         return NULL;
	}

    /**
	* @param set user
	*/
	public function save(User $user) {
		$_SESSION[$this->sessionHolderId] = $user;
	}
}

?>

