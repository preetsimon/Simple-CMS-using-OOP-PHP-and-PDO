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
// Validate id
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); 
if (!$id) {                                              
    redirect('adminActivities.php', ['failure' => 'Article not found']); // Redirect with error
}

ActivityDAO::initialize("Activity");
$activity = false;                                         
$activity = ActivityDAO::getActivityAndImage($id);

if (!$activity) { // If $activity empty Redirect
    redirect('adminActivities.php', ['failure' => 'Article not found']); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // If there is an image, delete the image first.
    if ($activity->getImageID()) { // If there was an image, Set the image path. If image file exists, delete image file
        ActivityDAO::deleteImage($id);
        $path = '../upload/' . $activity->image_file;  
        if (file_exists($path)) {                        
            $unlink = unlink($path);                    
        }
    }

    ActivityDAO::deleteActivity($id);
    redirect('adminActivities.php', ['success' => 'Article deleted']); // Redirect after deleting

}
Page::adminHeader();
?>
<main class="container admin" id="content">
    <form action="adminActivity-delete.php?id=<?= $id ?>" method="POST" class="narrow">
        <h1>Delete Activty</h1>
        <p>Click confirm to delete the article: <em><?= html_escape($activity->getTitle()) ?></em></p>
        <input type="submit" name="delete" value="Confirm" class="btn btn-primary">
        <a href="adminActivities.php" class="btn btn-danger">Cancel</a>
    </form>
</main>

<?php Page::adminFooter(); ?>