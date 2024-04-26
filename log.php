<?php
session_start();
require_once "db.php";
    if (isset($_POST['submit1'])) {
        if (!empty($_POST['reg1']) && ($_POST['reg2']) && ($_POST['reg3']))
        {
            $us=$_POST['reg1'];
            $em=$_POST['reg2'];
            $pas=$_POST['reg3'];
            $upi=$_POST['reg4'];
            if(mysqli_query($conn,"insert into user values('$us','$em','$pas','$upi')"));
            {
                echo "Success";
                header("refresh:2,url=login.php");
            }
        }
    } 
    if (isset($_POST['submit2'])) {
        if (!empty($_POST['log1']) && ($_POST['log2']))
        {
                $ema=$_POST['log1'];
                $pass=$_POST['log2'];
                $logres=mysqli_query($conn,"select * from user where email='$ema'");
                if(mysqli_num_rows($logres) > 0)
                {
                    echo "Success";
                    session_start();
                    $_SESSION['email']=$_POST['log1'];
                    $us = mysqli_fetch_array($logres);
                    $_SESSION['name']=$us['username'];
                    //Storing the name of user in SESSION variable.
                    header("Location:LoginViewController.php");
                }
                else{
                    echo "Login Failed";
                    header("refresh:2,url=login.php");
                }
        }
    } 
?>