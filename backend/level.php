<?php
session_start();
include_once("./db.php");

$data = array();


if (isset($_REQUEST['block_id'])) {

    $block_id = $_REQUEST['block_id'];

    $sql = "select * from level where block_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $block_id);


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
