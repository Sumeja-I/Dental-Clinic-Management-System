<?php

    include 'list_treatments.php';

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
    <title>Dentin - Services</title>
    <link rel="favicon" href="../pictures/tooth.png">
    <style>
        *{
            margin: 0;
        }
        body{
            font-family: 'DM Sans', sans-serif;
            background: #F7F5F0;
        }
        header {
            display: flex;
            background: #1E2B3C;
            height: 150px;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px 0 60px;
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
        nav{
            display: flex;
            justify-content: space-around;
            width: 600px;
            flex-shrink: 0;
            align-items: flex-end;
        }
        nav a{
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            color: #E8BC72;
            font-size: 17px;
            font-weight: 400;
            letter-spacing: .03em;
            padding: 8px 16px;
            border-radius: 20px;
            transition: color 0.2s ease, background 0.2s ease;
        }
        nav a:hover{
            transform: scale(1.1);
        }
        #span{
            height: 30px;
            width: 210px;
            align-items: flex-end;
            text-align: center;
            border-radius: 20px;
            align-content: center;
            flex-wrap: wrap;
            background: #C9963A;
            font-weight: 500;
            padding: 4px 10px;
            border: none;
            text-decoration: none;
            transition: background 0.25s ease, box-shadow 0.25s ease, transform 0.2s ease;
        }

        #span a{
            color: white;
            font-size: 16px;
        }
        #span:hover, #span a:hover{
            background: #D4A84B;
            box-shadow: 0 4px 20px rgba(201,150,58,.45);
            transform: translateY(-2px);
        }

        .service_header {
            font-family: 'Cormorant Garamond', serif;
            color: #E8BC72;
            text-align: center;
            font-size: 4.375rem;
            width: 100%;
            font-weight: 600;
            margin: 50px 0 16px;
        }
        .services_header_underline{
            display: block;
            width: 60px;
            height: 2px;
            background: #C9963A;
            margin: 0 auto 25px;
            border-radius: 2px;
        }

        input[type="radio"]{
            display: none;
        }

        .tabs{
            display: grid;
            grid-template-columns: 1.3fr repeat(3, 1fr);
            gap: 10px;
            width: 100%;
            margin: 0 auto;
            max-width: 700px;
            justify-content: space-around;
            padding: 0 25px 30px 25px;
            box-sizing: border-box;
        }

        .tabs label{
            font-family: 'DM Sans', sans-serif;
            padding: 10px 20px;
            border-radius: 19px;
            cursor: pointer;
            text-align: center;
            border: 1px solid rgba(30,43,60,.15);
            background: #2C3D52;
            color: #E8BC72;
            box-shadow: 0 6px 24px rgba(30,43,60,.09);
            transition: background 0.25s ease, box-shadow 0.25s ease, transform 0.2s ease, border-color 0.25s ease;
        }

        .tabs label:hover{
            background: #1E2B3C;
            border-color: #C9963A;
            box-shadow: 0 16px 48px rgba(30,43,60,.18), 0 4px 20px rgba(201,150,58,.22);
            transform: translateY(-3px);
            color: #fff;
        }

        .tabs label:active {
            background: #C9963A;
            color: #fff;
            border-color: #C9963A;
            box-shadow: 0 4px 20px rgba(201,150,58,.22);
        }

        .tabs label:hover {
            background: #D4A84B;
            box-shadow: 0 16px 48px rgba(30,43,60,.15), 0 4px 20px rgba(201,150,58,.35);
            transform: translateY(-3px);
        }

        #general_dentistry:checked ~ .tabs label[for="general_dentistry"],
        #orthodontics:checked ~ .tabs label[for="orthodontics"],
        #aesthetics:checked ~ .tabs label[for="aesthetics"],
        #implantology:checked ~ .tabs label[for="implantology"]{
            background: #C9963A;
            color: #fff;
            border-color: #C9963A;
            box-shadow: 0 4px 20px rgba(201,150,58,.22);
        }

        .content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 25px 0 25px;
        }

        .section {
            display: none;
            margin-bottom: 40px;
        }

        #general_dentistry:checked ~ .content #general_dentistry,
        #orthodontics:checked ~ .content #orthodontics,
        #aesthetics:checked ~ .content #aesthetics,
        #implantology:checked ~ .content #implantology{
            display:block;
        }

        .section p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            margin-bottom: 16px;
            font-weight: 600;
            color: #C9963A;
            border-left: 3px solid #C9963A;
            padding-left: 12px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 14px 0;
            border-bottom: 1px solid #C9963A;
            font-family: 'DM Sans', sans-serif;
            border-radius: 8px;
            transition: background 0.2s ease;
            cursor: default;
            color: #212A35;
            font-size: 18px;
        }
        .item:hover {
            background: rgba(201,150,58,.06);
        }

        .item:hover .price {
            color: #C9963A;
        }

        .name {
            font-size: 18px;
            color: #4A607A
        }

        .price {
            font-size: 18px;
            font-weight: 700;
            color: #1E2B3C;
            transition: color 0.2s ease;
        }

        .item:last-child{
            border-bottom: none;
        }

        .item span:first-child {
            flex: 1;
            padding-right: 1.5rem;
        }

        .item span:last-child {
            font-weight: 600;
            white-space: nowrap;
        }

        footer{
            background-color: #1E2B3C;
            color: #E8BC72;
            width: 100%;
            height: 210px;
            justify-content: space-around;
            align-items: center;
            font-family: 'DM Sans', sans-serif;
            display: grid;
            grid-template-columns: repeat(3,2fr);
            grid-template-rows: repeat(2,2fr);
            box-shadow: 0 2px 24px rgba(30,43,60,.28);
        }
        footer div{
            align-items: center;
            text-align: center;

        }
        .location, .contact, .hours{
            display: grid;
            grid-template-rows: repeat(2, 2fr);
        }

        .location p, .contact p, .hours p{
            margin-top: 8px;
            margin-bottom: 8px;
            padding-left: 10px;
        }

        footer h3{
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            margin-top: 22px;
        }

        footer img{
            width: 20px;
            height: 20px;
        }

        .footer_icons{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .end {
            grid-column-start: 1;
            grid-column-end: -1;
            text-align: center;
            align-items: center;
            color: #E8BC72;
            margin-top: 10px;
        }

        @media screen and (max-width: 1000px) {
            header {
                padding: 0 20px 0 40px;
            }
            nav{
                width: 500px;
                align-items: center;
            }
            nav a{
                font-size: 15px;
                padding: 2px 4px;
            }
            #span{
                height: 30px;
                width: 170px;
            }

            #span a{
                color: white;
                font-size: 15px;
            }
        }

        @media screen and (max-width: 815px){

            header {
                height: 200px;
            }
            .header_pic{
                max-width: 250px;
            }
            nav{
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
                width: 300px;
                height: 150px;
            }

            #span{
                height: 30px;
                width: 200px;
                padding: 0 4px 2px 4px;
            }

            .service_header{
                margin-top: 35px;
            }

            .name {
                font-size: 17px;
            }

            .price {
                font-size: 17px;
                font-weight: 600;
            }

            footer{
                height: 185px;
                grid-template-columns: 2.2fr repeat(2,2fr);
            }

            footer h3{
                font-size: 20px;
                font-weight: 700;
                margin-bottom: 5px;
            }

            footer p{
                font-size: 15px;
            }

            .end{
                margin-top: 0;
            }

        }

        @media screen and (max-width: 768px) {
            header {
                height: 200px;
            }
            .header_pic{
                max-width: 250px;
            }
            nav{
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
                width: 300px;
                height: 150px;
            }
            #span{
                height: 30px;
                width: 200px;
            }

            .tabs{
                grid-template-columns: repeat(2, 1fr);
            }

            footer{
                height: 175px;
            }

            footer h3{
                font-size: 18px;
                font-weight: 600;
            }

            footer p{
                font-size: 14px;
                padding-left: 5px;
            }

            .end{
                font-size: 15px;
            }
        }

        @media screen and (max-width: 634px){
            footer{
                height: 165px;
            }

            footer h3{
                font-size: 17px;
                font-weight: 600;
            }

            footer img{
                width: 15px;
                height: 15px;
            }

            footer p{
                font-size: 13px;
                padding-left: 3px;
            }

            .end{
                font-size: 13px;
            }
        }

        @media screen and (max-width: 568px){
            header nav{
                width: 256px;
            }

            footer{
                height: 165px;
            }

            footer h3{
                font-size: 16px;
                font-weight: 600;
            }

            footer img{
                width: 15px;
                height: 15px;
            }

            footer p{
                font-size: 12px;
            }
        }

        @media screen and (max-width: 500px){
            header{
                flex-direction: column;
                align-items: center;
                text-align: center;
                height: 180px;
            }
            .logo {
                height: 100px
            }
            .header_pic img {
                padding: 0;
            }
            .logo p{
                min-width: 100px;
            }
            nav{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr 1fr;
                align-items: center;
                justify-content: center;
                height: 80px;
                width: 400px !important;
            }
            #span{
                grid-column: 1 / -1;
                margin: 0 auto;
                width: 225px;
                text-align: center;
            }
            .service_header {
                font-size: 3.3rem;
            }
            .tabs{
                align-items: center;
            }
            .item{
                font-size: 16px;
            }
            .name {
                font-size: 16px;
            }

            .price {
                font-size: 16px;
                font-weight: 600;
            }

            footer h3{
                font-size: 15px;
                font-weight: 500;
                margin-top: 10px;
            }

            footer img{
                width: 10px;
                height: 10px;
            }

            footer p{
                font-size: 10px;
            }

            .end{
                font-size: 10px;
            }
        }

        @media screen and (max-width: 400px){

            header{
                flex-direction: column;
                align-items: center;
                text-align: center;
                height: 180px;
            }
            .logo{
                height: 100px;
            }
            .header_pic img{
                padding: 0;
            }
            nav{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr 1fr;
                align-items: center;
                justify-content: center;
                height: 80px;
                width: 100%;
                box-sizing: border-box;
                max-width: 100%;
            }
            nav a{
                margin-right: 10px;
            }

            #span{
                grid-column: 1 / -1;
                margin: 0 auto;
                width: 225px;
                text-align: center;
            }
            footer{
                height: 130px;
            }

            footer h3{
                font-size: 14px;
            }

            footer img{
                width: 10px;
                height: 10px;
            }

            footer p{
                font-size: 8px;
            }

            .end{
                font-size: 8px;
            }

        }

        @media screen and (max-width: 360px){
            .name {
                font-size: 15px;
            }

            .price {
                font-size: 15px;
                font-weight: 600;
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

    <nav>
        <a href="../welcome/testna2.php">Home</a>
        <a href="../about_us/about_us.php">About</a>
        <a href="../services/services.php">Services</a>
        <a href="../login/login.php">Log in</a>
        <span id="span"><a href="../registration/register.php"">Book an appointment</a></span>
    </nav>
</header>

<main>
    <div class="service_header">Services</div>
    <span class="services_header_underline"></span>

    <input type="radio" name="tab" id="general_dentistry" checked>
    <input type="radio" name="tab" id="orthodontics">
    <input type="radio" name="tab" id="aesthetics">
    <input type="radio" name="tab" id="implantology">

    <div class="tabs">
        <label for="general_dentistry">General dentistry</label>
        <label for="orthodontics">Orthodontics</label>
        <label for="aesthetics">Aesthetics</label>
        <label for="implantology">Implantology</label>
    </div>

    <div class="content">
        <div class="section" id="general_dentistry">
            <p>General dentistry</p>
            <?php while($row = mysqli_fetch_assoc($result_general)): ?>
                <div class="item">
                    <span class="name"><?= $row['tName']; ?></span>
                    <span class="price"><?= (float) $row['Price']; ?> KM</span>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="content">
        <div class="section" id="orthodontics">
            <p>Orthodontics</p>
            <?php while($row = mysqli_fetch_assoc($result_ortho)): ?>
                <div class="item">
                    <span class="name"><?= $row['tName']; ?></span>
                    <span class="price"><?= (float) $row['Price']; ?> KM</span>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="content">
        <div class="section" id="aesthetics">
            <p>Aesthetics</p>
            <?php while($row = mysqli_fetch_assoc($result_aesth)): ?>
                <div class="item">
                    <span class="name"><?= $row['tName']; ?></span>
                    <span class="pric"><?= (float) $row['Price']; ?> KM</span>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="content">
        <div class="section" id="implantology">
            <p>Implantology</p>
            <?php while($row = mysqli_fetch_assoc($result_implant)): ?>
                <div class="item">
                    <span class="name"><?= $row['tName']; ?></span>
                    <span class="price"><?= (float) $row['Price']; ?> KM</span>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</main>

<footer>
    <div class="location">
        <h3>Location</h3>
        <div class="footer_icons">
            <img src="../pictures/map-pin.png" alt="location favicon" width="20px" height="20px">
            <p>Paromlinska 53h, Sarajevo 71000</p>
        </div>
        <p>Bosnia and Herzegovina</p>
    </div>
    <div class="contact">
        <h3>Contact us</h3>
        <div class="footer_icons">
            <img src="../pictures/icon-phone.png" alt="phone" width="20px" height="20px">
            <p>Phone: 064/44/27/321</p>
        </div>
        <div class="footer_icons">
            <img src="../pictures/icon-mail.png" alt="email" width="20px" height="20px" >
            <p> Email: dentin@gmail.com</p>
        </div>
    </div>

    <div class="hours">
        <h3>Working hours</h3>
        <div class="footer_icons">
            <img src="../pictures/working-hours.png" alt="hours" width="20px" height="20px">
            <p>Mon - Fri: 9 am - 6 pm</p>
        </div>
        <p>
            Weekends: closed
        </p>
    </div>
    <div class="end">
        &copy; All rights reserved S&N 2026
    </div>
</footer>

</body>
</html>