<?php
session_start();
$mail=$_SESSION['email'];
$name=$_SESSION['name'];
require_once "db.php";
echo "Submit";
if (isset($_POST['submit'])) {
    echo "Submitted";
    $upi=$_POST['name4'];
        if (!empty($_POST["name1"]) && ($_POST["name2"]) && ($_POST["name3"]))
        {
            $usr=$mail;
            $na=$mail;
            $em=$_POST['name2'];
            $am=$_POST['name3'];

            // UPI ID
            $upi_id = $upi;

            // Transaction details
            $amount = $am;
            $description = "Note";

            // Construct UPI URL with transaction details
            $upi_url = "upi://pay?pa=".$upi_id."&pn=Request&tid=&tr=remark&tn=".$description."&am=".$amount."&cu=INR";


            if(mysqli_query($conn,"insert into lend values('$na','$em','$am','$upi_url')"));
            {
                echo "Success";
                header("refresh:2,url=lend.php");
            }
        }
} 
   
?>