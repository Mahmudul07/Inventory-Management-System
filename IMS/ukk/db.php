<?php
$sname = "localhost";
$uname = "root";
$password = "";
$dbname = "stock";

$con = mysqli_connect($sname, $uname, $password, $dbname);
if(!$con){
    echo ("Don't connect database: " . mysqli_connect_error());
}
else{
  //   echo "The database are connected.";
}
?>