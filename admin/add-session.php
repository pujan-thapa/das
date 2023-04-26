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
    
    
    if($_POST){
        //import database
        include("../connection.php");
        $title=$_POST["title"];
        $docid=$_POST["docid"];
        $nop=$_POST["nop"];
        $date=$_POST["date"];
        $time=$_POST["time"];
        $fee = $_POST["fee"];
        $hospital_id = $_POST["hospital_id"];
        $sql="insert into schedule (docid,title,scheduledate,scheduletime,nop,fee,hospital_id) values ($docid,'$title','$date','$time',$nop,$fee,$hospital_id);";
        $result= $database->query($sql);
        header("location: schedule.php?action=session-added&title=$title");
        
    }


?>