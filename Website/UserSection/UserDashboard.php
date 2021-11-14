<?php

    include "UserDashHead.php";
    UserDashHead("Dashboard","");


?>

    <div class="uk-container">
        <ul class="uk-breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><span href="" class="">Dashboard</span></li>
        </ul>
    </div>
<body>

<div class="uk-container uk-margin-medium-top uk-margin-remove-bottom" data-uk-height-viewport="offset-top: true">
    <div class="uk-grid-column-small uk-grid-row-small uk-child-width-1-3@s uk-text-center" uk-grid>
        <div class="uk-margin-remove-bottom">
            <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-margin-remove-bottom">
                <div class="uk-card-media-top">
                    <img class="uk-border-rounded uk-box-shadow-hover uk-margin-small-right" src="UserMainImages/cart.jpg" alt="" height="150" width="210">

                </div>
                <div class="uk-margin-medium-top">

                    <h3 class="uk-card-title"> Cart </h3>
                    <div class="uk-card-footer uk-margin-remove-bottom">
                        <br>
                        <span>
                            <?php
                                if(isset($_SESSION['cart'])&& empty($_SESSION['cart'])!=1)
                            {
                                echo "<span class='uk-label'>".GetCartItemNo()."</span>";
                            }
                            else
                            {
                                echo "<span class='uk-text-bold'> The <a href='UserCart.php'>cart</a> is empty. <a href='UserShop.php'>Shop</a> Now.</span>";
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-margin-remove-bottom">
            <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-margin-remove-bottom">
                <div class="uk-card-media-top">
                    <img class="uk-border-rounded uk-box-shadow-hover uk-margin-small-right" src="UserMainImages/dashboardart.svg" alt="" height="150" width="921">

                </div>
                <br>
                <div class="uk-margin-medium-top">

                    <h3 class="uk-card-title"> WELCOME </h3>

                </div>
                <br>
            </div>
        </div>


        <div class="uk-margin-remove-bottom">
            <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-margin-remove-bottom">
                <div class="uk-card-media-top">
                    <img class="uk-border-rounded uk-box-shadow-hover uk-margin-small-right" src="UserMainImages/piggy.jpg" alt="" height="150" width="210">
                </div>
                <div class="uk-margin-medium-top">

                    <h3 class="uk-card-title"> Account </h3>

                    <div class="uk-card-footer uk-margin-remove-bottom">
                        <br>
                        <span>
                           <a href="UserPixPurchase.php" class="uk-button uk-button-text uk-margin-small-right uk-text-secondary">View</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-margin-remove-bottom">

                <div class="uk-card-media-top">
                    <img class="uk-border-rounded uk-box-shadow-hover uk-margin-small-right" src="UserMainImages/transactions.jpg" alt="" height="150" width="210">
                </div>
                <div class="uk-margin-medium-top">
                    <h3 class="uk-card-title"> Transactions </h3>
                    <span>
                        <div class="uk-card-footer uk-margin-remove-bottom">
                            <a href="UserTransection.php" class="uk-button uk-button-text uk-margin-small-right uk-text-secondary">View</a>
                        </div>
                    </span>

                </div>
            </div>
        </div>
        <div class="uk-margin-remove-bottom">
            <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-margin-remove-bottom">
                <div class="uk-card-media-top">
                    <img class="uk-border-circle uk-box-shadow-hover uk-margin-small-right" src="<?php echo "UserCredentials/UserAvatar/".GetAvatar(); ?>" alt="" height="150" width="150">

                </div>
                <div class="uk-card-body card uk-margin-remove-bottom">

                    <h3 class="uk-card-title"> <?php echo "@".GetUsername(); ?> </h3>
                    <div class="uk-card-footer uk-margin-remove-bottom">
                        <p class="uk-text-center uk-text-bolder uk-text-capitalize uk-letter-spacing-small uk-text-meta">Profile</p>
                        <a href="UserProfile.php" class="uk-button uk-button-text uk-margin-small-right uk-text-secondary">View</a>
                        <a href="#" class="uk-button uk-button-text uk-margin-small-left uk-text-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-margin-remove-bottom">

                <div class="uk-card-media-top">
                    <img class="uk-border-rounded uk-box-shadow-hover uk-margin-small-right" src="UserMainImages/invoice.jpg" alt="" height="150" width="210">
                </div>
                <div class="uk-margin-medium-top">
                    <h3 class="uk-card-title"> Invoices </h3>
                    <span>
                        <div class="uk-card-footer uk-margin-remove-bottom">
                            <a href="UserInvoice.php" class="uk-button uk-button-text uk-margin-small-right uk-text-secondary">View</a>
                        </div>
                    </span>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php
    UserDashFoot();
