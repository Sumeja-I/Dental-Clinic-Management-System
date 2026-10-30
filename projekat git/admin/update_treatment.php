<?php

    mysqli_report(MYSQLI_REPORT_ERROR);

    require_once '../db_credentials.php';
    $conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $duration = $_POST['duration'];
        $price = $_POST['price'];
        $category = $_POST['type'];

        $query_t_update = mysqli_query($conn, "UPDATE treatment
                                                      SET t_name = '{$name}',
                                                          t_duration = '{$duration}',
                                                          price = '{$price}',
                                                          category = '{$category}'
                                                      WHERE tid = {$id}");

        header('Location: ../admin/admin_page.php?tab=treatments');
        exit();
    }
?>