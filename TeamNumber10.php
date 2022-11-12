<?php
  require_once("inc/config.inc.php");
  require_once("inc/Entity/Page.class.php");
  require_once("inc/Entity/Member.class.php");
  require_once("inc/Utility/CategoryDAO.class.php");
  
  
  require_once("inc/Utility/PDOAgent.class.php");
  require_once("inc/Utility/MemberDAO.class.php");
  require_once("inc/Utility/LoginManager.class.php");
  require_once("inc/Utility/ActivityDAO.class.php");
  require_once("inc/Entity/Activity.class.php");
  require_once("inc/Entity/Category.class.php");
  require_once("inc/Utility/functions.php");

  // this is the login page

  // init the User DAO
MemberDAO::init();
$err ='';

if(!empty($_POST['full_name'])){
    $authUser = MemberDAO::getMemberbyUsername($_POST['full_name']);

    // check if the user exists or not
    // check if the password is verified
    if($authUser && $authUser->verifyPassword($_POST['password'])){
        // start the session
        session_start();

        // register the session var
        $_SESSION['loggedin'] = $authUser->getAuthor();
    } else {
        $err = 'Incorrect username or password.';
    }

}
// check user type: admin or casual user
if(LoginManager::verifySession()) {
    if($_SESSION['loggedin'] == "admin"){
      // forward to admin panel
      header(("Location: admin/adminIndex.php"));
    }
    else{
 // forward them to normal user index
 header("Location: index.php"); 
    }
   
}else {
 // display login page
 Page::showLogin($err);

}
