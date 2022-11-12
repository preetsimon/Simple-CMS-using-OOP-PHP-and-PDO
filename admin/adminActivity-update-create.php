<?php
require_once("../inc/Entity/Page.class.php");
require_once("../inc/Entity/Member.class.php");
require_once("../inc/Entity/Image.class.php");
require_once("../inc/Utility/CategoryDAO.class.php");
require_once("../inc/config.inc.php");

require_once("../inc/Utility/PDOAgent.class.php");
require_once("../inc/Utility/MemberDAO.class.php");
require_once("../inc/Utility/LoginManager.class.php");
require_once("../inc/Utility/ActivityDAO.class.php");
require_once("../inc/Entity/Activity.class.php");
require_once("../inc/Entity/Category.class.php");
require_once("../inc/Utility/functions.php");
require_once("../inc/Utility/ImageDAO.class.php");

session_start();

// File upload settings
$uploads = dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR;
$file_types      = ['image/jpeg', 'image/png', 'image/gif',];
$file_extensions = ['jpg', 'jpeg', 'png', 'gif',];
$max_size        = '5000000';

// Initialize variables that the PHP code needs
$id          = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$temp        = $_FILES['image']['tmp_name'] ?? '';
$destination = '';

$activityObj = new Activity();

$errors  = [
    'warning'     => '',
    'title'       => '',
    'location'     => '',
    'content'     => '',
    'author'      => '',
    'category'    => '',
    'image_file'  => '',
    'image_alt'   => '',
];

ActivityDAO::initialize("Activity");

// If there was an id, page is editing an activity, so get current activity data
if ($id) {
    // get database objects
    $activityObj = ActivityDAO::getActivityAndImage($id);

    if (!$activityObj) {
        redirect('adminActivies.php', ['failure' => 'Article not found']);
    }
}

$imageUploaded = $activityObj->getImageFile() ? true : false;

MemberDAO::init();
$authors = MemberDAO::getAllMembers();

CategoryDAO::initialize("Category");
$categories = CategoryDAO::getCategories();

$newActivity = new Activity();


//validate form data If form submitted

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // If file bigger than limit in php.ini or .htaccess store error message
    $errors['image_file'] = (isset($_FILES['image']['error']) && $_FILES['image']['error'] === 1) ? 'File too big ' : '';
    // If image was uploaded, get image data and validate
    if ($temp and $_FILES['image']['error'] === 0) {
        $activityObj->image_alt = $_POST['image_alt'];

        // Validate image file
        $errors['image_file'] = in_array(mime_content_type($temp), $file_types)
            ? '' : 'Wrong file type. ';
        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $errors['image_file'] .= in_array($extension, $file_extensions)
            ? '' : 'Wrong file extension. ';
        $errors['image_file'] .= ($_FILES['image']['size'] <= $max_size)
            ? '' : 'File too big. ';
        // Check alt text
        if (strlen($activityObj->image_alt) < 1) {
            $errors['image_alt'] = "Alt text must be 1-254 characters.";
        } elseif (strlen($activityObj->image_alt) > 254) {
            $errors['image_alt'] = "Alt text must be 1-254 characters.";
        }


        // If image file is valid, specify the location to save it
        if ($errors['image_file'] === '' and $errors['image_alt'] === '') { // If valid
            // $activityObj->image_file = create_filename($_FILES['image']['name'], $uploads);
            // $destination = $uploads . $activityObj->image_file;         // Destination

            $filename = $_FILES['image']['name'];

            $destination = '../upload/' . $filename;

            // move uplaoded file
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                $destination
            );
        }
    }

    // get activity data
    $activityObj->setTitle($_POST['title']);
    $activityObj->setLocation($_POST['location']);
    $activityObj->setContent($_POST['content']);
    $activityObj->setMemberID($_POST['memberID']);
    $activityObj->setCategoryID($_POST['categoryID']);
    $activityObj->setDisplayed((isset($_POST['displayed']) and ($_POST['displayed'] == 1)) ? 1 : 0);   // Is it displayed?

    // Validate activity data and create error messages if it is invalid
    if (strlen($activityObj->getTitle()) < 1) {
        $errors['title']    = 'Title must be 1-80 characters';
    } elseif (strlen($activityObj->getTitle()) > 80) {
        $errors['title']    = 'Title must be 1-80 characters';
    }

    if (strlen($activityObj->getLocation()) < 1) {
        $errors['location']  = 'location must be 1-254 characters';
    } elseif (strlen($activityObj->getLocation()) > 254) {
        $errors['location']  = 'location must be 1-254 characters';
    }

    if (strlen($activityObj->getContent()) < 1) {
        $errors['content']  = 'Content must be 1-100,000 characters';
    } elseif (strlen($activityObj->getContent()) > 1000000) {
        $errors['content']  = 'Content must be 1-1000,000 characters';
    }

    if (empty($activityObj->getmemberID())) {
        $errors['member']   = 'Please select an author';
    }

    if (empty($activityObj->getCategoryID())) {
        $errors['category'] = 'Please select a category';
    }

    $invalid = implode($errors);

    // Check if data is valid, if so update database
    if ($invalid) {
        $errors['warning'] = 'Please correct the errors below';
    } else {
        $arguments = $activityObj;

        if ($destination) { // If have valid image
            ImageDAO::initialize("Image");
            $imageObj = new Image();
            $imageObj->setAlt($arguments->image_alt);
            $imageObj->setFile($_FILES['image']['name']);

            $imageID = ImageDAO::createImage($imageObj);
            $activityObj->setImageID($imageID);
        }


        if ($id) {
            ActivityDAO::updateActivity($activityObj);
        } else {
            unset($arguments);
            ActivityDAO::createActivity($activityObj);
        }

        redirect('adminActivities.php', ['success' => 'Article saved']);
    }
    $activityObj->image_file = $imageUploaded ? $activityObj->getImageFile() : '';
}

Page::adminHeader();

?>

<form action="adminActivity-update-create.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
    <main class="container admin" id="content">

        <h1>Edit Activity</h1>
        <?php if ($errors['warning']) { ?>
            <div class="alert alert-danger"><?= $errors['warning'] ?></div>
        <?php } ?>

        <div class="admin-article">
            <section class="image">
                <?php if (!$activityObj->image_file) {
                    $activityObj->setTitle('');
                    $activityObj->setLocation('');
                    $activityObj->setContent('');  ?>
                    <label for="image">Upload image:</label>
                    <div class="form-group image-placeholder">
                        <input type="file" name="image" class="form-control-file" id="image"><br>
                        <span class="errors"><?= $errors['image_file'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="image_alt">Alt text: </label>
                        <input type="text" name="image_alt" id="image_alt" value="" class="form-control">
                        <span class="errors"><?= $errors['image_alt'] ?></span>
                    </div>
                <?php } else { ?>
                    <label>Image:</label>
                    <img src="../upload/<?= html_escape($activityObj->image_file) ?>" alt="<?= html_escape($activityObj->image_alt) ?>">
                    <p class="alt"><strong>Alt text:</strong> <?= html_escape($activityObj->image_alt) ?></p>
                    <a href="adminImage-edit-alt.php?id=<?= $activityObj->getID() ?>" class="btn btn-secondary">Edit alt text</a>
                    <a href="adminImage-delete.php?id=<?= $id ?>" class="btn btn-secondary">Delete image</a><br><br>
                <?php } ?>
            </section>

            <section class="text">
                <div class="form-group">
                    <label for="title">Title: </label>
                    <input type="text" name="title" id="title" value="<?= html_escape($activityObj->getTitle()) ?>" class="form-control">
                    <span class="errors"><?= $errors['title'] ?></span>
                </div>
                <div class="form-group">
                    <label for="summary">Location: </label>
                    <textarea name="location" id="summary" class="form-control"><?= html_escape($activityObj->getLocation()) ?></textarea>
                    <span class="errors"><?= $errors['location'] ?></span>
                </div>
                <div class="form-group">
                    <label for="content">Content: </label>
                    <textarea name="content" id="content" class="form-control"><?= html_escape($activityObj->getContent()) ?></textarea>
                    <span class="errors"><?= $errors['content'] ?></span>
                </div>
                <div class="form-group">
                    <label for="member_id">Author: </label>
                    <select name="memberID" id="memberID">
                        <?php foreach ($authors as $author) { ?>
                            <option value="<?= $author->getID() ?>" <?= ($activityObj->setMemberID($author->getID()))  ? 'selected' : ''; ?>>
                                <?= html_escape($author->getAuthor()) ?></option>
                        <?php } ?>
                    </select>
                    <span class="errors"><?= $errors['author'] ?></span>
                </div>
                <div class="form-group">
                    <label for="category">Category: </label>
                    <select name="categoryID" id="category">
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?= $category->getCategoryID() ?>" <?= ($activityObj->setCategoryID($category->getCategoryID())) ? 'selected' : ''; ?>>
                                <?= html_escape($category->getName()) ?></option>
                        <?php } ?>
                    </select>
                    <span class="errors"><?= $errors['category'] ?></span>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="displayed" value="1" class="form-check-input" id="published" <?= ($activityObj->setDisplayed(1)) ? 'checked' : ''; ?>>
                    <label for="published" class="form-check-label">Displayed</label>
                </div>
                <input type="submit" name="update" value="Save" class="btn btn-primary">
            </section>
        </div>
    </main>
</form>

<?php Page::adminFooter();
?>