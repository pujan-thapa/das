<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Sessions</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com
    
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }

 
    //import database
    include("../connection.php");
    include_once('../header.php');
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];


    //echo $userid;
    //echo $username;
    
    date_default_timezone_set('Asia/kathmandu');

    $today = date('Y-m-d');


    //echo $userid;
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">
                                        <?php echo substr($username, 0, 13) ?>..
                                    </p>
                                    <p class="profile-subtitle">
                                        <?php echo substr($useremail, 0, 22) ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out"
                                            class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home ">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Home</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor">
                <a href="doctors.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">All Doctors</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
            <a href="schedule.php" class="non-style-link-menu non-style-link-menu-active">
                <div>
                    <p class="menu-text">Scheduled Sessions</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Bookings</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <?php
    $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today'  order by schedule.scheduledate asc";
    $sqlpt1 = "";
    $insertkey = "";
    $q = '';
    $searchtype = "All";
    $recommendation = '0';
    if($_POST){
        if(!empty($_POST['recommendation'])){
            $symptoms_arr = $_POST['symptoms'];
            if(isset($symptoms_arr) && !empty($symptoms_arr) ){
                $user_query = "select  * from  patient AS p  where p.pemail='$useremail'";
                $r = $database->query($user_query);
                $user = $r->fetch_assoc();
                $uid = $user['pid'];
                $symptoms = implode(',',$symptoms_arr);
                $query = "INSERT INTO `user_symptoms`(`pid`, `sid`) VALUES ('$uid','$symptoms')";
                $database->query($query);
                $a = [];
                $r = "select did,count(sid) scount from disease_symptom as ds where ds.sid in ($symptoms) group by ds.did order by scount desc limit 1";
                $d = $database->query($r);
                $res = $d->fetch_assoc();
                $disease_id = $res['did'];
                $query = "Select * from disease_specialties as ds where ds.did=$disease_id";
                $d = $database->query($query);
                $res = $d->fetch_assoc();
                $sid = $res['sid'];
                $query = "Select docid from doctor as d where d.specialties = $sid";
                $d = $database->query($query);
                $res = $d->fetch_all();
                $dids = [];
                if(!empty($res)){
                    foreach($res as $r){
                        array_push($dids,$r[0]);
                    }
                }
                if(isset($dids) && !empty($dids)){
                    $doctor_ids = implode(',',$dids);
                    $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today' and schedule.docid in ($doctor_ids) order by schedule.scheduledate asc";
                    $searchtype = "Recommendation Result : ";
                    $recommendation = '1';


                }

            }
        }
        elseif (!empty($_POST["search"])) {
            $keyword = $_POST["search"];
            $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today' and (doctor.docname='$keyword' or doctor.docname like '$keyword%' or doctor.docname like '%$keyword' or doctor.docname like '%$keyword%' or schedule.title='$keyword' or schedule.title like '$keyword%' or schedule.title like '%$keyword' or schedule.title like '%$keyword%' or schedule.scheduledate like '$keyword%' or schedule.scheduledate like '%$keyword' or schedule.scheduledate like '%$keyword%' or schedule.scheduledate='$keyword' )  order by schedule.scheduledate asc";
            //echo $sqlmain;
            $insertkey = $keyword;
            $searchtype = "Search Result : ";
            $q = '"';
        }
    }
    $result = $database->query($sqlmain);
    ?>

    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="schedule.php"><button class="login-btn btn-primary-soft btn btn-icon-back"
                            style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <form action="" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar"
                            placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors"
                            value="<?php echo $insertkey ?>">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="doctors">';
                        $list11 = $database->query("select DISTINCT * from  doctor;");
                        $list12 = $database->query("select DISTINCT * from  schedule GROUP BY title;");





                        for ($y = 0; $y < $list11->num_rows; $y++) {
                            $row00 = $list11->fetch_assoc();
                            $d = $row00["docname"];

                            echo "<option value='$d'><br/>";
                        }
                        ;


                        for ($y = 0; $y < $list12->num_rows; $y++) {
                            $row00 = $list12->fetch_assoc();
                            $d = $row00["title"];

                            echo "<option value='$d'><br/>";
                        }
                        ;

                        echo ' </datalist>';
                        ?>


                        <input type="Submit" value="Search" class="login-btn btn-primary btn"
                            style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                    </form>
                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php


                        echo $today;



                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img
                            src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>

            <tr>
                <td colspan="4"
                    style=" text-align: center; max-width: 100%; margin: 0 auto;padding-top: 10px;width: 100%;">
                    <a href="?action=recommendation&id=<?php echo $userid ?>"
                        class=" login-btn btn-primary btn">Recommendation by Symptoms</a>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">
                        <?php echo $searchtype . " Sessions" . "(" . $result->num_rows . ")"; ?>
                    </p>
                    <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)">
                        <?php echo $q . $insertkey . $q; ?>
                    </p>
                </td>

            </tr>



            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="100%" class="sub-table scrolldown" border="0"
                                style="padding: 50px;border:none">

                                <tbody>

                                    <?php




                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    } else {
                                        include_once('booked.php');
                                        //echo $result->num_rows;
                                        for ($x = 0; $x < ($result->num_rows); $x++) {
                                            echo "<tr>";
                                            for ($q = 0; $q < 3; $q++) {
                                                $row = $result->fetch_assoc();
                                                if (!isset($row)) {
                                                    break;
                                                }
                                                ;
                                                $scheduleid = $row["scheduleid"];
                                                $title = $row["title"];
                                                $docname = $row["docname"];
                                                $scheduledate = $row["scheduledate"];
                                                $scheduletime = $row["scheduletime"];
                                                $booked = scheduleBooked($scheduleid,$userid,$database);
                                                $hospital_id=$row["hospital_id"];
                                                $hospital_name = $database->query("SELECT * FROM `hospital` as h where h.id='$hospital_id';")->fetch_assoc()['name'];
                                                
                                                if($booked)
                                                    $link = '<a href="appointment.php" ><button  class="login-btn btn-secondary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Booked</font></button></a>';
                                                else
                                                    $link = '<a href="booking.php?id=' . $scheduleid . '&recommendation='.$recommendation.'" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Book Now</font></button></a>';
                                                
                                                if ($scheduleid == "") {
                                                    break;
                                                }

                                                echo '
                                        <td style="width: 25%;">
                                                <div  class="dashboard-items search-items"  >
                                                
                                                    <div style="width:100%">
                                                            <div class="h1-search">
                                                                ' . substr($title, 0, 21) . '
                                                            </div><br>
                                                            <div class="h3-search">
                                                                ' . substr($docname, 0, 30) . '
                                                            </div>
                                                            <div class="h3-search">
                                                                ' . $hospital_name . '
                                                            </div>
                                                            <div class="h4-search">
                                                                ' . $scheduledate . '<br>Starts: <b>@' . substr($scheduletime, 0, 5) . '</b> (24h)
                                                            </div>
                                                            <br>
                                                            '.$link.'
                                                    </div>
                                                            
                                                </div>
                                            </td>';
                                            }
                                            echo "</tr>";                                    
                                        }
                                    }

                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </center>
                </td>
            </tr>



        </table>
    </div>
    </div>

    </div>
    <?php
    function getOptions($row)
    {
        // $a = ['<option value="">- Select - </option>'];
        $a = [];
        if (isset($row) && $row !== null) {
            foreach ($row as $r) {
                array_push($a, '<option value="' . $r[0] . '">' . $r[1] . '</option>');
            }
        }
        return implode('', $a);
    }
    if ($_GET) {

        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'recommendation') {
            $sqlmain = "select * from symptoms";
            $result = $database->query($sqlmain);
            $row = $result->fetch_all();
            $options = getOptions($row);
            echo '
                <div id="popup_recommendation" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                        <form method="POST" action="schedule.php">

                            <h2>Symptoms</h2>
                            <a class="close" href="schedule.php">&times;</a>
                            <div class="content">
                            <div class="form-group">
                                <select multiple class="symptoms_select" name="symptoms[]" id="symptoms" style="width:100%;" placeholder="Select Symptoms">
                                ' . $options . '
                                </select>           
                                </div>                     
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <input type="submit" class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;" value="OK" name="recommendation">
                           

                            </div>
                            <br><br>
                            </form>

                        </center>
                </div>
                </div>
    ';



        }
        ;
    }
    ?>
<?php 
include_once('../footer.php');
?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        (function ($) {
            $(".symptoms_select").each(function () {
                $(this).select2({
                    multiple: true,
                    width: 'style',
                    placeholder: $(this).attr('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        })(jQuery)
    </script>
</body>

</html>