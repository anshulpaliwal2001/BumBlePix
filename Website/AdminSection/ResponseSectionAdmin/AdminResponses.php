<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Responses</title>
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

    if($_SERVER['REQUEST_METHOD']=='POST') {

        if (isset($_POST['seenunseen'])) {
             $id = $_POST['seenunseenid'];
              $seenunseen = $_POST['ss'];

            if($seenunseen==0)
                $seenunseen=1;
            else if($seenunseen==1)
                $seenunseen=0;



            $query="UPDATE contacts SET contact_seen=$seenunseen WHERE contact_id=$id ";

             mysqli_query($connection,$query);



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
                            <li class="uk-active"><a  href="../dashboard.php">Responses</a></li>
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
                        <img src="../PictureAdminPage/responses.svg" alt="Header" width="1000" height="1000">
                    </div>
                    <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                         data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                        <div>
                            <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Responses</h1>
                            <p class="uk-text-lead uk-width-4-5@m ">
                                We’re a digital marketing agency that delivers transformational growth for our clients.
                                With services ranging from Search to Content to Social Media to Website Design to Mobile Advertising,
                                we consult, strategize and execute to deliver #DigitalExcellence!</p>
                            <div class="uk-margin-medium-top">
                                <a href="#table" class="uk-button uk-width-1-3 uk-button-large uk-button-primary" data-uk-scroll="offset: 80">Responses</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div  id="table" class="uk-height-small uk-background-cover uk-light uk-flex" uk-parallax="bgy: -500" style="background-image: url('../../PictureWebPage/BG.jpg');">
    <h1 class="uk-width-1-2@m uk-heading-medium uk-text-center uk-margin-auto uk-margin-auto-vertical" uk-parallax="opacity: 0,1; y: 20,0; viewport: 0.5">Responses</h1>
</div>

<div  class="uk-section-small uk-margin-remove-top">
    <div class="uk-width-2-3 uk-align-center uk-overflow-auto">
        <table class="uk-table uk-table-striped uk-table-justify uk-table-middle uk-table-hover uk-table-responsive uk-table-expand ">
            <thead>
            <tr>

                <th class="uk-table-shrink uk-text-center" >No.</th>
                <th class="uk-table-shrink uk-text-center">Check</th>
                <th class="uk-table-shrink uk-text-center" >id</th>
                <th class=" uk-text-center " >Time/Date</th>

                <th class="uk-text-center">Name</th>
                <th class="uk-text-center uk-table-justify uk-table-expand uk-flex-wrap  ">Mail</th>
                <th class=" uk-text-center uk-table-justify ">Reason</th>

                <th class="uk-text-center uk-table-shrink">Seen Unseen</th>
                <th class="uk-text-center uk-table-shrink">Full view</th>


            </tr>
            </thead>
            <tbody>
            <?php
                $server_name= "localhost";
                $db_user="root";
                $db_password="";
                $db_name="digitalmarketing";

                $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
                $dbconfig=mysqli_select_db($connection,$db_name);
                $query= "SELECT * FROM digitalmarketing.contacts ORDER BY contact_seen ";
                $query_run=mysqli_query($connection,$query);
                $check_service= mysqli_num_rows($query_run)>0;
                $no=0;
                if($check_service)
                {
                    while ($row = mysqli_fetch_array($query_run))
                    {
                        $no++;
                        $id = $row['contact_id'];
                        $name = $row['contact_name'];
                        $mail = $row['contact_mail'];
                        $Message = $row['contact_message'];
                        $truncate_Message = substr($Message, 0, 270);
                        $seen = $row['contact_seen'];
                        $reason=$row['contact_reason'];
                        $time = strtotime($row['contact_datetime']);
                        $actual_date = date('d-m-y', $time);
                        $actual_time = date('H : i : s', $time);
                    ?>
                    <tr>
                        <td class="uk-text-center uk-table-shrink"> <?php echo $no; ?> </td>
                        <td class="uk-text-center uk-table-shrink"><label for="cb1"></label><input class="uk-checkbox" type="checkbox" id="cb1" name="cb1"></td>
                        <td class="uk-text-center uk-text-bold uk-table-shrink"><?php echo $id; ?></td>
                        <td class="uk-text-center"><?php echo $actual_time."<br>".$actual_date;  ?></td>
                        <td class="uk-text-center"><?php echo $name;  ?></td>
                        <td class="uk-text-left uk-text-bold"><a class="uk-link-border uk-link-border-bold" type="mail" href="<?php echo "mailto:".$mail;  ?>"><?php echo $mail;  ?></a></td>
                        <td class="uk-text-center "><?php echo $reason;  ?></td>

                        <?php
                        if($seen==0)
                        {
                            ?>
                            <form name="seenunseen" method="post" action="" >
                                <td>
                                    <input name="seenunseenid" id="seenunseenid" value="<?php echo $id?>" type="hidden">
                                    <input name="ss" id="ss" value="<?php echo $seen?>" type="hidden">
                                    <button class="uk-button-small  uk-button-danger uk-text-small uk-width-1-1" type="submit"  name="seenunseen"  id="seenunseen">Unseen</button>
                                </td>
                            </form>
                            <?php
                        }
                        else
                        {
                        ?>
                            <form name="seenunseen" method="post" action="" >
                            <td>
                                <input name="seenunseenid" value="<?php echo $id?>" type="hidden">
                                <input name="ss" id="ss" value="<?php echo $seen?>" type="hidden">
                                <button class="uk-button-small  uk-button-secondary uk-text-small uk-width-1-1" type="submit"  name="seenunseen"  id="seenunseen">Seen</button>
                            </td>
                            </form>
                        <?php
                            }
                        ?>




                        <td class="uk-align-center">
                            <ul class="uk-iconnav">
                                <li class=""><a  href="#view<?php echo $id; ?> " uk-icon="icon: file-text" uk-toggle></a></li>
                            </ul>
                        </td>
                        <!--View-->
                        <div id="view<?php echo $id; ?>" class="uk-modal-full" uk-modal>
                            <div class="uk-modal-dialog">
                                <button class="uk-modal-close-full uk-close-large" type="button" uk-close><?php echo "Sr no : ",$no,"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; ?></button>

                                <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                                    <div class="uk-background-cover" style="background-image: url('../PictureAdminPage/poster.jpg');" uk-height-viewport></div>

                                    <div class="uk-padding-large">
                                        <h2>View Services</h2>

                                        <form class="uk-form-horizontal uk-margin-small-top" name="seenunseen" action="" method="post">

                                            <div class="uk-margin">
                                                <label class="uk-form-label uk-text-bold" for="form-horizontal-text">Response ID</label>
                                                <label class="uk-form-label uk-text-bold" for="form-horizontal-text">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; Status</label>
                                                <div class="uk-form-controls">
                                                    <input class="uk-input uk-width-1-6" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $id; ?> " readonly>
                                                    <?php
                                                        if($seen==0)
                                                            echo "<input class='uk-input uk-width-1-6 uk-text-danger' id='form-horizontal-text' type='text' placeholder='Some text...' value='Not Seen' readonly>";
                                                        else
                                                            echo "<input class='uk-input uk-width-1-6 uk-text-success' id='form-horizontal-text' type='text' placeholder='Some text...' value='Seen' readonly>";

                                                    ?>

                                                    </div>

                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label uk-text-bold" for="form-horizontal-text">Responder's Name</label>
                                                <div class="uk-form-controls">
                                                    <input class="uk-input uk-form-large uk-width-1-2 uk-text-large uk-text-bold" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $name; ?> " readonly>
                                                </div>
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label uk-text-bold" for="form-horizontal-text">Response Reason</label>
                                                <div class="uk-form-controls">
                                                    <input class="uk-input uk-form-large uk-width-1-2 uk-text-large uk-text-bold" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $reason; ?> " readonly>
                                                </div>
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label uk-text-bold" for="form-horizontal-text">Message</label>
                                                <div class="uk-width-1-1">
                                                    <label>
                                                        <textarea rows="10" class="uk-textarea uk-button-default uk-text-justify" placeholder="<?php echo $Message; ?>"  readonly></textarea>
                                                    </label>
                                                </div>
                                            </div>



                                            <p>

                                                <button class="uk-button uk-button-default uk-width-1-3@s uk-modal-close" type="button">Cancel</button>
                                            </p>


                                        </form>


                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        }







