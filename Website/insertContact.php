<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Contact</title>
    <link rel="shortcut icon" type="image/png" href="PictureWebPage/BumblePixLogo.png" >
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="AdminSection/CSS/main.css" />
    <script src="AdminSection/js/uikit.js"></script>
</head>
<body>

<header id="header">
    <div data-uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent ; top: 600">
        <nav class="uk-navbar-container  uk-letter-spacing-small uk-text-bold">
            <div class="uk-container">
                <div class="uk-position-z-index" data-uk-navbar>
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-item uk-logo" href="index.php">BumblePixCo</a>
                    </div>
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav uk-visible@m" data-uk-scrollspy-nav="closest: li">



                            <li><a data-uk-scroll="offset: 80" href="#success">Back To main Site</a></li>


                        </ul>
                        <a class="uk-navbar-toggle uk-hidden@m" href="#offcanvas" data-uk-toggle><span
                                    data-uk-navbar-toggle-icon></span></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<?php

    $server_name= "localhost";
    $db_user="root";
    $db_password="";
    $db_name="digitalmarketing";

    $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
    $dbconfig=mysqli_select_db($connection,$db_name);

    if($connection==false)
    {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $name=$_POST['name'];
    $mail=$_POST['mail'];
    $reason=$_POST['reason'];
    $message=$_POST['txtMessage'];





    $sql=$sql="INSERT INTO contacts (contact_name, contact_mail, contact_reason, contact_message) VALUES ('$name', '$mail', '$reason', '$message')";



    if(mysqli_query($connection, $sql))
    { ?>
        <div id="success" class="uk-section uk-section-large  uk-preserve-color- ">
            <div class="uk-position-relative">
                <img class="uk-align-center" data-src="PictureWebPage/Successful.svg" width="500" height="500" alt="" uk-img>
            </div>
            <div class="uk-container uk-align-center">
                <div class="uk-card uk-card-body uk-text-center ">
                    <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Submitted Succesfully</h1>
                    <h2 class="uk-text-small uk-text-bold"> The form was succesfully subbmitted, we will contact you as soon as possitble. <br> Thankyou</h2>
                    <h1 class="uk-margin-remove uk-text-uppercase uk-h4 uk-letter-spacing-small uk-align-center">
                        <a class="hvr-back" href="index.php"><span
                                    class="uk-margin-right" data-uk-icon="arrow-left"></span>back to site</a>
                    </h1>
                </div>

            </div>

        </div>

        <?php
    }
    else{

        ?>
        <div id="fail" class="uk-section uk-section-large  uk-preserve-color- ">
            <div class="uk-position-relative">
                <img class="uk-align-center" data-src="PictureWebPage/error.svg" width="500" height="500" alt="" uk-img>
            </div>
            <div class="uk-container uk-align-center">
                <div class="uk-card uk-card-body uk-text-center ">
                    <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Somthing is broken!</h1>
                    <h2 class="uk-text-small uk-text-bold"> Seems like somthing is broken at our side, please try again later <br> Thankyou for your patience</h2>
                    <h1 class="uk-margin-remove uk-text-uppercase uk-h4 uk-letter-spacing-small uk-align-center">
                        <a class="hvr-back" href="index.php"><span
                                    class="uk-margin-right" data-uk-icon="arrow-left"></span>back to site</a>
                    </h1>
                </div>

            </div>

        </div>

        <?php

    }

    ?>



<div id="offcanvas" data-uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar">
        <a class="uk-logo" href="index.php">BumblePix</a>
        <button class="uk-offcanvas-close" type="button" data-uk-close="ratio: 1.2"></button>
        <ul class="uk-nav uk-nav-primary uk-nav-offcanvas uk-margin-medium-top uk-text-center"
            data-uk-scrollspy-nav="closest: li; scroll: true; offset: 80">
            <li><a href="index.php">Back to Site</a></li>



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


</body>

</html>



