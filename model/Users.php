<?php
   
namespace model;

//Array of users
class Users{
   
    private $users = array();
    private $userSessionHolder;
    private $selected;
    private $dal;

    public function __construct(sessionHolder $userSessionHolder, SelectedUserDAL $dal) {
		$this->userSessionHolder = $userSessionHolder;
        $this->dal = $dal;
        //In med alla users i en array - arrayen blir som min databas med en anv :)
		$this->users[] = $this->dal->getSavedUser();
	}
  
    //sparar user i dal - görs en gång vid start
    public function add(User $user) {
		$this->dal->saveSelection($user);
	}

    //hämtar aktuell user hämtas i getUserByNameAndPassword
    public function getSelectedUser() {
		return $this->selected;
	}

    public function setselectUser(User $user) {
		$this->selected = $user;
	}

    //Update password
    public function updateUser(user $user, $passwordString){
        //FUNCTION SET NEW HASH PASSWORD
        
        if (password_needs_rehash($passwordString, PASSWORD_BCRYPT)) {
                $newPassword = password_hash($passwordString, PASSWORD_BCRYPT);
               
                // (Save the new hash in the database)
                $newUser = $this->dal->updateSelection($user, $newPassword);
                //update user med nya password i modelen
                //var_dump("--xxxxx--");
                //var_dump($newUser);
                //var_dump("--xxxxx--");
                return $newUser;
         }
    }

    //Login user
    public function loginUser($nameString, $passwordString) {
		foreach($this->users as $user) {
			if ($user->getUsername() === $nameString) {
                //Login with "Password"
                if (password_verify($passwordString, $user->getPassword())) {
                        $newUser = $this->updateUser($user, $passwordString);
                        return $newUser;
                }else if($passwordString === $user->getPassword()){
                        return $user;
                }
            }
		}
        return NULL;
	}
    
    //logout user
    public function logout(){
        $this->selected = NULL;
    }
   

    //return user
    public function getSessionUser() {
		return $this->userSessionHolder->load();
	}

    //unset session
    public function unsetSessionUser() {
		$this->userSessionHolder->delete();
	}

    //unset session
    public function isSessionSet() {
		return $this->userSessionHolder->set();
	}

    //unset session
    public function saveSessionUser() {
		$this->userSessionHolder->save();
	}
}

?>

