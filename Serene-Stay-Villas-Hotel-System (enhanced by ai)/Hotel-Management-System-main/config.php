<?php

$server = "127.0.0.1";
$username = "serenehotelai_user";
$password = "password123";
$database = "serenehotelai";

$conn = mysqli_connect($server,$username,$password,$database);

if(!$conn){
    die("<script>alert('connection Failed.')</script>");
}
?>