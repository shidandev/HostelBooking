<?php
session_start();
include_once("./db.php");

$data = array();



$sql = "SELECT u.fname,b_id, CONCAT(br.name,' - ',l.name,' - ', h.name,' - ', r.name) name, DATE_FORMAT(b.sdate,'%d-%m-%Y') sdate,DATE_FORMAT(b.edate,'%d-%m-%Y') edate, b.status FROM booking b 
                JOIN room r ON (b.room_id = r.room_id) 
                JOIN house h ON (r.house_id = h.house_id) 
                JOIN LEVEL l ON (h.level_id = l.level_id) 
                JOIN block br ON (l.block_id = br.block_id)
                JOIN user u on (b.user_id = u.user_id) WHERE status = 'booking' ";
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
