<?php
    include "UserDashHead.php";
    UserDashHead("Pixa Coins","");
?>
<div class="uk-container">
    <ul class="uk-breadcrumb">
        <li><a href="../index.php">Home</a></li>
        <li><a href="UserDashboard.php" class="">Dashboard</a></li>
        <li><span  class="">Pixa Coins</span></li>
    </ul>
</div>

<body >
<div class="uk-container uk-margin-medium-top">
    <div class="uk-text-center" uk-grid>

        <div class="uk-width-1-3@m">
            <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                    <div class="">
                        <h3 class="uk-card-title">Buy Pixa Coin!</h3>
                        <span>Pixa Coins Packs are on offer!! Buy Now!</span>
                    </div>
            </div>
        </div>
        <div class="uk-width-expand@m">
            <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin uk-card-hover" uk-grid>
                <div class="uk-flex-last@s uk-card-media-right uk-cover-container">
                    <img src="UserMainImages/Coin.jpg" alt="" uk-cover>
                    <canvas width="600" height="410"></canvas>
                </div>
                <div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title uk-text-left">What is PixaCoin?</h3>
                        <p class="uk-text-justify">Its a simple in web currency to buy products. You can buy pixa coin anytime. Its Safe, Secure and transparent.</p> <p    class="uk-text-justify">More then <span class="uk-text-bold"> <?php echo "&#8377;".moneyFormatIndia(2000000); ?> </span> have been bought by buyers. <span class="uk-text-bold">1 Pix = &#8377; 10</span> </p>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="uk-text-center" uk-grid>

        <div class="uk-width-1-3@m">
            <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                <h3 class="uk-card-title"><span><img class="uk-icon-image" src="UserMainImages/pixacoin.png" width="35" height="35" alt=""></span>
                    <?php echo "".moneyFormatIndia(1000);?>
                </h3>
                <form action="" method="post">
                    <button class="uk-button uk-button-primary uk-button-large uk-width-1-1" name="1000">Pay &#8377;<?php echo moneyFormatIndia(10000); ?> </button>
                </form>

            </div>
        </div>
        <div class="uk-width-1-3@m">
            <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                <div class="uk-card-badge uk-label uk-label-new">Hot</div>
                <h3 class="uk-card-title"><span><img class="uk-icon-image" src="UserMainImages/pixacoin.png" width="35" height="35" alt=""></span>
                    <?php echo "".moneyFormatIndia(10000);?>
                </h3>
                <form action="" method="post">
                    <button class="uk-button uk-button-primary uk-button-large uk-width-1-1" name="10000">Pay &#8377;<?php echo moneyFormatIndia(100000); ?> </button>
                </form>
            </div>
        </div>
        <div class="uk-width-1-3@m">
            <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                <h3 class="uk-card-title"><span><img class="uk-icon-image" src="UserMainImages/pixacoin.png" width="35" height="35" alt=""></span>
                    <?php echo "".moneyFormatIndia(30000);?>
                </h3>
                <form action="" method="post">
                    <button class="uk-button uk-button-primary uk-button-large uk-width-1-1" name="30000">Pay &#8377;<?php echo moneyFormatIndia(300000); ?> </button>
                </form>
            </div>
        </div>

    </div>

</div>
</body>
<?php
    UserDashFoot();
