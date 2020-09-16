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
    isset($_REQUEST['faculty']) 
) {

    $matric_no = $_REQUEST['matric_no'];
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $address = $_REQUEST['address'];
    $email = $_REQUEST['email'];
    $phoneno = $_REQUEST['phoneno'];
    $faculty = $_REQUEST['faculty'];
    $password = $_REQUEST['password'];

    $sql = "insert into user ( matric_no,fname,lname,address,password,email,phoneno,faculty,type) values(?,?,?,?,password(?),?,?,?,'user') ";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssssssss', $matric_no, $fname, $lname, $address,$password, $email, $phoneno, $faculty, );


    if ($stmt->execute()) {

        $data['status'] = "ko";
        if (mysqli_affected_rows($db) > 0) {
            $data['status'] = "ok";
        }
    }
}




echo json_encode($data);
