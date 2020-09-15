<?php
session_start();
include_once("./db.php");

$data = array();


if (isset($_REQUEST['house_id'])) {

    $house_id = $_REQUEST['house_id'];

    $sql = "select * from room where house_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $house_id);


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
}




echo json_encode($data);