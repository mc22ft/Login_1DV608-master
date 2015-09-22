<?php

namespace model;

class SessionHolder{

    private $sessionHolderId;
    private $sessObj;
    
    public function __construct($sessionHolderId) {
		$this->sessionHolderId = $sessionHolderId;
        $this->sessObj = new \model\SessionUser($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
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
	public function save() {
        //$this->sessObj = new \model\SessionUser($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']); 
        
        //var_dump($this->SessObj);
        
        //var_dump("session saved sessionholder!!!!");
		$_SESSION[$this->sessionHolderId] = $this->sessObj;
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
    public function set() { // === $this->SessObj->getIp()
        //var_dump($this->sessOb);
       

        if (isset($_SESSION[$this->sessionHolderId]) && isset($this->sessObj)) {

            //var_dump($this->sessObj);
            //var_dump($_SESSION[$this->sessionHolderId]);
            //var_dump($_SESSION[$this->sessionHolderId]->getIp() === $this->sessObj->getIp());
            //var_dump($_SESSION[$this->sessionHolderId]->getIp());
            //var_dump($_SESSION[$this->sessionHolderId]->getIp() === $this->sessObj->getIp());

            if($_SESSION[$this->sessionHolderId]->getIp() === $this->sessObj->getIp() &&
                    $_SESSION[$this->sessionHolderId]->getBrowser() === $this->sessObj->getBrowser()){
                return TRUE;
            }
            
            
		}
        return FALSE;
	}
}

?>

