<?php

    session_start();

    $message=null;
    if(count($_POST)>0) {
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";

        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        $result = mysqli_query($connection,"SELECT * FROM digitalmarketing.admin WHERE digitalmarketing.admin.admin_username='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
            $_SESSION["id"] = $row['admin_id'];
            $_SESSION["u_name"] = $row['admin_username'];
        } else {
            $message = true;
        }
    }
    if(isset($_SESSION["id"])) {
        header("Location:dashboard.php");
        //echo "yay";
    }
?>


<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Login</title>
    <link rel="shortcut icon" type="image/png" href="PictureAdminPage/BumblePixLogo.png" >
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/main.css" />
    <script src="js/uikit.js"></script>
    <script src="js/uikit-icons.js"></script>

</head>
<body>

<div id="offcanvas" data-uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar">
        <a class="uk-logo" href="../index.php">BumblePix</a>
        <button class="uk-offcanvas-close" type="button" data-uk-close="ratio: 1.2"></button>
        <ul class="uk-nav uk-nav-primary uk-nav-offcanvas uk-margin-medium-top uk-text-center"
            data-uk-scrollspy-nav="closest: li; scroll: true; offset: 80">

            <li><a href=#header>Login</a></li>
            <li><a href="../index.php">Back To main Site</a></li>
            <li><a href="../index.php">Contact</a></li>
        </ul>
        <div class="uk-margin-medium-top uk-text-center">
            <div data-uk-grid class="uk-child-width-auto uk-grid-small uk-flex-center">
                <div>
                    <a href="https://twitter.com/" data-uk-icon="icon: twitter" class="uk-icon-link" target="_blank"></a>
                </div>
                <div>
                    <a href="https://www.facebook.com/" data-uk-icon="icon: facebook" class="uk-icon-link" target="_blank"></a>
                </div>
                <div>
                    <a href="https://www.instagram.com/" data-uk-icon="icon: instagram" class="uk-icon-link" target="_blank"></a>
                </div>
                <div>
                    <a href="https://vimeo.com/" data-uk-icon="icon: vimeo" class="uk-icon-link" target="_blank"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<header id="header">
    <div data-uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent ; top: 600">
        <nav class="uk-navbar-container uk-letter-spacing-small uk-text-bold">
            <div class="uk-container">
                <div class="uk-position-z-index" data-uk-navbar>
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-item uk-logo" href="../index.php">BumblePixCo</a>
                    </div>
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav uk-visible@m" data-uk-scrollspy-nav="closest: li">


                            <li><a data-uk-scroll="offset: 80" href="#header">Login</a></li>
                            <li><a href="../index.php">Back To main Site</a></li>
                            <li><a  href="../index.php#">Contact</a></li>

                        </ul>
                        <a class="uk-navbar-toggle uk-hidden@m" href="#offcanvas" data-uk-toggle><span
                                    data-uk-navbar-toggle-icon></span></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</header>






<div id="login">
    <div class="uk-flex uk-flex-middle" data-uk-height-viewport="offset-top: true">
        <div class="uk-width-1-1">
            <div class="uk-section">
                <div class="uk-container">
                    <div class="uk-grid-large" data-uk-grid>
                        <div class="uk-width-1-2@m"
                             data-uk-scrollspy="cls: uk-animation-slide-left-small; repeat: true; delay: 200">
                            <img src="PictureAdminPage/Login.svg" alt="Header" width="800" height="1000">
                        </div>
                        <div class="uk-width-1-2@m  uk-flex uk-flex-middle"
                             data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                            <div class="uk-width-1-1@l">

                                <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Login</h1>

                                <div class="uk-margin-large-top ">

                                    <form  action="" method="post">
                                        <div class="uk-container ">


                                            <div class="uk-margin">
                                                <div class="uk-inline">

                                                    <label>
                                                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                                                        <input class="uk-input uk-form-width-large uk-form-large uk-button-secondary" type="text" placeholder="Username" name="user_name" required>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="uk-margin" >
                                                <div class="uk-inline">

                                                    <label>
                                                        <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                                        <input class="uk-input uk-form-width-large uk-form-large uk-button-secondary" type="password" placeholder="Password" name="password" required>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="uk-margin">
                                                <?php
                                                    if($message)
                                                    {
                                                        include_once "alert.php";
                                                    }
                                                ?>

                                            </div>


                                            <button class="uk-button uk-button-default" type="submit" >Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>