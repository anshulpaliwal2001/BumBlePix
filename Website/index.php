


<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Home</title>
    <link rel="shortcut icon" type="image/png" href="PictureWebPage/BumblePixLogo.png" >
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="AdminSection/CSS/main.css" />
    <script src="AdminSection/js/uikit.js"></script>
</head>

<body>

<header id="header">
    <div data-uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent ; top: 600">
        <nav class="uk-navbar-container uk-letter-spacing-small uk-text-bold">
            <div class="uk-container">
                <div class="uk-position-z-index" data-uk-navbar>
                    <div class="uk-navbar-left" >
                        <a href="index.php">
                            <img width="80" height="50" alt="" uk-img="PictureWebPage\BumblePixLogo.png" uk-svg>
                        </a>
                        <a class="uk-navbar-item uk-logo" href="index.php">BumblePixCo</a>
                    </div>
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav uk-visible@m" data-uk-scrollspy-nav="closest: li">
                            <li><a data-uk-scroll="offset: 80" href="#header">Home</a></li>
                            <li><a data-uk-scroll="offset: 80" href="#projects">Projects</a></li>
                            <li><a data-uk-scroll="offset: 80" href="#services">Services</a></li>
                            <li><a data-uk-scroll="offset: 80" href="#about">About</a></li>
                            <li><a data-uk-scroll="offset: 80" href="#facts">Facts</a></li>
                            <li><a data-uk-scroll="offset: 80" href="#team">Team</a></li>
                            <li><a data-uk-scroll="offset: 80" href="#clients">Clients</a></li>
                            <li><a data-uk-scroll="offset: 200" href="#contact">Contact</a></li>
                            <li><a href='UserSection/UserCredentials/UserLogin.php'>Login</a></li>
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
                        <div class="uk-width-1-2@m uk-animation-toggle" data-uk-scrollspy="cls: uk-animation-slide-left-small; repeat: true; delay: 200">
                            <img class="" src="PictureWebPage/IndexIntro.svg" alt="Header" width="1000" height="1000">
                        </div>
                        <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                             data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                            <div>
                                <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">We Design & Build Creative
                                    Brands</h1>
                                <p class="uk-text-lead uk-width-4-5@m">
                                    We’re a digital marketing agency that delivers transformational growth for our clients.
                                    With services ranging from Search to Content to Social Media to Website Design to Mobile Advertising,
                                    we consult, strategize and execute to deliver #DigitalExcellence!</p>
                                <div class="uk-margin-medium-top">
                                    <a href="#projects" class="uk-button uk-button-large uk-button-primary"
                                       data-uk-scroll="offset: 80">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>




<?php

    require 'AdminSection/Database/dbconfig.php';
    $query="SELECT * FROM project";
    $query_run=mysqli_query($connection,$query);
    $check_project= mysqli_num_rows($query_run)>0;

?>
<div id="projects" class="uk-section uk-section-large uk-section-primary uk-preserve-color-">
    <div class="uk-container">
        <div class="uk-visible-toggle" tabindex="-1" data-uk-slider="autoplay: true" autoplay-interval='4000' >
            <div class="uk-position-relative">
                <div class="uk-slider-container uk-box-shadow-medium uk-background-primary-light">
                    <ul class="uk-slider-items uk-child-width-1-1">




                        <?php

                            $query="SELECT * FROM project ORDER BY rand()";
                            $query_run=mysqli_query($connection,$query);
                            $check_project= mysqli_num_rows($query_run)>0;
                            $path="AdminSection/ProjectSectionAdmin/ImagesProject";
                            if($check_project)
                            {
                                while ($row=mysqli_fetch_array($query_run))
                                {
                                    ?>
                                    <li>
                                        <div class="uk-grid-collapse" data-uk-grid>
                                            <div class="uk-width-1-2@s" >
                                                <img  src=" <?php echo "AdminSection/ProjectSectionAdmin/ImagesProject/",$row['Image']; ?>" alt="Slide" width="600" height="600">
                                            </div>
                                            <div class="uk-width-expand@s uk-flex uk-flex-middle">

                                                    <div class="uk-padding-large">
                                                        <h3 class="uk-text-uppercase uk-h5 uk-letter-spacing-small">Our Project</h3>
                                                        <h2 class="uk-heading-small uk-margin-medium-top"> <?php echo $row['Title']; ?> </h2>
                                                        <div>
                                                            <?php echo $row['Description']; ?>
                                                        </div>
                                                        <hr class="uk-margin-medium-top uk-separator-small">
                                                        <h3 class="uk-margin-remove uk-text-uppercase uk-h5 uk-letter-spacing-small">
                                                            <a class="hvr-forward" <?php echo "href='",$row ['Site'],"'" ?> target="_blank">Visit Site<span
                                                                        class="uk-margin-left" data-uk-icon="arrow-right"></span>
                                                            </a>


                                                        </h3>
                                                    </div>
                                                </div>



                                        </div>
                                    </li>

                                    <?php
                                }

                            }
                            else
                            {
                                echo" no record found";
                            }
                        ?>


                    </ul>
                </div>
                <div class="uk-hidden@l">
                    <a class="uk-position-center-left uk-position-small" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
                </div>

                <div class="uk-visible@l uk-light">
                    <a class="uk-position-center-left-out uk-slidenav-large" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
                    <a class="uk-position-center-right-out uk-slidenav-large" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
                </div>
            </div>
        </div>

    </div>

</div>


<div id="services" class="uk-section uk-section-primary- uk-section-large">
    <div class="uk-container">
        <h3 class="uk-text-uppercase uk-h5 uk-letter-spacing-small">Our Service Studio</h3>
        <h2 class="uk-heading-small uk-margin-medium">Services</h2>
        <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-5@l uk-grid-match" data-uk-grid>
            <?php

                $query="SELECT * FROM services ORDER BY rand()";
                $query_run=mysqli_query($connection,$query);
                $check_project= mysqli_num_rows($query_run)>0;

                if($check_project)
                {

                    while ($row=mysqli_fetch_array($query_run))
                    {
                        ?>

                        <div>
                            <div class="uk-card uk-card-small uk-card-body uk-border-medium uk-flex uk-flex-column">
                                <div class="uk-text-center uk-text-secondary  uk-overflow-hidden" >
                                    <img  <?php echo "src='AdminSection/ServicesSectionAdmin/", $row['service_image'],"'"; ?>  alt="" >
                                </div>
                                <hr class="uk-margin-large-top uk-separator-small">
                                <h3 class="uk-margin-remove uk-text-uppercase uk-h5 uk-letter-spacing-small"> <?php echo "$row[service_title]"; ?></h3>
                                <a class="uk-button  uk-button-small uk-button-primary uk-width-2-3 uk-margin-small-top " href="#services<?php echo $row['service_id']; ?>" uk-toggle>More</a>
                                <div id="services<?php echo $row['service_id']; ?>" class="uk-modal-full" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                                        <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                                            <div class="uk-background-cover" style="background-image: url(' <?php echo "AdminSection/ServicesSectionAdmin/","$row[service_image]"; ?>');" uk-height-viewport></div>
                                            <div class="uk-padding-large uk-text-justify">
                                                <h1 class="uk-heading-medium uk-letter-spacing-small"> <?php echo "$row[service_title]"; ?></h1>
                                                <p class="uk-text-justify"> <?php echo "$row[service_details]"; ?></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                }
            ?>
        </div>
    </div>
</div>

<div id="about" class="uk-section uk-section-large uk-section-primary">
    <div class="uk-container">
        <div class="uk-child-width-1-2@m uk-grid-match" data-uk-grid>
            <div>
                <div class="uk-padding-large uk-padding-remove-left uk-padding-remove-vertical uk-flex uk-flex-column">
                    <h3 class="uk-text-uppercase uk-h5 uk-letter-spacing-small">The Story So Far</h3>
                    <h2 class="uk-heading-small uk-margin-small-top">About Us</h2>
                    <div class="uk-margin-auto-bottom uk-text-justify">
                        <p>BumblePix is an innovative web agency based in Udaipur, RAJ.
                            Our passion for helping small and medium size businesses has grown us into a
                            full-service strategic marketing company developing online solutions for organizations across
                            business sectors.</p>
                        <p>Our mission is always to provide the highest quality products and services to our customers.</p>
                        <p>This customer-focused mindset has earned us accolades for offering some of the best
                            service and support in the industry. We build mutually beneficial relationships with our clients that deliver success.</p>
                    </div>
                    <hr class="uk-margin-auto-top uk-separator-small">
                    <h3 class="uk-margin-remove uk-text-uppercase uk-h5 uk-letter-spacing-small"><a class="hvr-forward" href="#contact" data-uk-scroll="offset: 200">Contact<span class="uk-margin-left" data-uk-icon="arrow-right"></span></a></h3>
                </div>
            </div>
            <div>
                <div id="test-filter" class="uk-height-large uk-background-cover uk-overflow-hidden uk-flex uk-flex-top"  style="background-image: url('PictureWebPage/1x1Poster.jpg');">
                </div>
            </div>
        </div>
    </div>
</div>


<?php

    $query="SELECT * FROM facts WHERE fact_id=1";
    $query_run=mysqli_query($connection,$query);
    $row=mysqli_fetch_array($query_run);
    $check_project= mysqli_num_rows($query_run)>0;
    if($check_project)
    {?>
        <div id="facts" class="uk-section uk-section-primary- uk-section-large">
            <div class="uk-container">
                <div class="uk-grid-large" data-uk-grid>
                    <div class="uk-width-1-3@m">
                        <h2 class="uk-heading-small uk-margin-large-bottom">Key Facts</h2>

                        <h3 class="uk-heading-2xlarge uk-text-primary"><?php echo $row['projects']; ?> </h3>
                        <hr class="uk-margin-bottom uk-margin-medium-top uk-separator-small">
                        <h3 class="uk-margin-remove-bottom uk-text-uppercase uk-h5 uk-letter-spacing-small uk-margin-small-top">Successful Projects</h3>
                    </div>

                    <div class="uk-width-expand@m uk-flex uk-flex-column">
                        <h3 class="uk-margin-auto-top uk-margin-medium-bottom">Designed For Growth</h3>
                        <div class="uk-child-width-1-3" data-uk-grid>
                            <div>
                                <h3 class="uk-heading-xlarge"><?php echo $row['employees']; ?></h3>
                                <hr class="uk-margin-bottom uk-margin-medium-top uk-separator-small">
                                <h3 class="uk-text-uppercase uk-h5 uk-letter-spacing-small uk-margin-small-top">Employees</h3>
                            </div>
                            <div>
                                <h3 class="uk-heading-xlarge"><?php echo $row['years']; ?></h3>
                                <hr class="uk-margin-bottom uk-margin-medium-top uk-separator-small">
                                <h3 class="uk-text-uppercase uk-h5 uk-letter-spacing-small uk-margin-small-top">Years</h3>
                            </div>
                            <div>
                                <h3 class="uk-heading-xlarge"><?php echo $row['locations']; ?></h3>
                                <hr class="uk-margin-bottom uk-margin-medium-top uk-separator-small">
                                <h3 class="uk-text-uppercase uk-h5 uk-letter-spacing-small uk-margin-small-top">Locations</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    if(!$check_project)
    {

        echo "<div style='text-align: center' class='uk-width-1-1@l'>
        <h2 class='uk-heading-large uk-margin-large'><br>No Data For Services</h2> </div>";
    }

?>



<div id="team" class="uk-section uk-section-primary uk-section-large">
    <div class="uk-container">
        <h2 class="uk-heading-small">Our Team</h2>
        <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-5@l
      uk-margin-large-top uk-grid-match" data-uk-grid>
            <div>
                <div class="uk-card uk-card-small uk-border-medium">
                    <div class="uk-card-media-top ">
                        <img src="PictureWebPage/Team/Akshay1.jpg" alt="Tow Sawyer">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title uk-margin-remove">Akshay Kumar</h3>
                        <p class="uk-text-small uk-margin-xsmall">CEO</p>
                        <div data-uk-grid class="uk-child-width-auto uk-grid-small uk-margin-top">
                            <div>
                                <a href="#" data-uk-icon="icon: facebook; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: instagram; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: twitter; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: dribbble; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: youtube; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-small uk-border-medium">
                    <div class="uk-card-media-top">
                        <img src="PictureWebPage\Team\Jasper Warner.jpg" alt="Tow Sawyer">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title uk-margin-remove">Jasper Warner</h3>
                        <p class="uk-text-small uk-margin-xsmall">Manager</p>
                        <div data-uk-grid class="uk-child-width-auto uk-grid-small uk-margin-top">
                            <div>
                                <a href="#" data-uk-icon="icon: facebook; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: instagram; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: dribbble; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: youtube; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-small uk-border-medium">
                    <div class="uk-card-media-top">
                        <img src="PictureWebPage\Team\Sara%20Kapoor.jpg" alt="Tow Sawyer">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title uk-margin-remove">Sally Dennis</h3>
                        <p class="uk-text-small uk-margin-xsmall">HR</p>
                        <div data-uk-grid class="uk-child-width-auto uk-grid-small uk-margin-top">
                            <div>
                                <a href="#" data-uk-icon="icon: facebook; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: instagram; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: twitter; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: youtube; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-small uk-border-medium">
                    <div class="uk-card-media-top">
                        <img src="PictureWebPage/Team/Tyler%20Reeves.jpg" alt="Tow Sawyer">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title uk-margin-remove">Tyler Reeves</h3>
                        <p class="uk-text-small uk-margin-xsmall">Art Director</p>
                        <div data-uk-grid class="uk-child-width-auto uk-grid-small uk-margin-top">
                            <div>
                                <a href="#" data-uk-icon="icon: facebook; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: instagram; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: twitter; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: dribbble; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                            <div>
                                <a href="#" data-uk-icon="icon: youtube; ratio: .8" class="uk-icon-link uk-icon"
                                   target="_blank"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-small uk-card-body uk-border-medium uk-flex uk-flex-column">
                    <h3>Join Us</h3>
                    <p class="uk-margin-auto-bottom">Contact us to check our vacancy and give your career a jump. </p>
                    <hr class="uk-margin-auto-top uk-separator-small">
                    <h3 class="uk-margin-remove uk-text-uppercase uk-h5 uk-letter-spacing-small"><a class="hvr-forward" href="#contact" data-uk-scroll="offset: 200">Contact<span class="uk-margin-left" data-uk-icon="arrow-right"></span></a></h3>
                </div>
            </div>
        </div>
    </div>
</div>





<div id="clients" class="uk-section  uk-section-large">
    <div class="uk-container">
        <div class="uk-child-width-1-2@s uk-child-width-1-4@m uk-grid-match" data-uk-grid>
            <div>
                <div class="uk-flex uk-flex-column uk-padding-small uk-padding-remove-horizontal uk-padding-remove-top">
                    <h3 class="uk-text-uppercase uk-h5 uk-letter-spacing-small">Selected</h3>
                    <h2 class="uk-heading-small uk-margin-top">Clients</h2>
                    <hr class="uk-margin-auto-top uk-separator-small uk-separator-primary">
                    <h3 class="uk-margin-remove uk-text-uppercase uk-h5 uk-letter-spacing-small"><a class="hvr-forward" href="#contact" data-uk-scroll="offset: 200">Contact<span class="uk-margin-left" data-uk-icon="arrow-right"></span></a></h3>
                </div>
            </div>
            <?php

                $query="SELECT * FROM clients";
                $query_run=mysqli_query($connection,$query);
                $check_project= mysqli_num_rows($query_run)>0;
                if($check_project)
                {
                    while ($row=mysqli_fetch_array($query_run))
                    {?>


                        <div>
                            <div class="uk-padding uk-background-primary uk-text-center uk-light">
                                <?php echo "<img class='uk-width-1-1' src='" , $row['client_image'],"' alt='Logo' data-uk-svg>"; ?>

                                <hr class="uk-separator-small uk-margin-auto">
                                <h3 class="uk-margin-remove uk-text-uppercase uk-h5 uk-letter-spacing-small"> <?php echo $row['client_name'];?>   </h3>

                            </div>

                        </div>
                        <?php
                    }
                }
                else
                {
                    echo "NO DATA";
                }
            ?>


        </div>
    </div>
</div>




<div  class="uk-height-small uk-background-cover uk-light uk-flex" uk-parallax="bgy: -500" style="background-image: url('PictureWebPage/BG.jpg">
    <h1 class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical " uk-parallax="opacity: 0,1; y: 50,0; viewport: 0.5">Contact</h1>
</div>












<div id="contact" class="uk-section uk-section-large">
    <div class="uk-container">
        <div class="uk-child-width-1-2@s" data-uk-grid>
            <div>
                <div>
                    <h3 class="uk-text-uppercase uk-h5 uk-letter-spacing-small">Let's talk</h3>
                    <h2 class="uk-heading-small uk-margin-medium-top">Give Us a Call</h2>
                    <p class="uk-width-4-5@l">Contact Us here</p>
                    <div class="uk-margin-medium-top uk-h4 uk-letter-spacing-small">
                        <div>Phone: <a class="uk-link-border uk-link-border-bold" href="tel:123-456-789">123-456-789</a></div>
                        <div class="uk-margin-top">Email: <a class="uk-link-border uk-link-border-bold" href="mailto:anshul.backup2001@gmail.com">anshul.backup2001@gmail.com</a></div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-padding uk-background-primary-light uk-light uk-box-shadow-large" data-uk-scrollspy="cls: uk-animation-slide-right; repeat: true; delay: 100">
                    <h3 class="uk-text-uppercase uk-h5 uk-letter-spacing-small">Send us a message</h3>
                    <form class="uk-grid-small uk-margin-medium-top" data-uk-grid action="insertContact.php" method="post">
                        <div class="uk-width-1-1">
                            <label>
                                <input class="uk-input uk-form-large" type="text" name="name" placeholder="Full Name">
                            </label>
                        </div>
                        <div class="uk-width-1-1">
                            <label>
                                <input class="uk-input uk-form-large" type="email" name="mail" placeholder="Email Address">
                            </label>
                        </div>
                        <div class="uk-width-1-1">
                            <label for="reason"></label>
                            <label>
                                <select name="reason" class="uk-select uk-form-large" >
                                    <option value="">Reason for contacting us</option>
                                    <option value="Quote request">Quote request</option>
                                    <option value="Arrange a meeting">Arrange a meeting</option>
                                    <option value="Work for us">Work for us</option>
                                    <option value="Legal">Legal</option>
                                    <option value="Other">Other</option>
                                </select>
                            </label>
                        </div>
                        <div class="uk-width-1-1">
                            <label for="message"></label>
                            <label for="txtMessage"></label><textarea class="uk-textarea" rows="5" placeholder="Message" name="txtMessage" id="txtMessage"></textarea>


                        </div>
                        <div class="uk-width-1-1">
                            <button class="uk-button uk-button-large uk-button-primary">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="uk-section uk-section-primary uk-border-large-top">
    <div class="uk-container">
        <div class="uk-child-width-1-2@m" data-uk-grid>
            <div>
                <div class="uk-child-width-expand@s" data-uk-grid data-uk-scrollspy-nav="closest: div; scroll: true; offset: 100">
                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href="#projects">Projects</a></h5>
                    </div>
                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href="AdminSection/AdminIntro.php">Admin</a></h5>
                    </div>
                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href="#clients">Clients</a></h5>
                    </div>
                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href="#services">Services</a></h5>
                    </div>
                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href="#contact">Contact</a></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-align-left uk-flex uk-flex-bottom" data-uk-grid>
            <div>
                <div>
                    <a href="#" class="uk-logo uk-margin-medium-top uk-display-inline-block">BumblePix</a>
                    <p class="uk-margin-remove">Made by <a href="" target="_blank">Anshul Paliwal</a> for University Project</p>
                </div>
            </div>
            <div>
                <div class="uk-padding uk-padding-remove-vertical">
                    <div data-uk-grid class="uk-child-width-auto uk-grid-small">
                        <div class="uk-first-column">
                            <a href="www.facebook.com" data-uk-icon="icon: facebook; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="www.instagram.com" data-uk-icon="icon: instagram; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="www.twitter.com" data-uk-icon="icon: twitter; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="www.dribble.com" data-uk-icon="icon: dribbble; ratio: 1.2" class="uk-icon-link uk-icon"
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


    <?php
        $query="SELECT * FROM visitors WHERE id=1";
        $query_run=mysqli_query($connection,$query);
        $row=mysqli_fetch_array($query_run);
        $check_project= mysqli_num_rows($query_run)>0;
        if($check_project)
        {
            $sql="UPDATE visitors SET visitors=visitors+1";
            mysqli_query($connection,$sql);

            ?>

            <div class="uk-container" >
                <div class="uk-align-right" class="uk-child-width-1-2@m" data-uk-grid>
                    Visitors : <?php echo $row['visitors'];  ?>
                </div>

            </div>
            <?php
        }
    ?>

</footer>
<div id="offcanvas" data-uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar">
        <a class="uk-logo" href="index.php">BumblePix</a>
        <button class="uk-offcanvas-close" type="button" data-uk-close="ratio: 1.2"></button>
        <ul class="uk-nav uk-nav-primary uk-nav-offcanvas uk-margin-medium-top uk-text-center"
            data-uk-scrollspy-nav="closest: li; scroll: true; offset: 80">
            <li><a href="#header">Home</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#team">Team</a></li>
            <li><a href="#clients">Clients</a></li>
            <li><a href='admin/Admin.php'>Login</a></li>
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





</body>

</html>







