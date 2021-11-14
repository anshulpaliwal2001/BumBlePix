<?php

    include '../Database/dbconfig.php';


    $query="DELETE FROM `project` WHERE `project`.`id` = '".$_GET["id"]."'";
    $data=mysqli_query($connection,$query);
    if($data)
    {
        ?>

        <script type="text/javascript">
             window.location.href = 'AdminProject.php';
            </script>
        <?php

    }
    else
        echo "Error deleting record: " . mysqli_error($connection);

?>


