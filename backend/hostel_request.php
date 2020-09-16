<?php
session_start();
include_once("./db.php");

$data = array();


if (isset($_REQUEST['user_id'])) {

    $user_id = $_REQUEST['user_id'];

    // $sql = "SELECT b_id, CONCAT(br.name,' - ',l.name,' - ', h.name,' - ', r.name) name, DATE_FORMAT(b.sdate,'%d-%m-%Y') sdate,DATE_FORMAT(b.edate,'%d-%m-%Y') edate, b.status FROM booking b 
    $sql = "SELECT b_id, br.name block,l.name level,h.name house, r.name room,r.password password, DATE_FORMAT(b.sdate,'%d-%m-%Y') sdate,DATE_FORMAT(b.edate,'%d-%m-%Y') edate, b.status FROM booking b 
    
                JOIN room r ON (b.room_id = r.room_id) 
                JOIN house h ON (r.house_id = h.house_id) 
                JOIN LEVEL l ON (h.level_id = l.level_id) 
                JOIN block br ON (l.block_id = br.block_id)  where user_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $user_id);


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