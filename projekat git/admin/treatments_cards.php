<?php
    mysqli_report(MYSQLI_REPORT_ERROR);

    require_once '../db_credentials.php';
    $conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");

    $query_treatment = mysqli_query($conn, "SELECT
                                                (SELECT COUNT(DISTINCT tid) FROM treatment) AS Total, 
                                                (SELECT SUM(lower(t_status) = 'active') FROM treatment) AS Active, 
                                                (SELECT COUNT(DISTINCT cid) FROM category) AS Categories;");
    $row_treatment = mysqli_fetch_assoc($query_treatment);
    $total_treatment = $row_treatment['Total'];
    $active_treatment = $row_treatment['Active'];
    $categories_treatment = $row_treatment['Categories'];

    if (!$row_treatment) {
        die("Query error: " . mysqli_error($conn));
    }
