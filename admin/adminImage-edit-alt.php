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

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Get and validate id

$errors = [
  'alt' => '',
  'warning' => '',
];

ActivityDAO::initialize("Activity");
ImageDAO::initialize("Image");

if ($id) {

  $image = ImageDAO::getImageforActivity($id);         // Get image data
}
if (!$image) {  // If no image
  redirect('adminActivity-update-create.php', ['id' => $id]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $image->setAlt($_POST['image_alt']);                  // Get alt text

  // Check alt text
  if (strlen($image->getAlt()) < 1) {
    $errors['image_alt'] = "Alt text must be 1-254 characters.";
  } elseif (strlen($image->getAlt()) > 254) {
    $errors['image_alt'] = "Alt text must be 1-254 characters.";
  }
  if ($errors['alt']) {  // If alt text not long enough
    $errors['warning'] = 'Please correct error below';
  } else {


    ImageDAO::updateImageAlt($image);                   // Update alt text
    redirect('adminActivity-update-create.php', ['id' => $id]);
  }
}
Page::adminHeader()
?>
<main class="container admin" id="content">
  <form action="adminImage-edit-alt.php?id=<?= $id ?>" method="POST" class="narrow">
    <h1>Update Alt Text</h1>
    <?php if ($errors['warning']) { ?><div class="alert alert-danger"><?= $errors['warning'] ?></div><?php } ?>

    <div class="form-group">
      <label for="image_alt">Alt text: </label>
      <input type="text" name="image_alt" id="image_alt" value="<?= html_escape($image->getAlt()) ?>" class="form-control">
      <span class="errors"><?= $errors['alt'] ?></span>
    </div>

    <div class="form-group">
      <input type="submit" name="delete" value="Confirm" class="btn btn-primary btn-save">
    </div>

    <img src="../upload/<?= $image->getFile() ?>" alt="<?= html_escape($image->getAlt()) ?>">
  </form>
</main>

<?php Page::adminFooter(); ?>