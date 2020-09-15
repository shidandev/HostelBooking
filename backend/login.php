<?php
    session_start();
    include_once("./db.php");

    $data = array();

    if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
    {   
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $sql = "select user_id,matric_no,fname,lname,type from user where matric_no = ? && password = password(?)";
        $stmt = $db->prepare($sql);

        $stmt->bind_param('ss', $username, $password );

        if($stmt->execute())
        {
            $res = $stmt->get_result();
            $data['status'] = "ko";
            if($res -> num_rows > 0)
            {

                $data['status'] = "ok";
                while($row = $res->fetch_assoc())
                {
                    $data['data'] = $row;
                }

                $_SESSION['login'] = true;
                $_SESSION['user_data'] = $data['data'];
            }
        }

    }
    
    echo json_encode($data);
