<?php
require_once '../db_credentials.php';

try{
$conn = mysqli_connect(db_host, db_user, db_password, 'dentist_office');

$query = "select a.appointment_start as start, concat(d.first_name, ' ', d.last_name) as dentist_name, a.app_total_price as price, a.notes as notes, t.t_name, lower(a.appointment_status) as status
from appointment a, treatment t, dentist d
where a.people = '{$_SESSION['person_id']}' and a.treatment = t.tid and d.did = a.dentist 
ORDER BY CASE 
            WHEN a.appointment_status IN ('pending', 'confirmed') THEN 0
        ELSE 1
    END ASC,
    a.appointment_start ASC;";

$sql_app_his = mysqli_query($conn, $query);
}
catch (mysqli_sql_exception $e){
    echo $e->getMessage();
}
