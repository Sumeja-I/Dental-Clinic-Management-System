<?php
require_once '../db_credentials.php';

$conn = mysqli_connect(db_host, db_user, db_password, 'dentist_office');

$query = "select t.t_name as treatment_name, t.price as price, count(a.treatment) as most_popular
            from treatment t, appointment a
            where t.tid = a.treatment
            group by t.t_name, t.price
            order by most_popular desc 
            limit 6; ";


$result = mysqli_query($conn, $query);








