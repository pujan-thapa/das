<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Doctor Booking</title>
    <style>
        table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>

</head>

<body>
<?php 
include_once('header.php');
?>
    <div class="full-height">
        <center>
            <table border="0">
                <tr>
                    <td colspan="3">
                        <p class="heading-text">Avoid Hassles & Delays.</p>

                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p class="sub-text2">How is health today, Sounds like not good!<br>Don't worry. Find your doctor online Book as you wish with eDoc. <br> We offer you a free doctor channeling service, Make your appointment now.</p>
                    </td>
                </tr>
                <tr>

                    <td colspan="3">
                        <center>
                            <a href="login.php">
                                <input type="button" value="Make Appointment" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                            </a>
                        </center>
                    </td>

                </tr>
                <tr>
                    <td colspan="3">

                    </td>
                </tr>
            </table>
            <!--<p class="sub-text2 footer-hashen">Find .</p> -->
            <?php
include "connection.php";
date_default_timezone_set('Asia/kathmandu');
$today = date('Y-m-d');
$sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today'  order by schedule.scheduledate asc";
$result = $database->query($sqlmain);
?>
<div class="available-sessions" style="background:aliceblue;margin-top:10em;">
<h2 style="
    padding: 2em 0 0 0;
    margin: 10px 0 0 0;
    color: darkblue;
"">Available Sessions</h2>

<table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
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
    include_once('./patient/booked.php');
    if(!isset($userid))
        $userid = null;
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
            $hospital_id = $row["hospital_id"];
            $hospital_name = $database->query("SELECT * FROM `hospital` as h where h.id='$hospital_id';")->fetch_assoc()['name'];
            $recommendation = '0';

            if($booked)
            $link = '<a href="/edoc/patient/appointment.php" ><button  class="login-btn btn-secondary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Booked</font></button></a>';
            else
            $link = '<a href="/edoc/patient/booking.php?id=' . $scheduleid . '&recommendation=' . $recommendation . '" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Book Now</font></button></a>';

            if ($scheduleid == "") {
                break;
            }

            echo '
                <td style="width: 25%;">
                        <div  class="dashboard-items search-items" style="
                        background: aliceblue;
                    ">

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
                                    ' . $link . '
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
        <?php 
include_once('footer.php');
?>
    </div>

</body>

</html>