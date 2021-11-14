<?php
    include "UserDashHead.php";
    include "ExtraFiles/Shop_items.php";
    UserDashHead("Shop","");


?>
    <div class="uk-container">
        <ul class="uk-breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="UserDashboard.php" class="">Dashboard</a></li>
            <li><span  class="">Shop</span></li>
        </ul>
    </div>
<body>
<div class="uk-container  uk-margin-remove-bottom" data-uk-height-viewport="offset-top: true">
    <?php
        Items();
    ?>
</div>
<?php

UserDashFoot();

