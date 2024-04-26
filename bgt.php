<?php
        require_once "db.php";
        session_start();
        $mail=$_SESSION['email'];
        $name=$_SESSION['name'];
        $ti=$_POST["Title"];
        $am=$_POST["Amount"];
        $ca=$_POST["Category"];
        if(mysqli_query($conn,"insert into bgt values('$mail','$ti','$am','$ca');"))
        {
                echo "Success";
                header("refresh:2,url=budgetview.php");
        }
?>