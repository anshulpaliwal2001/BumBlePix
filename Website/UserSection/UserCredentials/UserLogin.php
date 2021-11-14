
<?php
    include 'userheader.php';
    headerr("BumblePix | User Login");
    include '../UserDataBase/UserDB.php';


    session_start();


    $message=0;
    if(count($_POST)>0) {

        $count=0;

        $result=mysqli_query($connection,"SELECT count(*) as total from user_credentials where User_Name='".$_POST["user_name"]."'");
        $data=mysqli_fetch_assoc($result);
        $count= $data['total'];
        if($count==1)
        {
            $result = mysqli_query($connection, "SELECT * FROM digitalmarketing.user_credentials WHERE User_Name='" . $_POST["user_name"] . "' AND User_Password = '" . $_POST["password"] . "'");
            $row = mysqli_fetch_array($result);
            if (is_array($row)) {
                $_SESSION["Userid"] = $row['User_ID'];
                $_SESSION["user_name"] = $row['User_Name'];

            } else {
                $message = 1;
                // 1 = Password  Didnt Matched
            }
        }
        else
        {
            $message=2;
            // 2 = No user found
        }
    }
    if(isset($_SESSION["Userid"])) {
        header("Location:../../UserSection/UserDashboard.php");
    }






?>

<body>
<div id="login">
    <div class="uk-flex uk-flex-middle" data-uk-height-viewport="offset-top: true">
        <div class="uk-width-1-1">
            <div class="uk-section">
                <div class="uk-container">
                    <div class="uk-grid-large" data-uk-grid>
                        <div class="uk-width-1-2@m"
                             data-uk-scrollspy="cls: uk-animation-slide-left-small; repeat: true; delay: 200">
                            <img src="../UserMainImages/userloginart.svg" alt="Header" width="800" height="1000">
                        </div>
                        <div class="uk-width-1-2@m  uk-flex uk-flex-middle"
                             data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                            <div class="uk-width-1-1@l">
                                <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Login</h1>
                                <div class="uk-margin">
                                    <?php
                                        if($message==1)
                                        {
                                            ?>
                                            <div class="uk-alert-danger" uk-alert>
                                                <a class="uk-alert-close" uk-close></a>
                                                <p>Seems like the password is not correct! Try again :)</p>
                                            </div>
                                            <?php
                                        }
                                        if($message==2)
                                        {
                                            ?>
                                            <div class="uk-alert-danger" uk-alert>
                                                <a class="uk-alert-close" uk-close></a>
                                                <p>There's no user of this name available.</p>
                                            </div>
                                            <?php
                                        }
                                    ?>

                                </div>
                                <div class="uk-margin-small-top ">

                                    <form  action="" method="post">
                                        <div class="uk-container ">


                                            <div class="uk-margin">
                                                <div class="uk-inline">

                                                    <label>
                                                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                                                        <input class="uk-input uk-form-width-large uk-form-large uk-button-secondary" type="text" placeholder="Username" name="user_name" required>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="uk-margin" >
                                                <div class="uk-inline">
                                                    <label>
                                                        <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                                        <input class="uk-input uk-form-width-large uk-form-large uk-button-secondary" type="password" placeholder="Password" name="password" required>
                                                    </label>
                                                </div>
                                            </div>



                                            <button class="uk-button uk-button-primary" type="submit" >Login</button>

                                        </div>
                                        <div class="uk-margin-small-top">
                                            <p>Don't have Account? <b><a href="UserRegister.php"> Register</a></b> now. </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>






