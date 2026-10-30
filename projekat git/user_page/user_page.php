<?php

session_start();
require_once '../db_credentials.php';
include 'popular_appointments.php';
include 'appointment_history.php';

if($_SESSION['is_admin'] !== false){
    header('Location: ../login/login.php');
    exit;
}


$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");
$query = mysqli_query($conn, "select * from people where pid = '{$_SESSION['person_id']}'");
$sql = mysqli_fetch_assoc($query);

$treatments = mysqli_query($conn, "SELECT tid, t_name FROM treatment WHERE lower(t_status) = 'active'");

$time_slots = [];
$start      = strtotime('08:00');
$end        = strtotime('17:00');
while ($start <= $end) {
    $time_slots[] = date('H:i', $start);
    $start = strtotime('+30 minutes', $start);
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
    <title>Dentin - User Panel</title>
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
            font-family: "Montserrat", sans-serif;
            color: #EDBC7F;
            text-decoration: none;
        }
        nav a:hover, #span a:hover{
            transform: scale(1.1);
        }
        #span{
            background-color: darkgoldenrod;
            height: 30px;
            width: 125px;
            align-items: flex-end;
            text-align: center;
            border-radius: 2px;
            align-content: center;
            color: white;
            flex-wrap: wrap;
        }

        main{
            max-width: 1100px;
            margin: 0 auto;
           /* padding: 48px 28px 80px;*/
            width: 100%;
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
            grid-template-columns: 1fr 1.3fr 1fr;
            gap: 20px;
            width: 100%;
            margin: 0 0 40px 70px;
            max-width: 700px;
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

        #overview:checked ~ .tabs label[for="overview"],
        #appointment_history:checked ~ .tabs label[for="appointment_history"],
        #settings:checked ~ .tabs label[for="settings"]{
            background: #1E2B3C;
            color: #E8BC72;
            box-shadow: 0 2px 12px rgba(30,43,60,.20);
        }

        .section {
            display: none;
            margin-bottom: 40px;
        }

        #overview:checked ~ .content #overview,
        #appointment_history:checked ~ .content #appointment_history,
        #settings:checked ~ .content #settings{
            display:block;
        }

        html{
            scroll-behavior: smooth;
        }

        footer{
            background: #212A35;
            color: #EDBC7F;
            width: 100%;
            min-height: 15vh;
            justify-content: space-around;
            align-items: center;
            font-family: "Montserrat", sans-serif;
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

        .grid{
            background: #FFFFFF;
            border-radius: 24px;
            padding: 36px 36px 40px;
            display: grid;
            box-shadow: 0 8px 40px rgba(30,43,60,.13), 0 2px 8px rgba(30,43,60,.07);
            grid-template-columns: repeat(2,2fr);
            grid-template-rows: repeat(5,2fr);
            margin: 0 auto 30px auto;
            justify-content: center;
            align-items: center;
            text-align: center;
            align-content: center;
            gap: 20px;
            max-width: 1200px;
            width: 100%;
            border: 1px solid rgba(30,43,60,.06);
            border-top: 4px solid  #1E2B3C;
            box-sizing: border-box;
        }

        .title {
            font-family: 'Cormorant Garamond', serif;
            text-align: center;
            align-self: center;
            font-size: 25px;
            font-weight: 600;
            color:  #1E2B3C;
            letter-spacing: .05em;
            text-transform: uppercase;
            margin: 10px auto 20px auto;
            padding-bottom: 10px;
            padding-left: 10px;
            padding-top: 10px;
            grid-column-start: 1;
            grid-column-end: -1;
        }
        .grid h3{

            font-family: "Montserrat", sans-serif;
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
            justify-content: space-between;
            padding: 18px 22px;
            background:  #FAF5EA;
            border: 1px solid rgba(201,150,58,.18);
            border-radius: 16px;
            align-items: center;
            margin: 0 auto;
            max-width: 400px;
            width: 100%;
            font-weight: 700;
            color: #EDBC7F;
            line-height: 1.8;
            box-shadow: 0 2px 10px rgba(0,0,0,.10);
            transition: border-color .2s, box-shadow .2s, transform .15s;
        }
        .item:hover{
            border-color: rgba(201,150,58,.40);
            box-shadow: 0 6px 22px rgba(0,0,0,.14);
            transform: translateY(-1px);
        }
        .p1{
            font-size: 16px;
            font-weight: 500;
            color:#1E2B3C;
            flex: 1;
            word-break: break-word;
        }

        .price{
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 600;
            color: #C9963A;
            flex-shrink: 0;
            margin: 0 0 0 16px;
        }
        .price span{
            font-size: 15px;
        }
        #book{
            grid-column-start: 1;
            grid-column-end: -1;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 250px;
            background: linear-gradient(135deg, #E8BC72 0%, #E8BC72 100%);
            margin: 0 auto;
            height: 40px;
            border-radius: 15px;
            padding-top: 20px;
            box-shadow: 0 4px 20px rgba(201,150,58,.22), 0 1px 0 rgba(0,0,0,.06);
            cursor: pointer;
        }

        main{
            margin-bottom: 100px;
        }
        #book a{
            margin: 0 auto;
            text-align: center;
            align-self: center;
            color: #1E2B3C;
            border: none;
            border-radius: 100px;
            font-size: 17px;
            align-items: center;
            letter-spacing: .04em;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            font-weight: 800;
        }
        #book:hover {
            box-shadow: 0 0 0 4px rgba(232,185,106,.25), 0 0 0 8px rgba(232,185,106,.10);
            transform: translateY(-2px);
            transition: box-shadow .22s ease, transform .22s ease;
        }

        main{
            margin-bottom: 100px;
        }

    #form{
        overflow: hidden;
        max-height: 0;
        opacity: 0;
      /* An example: transition: opacity 0.4s ease;*/
        scroll-margin-top: 24px;
        transition: opacity 0.5s cubic-bezier(0, 0.24, 1, 1);
    }

    #form:target{
        background-color: #EDBC7F;
        max-height: 600px;
        width: 800px;
        margin: 0 auto;
        border-radius: 15px;
        opacity: 1;


    }
    #title{
        display: flex;
        justify-content: space-between;
        text-align: center;
        align-items: center;
        background: #1E2B3C;
        padding: 21px 29px 28px;
    }
    #title h2{
        margin: 0;
        padding-left: 5px;
        font-family: 'Cormorant Garamond', serif;
        font-size: 24px;
        font-weight: 400;
        font-style: italic;
        color: #FFFFFF;
        letter-spacing: .01em;
    }
    #title #close{
        color: lightgray;
        text-decoration: none;
        background: rgba(255,255,255,.08);
        border-radius: 50%;
        margin-right: 20px;
        text-align: center;
        width: 30px;
        height: 20px;
        border: 1px solid rgba(255,255,255,.12);
        cursor: pointer;
        flex-shrink: 0;
        transition: background .2s, border-color .2s;
    }
        #title #close:hover{
            background: rgba(255,255,255,.16);
            border-color: rgba(255,255,255,.25);
        }

    form{
        display: grid;
        grid-template-columns: repeat(2,2fr);
        gap: 10px;
        align-items: center;
        padding: 32px 36px 36px;
        background: #FFFFFF;
        max-width: 800px;
        margin: 0 auto;
        box-shadow:  0 16px 48px rgba(30,43,60,.11);
        overflow: hidden

    }

        .field{
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 0 15px;
        }

        .field label{
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .09em; text-transform: uppercase;
            color: #C9963A;
            opacity: 0.9;
        }

        input, select{
            background: #F7F5F0;
            font-size: 16px;
            padding: 10px 12px;
            width: 100%;
            border: 1.5px solid rgba(30,43,60,.10);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            color: #1E2B3C;
            outline: none;
            box-shadow: 0 2px 8px  rgba(30,43,60,.06);
            transition: border-color .2s, box-shadow .2s, background .2s;
            appearance: none; -webkit-appearance: none;

    }
    input::placeholder, select, input[type="date"], input[type="time"]{
        color: #212A35;
        font-family: "Montserrat", sans-serif;
    }
    #submit{
        grid-column-start: 1;
        grid-column-end: -1;
        text-align: center;
        padding-bottom: 10px;
        margin-top: 10px;

    }
        button{
            background-color: #2C3D52;
            color: #E8BC72;
            border-radius: 15px;
            border: none;
            text-align: center;
            height: 40px;
            width: 130px;
            font-family: 'DM Sans', sans-serif;
            align-self: center;
            align-items: center;
            align-content: center;
            font-size: 20px;
            margin-bottom: 10px;
            margin-top: 10px;
            cursor: pointer;
            box-shadow: 0 6px 24px rgba(30,43,60,.09), 0 4px 20px rgba(201,150,58,.22);
            transition:  background 0.18s ease, box-shadow 0.18s ease, transform 0.13s ease, color 0.18s ease;
        }
        button:hover {
            background: #2C3D52;
            color: #E8BC72;
            box-shadow: 0 16px 48px rgba(30,43,60,.11), 0 6px 28px rgba(201,150,58,.32);
            transform: translateY(-2px);
        }

        button:active {
            background: #1E2B3C;
            color: #C9963A;
            box-shadow: 0 2px 8px  rgba(30,43,60,.06);
            transform: translateY(0);
        }

        button:focus-visible {
            outline: 2px solid #C9963A;
            outline-offset: 3px;
        }
    #tname_input, #date_input, #time_input{
        text-align: center;
        align-items: center;
        align-content: center;
    }

    #time_input{
        grid-column-start: 1;
        grid-column-end: -1;
        margin-top: 20px;
    }

    #time{
        align-items: center;
        max-width: 400px;
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

        .message{
            font-family: 'DM Sans', sans-serif;
            background-color: #ffcec8;
            color: #fa370d;
            border: 1px solid #bc5555;
            border-radius: 8px;
            padding: 14px 20px;
            margin: 10px auto 20px auto;
            max-width: 900px;
            font-size: 15px;
            font-weight: 520;
        }

        .history{
            background: #FFFFFF;
            box-shadow: 0 8px 40px rgba(30,43,60,.13), 0 2px 8px rgba(30,43,60,.07);
            border: 1px solid rgba(30,43,60,.06);
            border-top: 4px solid  #1E2B3C;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            max-width: 1250px;
            width: 100%;
            box-sizing: border-box;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .his_item{
            display: flex;
            border-left: 4px solid #C9963A;;
            border-radius: 10px;
            padding: 20px 20px 0 20px;
            margin-top: 20px;
            gap: 15px;
            justify-content: space-between;
            transition: all 0.3s ease;
            background: #FAF5EA;
        }

        .his_item:hover{
            box-shadow: 0 0 16px rgba(237, 188, 127, 0.4);
        }

        .status{
            /*background: #D6F4DF;*/

        }

        .status p{
            font-family: "Montserrat", sans-serif;
            margin: 0;
            font-weight: bolder;
            color: #008236;
        }

        .pending{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            border: 1px solid #FAC775;
            border-radius: 20px;
            background: #FAEEDA;
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

        .history h2{
            margin: 0;
            box-sizing: border-box;
            font-family: 'Cormorant Garamond', serif;
            font-size: 25px;
            font-weight: 600;
            color:  #1E2B3C;
            letter-spacing: .05em;
            text-transform: uppercase;
            text-align: center;
            grid-column-start: 1;
            grid-column-end: -1;
        }

        .his_item h5 {
            font-family: 'Cormorant Garamond', serif;
            color:  #2C3D52;
            font-size: 30px;
            font-weight: 600;
            margin: 0 0 5px 0;
        }

        .duo{
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 10px;
        }

        .duo img{
            height: 25px;
            width: 25px;
        }

        .item_data p {
            font-family: 'DM Sans', sans-serif;
            color:  #2C3D52;
            font-size: 15px;
            align-self: center;
            margin: 13px 0 10px 0;
        }


        .notes{
            padding: 10px 15px;
            margin-top: 5px;
            border-radius: 10px;
            background: #F2E6CE;
            border: 0.5px solid rgba(255, 255, 255, 0.1);
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

        @media screen and (max-width: 1260px){
            .history{
                max-width: 1000px;
            }
        }

        @media screen and (max-width: 1000px){
            .history{
                max-width: 800px;
            }

            .settings{
                max-width: 800px;
            }
        }
        @media screen and (max-width: 945px){
            .item{
                width: 70%;
            }
        }
        @media screen and (max-width: 799px){
            .grid{
                width: 600px;
            }

            .tabs{
                margin: 0 auto 40px auto;
                max-width: 700px;
                width: 100%;
            }

            .history{
                max-width: 700px;
                grid-template-columns: 1fr;
            }

            .settings{
                max-width: 600px;
            }
            #form:target{
                width: 600px;
            }
        }

        @media screen and (max-width: 768px) {
            header {
                height: 150px;
            }

            .logo {
                max-width: 250px;
            }

            nav {
                flex-direction: column;
                align-items: center;
                justify-content: center;
                width: 300px;
                height: 150px;
            }

            #span {
                height: 30px;
                width: 200px;
            }

            .tabs{
                grid-template-columns: 1fr 1.5fr 1fr;
                margin: 0 auto 40px auto;
                max-width: 650px;
                width: 100%;
            }

            .history{
                max-width: 650px;
            }
        }

        @media screen and (max-width: 700px) {
            .tabs{
                grid-template-columns: 1fr 1.8fr 1fr;
                margin: 0 auto 40px auto;
                max-width: 600px;
                width: 100%;
            }

            .history{
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
                padding-left: 0;
            }
            .tabs{
                margin-left: 0;
            }

            .grid, #form{
                grid-template-columns: 1fr;
                width: 300px;
            }
            .grid #book{
                margin-bottom: 5px;

            }
            .grid{
                width: 400px;
            }

            .p1{
                font-size: 15px;
            }

            .item{
                padding: 14px 18px;
            }

            /* #title a{
                 display: none;
             }*/
            form{
                grid-template-columns: 1fr;
                padding: 22px 26px;
            }
            #form{
                max-width: 300px;
                grid-template-columns: 1fr;

            }
            #name_input, #tname_input, #date_input, #phone_input, #time_input, #type_input{
                text-align: left;
                align-items: flex-end;
                width: 70%;
                margin: 0 auto;
            }
            input{
                width: 90%;
            }

            #date_input, #time_input, #tname_input{
               align-items: center;
            }
            #title{
                font-size: 10px;
                display: flex;
                justify-content: space-between;
                flex-direction: row;
            }

            .tabs{
                justify-self: center;
                margin: 0 auto 40px auto;
                max-width: 550px;
                width: 100%;
            }

            .history{
                max-width: 550px;
            }

            .tabs label{
                font-size: 17px;
                padding: 5px 10px;
            }

            .settings{
                max-width: 500px;
            }
        }
        @media screen and (max-width: 520px){
            .user_header{
                font-size: 35px;
                margin: 0 auto;
                padding-bottom: 20px;
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

            .tabs{
                margin: 0 auto 40px auto;
                max-width: 400px;
                width: 100%;
            }

            .tabs label{
                font-size: 16px;
                padding: 5px 10px;
            }

            .grid{
                padding: 0;
            }

            .p1{
                font-size: 14px;
            }

            .item{
                padding: 14px 18px;
            }

            .settings, .history{
                max-width: 400px;
            }

            .title{
                font-size: 22px;
                margin-bottom: 0;
            }

            .his_item h5 {
                font-size: 25px;
            }

            .his_item{
                flex-direction: column;
                padding-bottom: 10px;
            }

            h4{
                font-size: 20px;
            }

            .item_text p{
                font-size: 15px;
            }

            .settings_item button{
                width: 70px;
                font-size: 18px;
            }
        }

        @media screen and (max-width: 400px){
            .grid{
                width: 300px;
            }
        }

        @media screen and (max-width: 360px){
            .tabs{
                margin: 0 auto 40px auto;
                max-width: 300px;
                width: 100%;
            }

            .tabs label{
                font-size: 12px;
                padding: 3px 6px;
            }

            .left{
                gap: 10px;
            }

            h4{
                font-size: 16px;
            }

            .item_text p{
                font-size: 12px;
            }

            .history{
                max-width: 300px;
                padding: 20px;
            }

            .history h2{
               font-size: 18px;
            }

            .his_item h5 {
                font-size: 20px;
            }

            .his_item{
                padding: 10px;
                flex-direction: column;
            }

            .status {
                padding: 2px 6px 1px 6px;
            }

            .status p, .duo p{
                font-size: 13px;
            }

            .item_data p{
                font-size: 14px;
            }

            .notes{
                padding: 8px;
            }

            .notes strong{
                font-size: 13px;
            }

            .item_data p:last-child{
                margin-top: 10px;
            }

            .settings_item button{
                width: 60px;
                font-size: 16px;
            }

            .delete_text{
                font-size: 18px;
            }
            .delete_p{
                font-size: 11px;
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

    <a href="log_out.php" class="logout">Log out</a>

</header>

<main>
    <div class="user_header">Welcome back, <span><?= $_SESSION['name']; ?>!</span></div>

    <input type="radio" name="tab" id="overview" checked>
    <input type="radio" name="tab" id="appointment_history"<?= (!empty($_GET['tab']) && $_GET['tab']==='appointment_history') ? 'checked': ''; ?>>
    <input type="radio" name="tab" id="settings" <?= (!empty($_GET['tab']) && $_GET['tab']==='settings') ? 'checked': ''; ?>>

    <div class="tabs">
        <label for="overview">Overview</label>
        <label for="appointment_history">My Appointments</label>
        <label for="settings">Settings</label>
    </div>



    <div class="content">
        <div class="section" id="overview">
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div class="success-message">
                    ✓ Your appointment has been booked successfully!
                </div>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
                <div class="message">
                    This slot/dentist is already taken!
                </div>
            <?php endif; ?>
            <div class="grid">
                <p class="title">Most popular appointments</p>
                <?php  while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="item">
                    <p class="p1"><?= $row['treatment_name']; ?></p>
                    <p class="price"><?= $row['price']; ?> <span>KM</span></p>
                </div>
                <?php endwhile;?>

                <div id="book">
                    <a href="#form"> Book an appointment </a>
                </div>

            </div>

            <?php if (!empty($_SESSION['success'])): ?>
                <div style="color: green;"><?= $_SESSION['success'] ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])): ?>
                <div style="color: red;"><?= $_SESSION['error'] ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>


            <div id="form">

                <div id="title">
                    <h2>Book an appointment</h2>
                    <a href="#overview" id="close">x</a>
                </div>

                <form method="post" action="process_app.php">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['person_id']; ?>">
                    <input type="hidden" id="name" name="name" placeholder="Name" value="<?= $sql['first_name']; ?>">
                    <input type="hidden" id="sname" name="sname" placeholder="Surname" value="<?= $sql['last_name']; ?>">


                    <div id="tname_input" class="field">
                        <label>Treatment name</label>
                        <select id="treatment" name="treatment" required>
                            <option value="" disabled selected hidden>Choose a treatment</option>
                            <?php while ($row = mysqli_fetch_assoc($treatments)): ?>
                                <option value="<?= $row['tid'] ?>"><?= $row['t_name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>


                    <div id="date_input" class="field">
                        <label>Date</label>
                        <input type="text" id="date" name="date" placeholder="Choose a date" onfocus="this.type='date'" onblur="if(!this.value) this.type='text'">
                    </div>

                    <div id="time_input" class="field">
                        <label>Time</label>
                        <select id="time" name="time" required>
                            <option value="" disabled selected hidden>Choose a time slot</option>
                            <?php foreach ($time_slots as $slot): ?>
                                <option value="<?= $slot ?>"><?= $slot ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div id="submit">
                        <button type="submit">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="content">
        <div class="section" id="appointment_history">
            <div class="history">
                <h2>My Appointments</h2>
                <?php while($row_app = mysqli_fetch_assoc($sql_app_his)):?>
                    <div class="his_item">
                            <div class="item_data">
                                <h5><!--Appointment name--> <?= $row_app['t_name']; ?></h5>
                            <div class="duo">
                                <img src="../pictures/icon-calendar.png" alt="calendar icon">
                                <p><strong>Date: </strong><?= $row_app['start']; ?></p>
                            </div>
                            <div class="duo">
                                <img src="../pictures/icon-user.png" alt="user icon">
                                <p><strong>Dentist: </strong><?= $row_app['dentist_name']; ?></p>
                            </div>
                            <div class="duo">
                                <img src="../pictures/coins.png" alt="coin icon">
                                <p><strong>Price: </strong><?= $row_app['price']; ?> KM</p>
                            </div>
                            <p class="notes"><strong>Notes: </strong> <?= $row_app['notes']; ?></p>
                        </div>
                            <?php if(strtolower($row_app['status'])==='pending'): ?>
                                <div class="pending"><p>Pending</p></div>
                            <?php elseif(strtolower($row_app['status'])==='confirmed'): ?>
                                <div class="confirmed"><p>Confirmed</p></div>
                            <?php elseif(strtolower($row_app['status'])==='completed'): ?>
                            <div class="completed"><p>Completed</p></div>
                                <?php else: ?>
                                    <div class="canceled"><p>Canceled</p></div>
                                <?php endif; ?>
                    </div>
                <?php endwhile;?>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="section" id="settings">

            <?php if (isset($_GET['editsuccess']) && $_GET['editsuccess'] == 1): ?>
                <div class="success-message">
                    ✓ Personal information edited successfully!
                </div>
            <?php endif; ?>

            <div class="settings">

                <h3>Personal Information</h3>
                <div class="settings_flex">
                    <div class="settings_item">
                        <div class="left">
                            <img src="../pictures/icon-user.png" alt="user icon">
                            <div class="item_text">
                                <h4>Full name</h4>
                                <p> <?= $sql['first_name']; ?>
                                    <?= $sql['last_name']; ?>
                                </p>
                            </div>
                        </div>
                        <button type="button" onclick="window.location.href='edit_user.php?id=<?= $_SESSION['person_id'];?>'">Edit</button>
                    </div>

                    <div class="settings_item">
                        <div class="left">
                            <img src="../pictures/icon-calendar.png" alt="calendar icon">
                            <div class="item_text">
                                <h4>Date of birth</h4>
                                <p><?= $sql['DOB']; ?></p>
                            </div>
                        </div>
                        <button type="button" onclick="window.location.href='edit_user.php?id=<?= $_SESSION['person_id'];?>'">Edit</button>
                    </div>

                    <div class="settings_item">
                        <div class="left">
                            <img src="../pictures/icon-phone.png" alt="phone icon">
                            <div class="item_text">
                                <h4>Phone number</h4>
                                <p><?= $sql['phone']; ?></p>
                            </div>
                        </div>
                        <button type="button" onclick="window.location.href='edit_user.php?id=<?= $_SESSION['person_id'];?>'">Edit</button>
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
                        <button type="button" onclick="window.location.href='edit_user.php?id=<?= $_SESSION['person_id'];?>'">Edit</button>
                    </div>

                    <div class="settings_item">
                        <div class="left">
                            <img src="../pictures/icon-lock.png" alt="lock icon">
                            <div class="item_text">
                                <h4>Password</h4>
                            </div>
                        </div>
                        <button type="button" onclick="window.location.href='edit_user.php?id=<?= $_SESSION['person_id'];?>'">Edit</button>
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
                        <button type="button" onclick="window.location.href='delete_user.php?id=<?= $_SESSION['person_id'];?>'">Delete</button>
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
