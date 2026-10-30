<?php

    mysqli_report(MYSQLI_REPORT_ERROR);

    require_once '../db_credentials.php';
    $conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");

    $query = "SELECT t_name AS tName, price as Price
                FROM treatment
                WHERE lower(t_status) = 'active'";

    $result_general=mysqli_query($conn, $query . " AND category = 1;");

    $result_ortho=mysqli_query($conn, $query . " AND category = 2;");

    $result_aesth=mysqli_query($conn, $query . " AND category = 3;");

    $result_implant=mysqli_query($conn, $query . " AND category = 4;");

