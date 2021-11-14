<?php
    include "UserDashHead.php";
    include "ExtraFiles/Shop_items.php";
    UserDashHead("Cart","");


?>
    <div class="uk-container">
        <ul class="uk-breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="UserDashboard.php" class="">Dashboard</a></li>
            <li><span href="#" class="">Cart</span></li>
        </ul>
    </div>
    <body>
    <div class="uk-container  uk-margin-remove-bottom" data-uk-height-viewport="offset-top: true">

                <?php
                    if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
                    {


                            GetCartItems();


                    }
                    else
                    {
                        Getemptycart();
                    }
                ?>

    </div>
<?php

    UserDashFoot();

    function GetCartItems() : void
    {
        ?>
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-responsive uk-table-hover uk-table-middle uk-table-divider">
                <thead>
                <tr>
                    <th class="uk-table-shrink uk-text-center">Check</th>
                    <th class="uk-table-shrink uk-text-center">Sr.</th>
                    <th class="uk-table-shrink uk-text-center">Image</th>
                    <th class=" uk-text-center ">Item Name</th>
                    <th class="uk-width-small uk-text-center">Catagory</th>
                    <th class="uk-width-small uk-text-center">Period</th>
                    <th class="uk-text-center uk-table-expand">Rate</th>
                    <th class="uk-text-center uk-table-shrink">Qty</th>
                    <th class=" uk-text-center ">IGST</th>
                    <th class="uk-table-expand uk-text-center">Amount</th>


                </tr>
                </thead>
                <tbody>
                <?php
                    $array = $_SESSION['cart'];
                    //print_r($array);
                    $vals = array_count_values($array);

//                    echo gettype($vals);
//                    echo gettype($array);
                    //echo 'No. of NON Duplicate Items: '.count($vals).'<br><br>';
                    //print_r($vals);
                    $subtotal=0;
                    $taxtotal=0;
                    $sr=0;
                    foreach ($vals as $key => $value)
                        {
                ?>

                    <tr>
                        <td class="uk-flex-middle"><input class="uk-checkbox" type="checkbox"></td>
                        <td class="uk-text uk-text-center"><?php echo ++$sr ?></td>
                        <td><img class="uk-preserve-width uk-border-rounded" src="<?php echo "ExtraFiles/Item_Pictures/".GetItemImage($key); ?>" width="70" alt=""></td>
                        <td class="uk-table-expand">
                            <ul uk-accordion="multiple: true">
                                <li class="">
                                    <a class="uk-accordion-title uk-text-bolder" href="#"><?php echo GetItemName($key); ?></a>
                                    <div class="uk-accordion-content">
                                        <p class="uk-text-justify"><?php echo GetItemShortDes($key); ?></p>
                                    </div>
                                </li>
                            </ul>
                        </td>
                        <td class="uk-text uk-text-center"><?php echo GetItemCat($key) ?></td>
                        <td class="uk-text uk-text-center"><?php echo GetItemPer($key) ?></td>
                        <td class="uk-text uk-text-center uk-text-bold"><?php echo "&#8377 ".moneyFormatIndia(GetItemRate($key))  ?></td>
                        <td class="uk-text uk-text-center">
                            <form action=""  method="post">
                                <input type="hidden" name="Item_Id"  value="<?php echo $key?>">
                                <button class="uk-button uk-button-link" name="increment_to_cart"><span class="" uk-icon="icon: plus-circle"></button>
                            </form>

                            <?php echo $value ?>
                            <form action=""  method="post">
                                <input type="hidden" name="Item_Id"  value="<?php echo $key?>">
                                <button class="uk-button uk-button-link" name="decrement_to_cart"><span class="" uk-icon="icon: minus-circle"></button>
                            </form>

                        <td class="uk-text uk-text-center"><?php echo GetItemTax($key)." %" ?></td>
                        <?php
                            $subtotal=+$subtotal+(GetItemRate($key)*$value);
                            $taxtotal=round($taxtotal+(GetItemRate($key)*$value)*(GetItemTax($key)/100));
                        ?>
                        <td class="uk-text uk-text-right@l">
                            <dt class= "uk-text-bold"><?php echo "&#8377 ".moneyFormatIndia(GetItemRate($key)*$value)  ?> </dt>
                            <dd class="uk-text-meta .uk-text-small"><?php echo "&#8377 ".moneyFormatIndia(round(GetItemRate($key)*$value*(GetItemTax($key)/100)))  ?></dd>
                        </td>


                    </tr>
                <?php
                        }
                ?>
                <tr>
                    <td colspan="5" class="uk-text-bold uk-text-center">Total Items in cart : <?php echo count($vals); ?> </td>
                    <td colspan="3" class="uk-text-bold uk-text-right uk-text-large">Sub Total :</td>
                    <td colspan="2" class="uk-text-bold uk-text-right uk-text-large uk-text-secondary"><?php echo "&#8377 ".moneyFormatIndia($subtotal); ?> </td>

                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="4" class="uk-text-bold uk-text-center">
                        <?php
                            if(isset($_SESSION['StockError']))
                            {
                                if($_SESSION['StockError']!=-1)
                                {
                                    ?>
                                    <div class="uk-alert-danger" uk-alert>
                                        <a class="uk-alert-close" uk-close></a>
                                        <p>
                                        <?php
                                            {
                                                $array=array_unique($_SESSION['StockError']);

                                                foreach ($array as $key => $value)
                                                {
                                                    echo ($key+1).". ".GetItemName($value)." [in Stock = ".GetItemStock($value)."]";
                                                    if (count($array) != $key+1)
                                                        echo ", ";
                                                }
                                            }
                                            if(count($array)>1)
                                                echo " are out of stock! ";
                                            else
                                                echo " is out of stock! ";

                                        ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                                unset($_SESSION['StockError']);
                            }
                        ?>
                    </td>
                    <td colspan="2" class="uk-text-bold uk-text-right uk-text">+ Tax (IGST) :</td>
                    <td colspan="2" class="uk-text-bold uk-text-right uk-text"><?php echo "&#8377 ".moneyFormatIndia($taxtotal); ?> </td>

                </tr>
                <?php $finalamount=ceil(($subtotal+$taxtotal) / 10) * 10;
                        $_SESSION['finalAmount']=$finalamount;
                    if($finalamount/10>GetUserBalance())
                    {
                        $_SESSION['ShortOn']=$finalamount/10-GetUserBalance();
                    }
                    ?>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="3" class="uk-text-bold uk-text-left">
                        <dt class= "uk-text-bold uk-text-primary">
                            In words
                        </dt>
                        <dd class="uk-text-meta .uk-text-small">
                            <?php echo convert_number_to_words(ceil(($subtotal+$taxtotal) / 10) * 10) ?>
                        </dd>
                        <dt class= "uk-text-bold uk-text-primary uk-text-center">
                           Or
                        </dt>
                        <dd class="uk-text-meta .uk-text-small">
                            <?php echo convert_number_to_words((ceil(($subtotal+$taxtotal) / 10) * 10)/10,1) ?>
                        </dd>

                    </td>
                    <td colspan="2" class="uk-text-bold uk-text-right uk-text-large">Grand Total :</td>
                    <td colspan="2" class="uk-text-bold uk-text-right uk-text-large">

                        <dt class= "uk-text-bold uk-text-primary"><?php  echo "&#8377 ".moneyFormatIndia($finalamount); ?> </dt>
                        <?php
                            $roundoff=(ceil(($subtotal+$taxtotal) / 10) * 10)-($subtotal+$taxtotal);
                            if($roundoff>0) //+
                                $sign="+";
                            else if ($roundoff<0) //-
                                $sign="-";
                            else
                                $sign="";
                        ?>
                        <dd class="uk-text-meta .uk-text-small"><?php echo "or &#8473; ".moneyFormatIndia($finalamount/10);  ?></dd>
                        <dd class="uk-text-meta .uk-text-small"><?php echo "Rounded off ".$sign." &#8377 ".moneyFormatIndia($roundoff)  ?></dd>

                    </td>

                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3" class="uk-text-bold uk-text">
                        <?php
                            if($finalamount/10>GetUserBalance())
                            {

                                echo "You are short on <span class='uk-text-danger'> &#8473; ".moneyFormatIndia($_SESSION['ShortOn'])."</span> Pixa Coins. <span class='uk-text-success'> Buy</span> Now!";
                            }
                        ?>

                    </td>
                    <td colspan="5">
                        <div class="uk-button-group uk-align-right">
                            <form method="post" name="pay" action="" >
                                <a class="uk-button uk-button-primary uk-button-large" href="UserShop.php">Shop More</a>
                                <a class="uk-button uk-button-secondary uk-button-large" href="UserPixPurchase.php">Buy Pix</a>


                                <button class="uk-button uk-button-success uk-button-large uk-text-bold" name="checkoutButton"  <?php if((($subtotal+$taxtotal)/10)>GetUserBalance()) {echo "disabled";} ?> ><?php echo "Pay &#8473; ".moneyFormatIndia($finalamount/10);  ?></button>
                            </form>

                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <?php
    }
    function Getemptycart() : void
    {
        ?>
        <div class="uk-flex uk-flex-middle" data-uk-height-viewport="offset-top: true">
            <div class="uk-width-1-1">
                <div class="uk-section">
                    <div class="uk-container">
                        <div class="uk-grid-large" data-uk-grid>
                            <div class="uk-width-1-2@m"
                                 data-uk-scrollspy="cls: uk-animation-slide-left-small; repeat: true; delay: 200">
                                <img src="UserMainImages/emptyCart.svg" alt="Header" width="500" height="1000">
                            </div>
                            <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                                 data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                                <div>
                                    <h1 class="uk-heading-medium uk-margin-remove-top uk-letter-spacing-xl">Err!</h1>
                                    <span class="uk-text-lead ">
                                        No items found in <span class="uk-margin-small-left" uk-icon="icon: cart">
                                    </span> <br>
                                    <span class="uk-text-bolder ">
                                         <a href="UserShop.php">Shop</a> Now!
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

