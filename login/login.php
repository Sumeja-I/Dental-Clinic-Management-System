<?php

require_once '../db_credentials.php';
    try{
        $conn = mysqli_connect(db_host, db_user, db_password, 'dentist_office');

    }
    catch(mysqli_sql_exception $e){
        echo $e->getMessage();
        exit;
}
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $query = mysqli_query($conn, "select * from people where email = '{$_POST['email']}' and p_password = '{$_POST['password']}' ");
    $row = mysqli_fetch_assoc($query);

    if($row){
        session_start();

        $_SESSION['is_authenticated'] = true;
        $_SESSION['name'] = $row['first_name'];
        $_SESSION['person_id'] = $row['pid'];
        $_SESSION['is_admin'] = $row['is_admin'] == 1;

        if($row['is_admin']) header('Location: ../admin/admin_page.php');
        else header('Location: ../user_page/user_page.php');
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;0,700;1,900&display=swap" rel="stylesheet">
    <link href="https://db.onlinewebfonts.com/c/9dc5a620301a9b7934ea10863bc3efc6?family=Vultura+Regular" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="favicon" href="tooth.png">
    <title>Dentin - Log in</title>
    <style>
        main, footer{
            width: 100%;
        }
        body{
            background: #F7F5F0;
            margin: 0;
        }

        #pic1{
            height: 150px;
            border-radius: 50%;
            padding-left: 20px;
        }
        header{
            display: flex;
            height: 150px;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px 0 60px;
            background: #1E2B3C;
            box-shadow: 0 2px 24px rgba(30,43,60,.28);
            position: sticky; top: 0; z-index: 100;
        }
        nav{
            display: flex;
            justify-content: space-around;
            width: 600px;
            flex-shrink: 0;
            align-items: flex-end;

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
            font-family: 'DM Sans', sans-serif;
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

        #span a{
            color: white;
            font-size: 16px;

        }
        /* nav a:hover{
             background-color: darkgoldenrod;
             border-radius: 10px;
             color: black;
         }*/
        #div, #span{
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
        #span:hover, #span a:hover{
            background: #D4A84B;
            box-shadow: 0 4px 20px rgba(201,150,58,.45);
            transform: translateY(-2px);
        }
        #div2{
            display: grid;
            grid-template-columns: 1fr 1.4fr;
            align-items: center;
            justify-content: center;
            gap: 15px;
            color: #EDBC7F;
            font-family: "Vultura Regular", sans-serif;
        }
        footer{
            background-color: #1E2B3C;
            color: #E8BC72;
            display: grid;
            grid-template-columns: repeat(3,2fr);
            grid-template-rows: repeat(2,2fr);
            font-family: 'DM Sans', sans-serif;
            justify-content: space-around;
            align-items: center;
            height: 210px;
            width: 100%;
            box-shadow: 0 2px 24px rgba(30,43,60,.28);
        }
        footer div{
            align-items: center;
            text-align: center;

        }
        footer h3{
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        footer p{
            margin-top: 8px;
            margin-bottom: 8px;
            padding-left: 10px;
        }

        .footer_icons{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #d3, #d2, #d4{
            display: grid;
            grid-template-rows: repeat(2,2fr) ;
        }
        #d1{
            grid-column-start: 1;
            grid-column-end: -1;
            text-align: center;
            align-items: center;
            color: #E8BC72;
            margin-top: 10px;
        }

        main{
            background-image: url("../pictures/ord.jpg");
            background-repeat: no-repeat;
            image-resolution: 300dpi;
            height: 600px;
            width: 100%;
            margin: 0 auto;

            /* background-color: #fadc95;*/
            display: flex;
            grid-template-columns: repeat(2,2fr);
            justify-content: space-around;
            align-items: center;


            background-size: cover;
            background-position: center;
            overflow-y: auto;
            image-rendering: high-quality;


        }
        #form{
            padding-left: 20px;
            padding-right: 20px;
            align-items: center;
            text-align: center;
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            background-color: #f0f0ee;
            border-radius: 15px;
            line-height: 1.8;
            font-family: 'DM Sans', sans-serif;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.30);
            color: #212A35;
            width: 400px;
            justify-content: center;
            margin: 0 auto;
        }
        section{
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        input{
            border: none;
            border-bottom: 2px solid white;
            background: transparent;
            line-height: 1.8;
            outline: none;
        }
        input::placeholder{
            color: #212A35;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
        }
        #div1{
            display: grid;
            grid-template-columns: 1fr;
            align-items: center;
            justify-content: center;
            column-gap: 20px;
        }
        #email_input, #pass_input{
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: repeat(2,2fr);
        }

        button{
            background-color: #2C3D52;
            color: #E8BC72;
            border-radius: 15px;
            border: none;
            text-align: center;
            height: 50px;
            width: 100px;
            font-family: 'DM Sans', sans-serif;
            align-self: center;
            align-items: center;
            align-content: center;
            font-size: 20px;
            margin-bottom: 10px;
            margin: 0 auto;
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
        #submit_button{
            display: grid;
            grid-template-columns: 1fr;
           align-items: center;
            justify-content: center;
            text-align: center;
            align-content: center;
            place-content: center;
        }

        #register_link{
            text-decoration: none;
            color: gray;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
        }

        #register_link span{
            color: #1E2B3C;
        }

        #register_link span:hover{
            color: #C9963A;
            transition: color 0.18s ease;
        }



        @media screen and (max-width: 1000px) {
            header{
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


        @media screen and (max-width: 924px){
            main{
                align-items: center;
                justify-content: center;
            }

        }
        @media screen and (max-width: 815px){

            header {
                height: 190px;
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

            #d1{
                margin-top: 0;
            }
        }
        @media screen and (max-width: 768px){
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

            #d1{
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

            #d1{
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

        @media screen and (max-width: 520px){

            header{
                flex-direction: column;
                align-items: center;
                text-align: center;
                height: 300px;
            }
            #div2 img{
                height: 150px;
            }
            nav{
                display: grid;
                grid-template-columns: 1fr;
                align-items: center;
                justify-content: center;

            }
            nav a{
                margin-right: 10px;
            }
            #div{
                width: 300px;
            }
            #form{
                align-items: center;
                margin: 0 auto;
            }

        }
        @media screen and (max-width: 500px){
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

            #d1{
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
            #div{
                width: 300px;
            }
            #span{
                grid-column: 1 / -1;
                margin: 0 auto;
                width: 225px;
                text-align: center;
            }
            #div2{
                height: 150px;
            }
            #div2 img{
                height: 140px;
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

            #d1{
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

    <div id="form">
        <h1>Log in</h1>
        <form action="login.php" method="post" target="_blank">
            <section>

                <div id="div1">
                    <div id="email_input">
                        <input type="email" name="email" id="email" required placeholder="Email">
                    </div>
                    <div id="pass_input">
                        <input type="password" name="password" id="password" required placeholder="Password">
                    </div>
                </div>
                <div id="submit_button">
                   <button type="submit">Log in</button>


                    <a href="../registration/register.php" id="register_link">Don't have an account? <span>Register now!</span></a>

               </div>

            </section>
        </form>

    </div>



</main>


<footer>

    <div id="d2">
        <h3>Location</h3>
        <div class="footer_icons">
            <img src="../pictures/map-pin.png" alt="location favicon" width="20px" height="20px">
            <p>Paromlinska 53h, Sarajevo 71000</p>
        </div>
        <p>Bosnia and Herzegovina</p>
    </div>
    <div id="d3">
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
    <div id="d4">
        <h3>Working hours</h3>
        <div class="footer_icons">
            <img src="../pictures/working-hours.png" alt="hours" width="20px" height="20px">
            <p>Mon - Fri: 9 am - 6 pm</p>
        </div>
        <p>
            Weekends: closed
        </p>
    </div>
    <div id="d1">
        &copy; All rights reserved S&N 2026
    </div>

</footer>


</body>
</html>
