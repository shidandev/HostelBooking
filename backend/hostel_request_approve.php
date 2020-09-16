<?php
session_start();
include_once("./db.php");

$data = array();


if (isset($_REQUEST['b_id'])) {

    $b_id = $_REQUEST['b_id'];
    $type = $_REQUEST['type'];

    $sql = "update booking set status = '".$type."' where b_id= '".$b_id."'";
    $stmt = $db->prepare($sql);
    // $stmt->bind_param('ss', $b_id, $type);

    // var_dump($stmt);
    if ($stmt->execute()) {
        $data['status'] = "ko";
        
        if (mysqli_affected_rows($db) > 0) {
            

            $room_id = 0;
            $sql2 = "select room_id from booking where b_id= '" . $b_id . "'";
            $stmt2 = $db->prepare($sql2);
            if ($stmt2->execute()) {
                $res2 = $stmt2->get_result();
                if ($res2->num_rows > 0) {
                    while ($row2 = $res2->fetch_assoc()) {
                        $room_id = $row2['room_id'];
                    }
                    $sql3 = "update room set stat = '" . (($type == 'disapproved')? 'empty': $type) . "' where room_id = '" . $room_id . "'";
                    // echo $sql3;
                    $stmt3 = $db->prepare($sql3);
                    $stmt3->execute();
                    $data['status'] = "ok";
                }
            }
        }
    }
}




echo json_encode($data);
