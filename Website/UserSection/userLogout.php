<title>BumblePix | Logout</title>
<?php
    session_start();
    session_destroy();
    header("Location:UserCredentials/UserLogin.php");
