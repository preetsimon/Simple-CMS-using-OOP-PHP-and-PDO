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

   // still need to start session
session_start();

// unset our registered session
unset($_SESSION['loggedin']);

// destroy the session
session_destroy();

// Page::header();


Page::footer();

//sleep(4);
header("Location: TeamNumber10.php");
?>