<?php
session_start();
include_once("./db.php");

$data = array();


if (isset($_REQUEST['user_id'])) {

    $user_id = $_REQUEST['user_id'];

    $sql = "select  matric_no,fname,lname,address,email,phoneno, faculty from user where user_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $user_id);


    if ($stmt->execute()) {
        $res = $stmt->get_result();
        $data['status'] = "ko";
        if ($res->num_rows > 0) {
            $data['status'] = "ok";
            while ($row = $res->fetch_assoc()) {
                $data['data'] = $row;
            }
        }
    }
}




echo json_encode($data);