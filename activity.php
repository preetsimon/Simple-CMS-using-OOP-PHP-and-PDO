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

// Validate id. If no valid id, Page not found.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo "<h1>Page not found.</h1>";
}

MemberDAO::init();
ActivityDAO::initialize("Activity");
CategoryDAO::initialize("Category");


// get database objects
$activity = ActivityDAO::getActivityDetail($id);
$navigation = CategoryDAO::getNavigationBar();

Page::header($activity, $navigation);

?>
<main class="article container" id="content">
    <section class="image">
        <img src="upload/<?= html_escape($activity->image_file ?? 'blank.png') ?>" alt="<?= html_escape($activity->image_alt) ?>">
    </section>
    <section class="text">
        <h1><?= html_escape($activity->getTitle()) ?></h1>
        <div class="date"><?= format_date($activity->getCreated()) ?></div>
        <div class="content"><?= html_escape($activity->getContent()) ?></div>
        <p class="credit">
            Posted in <a href="category.php?id=<?= $activity->getCategoryID() ?>"><?= html_escape($activity->category) ?></a> by <a href="member.php?id=<?= $activity->getMemberID() ?>">
                <?= html_escape($activity->author) ?></a>

        </p>
    </section>
</main>
<?php
Page::footer();
?>