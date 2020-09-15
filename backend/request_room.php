<?php
session_start();
include_once("./db.php");

$data = array();


if (isset($_REQUEST['user_id']) && isset($_REQUEST['room_id']) && isset($_REQUEST['sdate']) && isset($_REQUEST['edate']) ) {

    $user_id = $_REQUEST['user_id'];
    $room_id = $_REQUEST['room_id'];
    $sdate = $_REQUEST['sdate'];
    $edate = $_REQUEST['edate'];

    $sql = "insert into booking(user_id,room_id,sdate,edate,status) values (?,?,?,?,'booking')";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssss', $user_id, $room_id, $sdate, $edate);


    if ($stmt->execute()) {
        $data['status'] = "ko";
        if (mysqli_affected_rows($db) > 0) {
            $data['status'] = "ok";
            $sql2 = "update room set stat = 'booking' where room_id = '".$room_id."'";
            $stmt2 = $db->prepare($sql2);
            $stmt2->execute();
            
        }
    }
}




echo json_encode($data);