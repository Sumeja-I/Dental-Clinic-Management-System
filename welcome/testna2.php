<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dental Office Dentin</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;0,700;1,900&display=swap" rel="stylesheet">
    <link href="https://db.onlinewebfonts.com/c/9dc5a620301a9b7934ea10863bc3efc6?family=Vultura+Regular" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="favicon" href="../pictures/tooth.png">
    <style>
        *{
        }

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
            font-family: 'DM Sans', sans-serif;
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

        #span a{

            color: white;
            font-size: 16px;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            align-self: center;

        }
        #span:hover, #span a:hover{
            background: #D4A84B;
            box-shadow: 0 4px 20px rgba(201,150,58,.45);
            transform: translateY(-2px);
        }
        /* nav a:hover{
             background-color: darkgoldenrod;
             border-radius: 10px;
             color: black;
         }*/

        #div2{
            display: grid;
            grid-template-columns: 1fr 1.4fr;
            align-items: center;
            justify-content: center;
            gap: 15px;
            color: #EDBC7F;
            font-family: "Vultura Regular", sans-serif;
        }
        main{
            height: 600px;
            width: 100%;
            margin: 0 auto;

           /* background-color: #fadc95;*/
            display: grid;
            grid-template-columns: repeat(2,2fr);
            justify-content: center;
            align-items: center;
            gap: 15px;
            background-image: url("../pictures/A7_09678.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            overflow-y: auto;
            image-rendering: high-quality;

        }
        #section_one{
            padding-left: 20px;
            align-items: center;
            margin-left: 30px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            line-height: 1.8;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.15);

        }
        #section_one h1{
            font-family: "Vultura Regular", sans-serif;
            color: white;
            align-items: center;
            height: 30px;
            padding-bottom: 2px;

        }
        #section_one p{
            font-family: "Montserrat", sans-serif;
            color: white;
            font-stretch: expanded;

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
        #d3, #d2, #d4{
            display: grid;
            grid-template-rows: repeat(2,2fr) ;
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


        #article{
            background-color: #b19c6c;
            width: 100%;
            padding-bottom: 20px;

        }
        #article #div_one{

            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        #article div h1{
            margin-top: 0;
            color: #212A35;
            font-family: "Vultura-Regular", sans-serif;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #div_two{
            display: grid;
            grid-template-columns: repeat(4,2fr);
            gap: 15px;
            margin-left: 10px;
            margin-right: 10px;
            /*overflow: hidden;*/

        }
        #img1, #img2, #img3, #img4{
            /*border-radius: 15px;*/
            align-items: center;
            align-content: center;
            text-align: center;

        }
        #img1 img, #img2  img, #img3  img, #img4  img{
            border-radius: 15px;
            width: 300px;
            height: 300px;
            object-fit: cover;
        }
        .links{
            text-decoration: none;
            color: #212A35;
            font-family: "Montserrat", sans-serif;
        }

        .images:hover{
            transform: scale(1.15);
            box-shadow: 0 4px 10px black;
        }
      /*  .images{
            width: 100%;
            align-self: center;
            border-radius: 50%;
        }*/

        nav a:hover, #div a:hover{
            transform: scale(1.1);
        }

        #d1{
            grid-column-start: 1;
            grid-column-end: -1;
            text-align: center;
            align-items: center;
            color: #E8BC72;
            margin-top: 10px;
        }


    @media screen and (max-width: 1252px){
        #div_two{
            grid-template-columns: repeat(2,2fr);
        }

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

            #section_one h1{
                font-size: 30px;
            }
        }


        @media screen and (max-width: 924px){
            main{
                align-items: center;
                justify-content: center;
            }
            #section_one{
                height: 400px;
                display: grid;
                width: 400px;
                grid-template-columns: 1fr;
                align-items: center;
            }
            #section_one h1{
                height: 10px;
                margin-top: 0;
                justify-content: center;
                align-items: center;
                padding-bottom: 10px;
                font-size: 28px;
            }
            #section_one p{
                margin-top: 0;
            }
            #section_one #span{
                margin: 0 auto;
                width: 200px;
            }
        }
      @media screen and (max-width: 815px){

          header {
              height: 190px;
          }
          #pic1{
              max-width: 250px;
          }
          nav{
              flex-direction: column;
              align-items: center;
              justify-content: space-between;
              width: 300px;
              height: 150px;
          }
          .header_pic{
              max-width: 250px;
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
            #pic1{
                max-width: 250px;
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
            #div_two{
                grid-template-columns: 1fr;
            }
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
            #div2 img{
                height: 80px;
            }
            nav{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr 1fr;
                align-items: center;
                justify-content: center;
                height: 80px;
                width: 400px !important;
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
            main{
                max-height: 420px;
            }

            #section_one{
                margin-left: 10px;
                width: 300px;
                height: 350px;
                padding-right: 10px;
            }
            #section_one h1{
                font-size: 20px;
            }
            #section_one p{
                font-size: 13px;
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

    <section id="section_one">
        <h1>Your smile is our top priority</h1>
        <p>
            We provide high-quality dental care at affordable prices. Trusted by patients from Bosnia, the EU, the USA, and beyond, we combine expertise, experience, and modern techniques.
            Whether you need general, orthodontic, or pediatric dental care, we offer personalized treatments tailored to you.
            Enjoy a comfortable atmosphere, professional staff, and a smile you’ll love.
        </p>

        <span id="span" style="align-self: center; text-align: center; display: block; margin-bottom: 10px"><a href="../registration/register.php" style="color: white;">Book an appointment now!</a></span>
    </section>
</main>

<article id="article">

    <div id="div_one">
        <h1 style="padding-top: 30px; font-size: 40px; ">Services</h1>
    </div>
    
    <div id="div_two">
        
        <div id="img1">
            <a href="../services/services.php" class="links">
                <img src="../pictures/A7_09631.jpg" alt="picture" class="images">
                <h3>General dentistry</h3>
            </a>
        </div>

        <div id="img2">
            <a href="../services/services.php" class="links">
                <img src="../pictures/A7_09588.jpg" alt="picture" class="images">
                <h3>Orthodontics</h3>
            </a>
        </div>

        <div id="img3">
            <a href="../services/services.php" class="links">
                <img src="../pictures/red1_3-440x440.jpg" alt="picture" class="images">
                <h3>Aesthetics</h3>
            </a>
        </div>

        <div id="img4">
            <a href="../services/services.php" class="links">
                <img src="../pictures/A7_09538.jpg" alt="picture" class="images">
                <h3>Implantology</h3>
            </a>
        </div>
    </div>

</article>


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
