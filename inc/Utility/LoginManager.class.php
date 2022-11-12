<?php

class LoginManager  {

    //This function checks if the user is logged in, if they are not they are redirected to the login page
    static function verifySession()   {

        // check for existence of a session
        if(session_id() == '' || !isset($_SESSION)){
            // start the session
            session_start();
        }
        if(isset($_SESSION['loggedin'])){
            // the user is login and we have session
            return true;
        }
        else{
            // user is not login
            // destroy the session, just in case
            session_destroy();
            return false;
        }

    }
        
    
}
