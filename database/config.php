<?php
//database configurations
define("DB_HOST","localhost:3307");
define("DB_UNAME","root");
define("DB_PASS","");
define("DB_DNAME","quiz");
$conn=mysqli_connect(DB_HOST,DB_UNAME,DB_PASS,DB_DNAME);

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
