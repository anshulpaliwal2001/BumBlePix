
<?php


    function RegisterError($fname_error,$lname_error, $mail_error,$username_error,$password_error,$image_error,$successmsg) :void
    {
        if($fname_error==1)
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><b>First name</b> is either too small or too large! Check <a href="#modal-info-fname" uk-toggle>rule</a> for it.</p>
            </div>
            <?php
        }
        if($lname_error==1)
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><b>Last name</b> is either too small or too large! Check <a href="#modal-info-lname" uk-toggle>rule</a> for it.</p>
            </div>
            <?php
        }
        if($fname_error==2)
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Special characters not allowed in <b>First name</b>!  Check <a href="#modal-info-fname" uk-toggle>rule</a> for it.</p>
            </div>
            <?php
        }
        if($lname_error==2)
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Special characters not allowed in <b>Last name</b>!  Check <a href="#modal-info-lname" uk-toggle>rule</a> for it.</p>
            </div>
            <?php
        }
        if($mail_error==1)
        {
            ?>
            <div class="uk-alert-warning uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>This <b>E-mail</b> already exists! <a href="../UserCredentials/UserLogin.php">Login</a> here.</p>
            </div>
            <?php
        }
        if($username_error==1)
        {
            ?>
            <div class="uk-alert-warning uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>This <b>Username</b> already exists! Try diffrent or  <a href="../UserCredentials/UserLogin.php">Login</a> here.</p>
            </div>
            <?php
        }
        if($username_error==2)
        {
            ?>
            <div class="uk-alert-warning uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Special characters not allowed in <b>Username</b>. please change. See <a href="#modal-info-username" uk-toggle>rules</a> here.</p>
            </div>
            <?php
        }
        if($password_error[0]=='1')
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><b>Confirm Password</b> must match <b>Create Password.</b> Try again.</p>
            </div>
            <?php
        }
        if($password_error[1]=='1')
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><b>Password</b> should be at least of 8 digits. Check <b><a href="#modal-info-password" uk-toggle>rules</a></b> </p>
            </div>
            <?php
        }
        if($password_error[2]=='1')
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><b>Password</b> cant exceed 16 digits. Check <b><a href="#modal-info-password" uk-toggle>rules</a></b> </p>
            </div>
            <?php
        }
        if($password_error[3]=='1')
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Your <b>Password</b> Must Contain At Least one Number!. Check <b><a href="#modal-info-password" uk-toggle>rules.</a></b> </p>
            </div>
            <?php
        }
        if($password_error[4]=='1')
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Your <b>Password</b> Must Contain At Least one Capital Alphabet!.<br> Check <b><a href="#modal-info-password" uk-toggle>rules.</a></b> </p>
            </div>
            <?php
        }
        if($password_error[5]=='1')
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Your <b>Password</b> Must Contain At Least one Small Alphabet!. <br> Check <b><a href="#modal-info-password" uk-toggle>rules.</a></b> </p>
            </div>
            <?php
        }
        if($image_error==1)
        {
            ?>
            <div class="uk-alert-success uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p> <b>Avatar</b> uploaded succesfully! </p>
            </div>
            <?php
        }
        if($image_error==2)
        {
            ?>
            <div class="uk-alert-success uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>There was an error uploading your <b>Avatar</b>. Check <b><a href="#modal-info-file" uk-toggle>rules</a></b> & Try Again.</p>
            </div>
            <?php
        }
        if($successmsg==1)
        {
            ?>
            <div class="uk-alert-success uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Bravo! You successfully <b>registered!</b> Go to <b><a href="../UserCredentials/UserLogin.php">Login</a></b></p>
            </div>
            <?php
        }
        if($successmsg==0)
        {
            ?>
            <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Something failed :( Try Again. </a></b></p>
            </div>
            <?php
        }



    }

