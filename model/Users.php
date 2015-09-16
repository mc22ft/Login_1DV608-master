<?php
    
namespace model;

//Array of users
class Users{
   
   private $users = array();
   private $userSessionHolder;

    public function __construct(sessionHolder $userSessionHolder) {
		$this->userSessionHolder = $userSessionHolder;
        
	}
    
	public function add(User $user) {
		$this->users[] = $user;
        
	}
    
    public function getUsers() {
		return $this->users;
	}

    //testa så user finns och password stämmer överens
    public function getThisUser(user $newUser) {
        
		foreach ($this->users as $user) {
           
			if ($user->getUsername() === $newUser->getUsername()) {
                
                if($user->getPassword() === $newUser->getPassword()){
                    $this->userSessionHolder->save($user);
                    return TRUE;
                }
			}
		}
        
        return FALSE;

	}

    //return user
    public function getSessionUser() {
		return $this->userSessionHolder->load();
	}
}

?>


