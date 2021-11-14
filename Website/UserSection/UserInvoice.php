<?php
    include "UserDashHead.php";
    UserDashHead("Invoice","");
?>
    <div class="uk-container">
        <ul class="uk-breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="UserDashboard.php" class="">Dashboard</a></li>
            <li><span href="#" class="">Invoice</span></li>
        </ul>
    </div>
<body>
    <div class="uk-container uk-margin-medium-top">
        <div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-text-center " uk-grid="parallax: 150">


            <?php
                ShowAllInvoices();
            ?>

        </div>
    </div>
</body>


<?php
    function ShowAllInvoices() : void
    {
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";

        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        $userId=$_SESSION["Userid"];
        $query="SELECT * FROM invoice_log WHERE User_ID='$userId' ORDER BY Invoice_Timestamp DESC ";
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
                                    <span class="uk-margin-remove-bottom uk-text-meta">Invoice No</span>
                                    <br/>
                                    <span class="uk-margin-remove-bottom uk-text-bold uk-text-large"> # <?php echo GetFormattedInvoice($row['Invoice_ID']); ?> </span>
                                    <p class="uk-text-meta uk-margin-remove"><time datetime="2016-04-01T19:00"><?php echo date('D ,j-F-Y',strtotime($row['Invoice_Timestamp'])); ?></time></p>
                                    <p class="uk-text-meta uk-margin-remove"><time datetime="2016-04-01T19:00"><?php echo date('h:i:s A',strtotime($row['Invoice_Timestamp'])); ?></time></p>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin-small-top">
                             <span class="uk-align-left uk-margin-remove uk-text-bold uk-text-large"><span class="uk-text-meta uk-text-primary">Cr. </span><?php echo"&#8377; ". moneyFormatIndia((GetInvoiceTotal($row['Invoice_ID']))) ; ?> </span>
                            <li class="uk-margin-remove uk-align-right"><a href="<?php echo "UserInvoices/UserInvoice.php?Invoiceno=".$row['Invoice_ID']."&Userno=".$row['User_ID']; ?>" target="_blank"><span class="uk-margin-small-right" uk-icon="icon: download"></span> </a></li>
                        </div>
                    </div>
                </div>
                <?php
            }
        }

    }

