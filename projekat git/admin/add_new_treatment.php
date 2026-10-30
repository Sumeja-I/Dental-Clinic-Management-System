<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;0,700;1,900&display=swap" rel="stylesheet">
    <link href="https://db.onlinewebfonts.com/c/9dc5a620301a9b7934ea10863bc3efc6?family=Vultura+Regular" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Treatment</title>
    <link rel="favicon" href="../pictures/tooth.png">
    <style>
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

        main{
            width: 100%;
            overflow: hidden;
            /* margin: 85px auto 85px auto;*/
            height: 100%;
            padding-bottom: 100px;
            margin: 0 auto;
        }


        #form{
            display: block;
            max-height: 600px;
            width: 800px;
            margin: 0 auto;
            border-radius: 15px;
            opacity: 1;
        }

        #title{
            border-radius: 15px 15px 0 0;
            display: flex;
            justify-content: space-between;
            text-align: center;
            align-items: center;
            background: #1E2B3C;
            padding: 28px 36px 24px;
        }
        #title h2{
            margin: 0;
            padding-left: 5px;
            padding-bottom: 15px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 24px;
            font-weight: 600;
            font-style: italic;
            color: #FFFFFF;
            letter-spacing: .01em;
        }

        form{
            display: grid;
            grid-template-columns: repeat(2,2fr);
            gap: 15px;
            align-items: center;
            padding: 32px 36px 36px;
            background: #FFFFFF;
            max-width: 800px;
            margin: 0 auto;
            box-shadow:  0 16px 48px rgba(30,43,60,.11);
            overflow: hidden;
            border-radius: 0 0 15px 15px;
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
            letter-spacing: .09em;
            text-transform: uppercase;
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
        input:hover {
            border-color: #e8c98a;
            background: #fdf7ec;
        }
        input:focus {
            border-color: #c9963a;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(201,150,58,0.15);
        }
        input::placeholder{
            color: rgba(33, 42, 53, 0.7);
            font-family: "Montserrat", sans-serif;
        }

        #submit{
            grid-column-start: 1;
            grid-column-end: -1;
            padding-bottom: 10px;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 12px;
        }
        .submit{
            background: #1a2744;
            border: 2px solid #1a2744;
            color: #c9963a;
            border-radius: 15px;
            height: 40px;
            width: 140px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.05em;
            transition: background 0.2s, border-color 0.2s, color 0.2s, transform 0.15s, box-shadow 0.2s;
        }

        .submit:hover {
            background: #c9963a;
            border-color: #c9963a;
            color:  #1a2744;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(201,150,58,0.35);
        }

        .cancel{
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1.5px solid  #e2d8c8;
            color: #7a6e5f;
            border-radius: 15px;
            text-align: center;
            height: 36.8px;
            width: 136.8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.05em;
            transition: border-color 0.2s, color 0.2s, background 0.2s, transform 0.15s;
        }

        .cancel:hover {
            border-color: #7a6e5f;
            color: #2a2a2a;
            background: rgba(122,110,95,0.07);
            transform: translateY(-1px);
        }

        #name, #duration, #price, #type{
            text-align: center;
            align-items: center;
            align-content: center;
        }


        @media screen and (max-width: 799px){
            #form{
                width: 600px;
            }
        }
        @media screen and (max-width: 768px) {
            header {
                height: 200px;
            }

            .header_pic {
                max-width: 250px;
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
        }

        @media screen and (max-width: 600px) {

            nav {
                width: 200px;
                padding-right: 10px;
            }
            #form{
                width: 500px;
                margin: 0 auto;
            }


            form{
                width: 300px;
                grid-template-columns: 1fr;
            }

            #title{
                width: 300px;
                margin: 0 auto;
            }

            input{
                width: 90%;
            }
        }
        @media screen and (max-width: 510px){
            #form{
                margin: 0 auto;
            }
        }
        @media screen and (max-width: 500px) {
            header {
                flex-direction: column;
                align-items: center;
                text-align: center;
                height: 210px;
                justify-content: space-around;
            }
            .header_pic img{
                padding-left: 0;
            }

            .header_pic{
                height: 140px;
            }

            form{
                margin: 0 auto;
            }

            .logo{
                height: 150px;
            }

            #form{
                width: 400px;
                margin: 0 auto;
            }


            form{
                width: 300px;
                grid-template-columns: 1fr;
            }

            #title{
                width: 300px;
                margin: 0 auto;
            }
        }

        @media screen and (max-width: 410px) {
            #form{
                width: 320px;
                margin: 0 auto;
            }

            form{
                max-width: 300px;
                width: 100%;
                grid-template-columns: 1fr;
                box-sizing: border-box;
                padding: 22px 26px;
                margin: 0 auto;
                justify-content: center;
            }

            #title{
                width: 300px;
                margin: 0 auto;
                box-sizing: border-box;
            }

        }
        .field {
            padding: 0 10px;
        }


        input, select{
            max-width: 100%;
            margin: 0 auto;
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
    <div id="form">

        <div id="title">
            <h2>Add new treatment</h2>
        </div>
        <form id="treatmentForm" method="post" action="insert_treatment.php">

            <div class="field">
                <label for="name">Treatment name</label>
                <input type="text" id="name" name="name" placeholder="e.g. Root canal">
            </div>

            <div class="field">
                <label for="duration">Duration (mins)</label>
                <input type="number" id="duration" name="duration" placeholder="e.g. 60" min="1">
            </div>

            <div class="field">
                <label for="price">Price (KM)</label>
                <input type="number" id="price" name="price" placeholder="e.g. 80.00" min="1" step="1">
            </div>

            <div class="field">
                <label for="type">Category</label>
                <select id="type" name="type">
                    <option>— Select category —</option>
                    <option>General Dentistry</option>
                    <option>Orthodontics</option>
                    <option>Aesthetics</option>
                    <option>Implantology</option>
                </select>
            </div>

            <div id="submit">
                <button class=submit type="submit">Submit</button>
                <a href="../admin/admin_page.php?tab=treatments" class="cancel">Cancel</a>
            </div>

        </form>

    </div>
</main>




<footer>
    <div class="end">
        &copy; All rights reserved S&N 2026
    </div>
</footer>

</body>
</html>