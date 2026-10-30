<?php
require_once '../db_credentials.php';
session_start();
mysqli_report(MYSQLI_REPORT_ERROR);
$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");


$appointment_id = $_GET['id'];


$query = "update appointment
            set appointment_status = 'Confirmed'
            where aid = $appointment_id and lower(appointment_status) = 'pending'";

mysqli_query($conn, $query);

header("Location: admin_page.php");
exit();
