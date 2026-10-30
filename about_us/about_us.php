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
    <title>Dentin - About Us</title>
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
            height: 150px;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px 0 60px;
            background: #1E2B3C;
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
        .grid_container1 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-family: 'DM Sans', sans-serif;
            align-items: center;
            width: 100%;
            margin-top: 60px;
            column-gap: 50px;
            box-sizing: border-box;
            padding: 0 5%;
        }
        .grid_item1{
            display: flex;
            flex-direction: column;
            font-size: 20px;
            max-width: 60ch;
            padding-left: 0;
        }
        .grid_container2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-family: 'DM Sans', sans-serif;
            align-items: center;
            width: 100%;
            margin-top: 70px;
            gap: 50px;
            padding: 0 5%;
            box-sizing: border-box;
        }
        .grid_item2{
            display: flex;
            flex-direction: column;
            font-size: 20px;
            padding-right: 0;
            max-width: 60ch;
        }
        .section_header {
            font-family: 'Cormorant Garamond', serif;
            color: #EDBC7F;
            grid-column: span 3;
            text-align: center;
            font-size: 4.375rem;
            width: 100%;
            margin-bottom: 35px;
            font-weight: bold;
        }
        .paragraph{
            font-size: 1.2rem;
            color: #1E2B3C;
        }
        .grid_container1 img, .grid_container2 img {
            width: 100%;
            max-width: 490px;
            height: auto;
            border-radius: 15%;
            place-self: center;
            justify-self: center;
        }
        .grid_container3 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-family: 'DM Sans', sans-serif;
            align-items: center;
            width: 100%;
            margin: 0;
            gap: 50px;
            box-sizing: border-box;
        }
        .grid_item3, .grid_item4{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            margin: 80px auto;
            text-align: center;
        }
        .grid_item3 p, .grid_item4 p{
            color: #EDBC7F;
            font-family: 'Cormorant Garamond', serif;
            font-size: 35px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .drslika {
            width: 100%;
            max-width: 350px;
            height: auto;
            border-radius: 50%;
        }
        .grid_item3 div, .grid_item4 div{
            text-align: center;
            max-width: 50ch;
            margin-top: 15px;
            font-size: 18px;
            color: #1E2B3C;
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

        @media screen and (max-width: 1200px) {
            .section_header {
                font-size: 3.5rem;
                margin-bottom: 30px;
            }
            .paragraph{
                font-size: 1rem;
            }
        }
        @media screen and (max-width: 1000px) {
            header{
                padding: 0 20px 0 40px;
            }
            .section_header {
                margin-bottom: 20px;
                font-size: 2.3rem;
            }
            .paragraph{
                font-size: 1rem;
            }
            .grid_container3{
                grid-template-columns: 1fr;
                gap: 10px;
            }
            .grid_item3{
                margin: 0;
                padding-top: 50px;
            }
            .grid_item4{
                margin: 0;
                padding-top: 35px;
                padding-bottom: 50px;
            }
            .grid_item3 p, .grid_item4 p {
                font-size: 25px;
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
            .grid_container1{
                grid-template-columns: 1fr;
                margin-top: 20px;
            }
            .grid_container2{
                grid-template-columns: 1fr;
                gap: 20px;
                margin-top: 60px;
            }
            .grid_container1 img {
                justify-self: center;
                width: 100%;
                max-width: 100%;
                height: auto;
                margin-top: 30px;
            }
            .grid_container2 img{
                order: 2;
                justify-self: center;
                width: 100%;
                max-width: 100%;
                height: auto;
                margin-top: 10px;
            }
            .section_header {
                margin-top: 20px;
                text-align: center;
                font-size: 2.5rem;
            }
            .paragraph{
                font-size: 1.2rem;
            }
            .grid_container3{
                grid-template-columns: 1fr;
                gap: 10px;
            }
            .grid_item3{
                margin: 0;
                padding-top: 50px;
            }
            .grid_item4{
                margin: 0;
                padding-top: 35px;
                padding-bottom: 50px;
            }
            .grid_item3 p, .grid_item4 p {
                font-size: 25px;
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
                height: 100px;
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
            footer{
                height: 140px;
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
            #div2 img{
                height: 80px;
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
        <span id="span"><a href="../registration/register.php">Book an appointment</a></span>
    </nav>
</header>

<main>
    <div class="grid_container1">
        <div class="grid_item1">
            <p class="section_header">ABOUT US</p>
            <p class="paragraph">
                At Dentin Dental Office, we are dedicated to providing exceptional dental care in a warm and welcoming environment. Our team of experienced professionals combines modern techniques with a gentle approach, ensuring every patient feels comfortable and confident in their smile.
            </p>
        </div>
        <img src="../pictures/A7_09525.jpg" alt="slika">
    </div>
    <div class="grid_container2">
        <img src="../pictures/A7_09572.jpg" alt="slika">
        <div class="grid_item2">
            <p class="section_header">OUR TEAM</p>
            <p class="paragraph">
                Our team at Dentin is made up of passionate and highly qualified dental professionals with decades of combined experience. We believe that great dental care starts with trust, which is why we take the time to truly listen to each patient and tailor every treatment to their individual needs.
            </p>
        </div>
    </div>

    <div class="grid_container3">
        <div class="grid_item3">
            <p>dr. Rachel Greene</p>
            <img class="drslika" src="../pictures/drazra.jpg" alt="drazra">
            <div>Orthodontics Specialist since 2011.</div>
        </div>
        <div class="grid_item4">
            <p>dr. Marcus Hiding</p>
            <img class="drslika" src="../pictures/drfaruk.jpg" alt="drfaruk">
            <div>Implantology and General Dentistry Specialist</div>
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