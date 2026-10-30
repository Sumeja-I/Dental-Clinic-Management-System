<?php



mysqli_report(MYSQLI_REPORT_ERROR);
require_once '../db_credentials.php';

$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $people_list = !empty($_GET['patient_search']) ? $_GET['patient_search'] : '';

    if (!empty($people_list)) {
        $people_query = "select * from people where concat(first_name, ' ', last_name) like '%{$people_list}%'";
    } else {
        $people_query = "select * from people where p_status = 'Active'";
    }
    $query_active_inactive = mysqli_query($conn, "SELECT
                                                (SELECT SUM(lower(p_status) = 'active') FROM people) AS active, 
                                                (SELECT SUM(lower(p_status) = 'inactive') FROM people) AS inactive;");

    $people_result = mysqli_query($conn, $people_query);
    $total_people = mysqli_num_rows($people_result);

    $query_active_inactive_sql = mysqli_fetch_assoc($query_active_inactive);
    $active_people = $query_active_inactive_sql['active'];
    $inactive_people = $query_active_inactive_sql['inactive'];

    if (!$people_result) {
        die("Query error: " . mysqli_error($conn));
    }

}