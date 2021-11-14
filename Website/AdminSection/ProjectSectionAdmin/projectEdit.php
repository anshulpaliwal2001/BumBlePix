
<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Update Projects</title>
    <link rel="shortcut icon" type="image/png" href="../images/Website/Logo.png" >
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/uikit.js"></script>
</head>
<?php
    require "AdminHead.php";

    $server_name= "localhost";
    $db_user="root";
    $db_password="";
    $db_name="digitalmarketing";

    $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
    $dbconfig=mysqli_select_db($connection,$db_name);

    error_reporting(0);
    $id=$_GET['id'];
    $query="SELECT * FROM project WHERE id = '$id'";
    $query_run=mysqli_query($connection,$query);
    $row=mysqli_fetch_array($query_run);




?>


<body>

<div class="uk-flex uk-flex-middle" data-uk-height-viewport="offset-top: true">
    <div class="uk-width-1-1">
        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid-large" data-uk-grid>
                    <div class="uk-width-1-2@m" data-uk-scrollspy="cls: uk-animation-slide-left-small; repeat: true; delay: 200">
                        <h2>Current Data</h2>
                        <form class="uk-grid-small" uk-grid action="" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="uk-width-1-1">
                                <input class="uk-input uk-button-secondary" type="text" placeholder="<?php    echo $row['Title']; ?>"   disabled>
                            </div>

                            <div class="uk-width-1-1">
                                <textarea class="uk-textarea uk-button-secondary" placeholder="<?php    echo $row['Description']; ?>"  disabled></textarea>
                            </div>

                            <div class="uk-width-1-1">
                                <input class="uk-input uk-button-secondary" type="text" placeholder="<?php    echo $row['Site']; ?>"  disabled>
                            </div>
                            <div class="uk-width-1-2">
                                <div class="uk-child-width-1-2" uk-grid uk-lightbox="animation: slide">
                                    <div class="uk-align-center">
                                        <a class="uk-inline" href="<?php    echo $row['Image']; ?>" data-caption="<?php    echo $row['Image']; ?>">
                                            <img src="<?php    echo $row['Image']; ?>" alt="">
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div class="uk-width-1-2" >
                                <label for="title"></label><input class="uk-input uk-form-width-large" type="text" placeholder="<?php    echo $row['Image']; ?>"  disabled>
                            </div>




                        </form>
                    </div>









                    <div class="uk-width-1-2@m uk-flex uk-flex-middle" data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">

                        <form class="uk-grid-small" uk-grid action="" method="post" enctype="multipart/form-data" autocomplete="off">
                            <h2>Update here</h2>
                            <div class="uk-width-1-1">
                                <input class="uk-input uk-button-secondary" type="text" placeholder="Title" id="title" name="title" value="<?php echo $row['Title']; ?>" required>
                            </div>

                            <div class="uk-width-1-1">
                                <label for="des"></label><textarea class="uk-textarea uk-button-secondary" placeholder="Description" id="des" name="des"  required><?php echo $row['Description']; ?></textarea>
                            </div>
                            <div class="uk-margin" >
                                <div uk-form-custom="target: true" class="">
                                    <input class="uk-width-1-1@l uk-form-width-large" type="file" id="imageFile" accept="image/*" value="<?php echo $row['Image']; ?>" name="filename">
                                    <input class="uk-input uk-form-width-medium" type="text" placeholder="Select image" required >
                                </div>
                            </div>
                            <div class="uk-margin uk-width-1-2 uk-align-right">
                                <label for="link"></label><input class="uk-input uk-button-secondary uk-form-width-large" type="url" id="link" name="link" placeholder="Website" value="<?php echo $row['Site']; ?>" required>
                            </div>



                            <div class="uk-margin uk-width-1-1@s">
                                <button class="uk-button uk-button-default uk-width-1-1@l uk-button-large uk-button-secondary" type="submit"  value="Sum" name="Submit">Submit</button>
                            </div>




                        </form>

                    </div>
                    <div class="uk-margin uk-width-1-1@s">
                        <a class="uk-button uk-button-default uk-width-1-2 uk-button-small uk-button-danger" href="AdminProjects.php">Back To Projects</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php


    $server_name= "localhost";
    $db_user="root";
    $db_password="";
    $db_name="digitalmarketing";

    $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
    $dbconfig=mysqli_select_db($connection,$db_name);

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $title= mysqli_real_escape_string($connection,$_POST['title']);
        $Des= mysqli_real_escape_string($connection,$_POST['des']);
        $imagepath= mysqli_real_escape_string($connection,'Projects/'.$_FILES['filename']['name']);
        $link= mysqli_real_escape_string($connection,$_POST['link']);


        if(preg_match("!image!",$_FILES['filename']['type']))
            if(copy($_FILES['filename']['tmp_name'],$imagepath)) {
                $query = "UPDATE `project` SET `Title`='$title',`Description`='$Des',`Image`='$imagepath',`Site`='$link' WHERE id='$id'";
                header("Location : AdminProjects.php");
                if(!mysqli_query($connection, $query))
                {
                    echo "Error: " . $query . "<br>" . mysqli_error($connection);
                }


            }

    }
?>
