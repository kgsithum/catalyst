<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("user.php");

$user_obj = new User();
$str = $user_obj->test();
print_r($str);



?>
