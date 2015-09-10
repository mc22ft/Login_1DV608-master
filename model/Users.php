<?php
    
namespace model;

//Array of users
class Users{
   
    private $users = array();
    //private $selected;
	//private $dal;

 //   public function __construct(SelectedUserDAL $dal) {
	//	$this->dal = $dal;
	//}
 //    public function __construct() {
	//	
	//}
    
	public function add(User $user) {
		$this->users[] = $user;
        
	}
    
    public function getUsers() {
		return $this->users;
	}

    //testa så user finns och password stämmer överens
    public function getThisUser($usernameString, $passwordString) {
        
		foreach ($this->users as $user) {
           
			if ($user->getUsername() === $usernameString) {
                
                if($user->getPassword() === $passwordString){
                     
                    return TRUE;
                }
			}
		}
        
        return FALSE;

	}
}

?>


