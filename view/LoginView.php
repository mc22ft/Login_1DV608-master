<?php

namespace view;

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private $users;

	public function __construct(\model\Users $users) {
		$this->users = $users;
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = '';

      

        if (!isset($_SESSION["visits"]))
        $_SESSION["visits"] = 0;
        $_SESSION["visits"] = $_SESSION["visits"] + 1;
 
        if ($_SESSION["visits"] > 1)
        {
            if(isset($_POST[self::$logout])){
             
             //var_dump($_POST);
            
                 $this->logout();
                 $message = "Bye bye!";
                 
                 return $this->generateLoginFormHTML($message);
            }
        }
        //else
        //{
            $message = "";
      //      $response = $this->generateLoginFormHTML($message);
		    //return $response;
            //  här relodas f5 tangenten
            //header("Location:".$_SERVER['HTTP_REFERER']."");
            //nothing to do here!
            //var_dump("F5 är tryckt!!!");
        //}

         //if(isset($_POST[self::$logout])){
         //    
         //    var_dump($_POST);
         //   
         //        $this->logout();
         //        $message = "Bye bye!";
         //        
         //        return $this->generateLoginFormHTML($message);
         //}

        
        if($this->isSessionSet()){
            return $this->generateLogoutButtonHTML($message);
        }
        


        //Field empty test for username and password
        if (isset($_POST[self::$login])){
            if (empty($_POST[self::$name])){
                $message = "Username is missing";
            }
            else{
                if(empty($_POST[self::$password])){
                    $message = "Password is missing";
                }
                else{

                    //finns user eller inte
                    $newUser = new \model\User($_POST[self::$name], $_POST[self::$password]);

                    //if($this->users->getThisUser($_POST[self::$name], $_POST[self::$password])){
                        if($this->users->getThisUser($newUser)){

                        
                        $message = "Welcome";
                        //SET Cookie function

                        if(isset($_POST[self::$keep])){


                            //SET COOKIE
                           $this->setCookie();

                        }
                        
                        $response = $this->generateLogoutButtonHTML($message);

                           return $response;
                    }
                    else{
                        $message = "Wrong name or password";
                    }

                }
            }

       } 

       $response = $this->generateLoginFormHTML($message);
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
        return '
			<form method="post"> 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestUserName() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
        if(isset($_POST[self::$name])){
            return $_POST[self::$name]; 
        }
        else{
            return "";
        }
	}

    private function setCookie(){
         setcookie(self::$cookieName, $_SESSION["UserName"], time() + 3600); //TIME?
         setcookie(self::$cookiePassword, $_SESSION["PassWord"], time() + 3600); //TIME?
    }

    public function isCookieSet(){
        //Om det finns en cookie så logga in med den.
        //$u = $_COOKIE[self::$cookieName]; 
        //$p = $_COOKIE[self::$cookiePassword];
        ////Check if user and password is in system
        //if($svar = $this->users->getThisUser($u, $p)){
        //    return TRUE;
        //}
        //return FALSE;
        $name = "";
        $password = "";
       if(isset($_COOKIE[self::$cookieName])){   // only if it is set
         $name = $_COOKIE[self::$cookieName];
        }
         if(isset($_COOKIE[self::$cookiePassword])){   // only if it is set
         $password = $_COOKIE[self::$cookiePassword];
        }
       
        //Check if user and password is in system
        if($this->users->getThisUser($name, $password)){
            return TRUE;
        }
        return FALSE;

    }

    //return bool
    public function isSessionSet(){

        //Get session obj
        $sessionObj = $this->users->getSessionUser();

        //If null retunr false
        if(!is_null($sessionObj)){
            if($this->users->getThisUser($sessionObj)){
                return TRUE;
                }
        }
        

        return FALSE;
    }

    private function logout(){
        // remove all session variables
        session_unset(); 

        // destroy the session 
        //session_destroy(); 
    }


   

    

	
}