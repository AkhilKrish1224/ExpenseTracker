<?php
        require_once "db.php";
        session_start();
        $mail=$_SESSION['email'];
        $name=$_SESSION['name'];
        $ti=$_POST["Title"];
        $am=$_POST["Amount"];
        $ca=$_POST["Category"];
        $dt=$_POST["Date"];
        if(mysqli_query($conn,"insert into exp values('$mail','$ti','$am','$ca','$dt');"))
        {
                echo "Success";
                header("refresh:2,url=expenseview.php");
        }
?>