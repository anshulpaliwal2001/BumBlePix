<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Analytics</title>
    <link rel="shortcut icon" type="image/png" href="../PictureAdminPage/BumblePixLogo.png" >
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/main.css" />
    <script src="../js/uikit.js"></script>
    <script src="../../AdminSection/js/uikit-icons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<?php
    session_start();
    if(!$_SESSION["u_name"])
    {
        header("Location:../Login.php");

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
                            <li class="uk-active"><a  href="../dashboard.php">Analytics</a></li>
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
                        <img src="../PictureAdminPage/charts.svg" alt="Header" width="1000" height="1000">
                    </div>
                    <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                         data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                        <div>
                            <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Analytics</h1>
                            <p class="uk-text-lead uk-width-4-5@m">
                                We’re a digital marketing agency that delivers transformational growth for our clients.
                                With services ranging from Search to Content to Social Media to Website Design to Mobile Advertising,
                                we consult, strategize and execute to deliver #DigitalExcellence!</p>
                            <div class="uk-margin-medium-top">
                                <a href="#table" class="uk-button uk-width-1-3 uk-button-large uk-button-primary" data-uk-scroll="offset: 80">Analytics</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="table" class="uk-container">
    <div class=" uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                <h3 class="uk-card-title uk-text-center">User Gender</h3>
                <canvas id="bar-chart" width="100" height="100"></canvas>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                <h3 class="uk-card-title uk-text-center">User Gender</h3>
                <canvas id="doughnut-chart" width="100" height="100"></canvas>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                <h3 class="uk-card-title uk-text-center">User Gender</h3>
                <canvas id="line-chart" width="100" height="100"></canvas>
            </div>
        </div>

    </div>
</div>
<div class="uk-container uk-margin">
    <div class=" uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>

        <div>
            <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                <h3 class="uk-card-title uk-text-center">User Gender</h3>
                <canvas id="line-chart" width="100" height="30"></canvas>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                <h3 class="uk-card-title">Secondary</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>

    </div>
</div>
<script>
    new Chart(document.getElementById("doughnut-chart"), {
        type: 'pie',
        data: {
            labels: [<?php echo GetAnalyticsGender(1); ?>],
            datasets: [
                {
                    label: "",
                    backgroundColor: ["#DB4140", "#3f3c56","#3cba9f"],
                    data: [<?php echo GetAnalyticsGender(); ?>]
                }
            ]
        },
        options: {
            title: {
                display: false,
                text: ''


            }

        }

    });
    new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: {
            labels: [<?php echo GetAnalyticsGender(1); ?>],
            datasets: [
                {
                    label: ' ',
                    backgroundColor: ["#DB4140", "#3f3c56","#3cba9f"],
                    data: [<?php echo GetAnalyticsGender(); ?>]

                }
            ]
        },
        options: {
            title: {
                display: false,
                text: '',



            }


        }

    });
    new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: [<?php echo GetAnalyticsGender(1); ?>],
            datasets: [
                {
                    label: " ",
                    backgroundColor: ["#DB4140", "#3f3c56","#3cba9f"],
                    data: [<?php echo GetAnalyticsGender(); ?>]

                }
            ]
        },
        options: {
            title: {
                display: false,
                text: ''
            }


        }

    });
</script>
<?php
    function GetAnalyticsGender($type=0) : string
    {
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";
        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        $result=mysqli_query($connection,"SELECT count(*) as male from user_info WHERE Info_Gender='M'");
        $data=mysqli_fetch_assoc($result);
        $male=$data['male'];
        $result=mysqli_query($connection,"SELECT count(*) as female from user_info WHERE Info_Gender='F'");
        $data=mysqli_fetch_assoc($result);
        $female=$data['female'];
        $result=mysqli_query($connection,"SELECT count(*) as other from user_info WHERE Info_Gender='O'");
        $data=mysqli_fetch_assoc($result);
        $other=$data['other'];
        if($type==0) {
            $Gender = $male . "," . $female . "," . $other;
            return $Gender;
        }
        else if($type==1)
        {
            $total=$male+$female+$other;
            $maleper=$male*(100/$total);
            $femaleper=$female*(100/$total);
            $otherper=$other*(100/$total);
            return "'Male : $maleper% ', 'Female : $femaleper% ', 'Others : $otherper% '";
        }

    }
?>


