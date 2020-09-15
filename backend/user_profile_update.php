<?php
session_start();
include_once("./db.php");

$data = array();


if (
    isset($_REQUEST['matric_no']) &&
    isset($_REQUEST['fname']) &&
    isset($_REQUEST['lname']) &&
    isset($_REQUEST['address']) &&
    isset($_REQUEST['email']) &&
    isset($_REQUEST['phoneno']) &&
    isset($_REQUEST['faculty']) &&
    isset($_REQUEST['user_id'])
) {

    $user_id = $_REQUEST['user_id'];
    $matric_no = $_REQUEST['matric_no'];
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $address = $_REQUEST['address'];
    $email = $_REQUEST['email'];
    $phoneno = $_REQUEST['phoneno'];
    $faculty = $_REQUEST['faculty'];

    $sql = "update user set 
                matric_no =?,
                fname=?,
                lname=?,
                address=?,
                email=?,
                phoneno=?,
                faculty=?
            where user_id=? ";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssssssss', $matric_no, $fname, $lname, $address, $email, $phoneno, $faculty, $user_id);


    if ($stmt->execute()) {
      
        $data['status'] = "ko";
        if (mysqli_affected_rows($db)>0) {
            $data['status'] = "ok";
        }
    }
}




echo json_encode($data);
