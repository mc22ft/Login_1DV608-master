<?php

namespace model;

class SessionUser {

    private $ip;
    private $browser;

    public function __construct($ip, $browser) {
			   $this->ip = $ip;
               $this->browser = $browser;
	}
    
    public function getIp(){
        return $this->ip;
    }

    public function getBrowser(){
        return $this->browser;
    }
}

?>
