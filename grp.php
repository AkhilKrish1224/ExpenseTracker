<?php
session_start();
$mail=$_SESSION['email'];
$name=$_SESSION['name'];
require_once "db.php";
if (isset($_POST['submit'])) {
    if (!empty($_POST['name1']) && ($_POST['name2']))
    {
        $usr=$mail;
        $grp="Group1";
        $na=$_POST['name1'];
        $em=$_POST['name2'];
        if(mysqli_query($conn,"insert into grp values('$grp','$na','$em')"))
        {
            echo "Success";
            header("refresh:2,url=splitview.php");
        }
        else
        {
            echo "User already member of the group";
            header("refresh:2,url=splitview.php");
        }
    }
} 
   
?>