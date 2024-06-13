<?php 

$servername="localhost";
$username="root";
$password="";
$dbname="crud";

$connect=mysqli_connect($servername,$username,$password,$dbname);

if(!$connect){
    die("Connection failed");
}


if(!mysqli_select_db($connect,$dbname)){
    die("couldn't open the".$dbname."database");
}
