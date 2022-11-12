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
 
 
 session_start();
 MemberDAO::init();
 ActivityDAO::initialize("Activity");
 CategoryDAO::initialize("Category");
 
 
 // get database objects
 $activities = ActivityDAO::getActivityIndex();
 $navigation = CategoryDAO::getNavigationBar();
 
 Page::header(NULL, $navigation);

 ?> 

  <main class="container grid" id="content">
    <?php foreach ($activities as $activity) { ?>
      <article class="summary">
        <a href="activity.php?id=<?= $activity->getID() ?>">
          <img src="upload/<?= html_escape($activity->image_file ?? 'blank.png') ?>"
               alt="<?= html_escape($activity->image_alt) ?>">
          <h2><?= html_escape($activity->getTitle()) ?></h2>
          <p><?= html_escape($activity->getLocation()) ?></p>
        </a>
        <p class="credit">
          Posted in <a href="category.php?id=<?= $activity->getCategoryID() ?>">
          <?= html_escape($activity->category) ?></a>
          by <a href="member.php?id=<?= $activity->getMemberID() ?>">
          <?= html_escape($activity->author) ?></a>
        </p>
      </article>
    <?php } ?>
  </main>

  <?php
    Page::footer(); 
  ?>
 


