<title>BumblePix | Logout</title>
<?php
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["u_name"]);

    header("Location:Login.php");
