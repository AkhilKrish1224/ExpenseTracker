<?php
session_start();
$mail=$_SESSION['email'];
$name=$_SESSION['name'];
require_once "db.php";
echo "Submit";
if (isset($_POST['submit'])) {
    echo "Submitted";
    $count=$_POST['name4'];
    $upi=$_POST['name5'];
    for($i=1;$i<=$count;$i++)
    {
        echo $i;
        if (!empty($_POST["name1".$i]) && ($_POST["name2".$i]) && ($_POST["name3".$i]))
        {
            $usr=$mail;
            $grp="Group1";
            $na=$_POST['name1'.$i];
            $em=$_POST['name2'.$i];
            $am=$_POST['name3'.$i];

            // UPI ID
            $upi_id = $upi;

            // Transaction details
            $amount = $am;
            $description = "Note";

            // Construct UPI URL with transaction details
            $upi_url = "upi://pay?pa=".$upi_id."&pn=Split&tid=&tr=remark&tn=".$description."&am=".$amount."&cu=INR";


            if(mysqli_query($conn,"insert into split values('$na','$em','$grp','$am','$upi_url')"));
            {
                echo "Success";
                header("refresh:2,url=splitting.php");
            }
        }
    }
} 
   
?>