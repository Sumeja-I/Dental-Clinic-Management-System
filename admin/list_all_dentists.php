<?php




mysqli_report(MYSQLI_REPORT_ERROR);
require_once '../db_credentials.php';

$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $dentist_list = !empty($_GET['dentist_search']) ? $_GET['dentist_search'] : '';

    if (!empty($dentist_list)) {
        $dentist_query = "select * 
                            from dentist d , speciality s
                            where d.specialty = s.sid and
                            (d.first_name like '%{$dentist_list}%' or d.last_name like '%{$dentist_list}%' ) 
                           ";
    } else {
        $dentist_query = "select * 
                            from dentist d, speciality s
                            where  d.specialty = s.sid and did > 0";
    }
    $query_active_inactive = mysqli_query($conn, "SELECT
                                                (SELECT COUNT(did) FROM dentist) AS tot_dentist, 
                                                (SELECT COUNT(did) FROM dentist where d_status = 'Active') AS tot_active, 
                                                (SELECT COUNT(did) FROM dentist d where d_status = 'Inactive') AS spec;");

    $dentist_result = mysqli_query($conn, $dentist_query);
    $total_dentists = mysqli_num_rows($dentist_result);

    $query_active_inactive_sql = mysqli_fetch_assoc($query_active_inactive);
    $tot_den = $query_active_inactive_sql['tot_dentist'];
    $tot_spec = $query_active_inactive_sql['tot_active'];
    $tot_active = $query_active_inactive_sql['spec'];

    if (!$dentist_result) {
        die("Query error: " . mysqli_error($conn));
    }

}