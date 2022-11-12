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
?>




<?php
// initialize the UserDAO
MemberDAO::init("Member");

$email_err = '';
$fullName_err = '';
$password_err = '';
$confirm_password_err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Assemble user object
    $newUser = new Member();
    $newUser->setEmail($_POST['email']);
    $param_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Creates a password hash
    $newUser->setPassword($param_password);
    $newUser->setFullName($_POST['full-name']);

    $pictures = ['member.png', 'member2.png', 'member3.png', 'memberdefault.png'];
    $picture = $pictures[array_rand($pictures)];
    $newUser->setPicture($picture);

    // check for duplicate username/full-name
    $duplicateUser = MemberDAO::getMemberByUsername($_POST['full-name']);
    if (MemberDAO::$db->rowCount() == 1) {
        $fullName_err = "Sorry :( This username is already taken!";
    }

    // Validate password
    if (empty(trim($_POST["full-name"]))) {
        $fullName_err = "Please enter a full-name.";
    } elseif (strlen(trim($_POST["full-name"])) < 3) {
        $fullName_err = "full-name must have atleast 3 characters.";
    } else {
        $fullName = trim($_POST["full-name"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm-password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm-password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // validate email
    $input["Email"] = $_POST['email'];
    $input["Email"] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if (!$input['Email']) {
        $email_err = 'Please enter valid email.';
    } else {
        $email = trim($_POST["email"]);
    }



    // Check input errors before inserting in database
    if (empty($email_err) && empty($fullName_err) && empty($password_err) && empty($confirm_password_err)) {
        MemberDAO::createUser($newUser);
        // ? make sure same header is not implemented twice at separate instances
        // Redirect to login page
        header("location: TeamNumber10.php");
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="css/styleForm.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico">
</head>

<div class="form">
    <div class="title">Welcome</div>
    <div class="subtitle">Let's create your account!</div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-container ic1">
            <input id="full-Name" name="full-name" class="input" type="text" placeholder=" " />
            <label for="full-Name" class="placeholder">Full name</label>
            <span class="errors"><?= $fullName_err ?></span>
        </div>
        <div class="input-container ic2">
            <input id="password" name="password" class="input" type="password" placeholder=" " />
            <label for="password" class="placeholder">password</label>
            <span class="errors"><?= $password_err ?></span>
        </div>
        <div class="input-container ic2">
            <input id="confirm-password" name="confirm-password" class="input" type="password" placeholder=" " />
            <label for="confirm-password" class="placeholder">confirm password</label>
            <span class="errors"><?= $confirm_password_err ?></span>
        </div>
        <div class="input-container ic2">

            <input id="email" name="email" class="input" type="email" placeholder=" " />
            <label for="email" class="placeholder">Email</label>
            <span class="errors"><?= $email_err ?></span>
        </div>
        <input type="submit" class="submit" value="Submit">
        <input type="reset" class="submit" value="Reset">
        <div class="subtitle">
            <a href="./TeamNumber10.php">Have an account? Login here</a>
        </div>
        <div class="cut"></div>
</div>

</form>
</div>