<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$url = $_SERVER['REQUEST_URI'];
$header = '<div class="header-top" style="margin-bottom:10px">
<div class="header-logo">
<font class="edoc-logo">
<a href="/edoc">Doctor Booking. </font>
                    <font class="edoc-logo-sub">| DOCTOR APPOINTMENT PROJECT</font></a>
</div>
<div class="header-links">';
$t = 0;
if ((isset($_SESSION["user"]) && $_SESSION["user"] !== "") &&  (isset($_SESSION["user"]) == 'a'  || isset($_SESSION["user"]) == 'p'  || isset($_SESSION["user"]) == 'd')) {
    if ($_SESSION['usertype'] == 'a') {
        $header .= '<a href="/edoc/admin/index.php" class="non-style-link">
            <p class="nav-item">Dashboard</p>
        </a>';
        $t++;
    }
    else if ($_SESSION['usertype'] == 'p') {
        $header .= '<a href="/edoc/patient/index.php" class="non-style-link">
            <p class="nav-item">Dashboard</p>
        </a>';
        $t++;
    }
    else if ($_SESSION['usertype'] == 'd') {
        $header .= '<a href="/edoc/doctor/index.php" class="non-style-link">
            <p class="nav-item">Dashboard</p>
        </a>';
        $t++;
    }
    if($t > 0){
        include_once('connection.php');
        $useremail=$_SESSION["user"];
        if(isset($useremail)){
            $userrow = $database->query("select * from patient where pemail='$useremail'");
            $userfetch=$userrow->fetch_assoc();
            if(isset($userfetch["pid"])){
                $userid= $userfetch["pid"];
                $username=$userfetch["pname"];
            }
        }
    }

} else {
    if (strpos($url,"signup.php") !== false) {
        $header .= '<a href="/edoc/login.php" class="non-style-link">
            <p class="nav-item">LOGIN</p>
        </a>';
    }
    else if (strpos($url,"edoc/login.php") !== false) {
        $header .= '<a href="signup.php" class="non-style-link">
            <p class="nav-item" style="padding-right: 10px;">REGISTER</p>
        </a>';
    }
    else{
            $header .= '<a href="/edoc/login.php" class="non-style-link">
                <p class="nav-item">LOGIN</p>
            </a><a href="../signup.php" class="non-style-link">
            <p class="nav-item" style="padding-right: 10px;">REGISTER</p>
        </a>';
    }
    $userid = null;
}
if($t > 0){
    $header .= '<a href="/edoc/logout.php" class="non-style-link">
    <p class="nav-item" style="padding-right: 10px;">Logout</p>
</a>';
}
$header .= '</div></div>';
echo($header);
?>

<style>
    .header-top {
    background: #0A76D8;
    color: white;
    display: flex;
    justify-content: space-between;
    vertical-align: middle;
    align-items: center;
    padding: 0.5em 3rem;
}

.header-top a {
    color: white !important;
    text-decoration: none;
}
.header-links {
    display: flex;
    justify-content: space-between;
    gap: 2em;
}
</style>
