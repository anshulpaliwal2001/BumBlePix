<?php
$server_name= "localhost";
$db_user="root";
$db_password="";
$db_name="digitalmarketing";

$connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
$dbconfig=mysqli_select_db($connection,$db_name);

/* echo "BETA : ";

if($dbconfig)
{
    echo "Database Connected Successfully";
}
else
{
    echo "Database connection failed";
}
*/

