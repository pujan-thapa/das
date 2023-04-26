<?php

    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        $database->query("UPDATE `appointment` SET `pay_status`=1 WHERE appointment.appoid = $id");
        //$sql= $database->query("delete from doctor where docemail='$email';");
        //print_r($email);
        header("location: appointment.php");
    }


?>