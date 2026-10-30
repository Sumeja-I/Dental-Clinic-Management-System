<?php
mysqli_report(MYSQLI_REPORT_ERROR);

require_once '../db_credentials.php';
$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    $price = $_POST['price'];
    $notes = $_POST['notes'];

    $query_t_update = mysqli_query($conn, "UPDATE appointment
                                                      SET app_total_price = {$price}, notes = '{$notes}'
                                                      WHERE aid = {$id}");

    header('Location: ../admin/admin_page.php?tab=appointments&editsuccess=1');
    exit();
}