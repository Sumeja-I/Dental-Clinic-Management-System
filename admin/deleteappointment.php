<?php


session_start();
require_once '../db_credentials.php';

$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");

$aid = $_GET['id'];

$query = "delete from appointment where aid = {$aid}";
mysqli_query($conn, $query);

header("Location: admin_page.php");
exit();