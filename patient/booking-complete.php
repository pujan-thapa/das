<?php

    //learn from w3schools.com

    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];


    if($_POST){
        if(isset($_POST["booknow"])){
            $apponum=$_POST["apponum"];
            $scheduleid=$_POST["scheduleid"];
            $date=$_POST["date"];
            include('booked.php');
            $dup =  scheduleBooked($scheduleid,$userid,$database);
            if(!$dup){
                $recommendation=$_POST["recommendation"];
                print_r($recommendation);
                $sql2="insert into appointment(pid,apponum,scheduleid,appodate,recommendation) values ($userid,$apponum,$scheduleid,'$date',$recommendation)";
                $result= $database->query($sql2);
                //echo $apponom;
            }
            
                header("location: appointment.php?action=booking-added&id=".$apponum."&titleget=none");
 

        }
    }
 ?>