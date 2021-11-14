<?php


    function CheckName($name): int
    {
        /*
            1 : name > then 14 digits or < 5
            2 : No special characters
         */
        $length = strlen($name);
        if ($length > 14 || $length < 2)
            return 1;
        if (preg_match('/[\'^£$%&*()}{@#~?><,|=_+¬-]/', $name)) {
            return 2;
        }
        return 0;
    }

    function CheckMail($mail): int
    {
        $server_name = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "digitalmarketing";
        $connection = mysqli_connect($server_name, $db_user, $db_password, $db_name);
        $dbconfig = mysqli_select_db($connection, $db_name);
        $result = mysqli_query($connection, "SELECT count(*) as total from user_info where user_info.Info_mail='$mail'");
        $data = mysqli_fetch_assoc($result);
        $count = $data['total'];
        if ($count > 0) {
            return 1;
        }

        return 0;
    }

    function CheckUserName($username): int
    {
        if (preg_match('/[\'^£$%&*()}{@#~?><,|=_+¬-]/', $username)) {
            return 2;
        }
        $server_name = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "digitalmarketing";
        $connection = mysqli_connect($server_name, $db_user, $db_password, $db_name);
        $dbconfig = mysqli_select_db($connection, $db_name);
        $result = mysqli_query($connection, "SELECT count(*) as total from user_credentials where User_Name='$username'");
        $data = mysqli_fetch_assoc($result);
        $count = $data['total'];
        if ($count > 0) {
            return 1;
        }

        return 0;

    }

    function CheckPassword($createPass, $confirmPass): string
    {
        $result = "";
        for ($i = 0; $i < 6; $i++) {
            $result[$i] = '0';
        }


        if (strcmp($createPass, $confirmPass)) {
            $result[0] = '1';
        }
        if (strlen($createPass) < 8) {
            $result[1] = '1';
        }
        if (strlen($createPass) > 16) {
            $result[2] = '1';
        }
        if (!preg_match("#[0-9]+#", $createPass)) {
            $result[3] = '1';
        }
        if (!preg_match("#[A-Z]+#", $createPass)) {
            $result[4] = '1';
        }
        if (!preg_match("#[a-z]+#", $createPass)) {
            $result[5] = '1';
        }


        return $result;
    }

    function GetImageName($oldName): string
    {
        $extention = pathinfo($oldName, PATHINFO_EXTENSION);
        $randomno = rand(0, 100000);
        $rename = 'avatar' . '_' . date('dmY') . '_' . date('His') . '_' . $randomno;
        $newname = $rename . '.' . $extention;
        return $newname;
    }