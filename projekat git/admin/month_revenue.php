<?php
 require_once '../db_credentials.php';

 $conn = mysqli_connect(db_host, db_user, db_password, 'dentist_office');


 $first_month_query = " select sum(a.app_total_price) as total_rev, date_format(a.appointment_start, '%M') as month_name
                        from appointment a
                        where 
                        month(a.appointment_start) = month(NOW()) 
                        and year(a.appointment_start) = year(NOW())
                        group by date_format(a.appointment_start, '%M'); ";

 $second_month_query = " select sum(a.app_total_price) as total_rev, date_format(a.appointment_start, '%M') as month_name
                        from appointment a
                        where 
                        month(a.appointment_start) = month(date_sub(NOW(), interval 1 month)) 
                        and year(a.appointment_start) = year(date_sub(NOW(), interval 1 month))
                        group by date_format(a.appointment_start, '%M'); ";

 $result_month_one = mysqli_query($conn, $first_month_query);
 $result_month_two = mysqli_query($conn, $second_month_query);

 $month_one = mysqli_fetch_assoc($result_month_one);
 $month_two = mysqli_fetch_assoc($result_month_two);
