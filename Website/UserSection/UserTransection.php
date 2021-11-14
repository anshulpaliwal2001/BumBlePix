<?php

    include "UserDashHead.php";
    UserDashHead("Transaction","");
?>
    <div class="uk-container">
        <ul class="uk-breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="UserDashboard.php" class="">Dashboard</a></li>
            <li><span href="#" class="">Transaction</span></li>
        </ul>
    </div>
    <body>

    <div class="uk-container uk-margin-medium-top">
        <div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-text-center " uk-grid="parallax: 150">


            <?php
                ShowAllTransaction();
            ?>

        </div>
    </div>
</body>


<?php
    function ShowAllTransaction() : void
    {
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";

        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        $userId=$_SESSION["Userid"];
        $query="SELECT * FROM pix_log WHERE User_ID='$userId' ORDER BY Pix_Id DESC ";
        $query_run=mysqli_query($connection,$query);
        $check_items= mysqli_num_rows($query_run)>0;
        if($check_items)
        {
            while ($row = mysqli_fetch_array($query_run))
            {

                ?>
                <div>
                    <div class="uk-card uk-card-default uk-card-body uk-grid-margin">
                        <div class="uk-card-header">
                            <div class="uk-grid-small uk-flex-middle" uk-grid>

                                <div class="uk-width-expand">
                                    <span class="uk-margin-remove-bottom uk-text-meta">Transaction No</span>
                                    <br/>
                                    <span class="uk-margin-remove-bottom uk-text-bold uk-text-large"> # <?php echo ($row['Pix_Id']); ?> </span>
                                    <p class="uk-text-meta uk-margin-remove"><?php echo date('D ,j-F-Y',strtotime($row['Pix_Timestamp'])); ?></p>
                                    <p class="uk-text-meta uk-margin-remove"><?php echo date('h:i:s A',strtotime($row['Pix_Timestamp'])); ?></p>
                                    <?php if($row['Pix_flow']==0) echo "<p class='uk-text-danger uk-text-bold uk-margin-remove'> Purchase </p>"; else echo "<p class='uk-text-success uk-text-bold uk-margin-remove'> To wallet </p>"; ?>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin-small-top">
                            <?php
                                if($row['Pix_flow']==0)
                                {
                                    ?>
                                    <span class="uk-align-center uk-margin-remove uk-text-bold uk-text-large"><span class="uk-text-meta uk-text-primary">Cr. </span><?php echo"&#8473;  ". moneyFormatIndia($row['Pix_Amount']) ; ?> </span>

                                    <span class="uk-align-center uk-margin-remove uk-text-bold uk-text-meta"><span class="uk-text-meta uk-text-warning">Bal. </span><?php echo"&#8473; ". moneyFormatIndia($row['Pix_crnt_blnc']-$row['Pix_Amount']) ; ?> </span>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <span class="uk-align-center uk-margin-remove uk-text-bold uk-text-large"><span class="uk-text-meta uk-text-success">Dr. </span><?php echo"&#8473; ". moneyFormatIndia($row['Pix_Amount']) ; ?> </span>

                                    <span class="uk-align-center uk-margin-remove uk-text-bold uk-text-meta"><span class="uk-text-meta uk-text-warning">Bal. </span><?php echo"&#8473; ". moneyFormatIndia($row['Pix_crnt_blnc']+$row['Pix_Amount']) ; ?> </span>
                                    <?php

                                }
                            ?>



                        </div>
                    </div>
                </div>
                <?php
            }
        }

    }