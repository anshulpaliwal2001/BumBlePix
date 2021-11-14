<?php
    function Items() : void
    {
        ?>
        <div class="uk-container uk-margin-medium-top uk-margin-remove-bottom" data-uk-height-viewport="offset-top: true">
            <div uk-filter="target: .js-filter">

                <div class="uk-grid-small uk-grid-divider uk-child-width-auto" uk-grid>
                    <div>
                        <ul class="uk-subnav uk-subnav-pill" uk-margin>
                            <li class="uk-active" uk-filter-control><a href="#">All</a></li>
                        </ul>
                    </div>
                    <div>
                        <ul class="uk-subnav uk-subnav-pill" uk-margin>
                            <li class="uk-text-bolder uk-margin-remove"><p>Catagory:</p></li>
                            <li uk-filter-control="[data-category='Branding']"><a href="#">Branding</a></li>
                            <li uk-filter-control="[data-category='Social Media']"><a href="#">Social Media</a></li>
                            <li uk-filter-control="[data-category='Marketing']"><a href="#">Marketing</a></li>
                            <li uk-filter-control="[data-category='Others']"><a href="#">Others</a></li>
                        </ul>
                    </div>

                    <div>
                        <ul class="uk-subnav uk-subnav-pill" uk-margin>
                            <li class="uk-text-bolder uk-margin-remove"><p>Period:</p></li>
                            <li uk-filter-control="[data-size='Quarterly']"><a href="#">Quarterly</a></li>
                            <li uk-filter-control="[data-size='Half Yearly']"><a href="#">Half Yearly</a></li>
                            <li uk-filter-control="[data-size='Yearly']"><a href="#">Yearly</a></li>
                            <li uk-filter-control="[data-size='One Time']"><a href="#">One Time</a></li>

                        </ul>
                    </div>

                </div>

                <ul class="js-filter uk-child-width-1-2 uk-child-width-1-3@m uk-text-center" uk-grid="masonry: true">
                    <?php
                        $server_name= "localhost";
                        $db_user="root";
                        $db_password="";
                        $db_name="digitalmarketing";

                        $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
                        $dbconfig=mysqli_select_db($connection,$db_name);
                        $query="SELECT * FROM items ";
                        $query_run=mysqli_query($connection,$query);
                        $check_items= mysqli_num_rows($query_run)>0;
                        if($check_items) {
                            while ($row = mysqli_fetch_array($query_run))
                            {
                                $item_id = $row['Item_ID'];
                                $item_Name = $row['Item_Name'];
                                $item_Image= $row['Item_Image'];
                                $item_Cat= $row['Item_Catagory'];
                                $item_Per=$row['Item_Period'];
                                $item_large_des=$row['Item_Description_large'];
                                $item_short_des=$row['Item_Details_Small'];
                                $item_tags=$row['Item_Tags'];
                                $item_old_price=$row['Item_Old_Rate'];
                                $item_current_price=$row['Item_Current_Rate'];
                                $item_stock=$row['Item_Stock'];



                    ?>

                    <li data-category="<?php echo $item_Cat; ?>" data-size="<?php echo $item_Per; ?>" >
                        <form action="" method="post">
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-media-top uk-inline">
                                <img src="<?php echo "ExtraFiles/Item_Pictures/".$item_Image; ?>" alt="">

                            </div>
                            <div class="uk-card-body uk-margin-remove-bottom">
                                <span class="uk-text-large uk-text-secondary uk-text-bolder "><?php echo $item_Name; ?></span>
                                <br>
                                <span class="uk-margin-remove-top uk-text-meta "><?php echo $item_Per." | ".$item_Cat; ?></span>
                                <p><?php echo $item_short_des; ?></p>
                                <?php ShowTags($item_tags,$item_Cat,$item_Per,$item_old_price,$item_current_price,$item_stock); ?>
                                <br> <br>
                                <?php
                                if(!$item_old_price==NULL)
                                {
                                    ?>
                                <span class="uk-text-meta uk-text-small ">Price <strike>&#8377  <?php echo moneyFormatIndia( $item_old_price); ?></strike></span>
                                <br>
                                    <?php
                                }
                                    ?>
                                <span class="uk-text-bolder uk-text-primary ">&#8377  <?php echo moneyFormatIndia($item_current_price)." only"; ?></span>
                            </div>
                            <div class="uk-card-footer">

                                <a class="uk-margin-medium-right" href="#<?php echo "Item_Modal_".$item_id ?>"uk-toggle><button class="uk-button uk-button-link" ><span class="" uk-icon="file-text"></button></a>

                                <?php
                                    if(!$item_stock==0)
                                    {
                                ?>

                                        <input type="hidden" name="Item_Id"  value="<?php echo $item_id?>">
                                        <button class="uk-button uk-button-link" name="add_to_cart"><span class="" uk-icon="icon: cart"></button>
                                        <?php
                                        if(isset($_SESSION['cart']))
                                            {
                                        if(in_array( $item_id,$_SESSION['cart']))
                                        ?>
                                        <span class="uk-label"><?php GetParticularCartItemNo($item_id); ?></span>
                                                </form>
                                        <?php
                                    }
                                    }
                                        ?>
                            </div>
                        </div>
                    </li>

                    <div id="<?php echo "Item_Modal_".$item_id ?>" class="uk-modal-full" uk-modal>
                        <div class="uk-modal-dialog">
                            <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                            <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                                <div class="uk-background-cover" style="background-image: url('<?php echo "ExtraFiles/Item_Pictures/".$item_Image; ?>');" uk-height-viewport></div>
                                <div class="uk-padding-large">
                                    <h1 class="uk-margin-remove-bottom"><?php echo $item_Name; ?></h1>
                                    <span class="uk-margin-remove-top uk-text-meta "><?php echo $item_Per." | ".$item_Cat; ?></span>
                                    <br> <br>
                                    <?php
                                        ShowTags($item_tags,$item_Cat,$item_Per,$item_old_price,$item_current_price,$item_stock);
                                    ?>
                                    <p class="uk-text-justify uk-dropcap"><?php echo $item_large_des; ?></p>
                                    <?php
                                        if(!$item_old_price==NULL)
                                        {
                                            ?>
                                            <span class="uk-text-meta uk-text-small ">Price <strike>&#8377 <?php echo moneyFormatIndia($item_old_price); ?></strike></span>
                                            <br>
                                            <?php
                                        }
                                    ?>
                                    <span class="uk-text-bolder uk-text-primary ">&#8377 <?php echo moneyFormatIndia($item_current_price)." only"; ?></span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }
    function ShowTags($tags,$item_Cat,$item_Per,$item_old_price,$item_current_price,$item_stock) : void
    {
        ?>
        <?php
        if($item_stock==0)
        {
            ?>
            <span class="uk-label uk-label-danger">Out of Stock</span>
            <?php
            return;
        }
        else
        {
        if(!$item_old_price==NULL)
        {
            ?>
            <span class="uk-label uk-label-danger">Discount</span>
            <?php
        }
        if (str_contains($tags, 'Premium'))
        {
            ?>
            <span class="uk-label uk-label-warning">Premium</span>
            <?php
        }
            if (str_contains($tags, 'New'))
            {
                ?>
                <span class="uk-label uk-label-new">New</span>
                <?php
            }
        if (str_contains($tags, 'Hot')) {
            ?>
            <span class="uk-label uk-label-danger">Hot</span>
            <?php
        }
            ?>
            <span class="uk-label uk-label-success"><?php echo $item_Cat; ?></span>
            <span class="uk-label uk-label-success"><?php echo $item_Per; ?></span>
            <?php
        }
        if($item_stock<50)
        {
            ?>
            <span class="uk-label uk-label-warning"><?php echo $item_stock." left"; ?></span>
            <?php
        }




    }




