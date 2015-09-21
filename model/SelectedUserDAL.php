<?php
    
namespace model;

class SelectedUserDAL {

	private static $fileName = "selectedUser.user";

	//**
	// * @return \model\User
	// */
	public function getSavedUser() {
		$fileContent = @file_get_contents(self::$fileName);
		if ($fileContent !== FALSE){
			return unserialize($fileContent);
		}
		return null;
	}

    public function updateSelection(User $toBeUpdatedUser, $updatedUserPassword) {
         //var_dump("updatera password 1");

        $arrUsers[] = $this->getSavedUser();

        foreach($arrUsers as $user) {
            //var_dump("updatera password 2");
             //var_dump($user->getPassword());
             



             if($user->getUsername() === $toBeUpdatedUser->getUsername()){
                //var_dump("updatera password 3");

                $user->setPassword($updatedUserPassword);

                //var_dump($user->getPassword());
                //save
                $this->saveSelection($user);

                
            }
        }
       



		//$content = serialize($toBeSaved);
		//file_put_contents(self::$fileName, $content);
	}

	public function saveSelection(User $toBeSaved) {
		$content = serialize($toBeSaved);
		file_put_contents(self::$fileName, $content);
	}
}

?>