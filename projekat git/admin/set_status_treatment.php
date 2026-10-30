<?php

    session_start();
    mysqli_report(MYSQLI_REPORT_ERROR);

    require_once '../db_credentials.php';
    $conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");

    $tid=$_GET['tid'];
    $action=$_GET['action'];

    if($action === 'activate'){
        mysqli_query($conn, "UPDATE treatment SET t_status='Active' WHERE tid = '{$tid}'");
        header("Location: admin_page.php?tab=treatments&activate=1");
        exit();
    }
    elseif($action === 'deactivate'){
        mysqli_query($conn, "UPDATE treatment SET t_status='Inactive' WHERE tid = '{$tid}'");
        header("Location: admin_page.php?tab=treatments&deactivate=1");
        exit();
    }
    else{
        die("Database error: " . $conn->error);
    }