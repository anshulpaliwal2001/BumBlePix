<?php
    include "UserDashHead.php";
    UserDashHead("Password Change","");
?>
<div class="uk-container">
    <ul class="uk-breadcrumb">
        <li><a href="../index.php">Home</a></li>
        <li><a href="UserDashboard.php" class="">Dashboard</a></li>
        <li><span  class="">Password Change</span></li>
    </ul>
</div>



<div id="register">
    <div class="uk-flex " data-uk-height-viewport="offset-top: true">
        <div class="uk-width-1-1">
            <div class="uk-section">
                <div class="uk-container">
                    <div class="uk-grid-large" data-uk-grid>
                        <div class="uk-width-1-2@m  uk-flex uk-flex-middle uk-align-center"  data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                            <div class="uk-width-1-1@l">
                                <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl uk-text-primary">Create New Password</h1>
                                <?php
                                    //RegisterError($fname_error,$lname_error,$mail_error,$username_error,$password_error,$image_error,$successmsg);

                                ?>
                                <div class="uk-margin-remove-top">
                                    <form  action="" method="post" id="registerform" enctype="multipart/form-data" uk-grid>
                                        <div class="uk-margin-small uk-width-1-1" >
                                            <div class="uk-inline">
                                                <label>
                                                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                                    <input class="uk-input uk-form-width-large uk-button-secondary" type="password" placeholder="Existing password" name="CNpassword" required >
                                                </label>
                                            </div>
                                        </div>
                                        <div class="uk-margin-remove-top uk-width-1-1" >
                                            <div class="uk-inline">
                                                <label>
                                                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                                    <input class="uk-input uk-form-width-large uk-button-secondary" type="password" placeholder="Create new password" name="CRpassword" required>
                                                </label>
                                            </div>
                                            <a href="#modal-info-password" class="uk-icon uk-margin-small-left " uk-icon="info" uk-toggle="" ></a>
                                        </div>

                                        <div class="uk-margin-small uk-width-1-1" >
                                            <div class="uk-inline">
                                                <label>
                                                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                                    <input class="uk-input uk-form-width-large uk-button-secondary" type="password" placeholder="Confirm new password" name="CNpassword" required >
                                                </label>
                                            </div>
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

<?php
    UserDashFoot();