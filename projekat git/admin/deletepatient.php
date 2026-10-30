<?php


session_start();
require_once '../db_credentials.php';

$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");

$id = $_GET['id'];

$result = mysqli_query($conn, "update people 
                            set first_name = '', last_name = '', dob = '1000-01-01', phone ='', email = '', p_password = '', p_status = 'Inactive', is_admin = 0, deleted_at = now()
                            where pid = '{$id}'");

if($result){
    header("Location: admin_page.php?tab=patients&success=1");
    exit();
}
else{
    die("Database error: " . $conn->error);
}
