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
// get search term, display 3 results on one page
$term  = filter_input(INPUT_GET, 'term');
$show  = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 3;
$from  = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0;
$count = 0;
$activities = [];

MemberDAO::init();
ActivityDAO::initialize("Activity");
CategoryDAO::initialize("Category");

$navigation = CategoryDAO::getNavigationBar();

if ($term) {   // If search term provided. Store search term in array                                       
  $arguments['term1'] = '%' . $term . '%';
  $arguments['term2'] = '%' . $term . '%';
  $arguments['term3'] = '%' . $term . '%';

  $count = ActivityDAO::getColumns($arguments);

  if ($count > 0) { // If articles match term, Add to array for pagination. 
    $arguments['show'] = $show;
    $arguments['from'] = $from;

    $activities = ActivityDAO::searchResults($arguments);
  }
}

if ($count > $show) { // If matches is more than show, Calculate total pages. Calculate current page
  $total_pages  = ceil($count / $show);
  $current_page = ceil($from / $show) + 1;
}
Page::header(NULL, $navigation);

?>
<main class="container" id="content">
  <section class="header">
    <form action="search.php" method="get" class="form-search">
      <label for="search"><span>Search for: </span></label>
      <input type="text" name="term" value="<?= html_escape($term) ?>" id="search" placeholder="Enter search term" /><input type="submit" value="Search" class="btn btn-search" />
    </form>
    <?php if ($term) { ?><p><b>Matches found:</b> <?= $count ?></p><?php } ?>
  </section>

  <section class="grid">
    <?php foreach ($activities as $activity) { ?>
      <article class="summary">
        <a href="activity.php?id=<?= $activity->getID() ?>">
          <img src="upload/<?= html_escape($activity->image_file ?? 'blank.png') ?>" alt="<?= html_escape($activity->image_alt) ?>">
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
  </section>

  <?php if ($count > $show) { ?>
    <nav class="pagination" role="navigation" aria-label="Pagination Navigation">
      <ul>
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
          <li>
            <a href="?term=<?= $term ?>&show=<?= $show ?>&from=<?= (($i - 1) * $show) ?>" class="btn <?= ($i == $current_page) ? 'active" aria-current="true' : '' ?>">
              <?= $i ?>
            </a>
          </li>
        <?php } ?>
      </ul>
    </nav>
  <?php } ?>

</main>
<?php Page::footer(); ?>