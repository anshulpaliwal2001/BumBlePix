<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Statistics</title>
    <link rel="shortcut icon" type="image/png" href="../PictureAdminPage/BumblePixLogo.png" >
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/main.css" />
    <script src="../js/uikit.js"></script>
</head>

<?php
    session_start();
    if(!$_SESSION["u_name"]) {
        header("Location:Login.php");
    }
    $uname=$_SESSION["u_name"];
    $id=$_SESSION["id"];
    $server_name= "localhost";
    $db_user="root";
    $db_password="";
    $db_name="digitalmarketing";
    $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
    $dbconfig=mysqli_select_db($connection,$db_name);
    $query="SELECT * FROM admin WHERE admin_id='$id'";
    $query_run=mysqli_query($connection,$query);
    $row=mysqli_fetch_array($query_run);
    $fname= $row['admin_fname'];
    $pass= $row['password'];
    $lname= $row['admin_lname'];
    $Pimage= $row['admin_image'];
    $mail= $row['admin_mail'];
    $address=$row['admin_address'];

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if (isset($_POST['StatButton']))
        {
            $succesfullprojects=$_POST['succesfullprojects'];
            $EMPLOYEES = $_POST['EMPLOYEES'];
            $YEARS = $_POST['YEARS'];
            $LOCATIONS = $_POST['LOCATIONS'];
            //echo $succesfullprojects,$EMPLOYEES,$YEARS,$LOCATIONS;
            $query="UPDATE facts SET projects='$succesfullprojects', employees='$EMPLOYEES', years='$YEARS', locations='$LOCATIONS' WHERE fact_id=1";
            if (mysqli_query($connection, $query)) {
                //echo "success Update";
            }
            else
                echo "Error: " . $query . "<br>" . mysqli_error($connection);




        }
    }

?>

<header id="header">
    <div data-uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent ; top: 600">
        <nav class="uk-navbar-container uk-letter-spacing-small uk-text-bold">
            <div class="uk-container">
                <div class="uk-position-z-index" data-uk-navbar>
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-item uk-logo" href="../../index.php"> BumblePixCo </a>
                    </div>
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav uk-visible@m" data-uk-scrollspy-nav="closest: li">
                            <li><a  href="../dashboard.php">Dashboard</a></li>
                        </ul>
                        <ul class="uk-navbar-nav uk-visible@m" data-uk-scrollspy-nav="closest: li">
                            <li class="uk-active"><a  href="../dashboard.php">Statistics</a></li>
                        </ul>
                        <ul class="uk-navbar-nav">
                            <li>
                                <a href="#"> <?php echo $fname; ?> </a>
                                <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">


                                        <li><a href="#modal-full" uk-toggle>Profile</a></li>
                                        <li><a href="#">Change Password</a></li>
                                        <li class="uk-active"><a href="#modal-logout" uk-toggle>Logout</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                        <a class="uk-navbar-toggle" href="#modal-full" uk-toggle>
                            <img class="uk-border-circle uk-box-shadow-hover  " src="<?php echo "../PictureAdmin/",$Pimage; ?>" width="50" height="50" alt="Border circle">
                        </a>
                        <a class="uk-navbar-toggle uk-hidden@m" href="#" data-uk-toggle>
                            <span
                                data-uk-navbar-toggle-icon>

                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</header>
<div id="modal-logout" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Sure?</h2>
        <p>Are you sure you wanna logout?</p>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a class="uk-button uk-button-primary" href="../logout.php">Yes, Logout</a>
        </p>
    </div>
</div>
<div id="modal-full" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <image>
            <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                <div class="uk-background-cover" style="background-image: url('<?php echo "../PictureAdmin/",$Pimage; ?>');" uk-height-viewport></div>

                <div class="uk-padding-large">
                    <h1><?php echo "Hey! ",$fname," here's your profile "; ?></h1>
                    <form class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">User Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text" value="<?php echo "@",$uname; ?>  " disabled>

                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text" value="<?php echo $pass; ?>  "  disabled>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">E-Mail</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text" value="<?php echo $mail; ?>  " disabled>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">First Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text" value="<?php echo $fname; ?>  " disabled>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Last Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text" value="<?php echo $lname; ?>  " disabled>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Address</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text" value="<?php echo $address; ?>  " disabled>
                            </div>
                        </div>
                        <div class="uk-margin uk-align-right">
                            <button class="uk-button uk-button-danger uk-margin-small-right" type="button" uk-toggle="target: #modal-logout">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </image>
    </div>
</div>

<body>

<div class="uk-flex uk-flex-middle" data-uk-height-viewport="offset-top: true">
    <div class="uk-width-1-1">
        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid-large" data-uk-grid>
                    <div class="uk-width-1-2@m"
                         data-uk-scrollspy="cls: uk-animation-slide-left-small; repeat: true; delay: 200">
                        <img src="../PictureAdminPage/Statistics.svg" alt="Header" width="1000" height="1000">
                    </div>
                    <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                         data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                        <div>
                            <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Statistics</h1>
                            <p class="uk-text-lead uk-width-4-5@m ">
                                We’re a digital marketing agency that delivers transformational growth for our clients.
                                With services ranging from Search to Content to Social Media to Website Design to Mobile Advertising,
                                we consult, strategize and execute to deliver #DigitalExcellence!</p>
                            <div class="uk-margin-medium-top">
                                <a href="#table" class="uk-button uk-width-1-3 uk-button-large uk-button-primary" data-uk-scroll="offset: 80">Statistics</a>
                                <a href="#add" class="uk-button uk-width-1-3 uk-button-large uk-button-primary" uk-icon="icon: plus" uk-toggle data-uk-scroll="offset: 80">ADD</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div  id="table" class="uk-height-small uk-background-cover uk-light uk-flex" uk-parallax="bgy: -500" style="background-image: url('../../PictureWebPage/BG.jpg');">
    <h1 class="uk-width-1-2@m uk-heading-medium uk-text-center uk-margin-auto uk-margin-auto-vertical" uk-parallax="opacity: 0,1; y: 20,0; viewport: 0.5">Statistics</h1>
</div>
<?php

    $query="SELECT * FROM facts WHERE fact_id=1";
    $query_run=mysqli_query($connection,$query);
    $row=mysqli_fetch_array($query_run);
    $check_project= mysqli_num_rows($query_run)>0;
    if($check_project)
    {?>
        <div id="facts" class="uk-section uk-section-primary- uk-section-large uk-margin-remove-bottom">
            <div class="uk-container uk-margin-remove-bottom">
                <div class="uk-badge uk-label">LIVE</div>
                <div class="uk-grid-large uk-margin-remove-bottom" data-uk-grid>

                    <div class="uk-width-1-3@m">

                        <h2 class="uk-heading-small uk-margin-large-bottom">Key Facts</h2>

                        <h3 class="uk-heading-2xlarge uk-text-primary"><?php echo $row['projects']; ?> </h3>
                        <hr class="uk-margin-bottom uk-margin-medium-top uk-separator-small">
                        <h3 class="uk-margin-remove-bottom uk-text-uppercase uk-h5 uk-letter-spacing-small uk-margin-small-top">Successful Projects</h3>
                    </div>

                    <div class="uk-width-expand@m uk-flex uk-flex-column uk-margin-remove-bottom">
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
                                <h3 class="uk-text-uppercase uk-h5 uk-letter-spacing-small uk-margin-small-top uk-margin-remove-bottom">Locations</h3>
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
<div id="facts" class="uk-section uk-section-primary uk-section-large uk-margin-remove-top">
    <div class="uk-container">

            <form class="uk-grid-small" uk-grid name="Statistics" action="" method="post" >
                <div class="uk-width-1-4@s">
                    <label for="succesfullprojects" class="uk-text-bold">Succesfull Projects</label>
                    <input class="uk-input uk-button-default" type="text" id="succesfullprojects" name="succesfullprojects" placeholder="SUCCESSFUL PROJECTS" value="<?php echo $row['projects']; ?>" required>
                </div>
                <div class="uk-width-1-4@s">
                    <label for="EMPLOYEES" class="uk-text-bold">Employees</label>
                    <input class="uk-input uk-button-default" type="text" id="EMPLOYEES" name="EMPLOYEES" placeholder="EMPLOYEES" value="<?php echo $row['employees']; ?>" required>
                </div>
                <div class="uk-width-1-4@s">
                    <label for="YEARS" class="uk-text-bold">Years</label>
                    <input class="uk-input uk-button-default" type="text" id="YEARS" name="YEARS" placeholder="YEARS" value="<?php echo $row['years']; ?>" required>
                </div>
                <div class="uk-width-1-4@s">
                    <label for="LOCATIONS" class="uk-text-bold">Locations</label>
                    <input class="uk-input uk-button-default" type="text" id="LOCATIONS" name="LOCATIONS" placeholder="LOCATIONS" value="<?php echo $row['locations']; ?>" required>
                </div>
                <div class="uk-margin uk-width-1-1@s ">
                    <button class="uk-button  uk-button-default uk-width-1-3@l uk-button  uk-align-center " type="submit"  value="Sum" name="StatButton">Live</button>
                </div>

            </form>
        </div>
    </div>

</body>
