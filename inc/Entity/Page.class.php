<?php

class Page
{

    public static $title = "Week 09 Demo";

    static function header($activity = NULL, $navigation)
    {  // display header
?>

        <!DOCTYPE html>
        <html lang="en-US">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?php if ($activity) {
                        echo html_escape($activity->getTitle());
                    } else echo "Home";  ?></title>
            <link rel="stylesheet" type="text/css" href="css/styles.css">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
            <link rel="shortcut icon" type="image/png" href="img/favicon.ico">
        </head>

        <body>
            <header>
                <div class="container">
                    <a class="skip-link" href="#content">Skip to content</a>
                    <div class="logo">
                        <a href="index.php"><img src="img/logo.png" alt="Creative Folk"></a>
                    </div>
                    <nav>
                        <button id="toggle-navigation" aria-expanded="false">
                            <span class="icon-menu"></span><span class="hidden">Menu</span>
                        </button>
                        <ul id="menu">
                            <?php foreach ($navigation as $link) { ?>
                                <li><a href="category.php?id=<?= $link->getID() ?>" <?php if ($activity) {
                                                                                        ($activity->getCategoryID() == $link->getID());
                                                                                    } ?> class="on" ?>
                                        <?= html_escape($link->getName()) ?>
                                    </a></li>
                            <?php } ?>
                            <li><a href="search.php">
                                    <span class="icon-search"></span><span class="search-text">Search</span>
                                </a></li>

                            <li class="logout">
                                <div id="logout">
                                    <a class="on" href="memberLogout.php">
                                        Logout
                                    </a>
                                </div>

                            </li>
                        </ul>
                    </nav>
                </div>
            </header>


        <?php }

    static function adminHeader()
    {    // header for admin pages
        ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Admin</title>
                <link rel="stylesheet" href="../css/styles.css">
                <link rel="preconnect" href="https://fonts.gstatic.com">
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
                <link rel="shortcut icon" type="image/png" href="../img/favicon.ico">
            </head>

            <body>
                <header class="header-admin">
                    <div class="container">
                        <a class="skip-link" href="#content">Skip to content</a>
                        <div class="logo">
                            <a href="adminIndex.php"><img src="../img/logo.png" alt="OUTDOORS"></a>
                        </div>
                        <nav>
                            <button id="toggle-navigation" aria-expanded="false">
                                <span class="icon-menu"></span><span class="hidden">Menu</span>
                            </button>
                            <ul id="menu">
                                <li><a href="adminActivities.php">Activities</a></li>
                                <!-- <li><a href="otherTable.php">Categories</a></li> -->
                                <li>
                                    <a href="../memberLogout.php">
                                        Logout
                                    </a>

                                </li>
                            </ul>
                        </nav>
                    </div>
                </header>
            <?php
        }

        static function footer()
        { ?>
                <footer>
                    <div class="container">
                        &copy; CSIS 3280 Project <?= date('Y'); ?>
                    </div>
                </footer>
                <!-- <script src="js/site.js"></script> -->
            </body>

            </html>
        <?php }

        static function adminFooter()
        {
        ?>
            <footer>
                <div class="container">
                    &copy; CSIS 3280 Project <?= date('Y'); ?>
                </div>
            </footer>
            <!-- <script src="../js/site.js"></script> -->
        </body>

        </html>
    <?php
        }



        static function showLogin($err)
        { ?>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Login</title>
            <link rel="stylesheet" href="css/styleForm.css">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
            <link rel="shortcut icon" type="image/png" href="../img/favicon.ico">
        </head>

        <div class="form">
            <div class="title">Welcome</div>
            <div class="subtitle">Login to access website</div>
            <form action="" method="post">
                <div class="input-container ic1">
                    <input id="full-Name" name="full_name" class="input" type="text" placeholder=" " />

                    <label for="full-Name" class="placeholder">username</label>
                    <span class="errors"><?= $err ?></span>
                </div>
                <div class="input-container ic2">
                    <input id="password" name="password" class="input" type="password" placeholder=" " />

                    <label for="password" class="placeholder">password</label>
                    <span class="errors"><?= $err ?></span>
                </div>

                <input type="submit" class="submit" value="Submit">
                <input type="reset" class="submit" value="Reset">


                <!-- <input id="password" name="password" class="input" type="password" placeholder=" " /> -->

                <div class="subtitle">
                    <a href="./memberRegister.php">New users Register here</a>
                </div>

            </form>
        </div>


    <?php }






        
        
    }
