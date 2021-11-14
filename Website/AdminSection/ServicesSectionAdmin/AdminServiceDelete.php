<?php

    include '../Database/dbconfig.php';


    $query="DELETE FROM `services` WHERE `services`.`service_id` = '".$_GET["id"]."'";
    $data=mysqli_query($connection,$query);
    if($data)
    {
        ?>

        <script type="text/javascript">
            window.location.href = 'AdminServices.php';
        </script>
        <?php

    }
    else
        echo "Error deleting record: " . mysqli_error($connection);

?>


<?php
