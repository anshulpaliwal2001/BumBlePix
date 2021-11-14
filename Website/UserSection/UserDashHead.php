<?php
    function UserDashHead($pageTitle,$prefix) : void
    {

        session_start();
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
            exit();
        }
        include "UserDataBase/UserDB.php";
        $userID=$_SESSION["Userid"];
        date_default_timezone_set('Asia/Kolkata');

        if(isset($_SESSION['cart_details']))
        {
            $id=$_SESSION["Userid"];
            $invoice=$_SESSION["cart_details"];
            unset($_SESSION["cart"]);
            unset($_SESSION["finalAmount"]);
            $_SESSION["Userid"]=$id;
            $_SESSION["cart_details"]=$invoice;

        }






        ?>
        <!DOCTYPE html>
        <html lang="zxx" dir="ltr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?php echo "User | ",$pageTitle;?></title>

            <link rel="shortcut icon" type="image/png" href="../AdminSection/PictureAdminPage/BumblePixLogo.png">
            <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="../AdminSection/CSS/main.css" />
            <script src="../AdminSection/js/uikit.js"></script>
            <script src="../AdminSection/js/uikit-icons.js"></script>
        </head>
        <?php
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            if(isset($_POST['1000']))
            {
                PutMoneyInAccount(1000);
            }
            if(isset($_POST['10000']))
            {
                PutMoneyInAccount(10000);
            }
            if(isset($_POST['30000']))
            {
                PutMoneyInAccount(30000);
            }
            if(isset($_POST['increment_to_cart']))
            {
                $count=count($_SESSION['cart']);
                $_SESSION['cart'][$count]=$_POST['Item_Id'];
                sort($_SESSION['cart']);

            }
            if(isset($_POST['decrement_to_cart']))
            {
                if (($key = array_search($_POST['Item_Id'], $_SESSION['cart'])) !== false)
                {
                    unset($_SESSION['cart'][$key]);
                }
                sort($_SESSION['cart']);
            }
            if(isset($_POST['add_to_cart']))
            {
                if(isset($_SESSION['cart']))
                {

                        $count=count($_SESSION['cart']);
                        $_SESSION['cart'][$count]=$_POST['Item_Id'];
                        sort($_SESSION['cart']);
                }
                else
                {

                    $_SESSION['cart'][0]=$_POST['Item_Id'];

                }
                //print_r($_SESSION['cart']);
            }
            if(isset($_POST['checkoutButton']))
            {
                //Check if all items are in stock

                $array = $_SESSION['cart'];
                $vals = array_count_values($array);
                foreach ($vals as $key => $value)
                {
                    if(GetItemStock($key)<$value)
                    {
                        if(isset($_SESSION['StockError']))
                        {
                            $count=count($_SESSION['StockError']);
                            $_SESSION['StockError'][$count]=$key;
                            sort($_SESSION['StockError']);
                        }
                        else
                            $_SESSION['StockError'][0]=$key;
                    }

                }
                if(!isset($_SESSION['StockError']))         //if all items are in stock
                {

                    if(($_SESSION['finalAmount']/10)<=GetUserBalance())
                    {

                        $timestamp=date("Y-m-d H:i:s");

                        $query="INSERT INTO `invoice_log`
                        ( `User_ID`, `Invoice_Timestamp`) 
                        VALUES ('$userID','$timestamp')";
                        if(mysqli_query($connection,$query) or die(mysqli_error($connection)))
                        {

                            $bl=GetUserBalance();
                            $remainingBalnce=$bl-($_SESSION['finalAmount']/10);
                            $query="UPDATE digitalmarketing.user_credentials SET User_PixBalance='$remainingBalnce' WHERE User_ID='$userID'";
                            mysqli_query($connection,$query) or die(mysqli_error($connection));
                            $query="Select Invoice_ID FROM invoice_log WHERE Invoice_Timestamp='$timestamp'";
                            if(mysqli_query($connection,$query) or die(mysqli_error($connection)))
                            {
                                $getInvoiceID = mysqli_fetch_assoc(mysqli_query($connection, "SELECT Invoice_ID FROM invoice_log WHERE Invoice_Timestamp = '$timestamp'"));
                                $InvoiceId = $getInvoiceID['Invoice_ID'];

                                $array = $_SESSION['cart'];
                                $vals = array_count_values($array);

                                echo "<br>";

                                foreach ($vals as $key => $value)
                                {

                                    $rate=GetItemRate($key);
                                    $tax=GetItemTax($key);
                                    $remainingStock=GetItemStock($key)-$value;
                                    mysqli_query($connection,"UPDATE `items` SET `Item_Stock`='$remainingStock' WHERE Item_ID='$key'") or die(mysqli_error($connection));
                                    $query="INSERT INTO purchase_log (invoice_id, user_id, item_id, purchase_qty, purchase_rate, purchase_taxrate) VALUES ('$InvoiceId','$userID','$key','$value','$rate','$tax')";
                                    if(mysqli_query($connection,$query) or die(mysqli_error($connection)))
                                    {

                                    }

                                }
                                UpdatePixLog(GetInvoiceTotal($InvoiceId)/10,$userID,$bl,0,date("Y-m-d H:i:s"));
                                $_SESSION['cart_details']=$InvoiceId;
                                header('Location: UserPaymentSuccess.php');



                            }
                        }

                    }
                }

            }



        }
        ?>
        <header id="header">
            <div data-uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent ; top: 100">
                <nav class="uk-navbar-container uk-letter-spacing-small uk-text-bold">
                    <div class="uk-container">
                        <div class="uk-position-z-index" data-uk-navbar>
                            <div class="uk-navbar-left">
                                <a class="uk-navbar-item uk-logo" href="<?php echo $prefix."../index.php";?>">BumblePixCo</a>
                                <a class="uk-navbar-item  uk-text-large" ><?php echo "| ".$pageTitle;?></a>
                            </div>
                            <div class="uk-navbar-right">
                                <ul class="uk-navbar-nav uk-visible@m" data-uk-scrollspy-nav="closest: li">
                                    <li><a href=""> <?php echo $pageTitle;  ?></a> </li>
                                    <li><a href="UserCart.php"><span class="uk-margin-small-left" uk-icon="icon: cart"></span><span class="uk-label uk-label-success uk-margin-small-left"><?php if(isset($_SESSION['cart'])){echo GetCartItemNo();} else {echo "0";} ?></span></a></li>
                                    <li><a href="UserPixPurchase.php"><span><img class="uk-icon-image" src="UserMainImages/pixacoin.png" width="40" height="40"></span><span class="uk-label uk-label-yellow uk-margin-small-left"><?php echo "&#8473; ",moneyFormatIndia(GetUserBalance()); ?></span></a></li>

                                    <li><a uk-toggle="target: #offcanvas-push"><span class="uk-margin-small-left" uk-icon="icon: menu"></span></a></li>
                                    </ul>
                                <a class="uk-navbar-toggle uk-hidden@m" uk-toggle="target: #offcanvas-push"><span data-uk-navbar-toggle-icon></span></a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <div id="offcanvas-push" uk-offcanvas="mode: reveal; overlay: true; flip : true" >
            <div class="uk-offcanvas-bar">
<!--                <button class="uk-offcanvas-close" type="button" uk-close></button>-->
                <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>

                    <li class="uk-nav-header <?php if($pageTitle=='Dashboard'){ echo "uk-active";} ?>"><a href="UserDashboard.php">Dashboard</a></li>


                    <li class="uk-parent">

                        <a> <img class="uk-border-circle uk-box-shadow-hover uk-margin-small-right" src="<?php echo "UserCredentials/UserAvatar/".GetAvatar(); ?> " width="30" height="30" alt="Border circle">Profile</a>
                        <ul class="uk-nav-sub">
                            <li><a href="UserProfile.php"><span class="uk-margin-small-right uk-margin-small-bottom" uk-icon="icon: file-text"></span>View Profile</a></li>
                            <li><a href="#"><span class="uk-margin-small-right uk-margin-small-bottom" uk-icon="icon: settings"></span>Edit Profile</a></li>
                            <li><a href="UserChangePassword.php"><span class="uk-margin-small-right uk-margin-small-bottom" uk-icon="icon: cog"></span>Change Password</a></li>

                        </ul>
                    </li>
                    <li class="uk-parent">
                        <a href="UserInvoice.php"></span>Invoices</a>
                        <ul class="uk-nav-sub">
                            <?php
                                $userId=$_SESSION["Userid"];
                                $query="SELECT * FROM invoice_log WHERE User_ID='$userId' ORDER BY Invoice_Timestamp DESC LIMIT 6";
                                $query_run=mysqli_query($connection,$query);
                                $check_items= mysqli_num_rows($query_run)>0;
                                if($check_items)
                                {
                                    while ($row = mysqli_fetch_array($query_run))
                                    {

                                        ?>
                                                <li><a href="<?php echo "UserInvoices/UserInvoice.php?Invoiceno=".$row['Invoice_ID']."&Userno=".$row['User_ID']; ?>" target="_blank"><span class="uk-margin-small-right" uk-icon="icon: calendar"></span><?php echo date('D ,j-F-Y',strtotime($row['Invoice_Timestamp'])); ?></a></li>
                                        <?php
                                    }
                                }
                            ?>

                            <li><a href="UserInvoice.php"><span class="uk-margin-small-right" uk-icon="icon: history"></span> All</a></li>

                        </ul>

                    </li>
                    <li class="uk-parent">
                        <a href="UserInvoice.php"></span>Transactions</a>
                        <ul class="uk-nav-sub">
                            <?php
                                $userId=$_SESSION["Userid"];
                                $query="SELECT * FROM pix_log WHERE User_ID='$userId' ORDER BY Pix_Timestamp DESC LIMIT 4";
                                $query_run=mysqli_query($connection,$query);
                                $check_items= mysqli_num_rows($query_run)>0;
                                if($check_items)
                                {
                                    while ($row = mysqli_fetch_array($query_run))
                                    {

                                        ?>
                                        <li><a class="uk-text-<?php if($row['Pix_flow']==1){ echo "success"; } else { echo "danger";}?>" href="#" target="_blank"><span class="uk-margin-small-right" uk-icon="icon:  <?php if($row['Pix_flow']==1){ echo "pull"; } else { echo "push";}?>"></span><?php echo "&#8473; ",moneyFormatIndia($row['Pix_Amount']); ?></a></li>
                                        <?php
                                    }
                                }
                            ?>
                            <li><a href="UserTransection.php"><span class="uk-margin-small-right" uk-icon="icon: history"></span> All</a></li>
                        </ul>
                    </li>

                    <li class="uk-nav-divider"></li>
                    <li class="uk-nav-header">Services</li>
                    <li><a href="UserShop.php"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Shop</a></li>
                    <li><a href="UserCart.php"><span class="uk-margin-small-right" uk-icon="icon: cart"></span> Cart</a></li>
                    <li><a href="UserPixPurchase.php"><span class="uk-margin-small-right" uk-icon="icon: credit-card"></span> Buy PixaCoins</a></li>

                    <li class="uk-nav-divider"></li>
                    <li class="uk-active"><a href="userLogout.php"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> Logout</a></li>
                </ul>
            </div>
        </div>

        <?php
    }
    function moneyFormatIndia($num) {
        $explrestunits = "" ;
        if(strlen($num)>3) {
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++) {
                // creates each of the 2's group and adds a comma to the end
                if($i==0) {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                } else {
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }
    function GetAvatar() : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";
        $userID=$_SESSION["Userid"];
        $userInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.user_info WHERE User_ID='$userID' ");
        $userInfo = mysqli_fetch_array($userInfoQuery);
        $avatar=$userInfo['Info_Image'];
        return $avatar;
    }
    function GetUsername() : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";
        $userID=$_SESSION["Userid"];
        $userInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.user_credentials WHERE User_ID='$userID' ");
        $userInfo = mysqli_fetch_array($userInfoQuery);
        $userName=$userInfo['User_Name'];
        return $userName;
    }
    function GetName($prefix) : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";
        $userID=$_SESSION["Userid"];
        $userInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.user_info WHERE User_ID='$userID' ");
        $userInfo = mysqli_fetch_array($userInfoQuery);
        if($prefix=="F")
        {
            $Name = $userInfo['Info_FName'];
        }
        if($prefix=="L")
        {
            $Name = $userInfo['Info_LName'];
        }
        if($prefix=="G")
        {
            $Name = $userInfo['Info_Gender'];
        }
        return $Name;
    }
    function Getmail() : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";
        $userID=$_SESSION["Userid"];
        $userInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.user_info WHERE User_ID='$userID' ");
        $userInfo = mysqli_fetch_array($userInfoQuery);
        $userName=$userInfo['Info_mail'];
        return $userName;
    }
    function GetAdd() : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";
        $userID=$_SESSION["Userid"];
        $userInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.user_info WHERE User_ID='$userID' ");
        $userInfo = mysqli_fetch_array($userInfoQuery);
        $userName=$userInfo['Info_Address'];
        if($userInfo['Info_Address']==NULL)
            return "No Data";
        return $userName;
    }
    function GetUserBalance() : float
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";
        $userID=$_SESSION["Userid"];
        $userInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.user_credentials WHERE User_ID='$userID' ");
        $userInfo = mysqli_fetch_array($userInfoQuery);
        $userName=$userInfo['User_PixBalance'];
        return $userName;
    }
    function GetDateand() : void
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";
        $userID=$_SESSION["Userid"];
        $userInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.user_credentials WHERE User_ID='$userID' ");
        $userInfo = mysqli_fetch_array($userInfoQuery);
        echo $date= $userInfo['user_timestamp'];
    }
    function GetCartItemNo() : int
    {
        $array = $_SESSION['cart'];
        $vals = array_count_values($array);
        return count($vals);
    }
    function GetParticularCartItemNo($item) : void
    {
        $array = $_SESSION['cart'];
        $vals = array_count_values($array);
        foreach ($vals as $key => $value) {
            if($key==$item)
            {
                echo $value;
                return;
            }

        }
    }

    function UserDashFoot() : void
    {

    ?>
        <footer class="uk-section uk-section-primary uk-border-large-top uk-margin-large-top">
        <div class="uk-container">
        <div class="uk-child-width-1-2@m" data-uk-grid>
            <div>
                <div class="uk-child-width-expand@s" data-uk-grid data-uk-scrollspy-nav="closest: div; scroll: true; offset: 100">
                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href="UserDashboard.php">Dashboard</a></h5>
                    </div>
                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href="#clients">Profile</a></h5>
                    </div>
                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href="#services">Services</a></h5>
                    </div>
                    <div>
                        <h5 class="uk-text-uppercase uk-letter-spacing-small"><a href="#contact">Contact</a></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-align-left uk-flex uk-flex-bottom" data-uk-grid>
            <div>
                <div>
                    <a href="#" class="uk-logo uk-margin-medium-top uk-display-inline-block">BumblePix</a>
                    <p class="uk-margin-remove">Made by <a href="" target="_blank">Anshul Paliwal</a> for University Project</p>
                </div>
            </div>
            <div>
                <div class="uk-padding uk-padding-remove-vertical">
                    <div data-uk-grid class="uk-child-width-auto uk-grid-small">
                        <div class="uk-first-column">
                            <a href="www.facebook.com" data-uk-icon="icon: facebook; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="www.instagram.com" data-uk-icon="icon: instagram; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="www.twitter.com" data-uk-icon="icon: twitter; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="www.dribble.com" data-uk-icon="icon: dribbble; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                        <div>
                            <a href="#" data-uk-icon="icon: youtube; ratio: 1.2" class="uk-icon-link uk-icon"
                               target="_blank"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>




        </footer>
        <?php
    }
    function GetItemHSN($ID) : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";
        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);

        $itemInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.items WHERE Item_ID='$ID' ");

        $itemInfo = mysqli_fetch_array($itemInfoQuery);
        return $itemInfo['Item_HSN'];
    }

    function GetItemName($ID) : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";
        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);

        $itemInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.items WHERE Item_ID='$ID' ");

        $itemInfo = mysqli_fetch_array($itemInfoQuery);
        return $itemInfo['Item_Name'];
    }
    function GetItemShortDes($ID) : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";

        $itemInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.items WHERE Item_ID='$ID' ");
        $itemInfo = mysqli_fetch_array($itemInfoQuery);
        return $itemInfo['Item_Details_Small'];
    }
    function GetItemStock($ID) : int
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";

        $itemInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.items WHERE Item_ID='$ID' ");
        $itemInfo = mysqli_fetch_array($itemInfoQuery);
        return $itemInfo['Item_Stock'];
    }


    function GetItemImage($ID) : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";

        $itemInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.items WHERE Item_ID='$ID' ");
        $itemInfo = mysqli_fetch_array($itemInfoQuery);
        return $itemInfo['Item_Image'];
    }
    function GetItemCat($ID) : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";

        $itemInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.items WHERE Item_ID='$ID' ");
        $itemInfo = mysqli_fetch_array($itemInfoQuery);
        return $itemInfo['Item_Catagory'];
    }
    function GetItemPer($ID) : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";

        $itemInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.items WHERE Item_ID='$ID' ");
        $itemInfo = mysqli_fetch_array($itemInfoQuery);
        return $itemInfo['Item_Period'];
    }
    function GetItemRate($ID) : string
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";

        $itemInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.items WHERE Item_ID='$ID' ");
        $itemInfo = mysqli_fetch_array($itemInfoQuery);
        return $itemInfo['Item_Current_Rate'];
    }
    function GetItemTax($ID) : int
    {
        if(!$_SESSION["Userid"])
        {
            header("Location:UserCredentials/UserLogin.php");
        }
        include "UserDataBase/UserDB.php";

        $itemInfoQuery = mysqli_query($connection, "SELECT * FROM digitalmarketing.items WHERE Item_ID='$ID' ");
        $itemInfo = mysqli_fetch_array($itemInfoQuery);
        return $itemInfo['Item_Tax'];
    }
    function convert_number_to_words($number,$type=0)
    {

        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $decimal_part = $decimal;
        $hundred = null;
        $hundreds = null;
        $digits_length = strlen($no);
        $decimal_length = strlen($decimal);
        $i = 0;
        $str = array();
        $str2 = array();
        $words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');

        while( $i < $digits_length )
        {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }

        $d = 0;
        while( $d < $decimal_length ) {
            $divider = ($d == 2) ? 10 : 100;
            $decimal_number = floor($decimal % $divider);
            $decimal = floor($decimal / $divider);
            $d += $divider == 10 ? 1 : 2;
            if ($decimal_number) {
                $plurals = (($counter = count($str2)) && $decimal_number > 9) ? 's' : null;
                $hundreds = ($counter == 1 && $str2[0]) ? ' and ' : null;
                @$str2 [] = ($decimal_number < 21) ? $words[$decimal_number].' '. $digits[$decimal_number]. $plural.' '.$hundred:$words[floor($decimal_number / 10) * 10].' '.$words[$decimal_number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str2[] = null;
        }

        $Rupees = implode('', array_reverse($str));
        $paise = implode('', array_reverse($str2));
        $paise = ($decimal_part > 0) ? $paise . ' Paise' : '';
        if($type==0) {
            return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . " Only.";
        }
        else {
            return ($Rupees ? $Rupees . 'PixCoins ' : '') . $paise . " Only.";
        }

    }

    function GetFormattedInvoice($InvoiceID) : string
    {
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";
        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        $query = mysqli_query($connection,"SELECT * FROM invoice_log WHERE Invoice_ID = '$InvoiceID'");
        $row = mysqli_fetch_array($query);
        $formated="PIX 020521 113 223";
        $formated="PIX_".date('dmy',strtotime($row['Invoice_Timestamp']))."_".$row['User_ID']."_".$InvoiceID;
        return $formated;
    }
    function GetInvoiceDate($InvoiceID) : string
    {
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";
        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        $query = mysqli_query($connection,"SELECT * FROM invoice_log WHERE Invoice_ID = '$InvoiceID'");
        $row = mysqli_fetch_array($query);
        return date('D ,j-F-Y',strtotime($row['Invoice_Timestamp']));
    }
    function GetInvoiceTime($InvoiceID) : string
    {
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";
        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        $query = mysqli_query($connection,"SELECT * FROM invoice_log WHERE Invoice_ID = '$InvoiceID'");
        $row = mysqli_fetch_array($query);
        return date('h:i:s A',strtotime($row['Invoice_Timestamp']));
    }

    function GetInvoiceSubTotal($InvoiceID) : int
    {
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";
        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        $query = mysqli_query($connection,"SELECT * FROM purchase_log WHERE Invoice_ID = '$InvoiceID'");
        $check_items= mysqli_num_rows($query)>0;
        $total=0;
        $tax=0;

        if($check_items) {
            while ($row = mysqli_fetch_array($query)) {

                $item=0;
                $total=$total+($row['Purchase_Rate']*$row['Purchase_Qty']);
                $tax=$tax+(($row['Purchase_Rate']*$row['Purchase_Qty']))*($row['purchase_taxrate']/100);

            }
        }
        return ceil($total);
    }
    function GetInvoiceTaxTotal($InvoiceID) : int
    {
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";
        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        $query = mysqli_query($connection,"SELECT * FROM purchase_log WHERE Invoice_ID = '$InvoiceID'");
        $check_items= mysqli_num_rows($query)>0;
        $total=0;
        $tax=0;

        if($check_items) {
            while ($row = mysqli_fetch_array($query)) {

                $item=0;
                $total=$total+($row['Purchase_Rate']*$row['Purchase_Qty']);
                $tax=$tax+(($row['Purchase_Rate']*$row['Purchase_Qty']))*($row['purchase_taxrate']/100);

            }
        }
        return ceil($tax);
    }
    function GetInvoiceTotal($InvoiceID) : int
    {
        $total=GetInvoiceTaxTotal($InvoiceID)+GetInvoiceSubTotal($InvoiceID);
        return ceil($total);
    }


    function PutMoneyInAccount($purchase) : void
    {
        $newbalnce=GetUserBalance()+$purchase;
        $userID=$_SESSION["Userid"];
        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";
        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        UpdatePixLog($purchase,$userID,GetUserBalance(),1,date("Y-m-d H:i:s"));
        $query = mysqli_query($connection,"UPDATE user_credentials SET User_PixBalance='$newbalnce' WHERE User_ID='$userID'");
    }
    function UpdatePixLog($purchase,$UserID,$oldbalnce,$flag,$timestamp) : void
    {


        $server_name= "localhost";
        $db_user="root";
        $db_password="";
        $db_name="digitalmarketing";
        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
        $dbconfig=mysqli_select_db($connection,$db_name);
        mysqli_query($connection,"INSERT INTO `pix_log`(`User_Id`, `Pix_Amount`, `Pix_crnt_blnc`,`Pix_flow`) VALUES ('$UserID','$purchase','$oldbalnce','$flag')");

    }


