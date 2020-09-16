<?php
session_start();
include_once("./db.php");

$data = array();



$sql = "SELECT COUNT(1) count FROM booking WHERE user_id = '".$_REQUEST['user_id']."'";
$stmt = $db->prepare($sql);



if ($stmt->execute()) {
    $res = $stmt->get_result();
    $data['status'] = "ko";
    if ($res->num_rows > 0) {
        $data['status'] = "ok";
        while ($row = $res->fetch_assoc()) {
            $data['data'][] = $row;
        }
    }
}



echo json_encode($data);