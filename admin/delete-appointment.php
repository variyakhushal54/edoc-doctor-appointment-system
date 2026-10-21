<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php"); exit;
        }

    }else{
        header("location: ../login.php"); exit;
    }
    
    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        //$result001= $database->query("select * from schedule where scheduleid={$database->int($id)};");
        //$email=($result001->fetch_assoc())["docemail"];
        $sql= $database->query("delete from appointment where appoid='{$database->esc($id)}';");
        //$sql= $database->query("delete from doctor where docemail='{$database->esc($email)}';");
        header("location: appointment.php"); exit;
    }


?>