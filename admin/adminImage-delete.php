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

  $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); 
                                          

ActivityDAO::initialize("Activity");
ImageDAO::initialize("Image");

if ($id) { // If valid id sent
                       
    $image = ImageDAO::getImageforActivity($id);         
}
if (!$image) { // If no image
    redirect('adminActivity-update-create.php', ['id' => $id]);              
}

$path = '../upload/' . $image->getFile();  // Path to file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {// If form was submitted, Delete image from image
   ActivityDAO::deleteImage($id);                    
    if (file_exists($path)) {                        
        $unlink = unlink($path);                        
    }
    redirect('adminActivity-update-create.php', ['id' => $id]);              
}

Page::adminHeader();
?>

<main class="container admin" id="content">
      <form action="adminImage-delete.php?id=<?= $id ?>" method="POST" class="narrow">
        <h1>Delete Image</h1>
        <p><img src="../upload/<?= html_escape($image->getFile()) ?>" alt="<?= html_escape($image->getAlt()) ?>"></p>
        <p>Click confirm to delete the image:</p>
        <input type="submit" name="delete" value="Confirm" class="btn btn-primary" />
        <a href="adminActivity-update-create.php?id=<?= $id ?>" class="btn btn-danger">Cancel</a>
      </form>
  </main>
<?php Page::adminFooter(); ?>
