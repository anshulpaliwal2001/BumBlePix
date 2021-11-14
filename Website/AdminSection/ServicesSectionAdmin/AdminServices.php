
<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Services</title>
    <link rel="shortcut icon" type="image/png" href="../PictureAdminPage/BumblePixLogo.png" >
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/main.css" />
    <script src="../js/uikit.js"></script>
    <script src="../../AdminSection/js/uikit-icons.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
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



    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        //EDIT Service SQL
        if (isset($_POST['Edit_service']))
        {
            $id = $_POST['iid'];
            $title =  $_POST['title'];
            $Des = mysqli_real_escape_string($connection, $_POST['des']);

            $query = "UPDATE services SET service_title='$title' , service_details='$Des'WHERE service_id ='$id'";
            if (mysqli_query($connection, $query)) {
                //echo "success Update";
            } else
                echo "Error: " . $query . "<br>" . mysqli_error($connection);

        }
        //Add Project SQL
        if (isset($_POST['Add_service'])) {
            $title = mysqli_real_escape_string($connection, $_POST['title']);
            $Des = mysqli_real_escape_string($connection, $_POST['des']);
            $imagepath = mysqli_real_escape_string($connection,"ImagesServices/".$_FILES['filename']['name']);
            $image4query= mysqli_real_escape_string($connection,"ImagesServices/".$_FILES['filename']['name']);


            if (preg_match("!image!", $_FILES['filename']['type']))
            {
                if (copy($_FILES['filename']['tmp_name'], $imagepath))
                {
                    //echo "UPLOAD : ";
                    if (move_uploaded_file($_FILES["filename"]["tmp_name"], $_FILES["filename"]["name"]))
                    {
                        // echo 'Succesfull uplo';
                    }
                    else
                    {
                        // echo "Fuk U";
                    }
                    //echo "image path :".$imagepath ;
                    $query = "INSERT INTO `services` (`service_id`, `service_title`, `service_details`, `service_image`) VALUES (NULL, '$title', '$Des', '$image4query')";
                    if (mysqli_query($connection, $query)) {
                        //echo "success";
                    } else
                        echo "Error: " . $query . "<br>" . mysqli_error($connection);
                }
            }
            else
                echo "Couldnt Copy";
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
                            <li class="uk-active"><a  href="../dashboard.php">Services</a></li>
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
                        <img src="../PictureAdminPage/Servicess.svg" alt="Header" width="1000" height="1000">
                    </div>
                    <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                         data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                        <div>
                            <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Services</h1>
                            <p class="uk-text-lead uk-width-4-5@m">
                                We’re a digital marketing agency that delivers transformational growth for our clients.
                                With services ranging from Search to Content to Social Media to Website Design to Mobile Advertising,
                                we consult, strategize and execute to deliver #DigitalExcellence!</p>
                            <div class="uk-margin-medium-top">
                                <a href="#table" class="uk-button uk-width-1-3 uk-button-large uk-button-primary" data-uk-scroll="offset: 80">Services</a>
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
    <h1 class="uk-width-1-2@m uk-heading-medium uk-text-center uk-margin-auto uk-margin-auto-vertical" uk-parallax="opacity: 0,1; y: 20,0; viewport: 0.5">Service List</h1>
</div>


<div  class="uk-section-small uk-margin-remove-top">
    <div class="uk-width-2-3 uk-align-center uk-overflow-auto">
        <table class="uk-table uk-table-striped uk-table-justify uk-table-middle uk-table-hover uk-table-responsive">
            <thead>
            <tr>

                <th class="uk-table-shrink uk-text-center" >No.</th>
                <th class="uk-table-shrink uk-text-center">Check</th>
                <th class="uk-table-shrink uk-text-center" >id</th>
                <th class="uk-text-center uk-table-justify ">Title</th>
                <th class=" uk-text-center">Detail</th>
                <th class="uk-text-center">Images</th>
                <th class="uk-text-center uk-table-shrink">View</th>
                <th class="uk-text-center uk-table-shrink">Update</th>
                <th class="uk-text-center uk-table-shrink">Delete</th>

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
                $query="SELECT * FROM services";
                $query_run=mysqli_query($connection,$query);
                $check_service= mysqli_num_rows($query_run)>0;
                $no=0;
                if($check_service)
                {
                    while ($row=mysqli_fetch_array($query_run))
                    {
                        $no++;
                        $id=$row['service_id'];
                        $title=$row['service_title'];
                        $detail=$row['service_details'];
                        $truncate_detail = substr($detail,0,270);
                        $images=$row['service_image'];

                        ?>

                        <tr>
                            <td class="uk-text-right"> <?php echo $no; ?> </td>
                            <td class="uk-text-center"><label for="cb1"></label><input class="uk-checkbox" type="checkbox" id="cb1" name="cb1"></td>
                            <td class="uk-text-bold"><?php echo $id; ?></td>
                            <td class="uk-text-center uk-text-bolder"><?php echo $title; ?></td>
                            <td  class="uk-text-justify uk-text-justify "><?php echo $truncate_detail; ?>. . . .</td>
                            <td class="uk-text-center">
                                <div class="uk-child-width-1-1@l" uk-grid uk-lightbox="animation: slide">
                                    <a class="uk-inline" href="<?php echo $images; ?>" data-caption="<?php echo $images; ?>">
                                        <img src="<?php echo $images; ?>" alt="" width="60">
                                    </a>
                                </div>
                            </td>
                            <td >
                                <ul class="uk-iconnav uk-align-center">
                                    <li><a href="#view<?php echo $id; ?>" uk-icon="icon: file-text" uk-toggle></a></li>
                                </ul>

                            </td>

                            <td >
                                <ul class="uk-iconnav uk-align-center">
                                    <li><a  href="#update<?php echo $id; ?> " uk-icon="icon: file-edit" uk-toggle></a></li>
                                </ul>
                            </td>

                            <td >
                                <ul class="uk-iconnav uk-align-center">
                                    <li><a  href="#delete<?php echo $id; ?> " uk-icon="icon: trash" uk-toggle></a></li>
                                </ul>
                            </td>

                        </tr>
                        <!--View-->
                        <div id="view<?php echo $id; ?>" class="uk-modal-full" uk-modal>
                            <div class="uk-modal-dialog">
                                <button class="uk-modal-close-full uk-close-large" type="button" uk-close><?php echo "Sr no : ",$no,"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; ?></button>

                                <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                                    <div class="uk-background-cover" style="background-image: url('<?php echo $images; ?>');" uk-height-viewport></div>

                                    <div class="uk-padding-large">
                                        <h2>View Services</h2>

                                        <form class="uk-form-horizontal uk-margin-small-top">

                                            <div class="uk-margin">
                                                <label class="uk-form-label uk-text-bold" for="form-horizontal-text">Service ID</label>
                                                <div class="uk-form-controls">
                                                    <input class="uk-input uk-width-1-6" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $id; ?> " readonly>
                                                </div>
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label uk-text-bold" for="form-horizontal-text">Service Title</label>
                                                <div class="uk-form-controls">
                                                    <input class="uk-input uk-form-large uk-width-1-2 uk-text-large uk-text-bold" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $title; ?> " readonly>
                                                </div>
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label uk-text-bold" for="form-horizontal-text">Service Details</label>
                                                <div class="uk-width-1-1">
                                                    <label>
                                                        <textarea rows="10" class="uk-textarea uk-button-default" placeholder="<?php echo $detail; ?>"  readonly></textarea>
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="uk-margin">
                                                <label class="uk-form-label uk-text-bold" for="form-horizontal-text">Image Name</label>
                                                <div class="uk-form-controls">
                                                    <input class="uk-input uk-width-1-2 uk-text-italic" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $images; ?> " readonly>
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
                        <!-- Update -->
                        <div id="update<?php echo $id; ?>" class="uk-modal-full" uk-modal>
                            <div class="uk-modal-dialog">
                                <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>

                                <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                                    <div class="uk-background-cover" style="background-image: url('../PictureAdminPage/poster.jpg');" uk-height-viewport></div>
                                    <div class="uk-padding-large">
                                        <h2>Update Service</h2>

                                        <form class="uk-grid-small" uk-grid action="" name="Edit" method="post" role="form" enctype="multipart/form-data" >
                                            <div class="uk-width-1-1">
                                                <label for="iid"></label><input class="uk-input uk-button-default uk-width-1-3" type="number" placeholder="Id" id="iid" name="iid" value="<?php echo $id; ?>" required readonly>
                                            </div>
                                            <div class="uk-width-1-1 uk-margin">
                                                <label for="title"></label><input class="uk-input uk-button-default" type="text" placeholder="Title" id="title" name="title" value="<?php echo $title; ?>" required>
                                            </div>

                                            <div class="uk-width-1-1 uk-margin">
                                                <label for="des"></label><textarea rows="10" class="uk-textarea uk-button-default" placeholder="Description" id="des" name="des" required><?php echo $detail; ?></textarea>
                                            </div>




                                            <p >
                                                <button class="uk-button uk-button-default uk-width-1-3@s uk-modal-close" type="button">Cancel</button>

                                                <button class="uk-button uk-button-primary uk-width-1-3@s" type="submit"  value="Sum" name="Edit_service">Update</button>

                                            </p>

                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Delete -->
                        <div id="delete<?php echo $id; ?>" class="uk-modal-full" uk-modal>
                            <div class="uk-modal-dialog">
                                <button class="uk-modal-close-full uk-close-large" type="button" uk-close><?php echo "Sr no : ",$no,"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; ?></button>

                                <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                                    <div class="uk-background-cover" style="background-image: url('<?php echo $images; ?>');" uk-height-viewport></div>
                                    <div class="uk-padding-large">
                                        <h2>Delete Service ?</h2>

                                        <form class="uk-form-horizontal uk-margin-small-top" method="post" action="AdminServiceDelete.php">

                                            <div class="uk-margin">
                                                <label class="uk-form-label uk-text" for="form-horizontal-text">ID</label>
                                                <div class="uk-form-controls">
                                                    <label for="delete_id"></label><input class="uk-input uk-width-1-6" id="delete_id" name="delete_id" type="text" placeholder="Some text..." value="<?php echo $id; ?> " disabled>
                                                </div>
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="form-horizontal-text">Title</label>
                                                <div class="uk-form-controls">
                                                    <input class="uk-input uk-width-1-2" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $title; ?> " disabled>
                                                </div>
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="form-horizontal-text">Description</label>
                                                <div class="uk-width-1-1">
                                                    <label>
                                                        <textarea class="uk-textarea uk-button-secondary" placeholder="<?php    echo $detail; ?>"  disabled></textarea>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="form-horizontal-text">Image Name</label>
                                                <div class="uk-form-controls">
                                                    <input class="uk-input uk-width-1-2" id="form-horizontal-text" type="text" placeholder="Some text..." value="<?php echo $images; ?> " disabled>
                                                </div>
                                            </div>
                                            <p >
                                                <button class="uk-button uk-button-default uk-width-1-3@s uk-modal-close" type="button">Cancel</button>
                                                <a class="uk-button uk-button-primary uk-width-1-3@s" href="AdminServiceDelete.php?id=<?php echo $id; ?>" >Delete</a>

                                            </p>


                                        </form>


                                    </div>

                                </div>
                            </div>
                        </div>


                        <?php
                    }
                }
                $result= mysqli_query($connection,"SELECT * FROM services");
                $norows= mysqli_num_rows($result);
            ?>
            <tr>
                <td class="uk-text-center uk-text-bold" colspan="5"><?php echo "Total ",$norows; ?> Record(s) found</td>
                <td colspan="4"><a class="uk-button uk-button-default  uk-width-1-1@s " href="#add" uk-toggle>Add</a></td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td colspan="3">
                    <a class="uk-button uk-button-default  uk-button- uk-width-1-1@s "  href="AdminServices.php"> Reload Table
                    </a>
                </td>
                <td><a href="#" uk-totop uk-scroll></a></td>

            </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Service-->
<div id="add" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>

        <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
            <div class="uk-background-cover" style="background-image: url('../PictureAdminPage/poster.jpg');" uk-height-viewport></div>
            <div class="uk-padding-large">
                <h2>Add Service</h2>

                <form class="uk-grid-small" uk-grid action=""  method="post" role="form" enctype="multipart/form-data" >
                    <div class="uk-width-1-1">
                        <label for="title"></label><input class="uk-input uk-button-default" type="text" placeholder="Title" id="title" name="title" required>
                    </div>

                    <div class="uk-width-1-1">
                        <label for="des"></label><textarea rows="10" class="uk-textarea uk-button-default" placeholder="Description" id="des" name="des" required></textarea>
                    </div>

                    <div class="uk-width-1-2 uk-margin" >
                        <div uk-form-custom="target: true" class="">
                            <input class="uk-width-1-1@l uk-form-width-large" type="file" id="imageFile" accept="image/*" name="filename">
                            <input class="uk-input uk-form-width-large" type="text" placeholder="Select image" disabled>
                        </div>
                    </div>
                    <div class="uk-margin-remove uk-width-1-1@s ">
                        <button class="uk-button uk-button-default uk-width-1-3@l uk-button uk-button-primary " type="submit"  value="Sum" name="Add_service">Submit</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>






</body>
</html>



