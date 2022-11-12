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


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); 
if (!$id) {                                               
    echo "<h1>Page not found.</h1>";                         
}

MemberDAO::init();

CategoryDAO::initialize("Category");


// get database objects
$member = MemberDAO::getMember($id);
$activities = MemberDAO::getActiclesFromMember($id);
$navigation = CategoryDAO::getNavigationBar();

Page::header($member, $navigation);

?>
  <main class="container" id="content">
    <section class="header">
      <h1><?= html_escape($member->getAuthor()) ?></h1>
      <p class="member"><b>Member since:</b> <?= format_date($member->joined) ?></p>
      <img src="upload/<?= html_escape($member->getPicture() ?? 'member.png') ?>"
           alt="<?= html_escape($member->getAuthor()) ?>" class="profile"><br>
    </section>
    <section class="grid">
    <?php foreach ($activities as $activity) { ?>
      <article class="summary">
        <a href="activity.php?id=<?= $activity->getID() ?>">
          <img src="upload/<?= html_escape($activity->image_file ?? 'blank.png') ?>"
               alt="<?= html_escape($activity->image_alt) ?>">
          <h2><?= html_escape($activity->getTitle()) ?></h2>
          <p><?= html_escape($activity->location) ?></p>
        </a>
        <p class="credit">
          Posted in <a href="category.php?id=<?= $activity->categoryID ?>">
          <?= html_escape($activity->category) ?></a>
          by <a href="member.php?id=<?= $activity->memberID ?>">
          <?= html_escape($activity->author) ?></a>
        </p>
      </article>
    <?php } ?>
    </section>
  </main>


<?php
Page::footer();
?>