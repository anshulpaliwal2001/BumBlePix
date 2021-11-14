<?php
    function headerr($pagetitle) : void
    {
?>
        <!DOCTYPE html>
        <html lang="zxx" dir="ltr">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?php echo $pagetitle;?></title>
            <link rel="shortcut icon" type="image/png" href="../../PictureWebPage/BumblePixLogo.png" >
            <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="../../AdminSection/CSS/main.css" />
            <script src="../../AdminSection/js/uikit.js"></script>
            <script src="../../AdminSection/js/uikit-icons.js"></script>
        </head>
        <body>

        <div id="offcanvas" data-uk-offcanvas="flip: true; overlay: true">
            <div class="uk-offcanvas-bar">
                <a class="uk-logo" href="../../index.php">BumblePix</a>
                <button class="uk-offcanvas-close" type="button" data-uk-close="ratio: 1.2"></button>
                <ul class="uk-nav uk-nav-primary uk-nav-offcanvas uk-margin-medium-top uk-text-center"
                    data-uk-scrollspy-nav="closest: li; scroll: true; offset: 80">

                    <li><a href=#header>Login</a></li>
                    <li><a href="../../index.php">Back To main Site</a></li>
                    <li><a href="../../index.php">Contact</a></li>
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
                                <a class="uk-navbar-item uk-logo" href="../../index.php">BumblePixCo</a>
                            </div>
                            <div class="uk-navbar-right">
                                <ul class="uk-navbar-nav uk-visible@m" data-uk-scrollspy-nav="closest: li">


                                    <li><a data-uk-scroll="offset: 80" href="#header">Login</a></li>
                                    <li><a href="../../index.php">Back To main Site</a></li>
                                    <li><a  href="../../index.php">Contact</a></li>

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
    }
