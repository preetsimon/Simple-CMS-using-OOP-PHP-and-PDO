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

 /*
 Display all activities for admin
 */
 
 session_start();
 $success = $_GET['success'] ?? null;                   // Check for success message
 $failure = $_GET['failure'] ?? null;   
 

 ActivityDAO::initialize("Activity");
 
 // get database objects
 $activities = ActivityDAO::getAllActivities();

 Page::adminHeader(); 
?>
  <main class="container" id="content">
    <section class="header">
      <h1>Activities</h1>
      <?php if ($success) { ?><div class="alert alert-success"><?= $success ?></div><?php } ?>
      <?php if ($failure) { ?><div class="alert alert-danger"><?= $failure ?></div><?php } ?>
      <p><a href="adminActivity-update-create.php" class="btn btn-primary">Add new activity</a></p>
    </section>
    <table>
      <tr>
        <th>Image</th><th>Title</th><th class="created">Created</th><th class="pub">Displayed</th><th class="edit">Edit</th><th class="del">Delete</th>
      </tr>
      <?php foreach ($activities as $activity) { ?>
      <tr>
        <td><img src="../upload/<?= html_escape($activity->image_file ?? 'blank.png') ?>"
                 alt="<?= html_escape($activity->image_alt) ?>"></td>
        <td><strong><?= html_escape($activity->getTitle()) ?></strong></td>
        <td><?= format_date($activity->getCreated()) ?></td>
        <td><?= ($activity->getDisplayed()) ? 'Yes' : 'No' ?></td>
        <td><a href="adminActivity-update-create.php?id=<?= $activity->getID() ?>" class="btn btn-primary">Edit</a></td>
        <td><a href="adminActivity-delete.php?id=<?= $activity->getID() ?>" class="btn btn-danger">Delete</a></td>
      </tr>
      <?php } ?>
    </table>
  </main>

  <?php 
  
  Page::adminFooter();
  ?>