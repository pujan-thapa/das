<?php
function scheduleBooked($id,$userid,$database){
    if($userid == null){
        return false;
    }
    else{
    $query = $database->query("select count(*) as total from appointment where scheduleid = $id and pid = $userid")->fetch_assoc()['total'];
    if($query == 0)
        return false;
    else
     return true;
}
}
?>