<?php
session_start();
$mail=$_SESSION['email'];
$name=$_SESSION['name'];
require_once "db.php";
$con = mysqli_connect("localhost","root","","my_db");
$query = "SELECT sum(amount) as amt,category FROM `exp` where email='$mail' group by category";
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run) != 0)
{   
    $count=0;
    foreach($query_run as $items)
    {
        if($count==0){
            echo $items['category'];
        }
        else{
            echo ",",$items['category'];
        }
        $count++;
    }
    echo " ";
    $count=0;
    foreach($query_run as $items)
    {
        if($count==0){
            echo $items['amt'];
        }
        else{
            echo ",",$items['amt'];
        }
        $count++;
        //echo $items['year'];
    }
}
?>