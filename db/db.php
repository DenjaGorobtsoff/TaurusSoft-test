<?php
$localhost = 'localhost';
$root = 'root';
$password = '123';
$db_name = 'user_test';

$connect = new mysqli($localhost, $root, $password, $db_name);


if($connect->connect_errno) {
    die("Connection failed: " . $connect->connect_error);
}


//$connect = mysqli_connect($localhost, $root, $password, $d_b );
//if($connect == false){
//    echo 'Not connection';

