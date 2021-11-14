<?php

?>
<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Admin</title>
    <link rel="shortcut icon" type="image/png" href="PictureAdminPage/BumblePixLogo.png" >
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/main.css" />
    <script src="js/uikit.js"></script>
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
            <li><a href="#contact">Contact</a></li>
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
                            <li><a data-uk-scroll="offset: 200" href="#contact">Contact</a></li>

                        </ul>
                        <a class="uk-navbar-toggle uk-hidden@m" href="#offcanvas" data-uk-toggle><span
                                data-uk-navbar-toggle-icon></span></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="uk-flex uk-flex-middle" data-uk-height-viewport="offset-top: true">
        <div class="uk-width-1-1">
            <div class="uk-section">
                <div class="uk-container">
                    <div class="uk-grid-large" data-uk-grid>
                        <div class="uk-width-1-2@m"
                             data-uk-scrollspy="cls: uk-animation-slide-left-small; repeat: true; delay: 200">
                            <img src="PictureAdminPage/AdminIntro.svg" alt="Header" width="800" height="1000">
                        </div>
                        <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                             data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                            <div>
                                <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Welcome Admin</h1>
                                <p class="uk-text-lead uk-width-4-5@m">
                                    We’re a digital marketing agency that delivers transformational growth for our clients.
                                    With services ranging from Search to Content to Social Media to Website Design to Mobile Advertising,
                                    we consult, strategize and execute to deliver #DigitalExcellence!</p>
                                <div class="uk-margin-medium-top">
                                    <a href="Login.php" target="" class="uk-button uk-button-large uk-button-primary" >Login As Admin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<footer class="uk-section uk-section-primary uk-border-large-top">
    <div class="uk-container">
        <div class="uk-child-width-1-3@l" data-uk-grid>
            <div>
                <div class="uk-child-width-expand@s" data-uk-grid data-uk-scrollspy-nav="closest: div; scroll: true; offset: 100">

                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href=#header>Login</a></h5>
                    </div>
                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href="../index.php">Back To main Site</a></h5>
                    </div>

                </div>
            </div>
        </div>
        <div class="uk-child-width-expand@s uk-flex uk-flex-bottom" data-uk-grid>
            <div>
                <div>
                    <a href="#" class="uk-logo uk-margin-medium-top uk-display-inline-block">BumblePix</a>
                    <p class="uk-margin-remove">Made by <a href="https://drifter.works/" target="_blank">Anshul Paliwal</a> for University Project</p>
                </div>
            </div>
            <div>
                <div class="uk-padding uk-padding-remove-vertical">
                    <div data-uk-grid class="uk-child-width-auto uk-grid-small">
                        <div class="uk-first-column">
                            <a href="#" data-uk-icon="icon: facebook; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="#" data-uk-icon="icon: instagram; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="#" data-uk-icon="icon: twitter; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="#" data-uk-icon="icon: dribbble; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="#" data-uk-icon="icon: youtube; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>


