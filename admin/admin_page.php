<?php

session_start();
mysqli_report(MYSQLI_REPORT_ERROR);
require_once '../db_credentials.php';
$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");


if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true){
    header('Location: ../login/login.php');
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (!empty($_GET['search']) && !empty($_GET['dateinput'])) {
        $search = $_GET['search'];
        $dateinput = $_GET['dateinput'];

       $query = "select * from appointment_search
                    where fname like '%{$search}%' and dateapp = '{$dateinput}'
                order by app asc";

        /*$query = "select a.aid as id, a.appointment_start as app,
                    date(a.appointment_start) as dateapp, concat(p.first_name, ' ', p.last_name) as fname, 
                    p.email, concat(d.first_name, ' ', d.last_name) as dentist, a.appointment_status as status, t_name, t_duration, a.app_total_price as price
                    from appointment a, dentist d, people p, treatment t
                    where a.dentist = d.did and a.people = p.pid and a.treatment = t.tid
                    and concat(p.first_name, ' ', p.last_name) like '%{$search}%' and date(a.appointment_start) = '{$dateinput}' 
                    order by a.appointment_start asc";*/
    }
    elseif (!empty($_GET['search'])) {
        $search = $_GET['search'];

        $query = "select * from appointment_search
                    where fname like '%{$search}%'
                    order by app asc
";
        /* $query = "select a.aid as id, a.appointment_start as app,
                    date(a.appointment_start) as dateapp, concat(p.first_name, ' ', p.last_name) as fname, 
                    p.email, concat(d.first_name, ' ', d.last_name) as dentist, a.appointment_status as status, t_name, t_duration, a.app_total_price as price
                    from appointment a, dentist d, people p, treatment t
                    where a.dentist = d.did and a.people = p.pid and a.treatment = t.tid
                    and concat(p.first_name, ' ', p.last_name) like '%{$search}%' 
                    order by a.appointment_start asc";
*/
    } elseif (!empty($_GET['dateinput'])) {
        $dateinput = $_GET['dateinput'];

       $query = "select * from appointment_search
                    where dateapp = '{$dateinput}'
                    order by app asc
";

        /*$query = "select a.aid as id, a.appointment_start as app,
                    date(a.appointment_start) as dateapp, concat(p.first_name, ' ', p.last_name) as fname,
                    p.email, concat(d.first_name, ' ', d.last_name) as dentist, a.appointment_status as status, t_name, t_duration, a.app_total_price as price
                    from appointment a, dentist d, people p, treatment t
                    where a.dentist = d.did and a.people = p.pid and a.treatment = t.tid
                    and date(a.appointment_start) = '{$dateinput}' 
                    order by a.appointment_start asc";
*/
    } else {
       /* $query = "select a.aid as id, a.appointment_start as app,
                    date(a.appointment_start) as dateapp, concat(p.first_name, ' ', p.last_name) as fname, 
                    p.email, concat(d.first_name, ' ', d.last_name) as dentist, a.appointment_status as status, t_name, t_duration, a.app_total_price as price
                    from appointment a, dentist d, people p, treatment t
                    where a.dentist = d.did and a.people = p.pid and a.treatment = t.tid
                    and date(a.appointment_start) = curdate() 
                    order by a.appointment_start asc";
    */

        $query = "select * from appointment_search where dateapp = current_date() order by app asc";
    }

    $query_app = mysqli_query($conn, "SELECT
                                                (SELECT SUM(lower(appointment_status) = 'confirmed') FROM appointment) AS Confirmed, 
                                                (SELECT SUM(lower(appointment_status) = 'pending') FROM appointment) AS Pending;");

    $query_admin = mysqli_query($conn, "select * from people where pid = '{$_SESSION['person_id']}'");
    $sql = mysqli_fetch_assoc($query_admin);

    $result = mysqli_query($conn, $query);
    $total = mysqli_num_rows($result);

    $row_appointments = mysqli_fetch_assoc($query_app);
    $confirmed_app = $row_appointments['Confirmed'];
    $pending_app = $row_appointments['Pending'];


    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }
}

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Dentin - Admin Panel</title>
    <link rel="favicon" href="../pictures/tooth.png">
    <style>
        *{
        }

        main, footer{
            width: 100%;
        }
        body{
            font-family: 'DM Sans', sans-serif;
            background: #F7F5F0;
            color: #1E2B3C;
            margin: 0;
            min-height: 100vh;
        }
        header {
            display: flex;
            margin-bottom: 50px;
            padding: 0 60px;
            background: #1E2B3C;
            height: 100px;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 24px rgba(30,43,60,.28);
            position: sticky; top: 0; z-index: 100;

        }
        .logo{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            text-decoration: none;
        }
        .header_pic img{
            height: 140px;
            border-radius: 50%;
            padding-left: 20px;
        }
        .header_text{
            color: rgba(255,255,255,.75);
            font-size: 17px;
            font-weight: 300;
            letter-spacing: .08em;
            line-height: 1.3;
        }
        .header_text strong{
            display: block;
            font-family: 'Cormorant Garamond', serif;
            font-size: 25px;
            font-weight: 600;
            font-style: italic;
            color: #E8BC72;
            letter-spacing: .02em;
            line-height: 1;
        }
        .logout{
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            background: transparent;
            border: 1.5px solid rgba(232,188,114,.45);
            border-radius: 100px;
            color: #E8BC72;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: .04em;
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, border-color .2s, color .2s, box-shadow .2s;
        }

        .logout:hover {
            background: rgba(232,188,114,.10);
            border-color: #E8BC72;
            color: #FFFFFF;
            box-shadow: 0 0 20px rgba(201,150,58,.16);
        }

        nav{
            display: flex;
            justify-content: space-around;
            width: 300px;
            flex-shrink: 0;
            align-items: flex-end;
        }
        nav a, #span a{
            font-family: 'DM Sans', sans-serif;
            color: #EDBC7F;
            text-decoration: none;
        }
        nav a:hover, #span a:hover{
            transform: scale(1.1);
        }

        .user_header {
            font-family: 'Cormorant Garamond', serif;
            color: #1E2B3C;
            font-size: clamp(30px, 4vw, 46px);
            width: 50%;
            font-weight: 600;
            margin-bottom: 32px;
            padding-left: 70px;
            letter-spacing: -.01em;
            line-height: 1.1;
        }
        .user_header span{
            color: #C9963A;
        }

        input[type="radio"]{
            display: none;
        }

        .tabs{
            display: grid;
            grid-template-columns: repeat(6,1fr);
            gap: 20px;
            width: 100%;
            margin: 0 0 40px 70px;
            max-width: 950px;
            justify-content: space-around;
            padding: 12px 22px 12px 22px;
            box-sizing: border-box;
            background: #F2E6CE;
            align-items: center;
            border-radius: 24px;
            box-shadow: 0 2px 8px  rgba(30,43,60,.06);
        }

        .tabs label{
            font-size: 17px;
            font-weight: 600;
            color: #4A607A;
            padding: 10px 20px;
            border-radius: calc(24px - 4px);
            cursor: pointer;
            text-align: center;
            transition: background .2s, color .2s, box-shadow .2s;
            user-select: none;
            letter-spacing: .01em;
        }

        .tabs label:hover{
            background: #1E2B3C;
            color: #E8BC72;
        }

        #appointments:checked ~ .tabs label[for="appointments"],
        #patients:checked ~ .tabs label[for="patients"],
        #treatments:checked ~ .tabs label[for="treatments"],
        #dentists:checked ~ .tabs label[for="dentists"],
        #analytics:checked ~ .tabs label[for="analytics"],
        #settings:checked ~ .tabs label[for="settings"]{
            background: #1E2B3C;
            color: #E8BC72;
            box-shadow: 0 2px 12px rgba(30,43,60,.20);
        }

        .section {
            display: none;
            margin-bottom: 40px;
        }


        #appointments:checked ~ .content #appointments,
        #patients:checked ~ .content #patients,
        #treatments:checked ~ .content #treatments,
        #dentists:checked ~ .content #dentists,
        #analytics:checked ~ .content #analytics,
        #settings:checked ~ .content #settings {
            display:block;
        }
        .settings{
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
            background: #FFFFFF;
            box-shadow: 0 8px 40px rgba(30,43,60,.13), 0 2px 8px rgba(30,43,60,.07);
            border: 1px solid rgba(30,43,60,.06);
            border-top: 4px solid  #1E2B3C;
            border-radius: 10px;
        }

        .settings h3{
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px;
            color: #1E2B3C;
            margin: 0;
            box-sizing: border-box;
            padding: 20px 20px 15px 22px;
            text-transform: uppercase;

        }

        .settings_flex{
            display: flex;
            flex-direction: column;
            padding-bottom: 35px;
            margin: 0 22px 0 22px;
            border-bottom: 2px solid  #1E2B3C;
        }

        .settings_item{
            background: #faf6ef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 25px 12px 25px;
            border: 1px solid #e2d8c8;
            border-radius: 10px;
            margin: 7px 0 7px 0;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        .settings_item:hover {
            border-color:  #e8c98a;
        }

        .left{
            display: flex;
            align-items: center;
            gap: 20px;
        }

        h4{
            margin: 0;
            font-family: 'Cormorant Garamond', serif;
            color: #1E2B3C;
            font-weight: 600;
            font-size: 22px;
        }

        .item_text p{
            font-family: 'DM Sans', sans-serif;
            color: #1E2B3C;
            font-size: 15px;
            margin: 5px 0 5px 0;
        }

        .delete_text{
            margin: 0;
            font-family: 'Cormorant Garamond', serif;
            color: #f5d0d0;
            font-weight: normal;
            font-size: 22px;
        }

        .delete_p{
            font-family: 'Cormorant Garamond', serif;
            color: #a07070;
            font-size: 18px;
            margin: 5px 0 5px 0;
        }

        img{
            height: 40px;
        }

        .settings_item button{
            margin: 0;
            width: 80px;
            border-radius: 10px;
            background: transparent;
            border: 1px solid #e2d8c8;
            color:  #1a2744;
            cursor: pointer;
            transition: background 0.18s, border-color 0.18s, color 0.18s, transform 0.12s, box-shadow 0.18s;
        }

        .settings_item button:hover{
            border-color: #c9963a;
            color: #c9963a;
            background: #f5e6cc;
            box-shadow: 0 2px 10px rgba(201,150,58,0.18);
            transform: translateY(-1px);
        }

        .settings_flex:last-child button{
            background: #c82538;
            color: #2a1a1a;
            width: 100px;
            box-shadow: 0 0 0 0 rgba(200, 37, 56, 0);
            border: none;
        }

        .settings_flex:last-child .settings_item{
            background: #2a1a1a;
        }

        .settings_flex:last-child{
            border-bottom: none;
        }

        .settings_flex:last-child button:hover {
            box-shadow: 0 0 0 5px rgba(200, 37, 56, 0.55);
            transform: translateY(-1px);
        }


        html{
            scroll-behavior: smooth;
        }

        .content{
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
        }

        footer{
            background: #212A35;
            color: #EDBC7F;
            width: 100%;
            min-height: 15vh;
            justify-content: space-around;
            align-items: center;
            font-family: 'DM Sans', sans-serif;
            display: grid;
            grid-template-columns: repeat(3,2fr);
            grid-template-rows: repeat(2,2fr);
        }

        .end {
            grid-column-start: 1;
            grid-column-end: -1;
            text-align: center;
            align-items: center;
        }


        .list{
            display: grid;
            grid-template-columns: repeat(3,2fr);
            grid-template-rows: 2fr;
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
            align-self: center;
            justify-content: space-around;
            align-items: center;
            text-align: center;
            align-content: center;
            gap: 20px;
            border-radius: 15px;
            padding-bottom: 50px;

        }

        .grid h3{
            font-family: 'DM Sans', sans-serif;
            text-align: left;
            align-self: center;
            color: #EDBC7F;
            margin: 10px auto 20px auto;
            padding-bottom: 10px;
            padding-left: 10px;
            padding-top: 20px;
            grid-column-start: 1;
            grid-column-end: -1;
        }
        .item{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            border-radius: 5px;
            font-family: 'DM Sans', sans-serif;
            align-items: center;
            width: 100%;
            height: 142px;
            margin: 0 auto;
            font-weight: 700;
            color:   #1E2B3C;
            background-color: #FFFFFF;
            box-shadow: 0 6px 24px rgba(30,43,60,.09);
            line-height: 1.8;
            border: 1px solid rgba(30,43,60,.06);
            border-left: 4px solid  #1E2B3C;
            transition: transform .25s cubic-bezier(.34,1.56,.64,1), box-shadow .25s ease;
        }

        .text, .image{
            flex: 1;
        }

        .item:hover{
            transform: translateY(-4px);
            box-shadow:  0 16px 48px rgba(30,43,60,.11), 0 4px 20px rgba(201,150,58,.22);
        }
        .image{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin: auto auto;
            transition: transform .25s ease;

        }
        .image:hover . item{
            transform: scale(1.1);
        }
        .image img{
            width: 80px;
            height: 80px;
            padding-top: 10px;
            padding-left: 5px;
            padding-right: 5px;
        }
        .p1{
            padding-left: 2px;
            color: #1E2B3C;
            font-size: 18px;
            font-weight: 400;
            text-align: center;
            margin-bottom: 0;
        }

        .p2{
            font-size: 18px;
            color: #1E2B3C;
            font-weight: 400;
            text-align: center;
            margin-bottom: 0;
            padding-left: 2px;
            white-space: nowrap;
        }

        .p3{
            font-size: 17px;
            color: #1E2B3C;
            font-weight: 400;
            text-align: center;
            margin: 18px 0 0 0;
            padding-left: 5px;
            white-space: nowrap;
        }

        .appointments, .treatments{
            background-color: #F2E6CE;
            max-width: 1080px;
            width: 100%;
            margin: 0 auto 40px auto;
            height: 80px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .search{
            width: 100%;
            max-width: 700px;
            margin-left: 10px;
            padding-left: 10px;
            background-color: white;
            border-radius: 10px;
            text-align: left;
            justify-content: center;
            border: 1.5px solid transparent;
            display: flex;
            align-items: center;
            transition: border-color .2s ease, box-shadow .2s ease;
            box-shadow: 0 6px 24px rgba(30,43,60,.09);
        }
        .search:focus-within {
            border-color: #C9963A;
            box-shadow: 0 4px 20px rgba(201,150,58,.22);
        }
        .search img{
            height: 20px;
            width: 20px;
            transition: transform .2s ease;
        }
        .search input, .date_input input{
            width: 100%;
            border: none;
        }
        .search:focus-within img {
            transform: scale(1.15);
        }
        .date_input{
            padding-right: 10px;
            margin-right: 10px;
            padding-left: 10px;
            background-color: white;
            border-radius: 10px;
            text-align: left;
            justify-content: center;
            border: 1.5px solid transparent;
            transition: background .2s ease, border-color .2s ease,  color .2s ease,  box-shadow .2s ease;
            box-shadow: 0 6px 24px rgba(30,43,60,.09);
        }
        .date_input:hover {
            border-color: #C9963A;
            color: #1E2B3C;
            box-shadow: 0 4px 20px rgba(201,150,58,.22);
        }
        input::placeholder, input[type="date"]{
            color: #212A35;
            font-family: 'DM Sans', sans-serif;
            margin-top: 20px;
        }
        input{
            border: none;
            border-bottom: 2px solid white;
            background: transparent;
            outline: none;
            margin: 5px 0 5px 10px;
            font-family: 'DM Sans', sans-serif;
        }




        main{
            margin-bottom: 100px;
        }

        .number{
            color: #1E2B3C;
            font-size: 50px;
            font-weight: 400;
            margin: 0 0 ;
        }

        .patient_list{
            background: #F2E6CE;
            border-radius: 10px;
            max-width: 1080px;
            width: 100%;
            margin: 0 auto;
        }

        .patient_list h3{
            font-family: 'Cormorant Garamond', serif;
            color: #1E2B3C;
            margin: 0 0 20px 15px;
            padding-top: 15px;
            box-sizing: border-box;
            font-size: 22px;
            font-weight: 600;
            text-transform: uppercase;
            text-align: center;
        }

        .patients{
            margin-bottom: 20px;
            width: 90%;
            margin-left: 10px;
            padding-left: 10px;
            background-color: white;
            border-radius: 10px;
            text-align: left;
            justify-content: center;
            border: 1.5px solid transparent;
            display: flex;
            align-items: center;
            transition: border-color .2s ease, box-shadow .2s ease;
            box-shadow: 0 6px 24px rgba(30,43,60,.09);
        }

        .patients:focus-within{
            border-color: #C9963A;
            box-shadow: 0 4px 20px rgba(201,150,58,.22);
        }
        .patients:focus-within, .search:focus-within{
            border: 2px solid #2f3e52;
            transition: border-color 0.2s ease;
        }
        .patients img{
            height: 20px;
            width: 20px;
            transition: transform .2s ease;
        }
        .patients input{
            width: 100%;
            border: none;
        }
        .patients:focus-within img {
            transform: scale(1.15);
        }

        .app_list{
            border-radius: 10px;
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
            background: #F2E6CE;
            box-shadow: 0 20px 60px rgba(30, 43, 60, 0.15);
        }

        .app_list_header{
            max-width: 1278px;
            width: 100%;
            margin: 0 auto;
            background: #F2E6CE;

        }

        .app_list_header h3{
            font-family: 'Cormorant Garamond', serif;
            color: #1E2B3C;
            margin-left: 15px;
            padding-top: 20px;
            font-size: 22px;
            font-weight: 600;
            box-sizing: border-box;
        }

       .app_table{
           margin: 0 auto;
           width: 100%;
           max-width: 1300px;
           /*table-layout: fixed;*/
           background: #FAF5EA;
           border-radius: 0 0 10px 10px;
       }
        .app_header{
            background: #2C3D52;
        }
       .app_header, .app_body{
           grid-template-columns: repeat(9, 1fr);
       }

        .app_table col.col-time {
            width: 12%;
        }
        .app_table col.col-patient{
            width: 10%;
        }
        .app_table col.col-contact{
            width: 15%;
        }
        .app_table col.col-treatment{
            width: 16%;
        }
        .app_table col.col-dentist{
            width: 9%;
        }
        .app_table col.col-duration{
            width: 8%;
        }
        .app_table col.col-price{
            width: 7%;
        }
        .app_table col.col-status{
            width: 10%;
        }
        .app_table col.col-action{
            width: 13%;
        }

       .app_header{
           background: #212A35;
       }

       .app_table .app_header th{
           font-family: 'DM Sans', sans-serif;
           color: #C9963A;
           font-size: 16px;
           height: 50px;
           border: none;

       }
        tbody tr {
            transition: background .18s ease;
        }
        tbody tr:hover {
            background: #F2E6CE;
        }
       table{
           border-collapse: collapse;
           border-spacing: 0;
       }

       .app_table .app_body td{
           text-align: center;
           height: 80px;
           font-family: 'DM Sans', sans-serif;
           font-size: 15px;
           color: #1E2B3C;
           font-weight: 400;
       }

       .table_links{
           display: flex;
           justify-content: space-evenly;
       }

        td a{
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
        }

        .pat_table{
            margin: 0 auto;
            width: 100%;
            max-width: 1100px;
            table-layout: fixed;
            background: #FAF5EA;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 20px 60px rgba(30, 43, 60, 0.15);
        }
        .pat_header{
            background: #2C3D52;
        }
        .pat_header, .pat_body{
            grid-template-columns: repeat(6, 1fr);
        }

        .pat_table col.col-name {
            width: 20%;
        }
        .pat_table col.col-email{
            width: 22%;
        }
        .pat_table col.col-phone{
            width: 14%;
        }
        .pat_table col.col-dob{
            width: 18%;
        }
        .pat_table col.col-status{
            width: 14%;
        }
        .pat_table col.col-action{
            width: 12%;
        }

        .pat_header{
            background: #212A35;
        }

        .pat_table .pat_header th{
            font-family: 'DM Sans', sans-serif;
            color: #C9963A;
            font-size: 18px;
            height: 50px;
            border: none;
        }

        .pat_table .pat_body td{
            text-align: center;
            height: 80px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            color: #1E2B3C;
            font-weight: 400;
        }

        .treat_list{
            background: #F2E6CE;
            border-radius: 10px;
            max-width: 1080px;
            width: 100%;
            margin: 0 auto;
        }

        .treat_list_header{
            max-width: 1078px;
            width: 100%;
            margin: 0 auto;
            background: #F2E6CE;
        }

        .treat_list_header h3{
            font-family: 'Cormorant Garamond', serif;
            color: #1E2B3C;
            margin-left: 15px;
            padding-top: 20px;
            font-size: 22px;
            font-weight: 600;
            box-sizing: border-box;
            text-transform: uppercase;
            text-align: center;
        }

        .treat_table{
            margin: 0 auto;
            width: 100%;
            max-width: 1100px;
            table-layout: fixed;
            background: #FAF5EA;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 20px 60px rgba(30, 43, 60, 0.15);
        }

        .treat_header, .treat_body{
            grid-template-columns: repeat(6, 1fr);
        }

        .treat_table col.col-name {
            width: 30%;
        }
        .treat_table col.col-duration{
            width: 12%;
        }
        .treat_table col.col-price{
            width: 11%;
        }
        .treat_table col.col-category{
            width: 18%;
        }
        .treat_table col.col-status{
            width: 13%;
        }
        .treat_table col.col-action{
            width: 16%;
        }

        .treat_header{
            background: #212A35;
        }

        .treat_table .treat_header th{
            font-family: 'DM Sans', sans-serif;
            color: #C9963A;
            font-size: 18px;
            height: 50px;
            border: none;

        }

        .treat_table .treat_body td{
            text-align: center;
            height: 80px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            color: #1E2B3C;
            font-weight: 400;
        }

        .edit{
            color: #1a6fa8;
            font-weight: 600;
            font-size: 15px;
            transition: transform .2s cubic-bezier(.34,1.56,.64,1), opacity .15s ease;
            display: inline-block;
        }

        .edit:hover{
            color: #145a8a;
            transform: translateX(3px);
            opacity: .8;
        }

        .confirm{
            color: #219a54;
            font-weight: 600;
            font-size: 15px;
            transition: transform .2s cubic-bezier(.34,1.56,.64,1), opacity .15s ease;
            display: inline-block;
        }

        .confirm:hover{
            color: #1a7a43;
            transform: translateX(3px);
            opacity: .8;
        }

        .cancel{
            color: #c82538;
            font-weight: 600;
            font-size: 15px;
            transition: transform .2s cubic-bezier(.34,1.56,.64,1), opacity .15s ease;
            display: inline-block;
        }

        .cancel:hover{
            color: #8C1A27;
            transform: translateX(3px);
            opacity: .8;
        }

        .reactivate{
            color: #219a54;
            font-weight: 600;
            font-size: 15px;
            transition: transform .2s cubic-bezier(.34,1.56,.64,1), opacity .15s ease;
            display: inline-block;
        }

        .reactivate:hover{
            color: #1a7a43;
            transform: translateX(3px);
            opacity: .8;
        }

        .status{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            padding: 6px 16px;
            border: 1px solid #9FE1CB;
            border-radius: 20px;
            background: #E6F5EE;
            margin: 0 auto;
            min-width: 90px;
        }

        .status p{
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            font-weight: 550;
            color: #0F6E56;
            font-size: 14px;
        }

        .pending{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            border: 1px solid #FAC775;
            border-radius: 20px;
            background: #FAEEDA;
            margin: 0 auto;
            gap: 6px;
            padding: 5px 14px;
            white-space: nowrap;
        }

        .pending::before {
            content: "";
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
            background: #EF9F27;
        }

        .pending p{
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            color: #854F0B;
            font-size: 13px;
            font-weight: 500;
        }

        .confirmed{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            border: 1px solid #B5D4F4;
            border-radius: 20px;
            background: #E6F1FB;
            margin: 0 auto;
            gap: 6px;
            padding: 5px 14px;
            white-space: nowrap;
        }

        .confirmed::before {
            content: "";
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
            background: #378ADD;
        }

        .confirmed p{
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            color: #185FA5;
            font-size: 13px;
            font-weight: 500;
        }

        .completed{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            border: 1px solid #9FE1CB;
            border-radius: 20px;
            background: #E6F5EE;
            margin: 0 auto;
            gap: 6px;
            padding: 5px 14px;
            white-space: nowrap;
        }

        .completed::before {
            content: "";
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
            background: #1D9E75;
        }

        .completed p{
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            color: #0F6E56;
            font-size: 13px;
            font-weight: 500;
        }

        .canceled{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            border: 1px solid #F0997B;
            border-radius: 20px;
            background: #FAECE7;
            margin: 0 auto;
            gap: 6px;
            padding: 5px 14px;
            white-space: nowrap;
        }

        .canceled::before {
            content: "";
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
            background: #D85A30;
        }

        .canceled p{
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            color: #993C1D;
            font-size: 13px;
            font-weight: 500;
        }

        .status_inactive{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            padding: 6px 16px;
            border: 1px solid rgba(160,48,37,.2);
            border-radius: 20px;
            background-color: #F5EEEE;
            margin: 0 auto;
            min-width: 90px;
        }

        .status_inactive p{
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            font-weight: 600;
            color: #A03025;
            font-size: 14px;
        }

        .month{
            color: #212A35;
            width: 80%;
            font-family: 'DM Sans', sans-serif;
            border-radius: 20px;
            margin: 0 auto;
            align-items: center;
            text-align: center;
            justify-content: center;
        }
        .month_analytics{
            display: flex;
            text-align: center;
            justify-content: space-around;
        }
        #month{
            text-align: right;
            padding-top: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        #money{
            text-align: right;
            padding-top: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .bar {
            width: 100%;
            height: 10px;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 14px;
        }

        .bar_fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #1a2332, #212A35, #EDBC7F);
            margin: 0 auto;
        }
        .analytics_div{
            background: rgba(255,255,255,0.5);
            height: 80px;

            color: #212A35;
            width: 80%;
            font-family: "Montserrat", sans-serif;
            border-radius: 20px;
            margin: 0 auto;
            align-items: center;
            text-align: center;
            justify-content: center;
            margin-bottom: 10px;
        }


        .bar_fill.mon {
            width: 90%;
            animation: growmon 1s 0.35s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        @keyframes growmon {
            from { width: 0%; }
            to   { width: 84%; }
        }

        .success-message{
            font-family: 'DM Sans', sans-serif;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 14px 20px;
            margin: 10px auto 20px auto;
            max-width: 900px;
            font-size: 15px;
            font-weight: 520;
        }

        .treatment_search{
            width: 100%;
            max-width: 700px;
            margin-left: 10px;
            padding-left: 10px;
            background-color: white;
            border-radius: 10px;
            text-align: left;
            justify-content: center;
            border: 2px solid transparent;
            display: flex;
            align-items: center;
            transition: border-color .2s ease, box-shadow .2s ease;
            box-shadow: 0 6px 24px rgba(30,43,60,.09);
        }

        .treatments:focus-within{
            border-color: #C9963A;
            box-shadow: 0 4px 20px rgba(201,150,58,.22);
        }

        .treatment_search img{
            height: 20px;
            width: 20px;
            transition: transform .2s ease;
        }
        .treatment_search input{
            width: 100%;
            border: none;
        }

        .treatments:focus-within img {
            transform: scale(1.15);
        }

        .add_treat{
            width: 100%;
            max-width: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .add_treat a{
            background: #C9963A;
            color: #FFFFFF;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            padding: 10px 22px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 20px rgba(201,150,58,.22);
            transition: background .2s ease,  transform .2s cubic-bezier(.34,1.56,.64,1),  box-shadow .2s ease;
        }

        .add_treat a:hover {
            background: #b8832e;
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(201,150,58,.35);
        }

        .add_treat a:active {
            transform: translateY(0px);
            box-shadow: 0 4px 20px rgba(201,150,58,.22);
        }


    @media screen and (max-width: 1080px){
        .tabs{
            gap: 10px;
            width: 100%;
            margin: 0 auto 30px auto;
            max-width: 850px;
            justify-content: space-around;
            padding: 12px 22px 12px 22px;
        }

        .appointments, .patient_list{
            max-width: 900px;
        }

        .search {
            max-width: 600px;
        }
        .app_list, .patient_list, .treat_list{
            overflow-x: auto;
            width: 100%;
        }
        .app_table, .pat_table, .treat_table{
            min-width: 1075px;
            width: 100%;
        }
        .app_table td, .app_table th{
            white-space: wrap;
        }
        .settings{
            max-width: 800px;
        }
    }

        @media screen and (max-width: 900px){
            .tabs{
                width: 100%;
                margin: 0 auto 30px auto;
                max-width: 700px;
                grid-template-columns: 1fr 1fr 1fr;
            }

            .p3{
                font-size: 17px;
                white-space: normal;
            }

            .list{
                max-width: 700px;
            }

            .appointments, .patient_list{
                max-width: 700px;
            }

            .search, .treatment_search{
                max-width: 400px;
            }
        }

        @media screen and (max-width: 768px) {
            header {
                height: 150px;
            }

            .logo {
                max-width: 250px;
            }
            .settings{
                max-width: 600px;
            }

            nav {
                flex-direction: column;
                align-items: center;
                justify-content: center;
                width: 300px;
                height: 150px;
            }


            .tabs{
                grid-template-columns: 1fr 1fr 1fr;
                margin: 0 auto 40px auto;
                max-width: 600px;
                width: 100%;
                padding: 8px 18px 8px 18px;
                gap: 10px;
            }

            .p2, .p3{
                white-space: normal;
            }
        }

        @media screen and (max-width: 700px) {
            header{
                margin-bottom: 40px;
            }
            .tabs{
                grid-template-columns: 1fr 1fr 1fr;
                margin: 0 auto 45px auto;
                max-width: 600px;
                width: 100%;
            }
            .tabs label{
                font-size: 17px;
                padding: 5px 10px;
            }
            .list{
                width: 100%;
                padding-bottom: 45px;
            }
            .item{
                width: 100%;
                height: 120px;
            }
            .p1, .p2, .p3{
                font-size: 17px;
                margin-top: 0;
            }
            .image{
                margin: 0;
            }
            .image img{
                width: 50px;
                height: 50px;
            }
            .number{
                font-size: 30px;
            }
            .search, .treatment_search{
                max-width: 300px;
            }

            .list{
                max-width: 600px;
            }

            .appointments, .patient_list{
                max-width: 600px;
            }
        }

        @media screen and (max-width: 600px){

            nav{
                width: 200px;
                padding-right: 10px;
            }
            .user_header, .tabs{
                align-content: center;
                justify-content: center;
                text-align: center;
            }
            .user_header{
                margin: 32px auto;
                padding: 0;
                width: 400px;
            }
            .tabs{
                margin-left: 0;
            }
            .settings{
                max-width: 500px;
            }

            .content{
                width: 100%;
            }
            .item{
                width: 50%;
            }

            /* #title a{
                 display: none;
             }*/
            form{
                width: 300px;
                grid-template-columns: 1fr;
            }

            input{
                width: 90%;
            }
            .list{
                width: 100%;
                padding-bottom: 45px;
            }
            .item{
                width: 100%;
            }
            .search, .treatment_search{
                width: 50%;
            }
            .date_input{
                width: 30%;
            }
            .tabs{
                justify-self: center;
                margin: 0 auto 40px auto;
                max-width: 550px;
                width: 100%;
            }

            .tabs label{
                font-size: 18px;
                padding: 5px 10px;
            }

            .list{
                max-width: 550px;
            }

            .appointments, .patient_list{
                max-width: 550px;
            }
            .p3{
                font-size: 16px;
            }
        }
        @media screen and (max-width: 520px){
            .user_header{
                font-size: 30px;
                margin: 35px auto;
                width: 100%;
            }
        }


        @media screen and (max-width: 515px){
            .p3{
                font-size: 15px;
            }
        }

        @media screen and (max-width: 500px){
            header{
                flex-direction: column;
                align-items: center;
                text-align: center;
                height: 200px;
                justify-content: space-around;
                margin-bottom: 40px;
            }
            .settings{
                max-width: 400px;
            }
            .logo {
                max-width: 399px;
                height: 150px;
            }
            .header_pic{
                height: 140px;
            }
            .header_pic img{
                padding-left: 0;
            }
            .logo p{
                min-width: 100px;
            }
            nav{
                height: 100px;
                padding-right: 0;
            }
            .content{
                overflow: hidden;
            }
            .section{
                overflow: hidden;
            }
            .user_header{
                font-size: 35px;
            }
            .list{
                display: grid;
                width: 100%;
                grid-template-columns: 1fr;
                grid-template-rows: repeat(3,2fr);
                margin: 0 auto;
                overflow: hidden;
                justify-content: left;
                max-width: 420px;
            }
            .p1{
                font-size: 20px;
            }
            .p2, .p3{
                font-size: 19px;
            }
            .image img{
                height: 70px;
                width: 70px;
            }
            .item{
                width: 90%;
                overflow: hidden;
                height: 100px;
            }
            .header_pic{
                height: 140px;
            }
            nav{
                height: 100px;
                padding-right: 0;
            }
            .logo p{
                min-width: 100px;
            }
            .logout {
                margin: 0 auto;
            }
            .tabs{
                grid-template-columns: 1fr 1fr;
                margin: 0 auto 45px auto;
                max-width: 430px;
                width: 100%;
            }

            .tabs label{
                font-size: 16px;
                padding: 5px 10px;
            }

            .appointments, .patient_list{
                width: 100%;
                max-width: 450px;
            }

            .treatment_search{
                width: 100%;
                max-width: 500px;
            }

            .add_treat {
                max-width: 150px;
            }

            .add_treat a{
                font-size: 13px;
                padding: 10px 7px;
            }
        }

        @media screen and (max-width: 430px) {
            .user_header{
                font-size: 32px;
            }
        }

        @media screen and (max-width: 360px) {
            .user_header{
                font-size: 27px;
                margin: 25px auto;
            }
            .tabs {
                grid-template-columns: 1fr;
                margin: 0 auto 30px auto;
                max-width: 250px;
                width: 100%;
                height: 230px;
            }

            .tabs label {
                font-size: 16px;
                padding: 3px 6px;
            }

            .list{
                max-width: 300px;
            }

            .p1{
                padding-top: 10px;
                font-size: 16px;
            }
            .p2, .p3{
                font-size: 14px;
                padding-top: 10px;
                margin: 0;
            }
            .image img{
                height: 55px;
                width: 55px;
            }
            .item{
                width: 90%;
                overflow: hidden;
                height: 80px;
            }

            .appointments, .treatments{
                flex-direction: column;
                justify-content: space-evenly;
                max-width: 300px;
                width: 100%;
                height: 120px;
            }

            .search, .treatment_search{
                max-width: 200px;
                width: 100%;
                padding: 0;
                height: 30px;
                margin: 0 auto;
            }

            .date_input{
                max-width: 150px;
                width: 100%;
                height: 30px;
                margin: 0 auto;
                padding: 0;
            }

            .patient_list{
                max-width: 300px;
                width: 100%;
            }

            .patient_list h3{
                text-align: center;
                margin-left: 0;
            }

            .patients{
               padding-left: 0;
            }

        }

    </style>
</head>
<body>
<header>
    <a href="../welcome/testna2.php" class="logo">
        <div class="header_pic">
            <img src="../pictures/newlogo.png" alt="logo">
        </div>
        <div class="header_text">
            Dental office
            <strong>Dentin</strong>
        </div>
    </a>

    <a href="../user_page/log_out.php" class="logout">Log out</a>
</header>

<main>
    <div class="user_header">Welcome back, <span><?= $_SESSION['name']; ?>!</span></div>

    <input type="radio" name="tab" id="appointments" checked>
    <input type="radio" name="tab" id="patients" value="patients" <?= (!empty($_GET['tab']) && $_GET['tab']==='patients') ? 'checked': ''; ?> >
    <input type="radio" name="tab" id="treatments" value="treatments" <?= (!empty($_GET['tab']) && $_GET['tab']==='treatments') ? 'checked': ''; ?> >
    <input type="radio" name="tab" id="dentists" value="dentists" <?= (!empty($_GET['tab']) && $_GET['tab']==='dentists') ? 'checked': ''; ?> >
    <input type="radio" name="tab" id="analytics">
    <input type="radio" name="tab" id="settings" value="settings" <?= (!empty($_GET['tab']) && $_GET['tab']==='settings') ? 'checked': ''; ?> >

    <div class="tabs">
        <label for="appointments">Appointments</label>
        <label for="patients">Patients</label>
        <label for="treatments">Treatments</label>
        <label for="dentists">Dentists</label>
        <label for="analytics">Analytics</label>
        <label for="settings">Settings</label>
    </div>

    <div class="content">
        <div class="section" id="appointments">
            <?php if (isset($_GET['editsuccess']) && $_GET['editsuccess'] == 1): ?>
                <div class="success-message">
                    ✓ The appointment has been updated successfully!
                </div>
            <?php endif; ?>
            <div class="list">

                <div class="item">
                    <div class="text">
                        <p class="p1">Total</p>
                        <p class="number"><?= $total ?></p>
                    </div>
                    <div class="image">
                        <img src="../pictures/calendar.png" alt="calendar" id="schedule">
                    </div>
                </div>
                <div class="item">
                <div class="text">
                    <p class="p1">Confirmed</p>
                    <p class="number"><?= $confirmed_app ?></p>
                </div>
                <div class="image">
                    <img src="../pictures/check-circle.png" alt="tick">
                </div>
                </div>
                <div class="item">
                    <div class="text">
                        <p class="p1">Pending</p>
                        <p class="number"><?= $pending_app ?></p>
                    </div>
                    <div class="image">
                        <img src="../pictures/clock.png" alt="pending">
                    </div>
                </div>

            </div>


        <form class="appointments" method="get" action="admin_page.php">

            <div class="search">
                <img src="../pictures/search.png" alt="search icon">
                <input type="text" name="search" placeholder="Search by client name">
            </div>
            <div class="date_input">
                <input type="text" name="dateinput" placeholder="Search by date" onfocus="this.type='date'" onblur="if(!this.value) this.type='text'">
            </div>
            <button type="submit" style="display:none"></button>

        </form>

            <div class="app_list">
                <div class="app_list_header">
                    <h3>Today's appointments - Weekday, Month DD, YYY</h3>
                </div>

                <table class="app_table">
                    <colgroup>
                        <col class="col-time">
                        <col class="col-patient">
                        <col class="col-contact">
                        <col class="col-treatment">
                        <col class="col-dentist">
                        <col class="col-duration">
                        <col class="col-price">
                        <col class="col-status">
                        <col class="col-action">
                    </colgroup>
                    <thead>
                        <tr class=app_header>
                            <th>Time</th>
                            <th>Patient</th>
                            <th>Contact</th>
                            <th>Treatment</th>
                            <th>Dentist</th>
                            <th>Duration</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)):?>
                        <tr class="app_body">
                            <td><?= $row['app']?></td>
                            <td><?= $row['fname']?></td>
                            <td><?= $row['email']?></td>
                            <td><?= $row['t_name']?></td>
                            <td><?= $row['dentist']?></td>
                            <td><?= $row['t_duration']?> min</td>
                            <td><?= $row['price']?></td>
                            <td> <?php if(strtolower($row['status'])==='pending'): ?>
                                    <div class="pending"><p>Pending</p></div>
                                <?php elseif(strtolower($row['status'])==='confirmed'): ?>
                                    <div class="confirmed"><p>Confirmed</p></div>
                                <?php elseif(strtolower($row['status'])==='completed'): ?>
                                    <div class="completed"><p>Completed</p>
                                <?php else: ?>
                                    <div class="canceled"><p>Canceled</p></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="table_links">
                                        <?php if (strtolower($row['status']) === 'pending'): ?>
                                            <a class="confirm" href="confirm_appoitnment.php?id=<?= $row['id']?>">Confirm</a>
                                            <a class="cancel" href="deleteappointment.php?id=<?= $row['id']?>">Cancel</a>
                                        <?php elseif (strtolower($row['status']) === 'confirmed'): ?>
                                            <a class="reactivate" href="complete_appointment.php?id=<?= $row['id'] ?>">Complete</a>
                                            <a class="cancel" href="deleteappointment.php?id=<?= $row['id']?>">Cancel</a>
                                        <?php elseif (strtolower($row['status']) === 'completed'): ?>
                                            <a class="edit" href="edit_appointment.php?id=<?= $row['id'] ?>">Edit</a>
                                        <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile;?>
                    </tbody>



                </table>


            </div>


        </div>

    </div>

    <div class="content">
        <div class="section" id="patients">
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="success-message">
                ✓ Patient has been deleted successfully.
            </div>
            <?php endif; ?>
            <div class="list">
                <?php require 'listallpatients.php'; ?>
                <div class="item">
                    <div class="text">
                        <p class="p2">Total patients</p>
                        <p class="number"><?= $total_people?></p>
                    </div>
                    <div class="image">
                        <img src="../pictures/users.png" alt="users" id="schedule">
                    </div>
                </div>
                <div class="item">
                    <div class="text">
                        <p class="p3">Active patients</p>
                        <p class="number"><?= $active_people?></p>
                    </div>
                    <div class="image">
                        <img src="../pictures/check-circle.png" alt="tick">
                    </div>
                </div>
                <div class="item">
                    <div class="text">
                        <p class="p3">Inactive patients</p>
                        <p class="number"><?= $inactive_people?></p>
                    </div>
                    <div class="image">
                        <img src="../pictures/user-plus.png" alt="new patients">
                    </div>
                </div>
            </div>

            <div class="patient_list">
                <h3>Patient Database</h3>

                <form class="patients" method="get" action="">
                    <img src="../pictures/search.png" alt="search icon">
                    <input type="hidden" name="tab" value="patients">
                    <input type="text" name="patient_search" placeholder="Search by patient name">
                    <button type="submit" style="display:none"></button>

                </form>

                <div>

                    <table class="pat_table">
                        <colgroup>
                            <col class="col-name">
                            <col class="col-email">
                            <col class="col-phone">
                            <col class="col-dob">
                            <col class="col-status">
                            <col class="col-action">
                        </colgroup>
                        <thead>
                        <tr class=pat_header>
                            <th>Patient name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Date of birth</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>

                        <tbody>
                        <?php while($people_row = mysqli_fetch_assoc($people_result)):?>
                            <tr class="pat_body">
                                <td><?= $people_row['first_name'] . " " . $people_row['last_name']?></td>
                                <td><?= $people_row['email']?></td>
                                <td><?= $people_row['phone']?></td>
                                <td><?= $people_row['DOB']?></td>

                                <td><div class="status"><p><?= $people_row['p_status']?></p></div></td>
                                <td>
                                    <div class="table_links">
                                        <a  class="cancel" href="deletepatient.php?id=<?= $people_row['pid']?>" >Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile;?>
                        </tbody>

                    </table>
                </div>
                </div>

        </div>
    </div>

        <div class="content">
             <div class="section" id="treatments">
                 <?php require 'treatments_cards.php';?>
                 <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                     <div class="success-message">
                         ✓ New treatment has been added successfully!
                     </div>
                 <?php elseif (isset($_GET['deactivate']) && $_GET['deactivate'] == 1): ?>
                 <div class="success-message">
                     ✓ Treatment has been deactivated successfully.
                 </div>
                 <?php elseif (isset($_GET['activate']) && $_GET['activate'] == 1): ?>
                     <div class="success-message">
                         ✓ Treatment has been reactivated successfully.
                     </div>
                 <?php endif; ?>
                 <div class="list">

                     <div class="item">
                         <div class="text">
                             <p class="p1">Total</p>
                             <p class="number"> <?= $total_treatment ?> </p>
                         </div>
                         <div class="image">
                             <img src="../pictures/stethoscope.png" alt="stethoscope" id="schedule">
                         </div>
                     </div>
                     <div class="item">
                         <div class="text">
                             <p class="p1">Active</p>
                             <p class="number"> <?= $active_treatment ?> </p>
                         </div>
                         <div class="image">
                             <img src="../pictures/check-circle.png" alt="tick">
                         </div>
                     </div>
                     <div class="item">
                         <div class="text">
                             <p class="p1">Categories</p>
                             <p class="number"> <?= $categories_treatment ?> </p>
                         </div>
                         <div class="image">
                             <img src="../pictures/boxes.png" alt="categories">
                         </div>
                     </div>
                 </div>

                 <form class="treatments" method="get" action="admin_page.php">
                     <?php require 'treatments_search.php';?>
                     <input type="hidden" name="tab" value="treatments">
                     <div class="treatment_search">
                         <img src="../pictures/search.png" alt="search icon">
                         <input type="text" name="treatment_search" placeholder="Search by treatment name or category">
                     </div>
                     <div class="add_treat">
                         <a href="add_new_treatment.php">Add New Treatment</a>
                     </div>
                 </form>

                 <div class="treat_list">
                     <div class="treat_list_header">
                         <h3>Treatment Catalog</h3>
                     </div>

                     <table class="treat_table">
                         <colgroup>
                             <col class="col-name">
                             <col class="col-duration">
                             <col class="col-price">
                             <col class="col-category">
                             <col class="col-status">
                             <col class="col-action">
                         </colgroup>
                         <thead>
                         <tr class=treat_header>
                             <th>Name</th>
                             <th>Duration</th>
                             <th>Price</th>
                             <th>Category</th>
                             <th>Status</th>
                             <th>Action</th>
                         </tr>
                         </thead>

                         <tbody>
                         <?php while($row_t=mysqli_fetch_assoc($query_t_search)): ?>
                         <tr class="treat_body">
                             <td> <?= $row_t['tName'] ?> </td>
                             <td> <?= $row_t['tDuration'] ?> min</td>
                             <td> <?= $row_t['tPrice'] ?> KM</td>
                             <td> <?= $row_t['cName'] ?> </td>
                             <td> <?php if($row_t['tStatus']==='active'): ?>
                                 <div class="status"><p>Active</p></div>
                                <?php else: ?>
                                 <div class="status_inactive"><p>Inactive</p></div>
                                 <?php endif; ?>
                                </td>
                             <td>
                                 <div class="table_links">
                                     <a class="edit" href="edit_treatment.php?tid=<?= $row_t['tid'] ?>">Edit</a>
                                     <?php if ($row_t['tStatus'] === 'active'): ?>
                                        <a class="cancel" href="set_status_treatment.php?tid=<?= $row_t['tid'] ?>&action=deactivate">Deactivate</a>
                                     <?php else: ?>
                                        <a class="reactivate" href="set_status_treatment.php?tid=<?= $row_t['tid'] ?>&action=activate">Reactivate</a>
                                     <?php endif; ?>
                                 </div>
                             </td>
                         </tr>
                         <?php endwhile; ?>
                         </tbody>




                     </table>

                 </div>

             </div>
        </div>



        <div class="content">
            <div class="section" id="dentists">
                <?php require 'list_all_dentists.php';?>
                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    <div class="success-message">
                        ✓ New dentist has been added successfully!
                    </div>
                <?php elseif (isset($_GET['delete']) && $_GET['delete'] == 1): ?>
                    <div class="success-message">
                        ✓ Dentist has been removed successfully.
                    </div>
                <?php endif; ?>
                <div class="list">

                    <div class="item">
                        <div class="text">
                            <p class="p1">Total dentists</p>
                            <p class="number"> <?= $total_dentists; ?> </p>
                        </div>
                        <div class="image">
                            <img src="../pictures/stethoscope.png" alt="stethoscope" id="schedule">
                        </div>
                    </div>
                    <div class="item">
                        <div class="text">
                            <p class="p1">Active</p>
                            <p class="number"> <?= $tot_spec; ?> </p>
                        </div>
                        <div class="image">
                            <img src="../pictures/check-circle.png" alt="tick">
                        </div>
                    </div>
                    <div class="item">
                        <div class="text">
                            <p class="p1">Inactive</p>
                            <p class="number"> <?= $tot_active; ?> </p>
                        </div>
                        <div class="image">
                            <img src="../pictures/boxes.png" alt="categories">
                        </div>
                    </div>
                </div>

                <form class="treatments" method="get" action="admin_page.php">
                    <?php require 'list_all_dentists.php';?>
                    <input type="hidden" name="tab" value="dentists">
                    <div class="treatment_search">
                        <img src="../pictures/search.png" alt="search icon">
                        <input type="text" name="dentist_search" placeholder="Search by dentist name">
                    </div>
                    <div class="add_treat">
                        <a href="add_new_dentist.php">Add New Dentist</a>
                    </div>
                </form>

                <div class="patient_list">
                    <h3>Dentist Database</h3>

                    <!--form class="patients" method="get" action="">
                        <img src="../pictures/search.png" alt="search icon">
                        <input type="hidden" name="tab" value="patients">
                        <input type="text" name="patient_search" placeholder="Search by patient name">
                        <button type="submit" style="display:none"></button>

                    </form-->

                    <div>

                        <table class="pat_table">
                            <colgroup>
                                <col class="col-name">
                                <col class="col-email">
                                <col class="col-phone">
                                <col class="col-dob">
                                <col class="col-status">
                                <col class="col-action">
                            </colgroup>
                            <thead>
                            <tr class=pat_header>
                                <th>Dentist name</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Specialty</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php while($dent_row = mysqli_fetch_assoc($dentist_result)):?>
                                <tr class="pat_body">
                                    <td><?= $dent_row['first_name'] . " " . $dent_row['last_name']?></td>
                                    <td><?= $dent_row['email']?></td>
                                    <td><?= $dent_row['phone']?></td>
                                    <td><?= $dent_row['name']?></td>

                                    <td><div class="status"><p><?= $dent_row['d_status']?></p></div></td>
                                    <td>
                                        <div class="table_links">
                                            <a  class="cancel" href="deletedentist.php?id=<?= $dent_row['did']; ?>" >Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile;?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>

    <div class="content">
        <div class="section" id="analytics">

            <?php require 'month_revenue.php'; ?>
            <div class="patient_list">
                <h3> Monthly revenue</h3>
                <div class="analytics_div">
                    <div class="month">
                        <div class="month_analytics">
                            <span id="month"><?= $month_one['month_name']; ?></span>
                            <span id="money"><?= $month_one['total_rev']; ?>KM</span>
                        </div>

                        <div class="bar">
                            <div class="bar_fill mon"></div>
                        </div>
                    </div>
                </div>
                <div class="patient_list">
                    <div class="analytics_div">
                        <div class="month">
                            <div class="month_analytics">
                                <span id="month"><?= $month_two['month_name']; ?></span>
                                <span id="money"> <?= $month_two['total_rev']; ?>KM</span>
                            </div>
                            <div class="bar">
                                <div class="bar_fill mon"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="section" id="settings">

            </div>
        </div>

        <div class="content">
            <div class="section" id="settings">
                <?php if (isset($_GET['infosuccess']) && $_GET['infosuccess'] == 1): ?>
                    <div class="success-message">
                        ✓ Personal information edited successfully!
                    </div>
                <?php endif; ?>
                <div>
                    <div class="settings">

                    <h3>Personal Information</h3>
                    <div class="settings_flex">
                        <div class="settings_item">
                            <div class="left">
                                <img src="../pictures/icon-user.png" alt="user icon">
                                <div class="item_text">
                                    <h4>Full name</h4>
                                    <p> <?= $sql['first_name']; ?>
                                        <?= $sql['last_name']; ?></p>
                                </div>
                            </div>
                            <button type="button" onclick="window.location.href='edit_admin.php?id=<?= $_SESSION['person_id'];?>'">Edit</button>
                        </div>

                        <div class="settings_item">
                            <div class="left">
                                <img src="../pictures/icon-calendar.png" alt="calendar icon">
                                <div class="item_text">
                                    <h4>Date of birth</h4>
                                    <p> <?= $sql['DOB']; ?></p>
                                </div>
                            </div>
                            <button type="button" onclick="window.location.href='edit_admin.php?id=<?= $_SESSION['person_id'];?>'">Edit</button>
                        </div>

                        <div class="settings_item">
                            <div class="left">
                                <img src="../pictures/icon-phone.png" alt="phone icon">
                                <div class="item_text">
                                    <h4>Phone number</h4>
                                    <p><?= $sql['phone']; ?></p>
                                </div>
                            </div>
                            <button type="button" onclick="window.location.href='edit_admin.php?id=<?= $_SESSION['person_id'];?>'">Edit</button>
                        </div>
                    </div>

                    <h3>Account & Security</h3>
                    <div class="settings_flex">
                        <div class="settings_item">
                            <div class="left">
                                <img src="../pictures/icon-mail.png" alt="mail icon">
                                <div class="item_text">
                                    <h4>Email</h4>
                                    <p><?= $sql['email']; ?></p>
                                </div>
                            </div>
                            <button type="button" onclick="window.location.href='edit_admin.php?id=<?= $_SESSION['person_id'];?>'">Edit</button>
                        </div>

                        <div class="settings_item">
                            <div class="left">
                                <img src="../pictures/icon-lock.png" alt="lock icon">
                                <div class="item_text">
                                    <h4>Password</h4>
                                </div>
                            </div>
                            <button type="button" onclick="window.location.href='edit_admin.php?id=<?= $_SESSION['person_id'];?>'">Edit</button>
                        </div>
                    </div>

                    <h3>Delete Account</h3>
                    <div class="settings_flex">
                        <div class="settings_item">
                            <div class="left">
                                <img src="../pictures/icon-trash.png" alt="trash icon">
                                <div class="item_text">
                                    <h4 class="delete_text">Delete account</h4>
                                    <p class="delete_p" id="delete_acc_text" style="color:white;">This is permanent and cannot be undone!</p>
                                </div>
                            </div>
                            <button type="button" onclick="window.location.href='delete_admin.php?id=<?= $_SESSION['person_id'];?>'">Delete</button>
                        </div>

                    </div>
                </div>
            </div>




</main>

<footer>
    <div class="end">
        &copy; All rights reserved S&N 2026
    </div>
</footer>

</body>
</html>
