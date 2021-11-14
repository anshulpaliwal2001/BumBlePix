<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Users Information</title>
    <link rel="shortcut icon" type="image/png" href="../PictureAdminPage/BumblePixLogo.png" >
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/main.css" />
    <script src="../js/uikit.js"></script>
    <script src="../../AdminSection/js/uikit-icons.js"></script>
</head>
<?php
    session_start();
    if(!$_SESSION["u_name"])
    {
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
?>
<header id="header">
    <div
        data-uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent ; top: 600">
        <nav class="uk-navbar-container uk-letter-spacing-small uk-text-bold">
            <div class="uk-container">
                <div class="uk-position-z-index" data-uk-navbar>
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-item uk-logo" href="../../index.php"> BumblePixCo </a>
                    </div>
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav uk-visible@m" data-uk-scrollspy-nav="closest: li">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                        </ul>
                        <ul class="uk-navbar-nav uk-visible@m" data-uk-scrollspy-nav="closest: li">
                            <li class="uk-active"><a href="../dashboard.php">users</a></li>
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
                            <img class="uk-border-circle uk-box-shadow-hover"
                                 src="<?php echo "../PictureAdmin/", $Pimage; ?>" width="50" height="50"
                                 alt="Border circle">
                        </a>
                        <a class="uk-navbar-toggle uk-hidden@m" href="#" data-uk-toggle>
                            <span data-uk-navbar-toggle-icon>
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
                <div class="uk-background-cover"
                     style="background-image: url('<?php echo "../PictureAdmin/", $Pimage; ?>');"
                     uk-height-viewport></div>

                <div class="uk-padding-large">
                    <h1><?php echo "Hey! ", $fname, " here's your profile "; ?></h1>
                    <form class="uk-form-horizontal uk-margin-large">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">User Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text"
                                       value="<?php echo "@", $uname; ?>  " disabled>

                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text"
                                       value="<?php echo $pass; ?>  " disabled>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">E-Mail</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text"
                                       value="<?php echo $mail; ?>  " disabled>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">First Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text"
                                       value="<?php echo $fname; ?>  " disabled>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Last Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text"
                                       value="<?php echo $lname; ?>  " disabled>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-text">Address</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text"
                                       value="<?php echo $address; ?>  " disabled>
                            </div>
                        </div>
                        <div class="uk-margin uk-align-right">
                            <button class="uk-button uk-button-danger uk-margin-small-right" type="button"
                                    uk-toggle="target: #modal-logout">Logout
                            </button>
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
                        <img src="../PictureAdminPage/project.svg" alt="Header" width="1000" height="1000">
                    </div>
                    <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                         data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                        <div>
                            <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Users</h1>
                            <p class="uk-text-lead uk-width-4-5@m">
                                We’re a digital marketing agency that delivers transformational growth for our clients.
                                With services ranging from Search to Content to Social Media to Website Design to Mobile
                                Advertising,
                                we consult, strategize and execute to deliver #DigitalExcellence!</p>
                            <div class="uk-margin-medium-top">
                                <a href="#table" class="uk-button uk-width-1-3 uk-button-large uk-button-primary"
                                   data-uk-scroll="offset: 80">Users</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="table" class="uk-height-small uk-background-cover uk-light uk-flex" uk-parallax="bgy: -500"
     style="background-image: url('../../PictureWebPage/BG.jpg');">
    <h1 class="uk-width-1-2@m uk-heading-medium uk-text-center uk-margin-auto uk-margin-auto-vertical"
        uk-parallax="opacity: 0,1; y: 20,0; viewport: 0.5">Users List</h1>
</div>


<div  class="uk-section-small uk-margin-remove-top">
    <div class="uk-width-2-3 uk-align-center uk-overflow-auto">



        <table class="uk-table uk-table-striped uk-table-justify uk-table-middle uk-table-hover uk-table-responsive">
            <thead>
            <tr>

                <th class="uk-table-shrink uk-text-center" >No.</th>
                <th class="uk-table-shrink uk-text-center">Check</th>
                <th class="uk-table-shrink uk-text-center" >User ID</th>
                <th class="uk-table-shrink uk-text-center" >Info ID</th>
                <th class="uk-text-center">Avatar</th>
                <th class="uk-text-center uk-table-justify ">User Name</th>
                <th class="uk-text-center uk-table-justify ">Email</th>
                <th class="uk-text-center uk-table-justify ">First Name</th>
                <th class="uk-text-center uk-table-justify ">Last Name</th>
                <th class="uk-text-center uk-table-shrink uk-table-justify ">Gender</th>
                <th class="uk-text-center uk-table-shrink">View</th>
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
                $query="SELECT * FROM user_credentials";
                $query_run=mysqli_query($connection,$query);
                $check_project= mysqli_num_rows($query_run)>0;
                $no=0;

                if($check_project) {
                    while ($row = mysqli_fetch_array($query_run)) {
                        $no++;
                        $Uid = $row['User_ID'];
                        $username = $row['User_Name'];
                        $query2 = "SELECT * FROM user_info where User_ID='$Uid'";
                        $query2_run = mysqli_query($connection, $query2);
                        $row2 = mysqli_fetch_array($query2_run);
                        $InfoID = $row2['Info_ID'];
                        $InfoMail = $row2['Info_mail'];
                        $Info_Fname = $row2['Info_FName'];
                        $Info_Lname = $row2['Info_LName'];
                        $InfoGender = $row2['Info_Gender'];
                        $InfoAvatar = $row2['Info_Image'];
                        $infoAdd = $row2['Info_Address'];
                        ?>
                            <tr>
                                <td class="uk-text-center uk-text-bold"> <?php echo $no; ?> </td>
                                <td class="uk-text-center"><label for="cb1"></label><input class="uk-checkbox" type="checkbox" id="cb1" name="cb1"></td>
                                <td class="uk-text"><?php echo $Uid; ?></td>
                                <td class="uk-text"><?php echo $InfoID; ?></td>
                                <td class="uk-text-center">
                                    <div class="uk-child-width-1-1@l" uk-grid uk-lightbox="animation: slide">
                                        <a class="uk-inline" href="<?php echo "../../UserSection/UserCredentials/UserAvatar/",$InfoAvatar; ?>" data-caption="<?php echo "Path : UserSection/UserCredentials/UserAvatar/",$InfoAvatar; ?>">
                                            <img class="uk-border-circle" src="<?php echo "../../UserSection/UserCredentials/UserAvatar/",$InfoAvatar; ?>" alt="" width="60">
                                        </a>
                                    </div>
                                </td>
                                <td class="uk-text uk-text-bolder uk-text-italic"><?php echo $username; ?></td>
                                <td class="uk-text uk-text"><?php echo $InfoMail; ?></td>
                                <td class="uk-text uk-text"><?php echo $Info_Fname; ?></td>
                                <td class="uk-text uk-text"><?php echo $Info_Lname; ?></td>
                                <td class="uk-text uk-text uk-text-center uk-text-bolder"><?php echo $InfoGender; ?></td>
                                <td>
                                    <ul class="uk-iconnav uk-align-center">
                                        <li><a href="#view<?php echo $Uid; ?>" uk-icon="icon: file-text" uk-toggle></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <!--View-->
                            <div id="view<?php echo $Uid; ?>" class="uk-modal-full" uk-modal>
                                <div class="uk-modal-dialog">
                                    <button class="uk-modal-close-full uk-close-large" type="button" uk-close><?php echo "Sr no : ",$no,"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; ?></button>

                                    <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                                        <div class="uk-background-cover" style="background-image: url('<?php echo "../../UserSection/UserCredentials/UserAvatar/",$InfoAvatar; ?>');" uk-height-viewport></div>
                                        <div class="uk-padding-large">
                                            <h2>View User</h2>

                                            <form class="uk-form-horizontal uk-margin-small-top">

                                                <div class="uk-margin">
                                                    <label class="uk-form-label uk-text" for="form-horizontal-text">User ID</label>
                                                    <div class="uk-form-controls">
                                                        <input class="uk-input uk-width-1-6 uk-button-secondary" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $Uid; ?> " readonly>
                                                    </div>
                                                </div>
                                                <div class="uk-margin">
                                                    <label class="uk-form-label uk-text" for="form-horizontal-text">Information ID</label>
                                                    <div class="uk-form-controls">
                                                        <input class="uk-input uk-width-1-6 uk-button-secondary" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $InfoID; ?> " readonly>
                                                    </div>
                                                </div>
                                                <div class="uk-margin">
                                                    <label class="uk-form-label" for="form-horizontal-text">Username</label>
                                                    <div class="uk-form-controls">
                                                        <input class="uk-input uk-width-1-2 uk-button-primary" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $username; ?> " readonly>
                                                    </div>
                                                </div>
                                                <div class="uk-margin">
                                                    <label class="uk-form-label" for="form-horizontal-text">First Name</label>
                                                    <div class="uk-form-controls">
                                                        <input class="uk-input uk-width-1-2 uk-button-secondary" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $Info_Fname; ?> " readonly>
                                                    </div>
                                                </div>
                                                <div class="uk-margin">
                                                    <label class="uk-form-label" for="form-horizontal-text">Last Name</label>
                                                    <div class="uk-form-controls">
                                                        <input class="uk-input uk-width-1-2 uk-button-secondary" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $Info_Lname; ?> " readonly>
                                                    </div>
                                                </div>
                                                <div class="uk-margin">
                                                    <label class="uk-form-label" for="form-horizontal-text">Gender</label>
                                                    <div class="uk-form-controls">
                                                        <?php
                                                            if($InfoGender=='M')
                                                            {
                                                        ?>
                                                        <input class="uk-input uk-width-1-2 uk-button-primary" id="form-horizontal-text" type="text" placeholder="Some text..." value="MALE" readonly>
                                                        <?php
                                                            }
                                                            else if ($InfoGender=='F')
                                                            {
                                                        ?>
                                                        <input class="uk-input uk-width-1-2 uk-button-primary" id="form-horizontal-text" type="text" placeholder="Some text..." value="Female" readonly>
                                                        <?php
                                                            }
                                                            else
                                                            {
                                                        ?>
                                                        <input class="uk-input uk-width-1-2 uk-button-primary" id="form-horizontal-text" type="text" placeholder="Some text..." value="Other" readonly>
                                                        <?php
                                                            }
                                                        ?>

                                                    </div>
                                                </div>
                                                <div class="uk-margin">
                                                    <label class="uk-form-label" for="form-horizontal-text">Address</label>
                                                    <div class="uk-width-1-1">
                                                        <label>
                                                            <textarea class="uk-textarea uk-button-secondary" placeholder="<?php    echo $infoAdd; ?>"  readonly></textarea>
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
                $result= mysqli_query($connection,"SELECT * FROM user_info");
                $norows= mysqli_num_rows($result);
            ?>
            <tr>
                <td class="uk-text-center uk-text-bold" colspan="8"><?php echo "Total ",$norows; ?> Record(s) found</td>
                <td colspan="2">
                    <a class="uk-button uk-button-default  uk-button- uk-width-1-1@s "  href="AdminUsersInfo.php"> Reload Table
                    </a>
                </td>
                <td><a href="#" uk-totop uk-scroll></a></td>
            </tr>



