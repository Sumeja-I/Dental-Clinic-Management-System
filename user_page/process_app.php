<?php
session_start();
require_once '../db_credentials.php';
$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");


$success = null;
$error   = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pid          = $_POST['user_id'];
    $treatment_id = (int) $_POST['treatment'];
    $date         = $_POST['date'];
    $time         = $_POST['time'];
    $new_start    = $date . ' ' . $time . ':00';

    // Weekend check
    $day_of_week = date('N', strtotime($date));
    if ($day_of_week >= 6) {
        $_SESSION['error'] = "The dental office is closed on weekends. Please select a weekday.";
        header('Location: user_page.php');
        exit;
    } else {
        $query = "CALL book_appointment($pid, $treatment_id, '$new_start')";
        try {
            $result = mysqli_query($conn, $query);
        }
        catch (mysqli_sql_exception $e){
            header('Location: user_page.php?error=1');
            exit;
        }
        if (!$result) {
            #$_SESSION['error'] = mysqli_error($conn); // overlap or no dentist found
            header('Location: user_page.php?error=1');
            exit;
        } else {
            header('Location: user_page.php?success=1');
            exit;
        }
    }
}