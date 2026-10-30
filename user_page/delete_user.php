<?php


session_start();
require_once '../db_credentials.php';

$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");
$del = "update people
        set dob = '', p_password = '', p_status = 'Inactive', deleted_at = NOW()
        where pid = {$_GET['id']}
";

$query = mysqli_query($conn, $del);
header('Location: ../welcome/testna2.php');
