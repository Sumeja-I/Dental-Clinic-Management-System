<?php

    mysqli_report(MYSQLI_REPORT_ERROR);

    require_once '../db_credentials.php';
    $conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");


    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $search = !empty($_GET['treatment_search']) ? $_GET['treatment_search'] :'';

        if(!empty($search)){
            $query_t_search = mysqli_query($conn, "SELECT * FROM vtreatment_details
                                                           WHERE tName LIKE '%{$search}%' OR cName LIKE '%{$search}%';");
        }
        else{
            $query_t_search = mysqli_query($conn, "SELECT * FROM vtreatment_details");
        }
    }