<?php
session_start();
    session_destroy();

    $data['status'] = 'ok';

    echo json_encode($data);
?>