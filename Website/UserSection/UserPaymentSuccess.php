<?php
    include "UserDashHead.php";
    include "ExtraFiles/Shop_items.php";
    UserDashHead("Success Page","");


?>
    <body>
<div class="uk-container  uk-margin-remove-bottom" data-uk-height-viewport="offset-top: true">

    <?php
        if(isset($_SESSION['cart_details']))
        {

            ?>
            <div class="uk-flex uk-flex-middle" data-uk-height-viewport="offset-top: true">
                <div class="uk-width-1-1">
                    <div class="uk-section">
                        <div class="uk-container">
                            <div class="uk-grid-large" data-uk-grid>
                                <div class="uk-width-1-2@m"
                                     data-uk-scrollspy="cls: uk-animation-slide-left-small; repeat: true; delay: 200">
                                    <img src="UserMainImages/success.svg" alt="Header" width="800" height="1000">
                                </div>
                                <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                                     data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                                    <div>
                                        <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Purchase Successful</h1>
                                        <p class="uk-text-lead uk-width-4-5@m">
                                            You have checked out successfully.</p>
                                        <div class="uk-margin-medium-top">
                                            <a href="<?php echo "UserInvoices/UserInvoice.php?Invoiceno=".$_SESSION['cart_details']."&Userno=".$_SESSION["Userid"]; ?>" target="" class="uk-button uk-button-large uk-button-primary" >Invoice</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php



        }
        else
        {
            header('Location: UserCredentials/UserLogin.php');
        }
    ?>

</div>
<?php

    UserDashFoot();