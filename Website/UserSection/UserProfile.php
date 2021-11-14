<?php
    include "UserDashHead.php";
    UserDashHead("Profile","");


?>
    <div class="uk-container">
        <ul class="uk-breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="UserDashboard.php" class="">Dashboard</a></li>
            <li><span  class="">Profile</span></li>
        </ul>
    </div>
<body>
    <div class="uk-container uk-margin-medium-top uk-margin-remove-bottom" data-uk-height-viewport="offset-top: true">
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
            <div class="uk-flex-last@s uk-card-media-right uk-cover-container">
                <img src="https://images.pexels.com/photos/2908194/pexels-photo-2908194.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="" uk-cover>
                <canvas width="600" height="250"></canvas>
            </div>
            <div>
                <div class="uk-card-body">
                    <h3 class="uk-card-title">ID Details</h3>
                    <form class="uk-form-horizontal uk-margin-medium" >
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="username">Username : </label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large  uk-button-default uk-text-bolder " id="username" type="text" placeholder="Username" value="<?php echo "@".GetUsername(); ?>" readonly>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="date">Join Date : </label>
                            <div class="uk-form-controls">
                                <p class="uk-text-bold "><?php GetDateand(); ?></p>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
            <div class="uk-card-media-left uk-cover-container">
                <img src="<?php echo "UserCredentials/UserAvatar/".GetAvatar(); ?>" alt="" uk-cover>
                <canvas width="600" height="300"></canvas>
            </div>
            <div>
                <div class="uk-card-body">
                    <h3 class="uk-card-title">Personal Details</h3>
                    <form class="uk-form-horizontal uk-margin-medium" >
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="FirstName">First Name : </label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large  uk-button-default uk-text-bolder " id="FirstName" type="text" placeholder="First Name" value="<?php echo GetName("F"); ?>" readonly>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="LastName">Last Name : </label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large  uk-button-default uk-text-bolder " id="LastName" type="text" placeholder="Last Name" value="<?php echo GetName("L"); ?>" readonly>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="Gender">Gender : </label>
                            <div class="uk-form-controls">
                                <?php
                                    if(GetName("G")=="M")
                                    {
                                        ?>
                                        <input class="uk-input uk-form-width-large  uk-button-default uk-text-bolder " id="Gender" type="text" placeholder="Gender" value="MALE &#9794; " readonly>
                                        <?php
                                    }
                                    else if(GetName("G")=="F")
                                    {
                                        ?>
                                        <input class="uk-input uk-form-width-large  uk-button-default uk-text-bolder " id="Gender" type="text" placeholder="Gender" value="FEMALE &#9792;" readonly>
                                        <?php
                                    }
                                    else if(GetName("G")=="O")
                                    {
                                        ?>
                                        <input class="uk-input uk-form-width-large  uk-button-default uk-text-bolder " id="Gender" type="text" placeholder="Gender" value="OTHER &#9893;" readonly>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
            <div class="uk-flex-last@s uk-card-media-right uk-cover-container">
                <img src="https://images.pexels.com/photos/821754/pexels-photo-821754.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="" uk-cover>
                <canvas width="600" height="300"></canvas>
            </div>
            <div>
                <div class="uk-card-body">
                    <h3 class="uk-card-title">Contact Details</h3>
                    <form class="uk-form-horizontal uk-margin-medium" >
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="mail">E-Mail : </label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large  uk-button-default uk-text-bolder " id="mail" type="text" placeholder="Username" value="<?php echo Getmail(); ?>" readonly>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="address">Address : </label>
                            <div class="uk-form-controls">

                                <textarea class="uk-textarea uk-form-width-large  uk-button-default uk-text-bolder  " rows="4" id="address" placeholder="Textarea" readonly><?php echo GetAdd(); ?></textarea>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
<?php
    UserDashFoot();
