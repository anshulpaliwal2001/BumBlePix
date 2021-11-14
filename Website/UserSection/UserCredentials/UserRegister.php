
<?php
    include 'userheader.php';
    headerr("BumblePix | User Registration");
    include '../UserDataBase/UserDB.php';
    include '../UserCredentials/RegisterError.php';
    include '../UserCredentials/validation.php';


    session_start();
    $message=1;
    $fname_error=0;
    $lname_error=0;
    $mail_error=0;
    $username_error=0;
    $password_error="";
    $image_error=0;
    $successmsg=2;
    for($i=0; $i<6; $i++)
    {
        $password_error[$i]='0';
    }
    if(isset($_POST['registerform']))
    {

        $flag=0;
        $fname_error= CheckName($_POST['F_Name']);
        $lname_error= CheckName($_POST['L_Name']);
        $mail_error=CheckMail($_POST['E_mail']);
        $username_error=CheckUserName($_POST['user_name']);
        $password_error=CheckPassword($_POST['CRpassword'],$_POST['CNpassword']);
        $user_name= $_POST['user_name'];
        $password= $_POST['CRpassword'];
        $mail=$_POST['E_mail'];
        $fname=$_POST['F_Name'];
        $lname=$_POST['L_Name'];
        $gender=$_POST['Gender'];




        for($i=0;$i<6;$i++)
        {
            $flag=$flag+$password_error[$i];
        }
        if(($fname_error+$lname_error+$mail_error+$username_error+$flag)==0)
        {
            $AvatarName= GetImageName($_FILES['avatar1']['name']);
            $tempname=$_FILES['avatar1']['tmp_name'];
            $dir="UserAvatar/";
            if(move_uploaded_file($tempname,$dir.$AvatarName)) {
                $image_error = 1;
            }
            else {
                $image_error = 2;
            }
            if($image_error==1)
            {

                $credentials_query="INSERT INTO user_credentials (user_id, user_name, user_password) VALUES (NULL,'$user_name','$password')";
                if(mysqli_query($connection,$credentials_query) or die(mysqli_error($connection)))
                {

                    $getid=mysqli_query($connection,"SELECT User_ID FROM user_credentials where User_Name='$user_name'") or die(mysqli_error($connection));
                    $iid = mysqli_fetch_array($getid);
                    $id=$iid['User_ID'];
                    $userQuery="INSERT INTO `user_info`(`Info_ID`,`User_ID`, `Info_mail`, `Info_FName`, `Info_LName`, `Info_Gender`, `Info_Image`, `Info_Address`) VALUES (NULL,'$id','$mail','$fname','$lname','$gender','$AvatarName',NULL)";
                    if(mysqli_query($connection,$userQuery) or die(mysqli_error($connection)))
                    {
                        $successmsg=1;
                    }
                    else
                    {
                        $successmsg=0;
                    }
                }

            }



        }


        //$mail_error= CheckMail($_POST['E_mail']);
    }

?>

<body>
<div id="register">
    <div class="uk-flex uk-flex-middle" data-uk-height-viewport="offset-top: true">
        <div class="uk-width-1-1">
            <div class="uk-section">
                <div class="uk-container">
                    <div class="uk-grid-large" data-uk-grid>
                        <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                             data-uk-scrollspy="cls: uk-animation-slide-left-small; repeat: true; delay: 200">
                            <img src="../UserMainImages/userregisterart.svg" alt="Header" width="800" height="1000">
                        </div>
                        <div class="uk-width-1-2@m  uk-flex uk-flex-middle"
                             data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                            <div class="uk-width-1-1@l">
                                <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Register</h1>
                                <?php
                                    RegisterError($fname_error,$lname_error,$mail_error,$username_error,$password_error,$image_error,$successmsg);

                                ?>
                                <div class="uk-margin-remove-top">
                                    <form  action="" method="post" id="registerform" enctype="multipart/form-data" uk-grid>
                                        <div class="uk-margin-small uk-width-1-1 uk-margin-top">
                                            <div class="uk-inline">
                                                <label>
                                                    <span class="uk-form-icon" uk-icon="icon: quote-right"></span>
                                                    <input class="uk-input uk-form-width-large  uk-button-secondary" type="text" placeholder="First Name" name="F_Name" id="F_Name" required>
                                                </label>
                                            </div>
                                            <a href="#modal-info-fname" class="uk-icon uk-margin-small-left " uk-icon="info" uk-toggle=""></a>
                                        </div>
                                        <div class="uk-margin-remove uk-width-1-1">
                                            <div class="uk-inline">
                                                <label>
                                                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: quote-right"></span>
                                                    <input class="uk-input uk-form-width-large  uk-button-secondary" type="text" placeholder="Last Name" name="L_Name" id="L_Name" required>
                                                </label>
                                            </div>
                                            <a href="#modal-info-lname" class="uk-icon uk-margin-small-left " uk-icon="info" uk-toggle=""></a>
                                        </div>
                                        <div class="uk-margin-small-top uk-width-1-1">
                                            <div class="uk-inline">
                                                <label>
                                                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                                    <input class="uk-input uk-form-width-large  uk-button-secondary" type="email" placeholder="E-mail" name="E_mail" id="E_mail" required>
                                                </label>
                                            </div>
                                            <a href="#modal-info-mail" class="uk-icon uk-margin-small-left " uk-icon="info" uk-toggle=""></a>
                                        </div>
                                        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid uk-margin-remove-bottom">
                                            <label>Gender: <input class="uk-radio uk-margin-large-left" type="radio" name="Gender" value="M" id="Gender" checked> Male</label>
                                            <label><input class="uk-radio uk-margin-left" type="radio" name="Gender" value="F" id="Gender"> Female</label>
                                            <label><input class="uk-radio uk-margin-left" type="radio" name="Gender" value="O" id="Gender"> Others</label>
                                        </div>

                                        <div class=" uk-margin-small-top" >
                                            <div uk-form-custom="target: true">

                                                <input class="uk-button-secondary" type="file" name="avatar1" required>
                                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: image"></span>
                                                <input class="uk-input  uk-button-secondary uk-form-width-large" type="text" placeholder="Select Avatar" name="avatar" readonly required>
                                            </div>
                                            <a href="#modal-info-file" class="uk-icon uk-margin-small-left " uk-icon="info" uk-toggle=""></a>
                                        </div>

                                        <div class="uk-margin-small uk-width-1-1 uk-margin-top">
                                            <div class="uk-inline">
                                                <label>
                                                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                                                    <input class="uk-input uk-form-width-large  uk-button-secondary" type="text" placeholder="Username" name="user_name" required>
                                                </label>
                                                <a href="#modal-info-username" class="uk-icon uk-margin-small-left " uk-icon="info" uk-toggle=""></a>
                                            </div>
                                        </div>
                                        <div class="uk-margin-remove-top uk-width-1-1" >
                                            <div class="uk-inline">
                                                <label>
                                                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                                    <input class="uk-input uk-form-width-large uk-button-secondary" type="password" placeholder="Create password" name="CRpassword" required>
                                                </label>
                                            </div>
                                            <a href="#modal-info-password" class="uk-icon uk-margin-small-left " uk-icon="info" uk-toggle="" ></a>
                                        </div>

                                        <div class="uk-margin-small uk-width-1-1" >
                                            <div class="uk-inline">
                                                <label>
                                                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                                    <input class="uk-input uk-form-width-large uk-button-secondary" type="password" placeholder="Confirm password" name="CNpassword" required >
                                                </label>
                                            </div>
                                        </div>



                                    </form>
                                    <button class="uk-button uk-button-primary" type="submit" name="registerform" form="registerform" >Register</button>
                                    <div class="uk-margin-small-top">
                                        <p>Already have account?<b><a href="UserLogin.php"> Login</a></b>  now. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- MODALS-->
<!-- FIRST NAME MODAL-->
<div id="modal-info-fname" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">1: FIRST NAME RULE</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-column-1-2">
                <ul class="uk-list uk-list-disc uk-list">
                    <li><b>1. </b>Minimum 2 letters.</li>
                    <li><b>2. </b>Maximum 14 letters.</li>
                    <li><b>3. </b>Special Characters not allowed.</li>
                    <li><b>4. </b>Can be later edited.</li>
                </ul>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a href="#modal-info-lname" class="uk-button uk-button-primary" uk-toggle>Next</a>
        </div>
    </div>
</div>
<!-- LAST NAME MODAL-->
<div id="modal-info-lname" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">2: LAST NAME RULE</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-column-1-2">
                <ul class="uk-list uk-list-disc uk-list">
                    <li><b>1. </b>Minimum 2 letters.</li>
                    <li><b>2. </b>Maximum 14 letters.</li>
                    <li><b>3. </b>Special Characters not allowed.</li>
                    <li><b>4. </b>Can be later edited.</li>
                </ul>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a href="#modal-info-mail" class="uk-button uk-button-primary" uk-toggle>Next</a>
        </div>
    </div>
</div>
<!-- MAIL MODAL-->
<div id="modal-info-mail" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">3: Mail Rule</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-column-1-2">
                <ul class="uk-list uk-list-disc uk-list">
                    <li><b>1. </b>Should be a valid Mail.</li>
                    <li><b>2. </b>Must not be registered already.</li>
                    <li><b>3. </b>Later can be changed.</li>
                </ul>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a href="#modal-info-file" class="uk-button uk-button-primary" uk-toggle>Next</a>
        </div>
    </div>
</div>
<!-- IMAGE MODAL-->
<div id="modal-info-file" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">4: Image Rule</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-column-1-2">
                <ul class="uk-list uk-list-disc uk-list">
                    <li><b>1. </b>Must be a PNG or JPEG</li>
                    <li><b>2. </b>1:1 Ratio recommended.</li>
                    <li><b>3. </b>Should be <=5 MB</li>
                </ul>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a href="#modal-info-username" class="uk-button uk-button-primary" uk-toggle>Next</a>
        </div>
    </div>
</div>
<!-- USERNAME MODAL-->
<div id="modal-info-username" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">5: Username Rule</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-column-1-2">
                <ul class="uk-list uk-list-disc uk-list">
                    <li><b>1. </b>Must not be registered already.</li>
                    <li><b>2. </b>Should be unique</li>
                    <li><b>3. </b>Will be used to login.</li>
                    <li><b>5. </b>No Special characters allowed.</li>
                    <li><b>6. </b>No blank space or underscore.</li>
                    <li><b>7. </b>Once registered cannot be changed later.</li>
                </ul>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a href="#modal-info-password" class="uk-button uk-button-primary" uk-toggle>Next</a>
        </div>
    </div>
</div>
<!-- Password MODAL-->
<div id="modal-info-password" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">6: Password Rule</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-column-1-2">
                <ol class="uk-list uk-list-disc uk-list">
                    <li class="uk-text-justify"><b>1. </b>Must have at least 6 characters</li>
                    <li class="uk-text-justify"><b>2. </b>Must have not have more then 16 characters.</li>
                    <li class="uk-text-justify"><b>3. </b>Must have at least one Capital letter.</li>
                    <li class="uk-text-justify"><b>4. </b>Must have at least one Small letter.</li>
                    <li class="uk-text-justify"><b>5. </b>Must have at least one Number.</li>
                    <li class="uk-text-justify"><b>6. </b>Create Password should match confirm password.</li>
                    <li class="uk-text-justify"><b>7. </b>Once registered cannot be changed later.</li>
                </ol>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a href="#modal-info-fname" class="uk-button uk-button-primary" uk-toggle>Next</a>
        </div>
    </div>
</div>
<!--MODALS END-->
</body>
