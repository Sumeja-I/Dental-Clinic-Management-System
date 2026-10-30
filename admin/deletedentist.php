<?php


session_start();
require_once '../db_credentials.php';

$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");

$did = $_GET['id'];

$query = "update dentist 
            set d_status = 'Inactive'
            where did = {$did}";
$result = mysqli_query($conn, $query);

if($result){
    header("Location: admin_page.php?tab=dentists&delete=1");
    exit();
}
else{
    die("Database error: " . $conn->error);
}