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

    //sparar user i dal - görs en gång vid start
    public function updateUser($updatedUserPassword) {
		$this->dal->updateSelection($this->getSelectedUser(), $updatedUserPassword);
	}

    //hämtar aktuell user hämtas i getUserByNameAndPassword
    public function getSelectedUser() {
		return $this->selected;
	}

    //get user anv ej
    public function getUsers() {
		return $this->users;
	}


    //testa så user finns och password stämmer överens med string
    public function getUserByNameAndPassword($nameString, $passwordString) {//Här kan hashed password komma in!
        
        // Insert $hashAndSalt into database against user
        //$hashAndSalt = password_hash($passwordString, PASSWORD_BCRYPT);
        //var_dump($hashAndSalt);
        // Fetch hash+salt from database, place in $hashAndSalt variable
        // and then to verify $password:
        //if (password_verify($passwordString, $hashAndSalt)) {
        //// Verified
        ////var_dump("password verify");
        //}

        
		foreach($this->users as $user) {
           
           

			if ($user->getUsername() === $nameString) {
                //
                //Login with "Password"
                if (password_verify($passwordString, $user->getPassword())) {
                    //sätter secelted user till inloggad
                    $this->selected = $user;
               
                    //FUNCTION SET NEW HASH
                    if (password_needs_rehash($user->getPassword(), PASSWORD_BCRYPT, ['cost' => 12])) {
                         //var_dump("loggat in med password as password");

                        $updatedPasswordString = password_hash($passwordString, PASSWORD_BCRYPT, ['cost' => 12]);
                        // (Save the new hash in the database)
                        $this->updateUser($updatedPasswordString);


                    }

                    
                   
                    return $user;
                    //Login with hash string = cookie FAIL if password changes
                }else if($passwordString === $user->getPassword()){
                    //sätter secelted user till inloggad med cookies
                    $this->selected = $user;
                    return $user;
                }
			}
		}
        return null;
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
    public function saveSessionUser(user $user) {
		$this->userSessionHolder->save($user);
	}
}

?>

