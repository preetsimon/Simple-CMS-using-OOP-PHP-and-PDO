<?php
   require_once("../inc/Entity/Page.class.php");
   require_once("../inc/Entity/Member.class.php");
   require_once("../inc/Utility/CategoryDAO.class.php");
   require_once("../inc/config.inc.php");
   
   require_once("../inc/Utility/PDOAgent.class.php");
   require_once("../inc/Utility/MemberDAO.class.php");
   require_once("../inc/Utility/LoginManager.class.php");
   require_once("../inc/Utility/ActivityDAO.class.php");
   require_once("../inc/Entity/Activity.class.php");
   require_once("../inc/Entity/Category.class.php");
   require_once("../inc/Utility/functions.php");

   session_start();

   ActivityDAO::initialize("Activity");
   
   $activitiesCount = ActivityDAO::getCount();

 Page::adminHeader();
?>

<main class="container" id="content">
    <section class="header">
      <h1>Admin</h1>
    </section>
    <table class="admin">
      <tr><th></th><th>Count</th><th class="create">Create</th><th class="view">View</th></tr>
      <tr><td><strong>Articles</strong></td><td><?= $activitiesCount?></td><td><a href="adminActivity-update-create.php" class="btn btn-primary">Add</a></td><td><a href="adminActivities.php" class="btn btn-primary">View</a></td></tr>
    </table>
  </main>
<?php Page::adminFooter(); ?>