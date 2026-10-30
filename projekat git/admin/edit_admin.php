<?php


session_start();
mysqli_report(MYSQLI_REPORT_ERROR);

require_once '../db_credentials.php';
$conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");

$id = $_GET['id'];
$query = mysqli_query($conn,"select * from people where pid = $id");

$row = mysqli_fetch_assoc($query);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $q = "update people
           set first_name = '{$_POST['name']}', last_name = '{$_POST['last_name']}', DOB = '{$_POST['dob']}', phone = '{$_POST['phone']}', email = '{$_POST['email']}', p_password = '{$_POST['pass']}'
        where pid = {$_POST['id']}
    ";
    $result = mysqli_query($conn, $q);
    $_SESSION['name'] = $_POST['name'];
    if($result){
        header("Location: admin_page.php?tab=settings&infosuccess=1");
        exit();
    }
    else{
        die("Database error: " . $conn->error);
    }
}


?>


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
    <title>Edit Admin</title>
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
        input::placeholder, select, input[type="duraton"], input[type="price"]{
            color: #212A35;
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
            background-color: #212A35;
            color: #EDBC7F;
            border-radius: 15px;
            height: 40px;
            width: 140px;
            font-family: "Montserrat", sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.05em;
        }

        .submit:hover {
            opacity: 0.85;
        }

        .cancel{
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            color: #212A35;
            border-radius: 15px;
            border: 2px #212A35 solid;
            text-align: center;
            height: 36.8px;
            width: 136.8px;
            font-family: "Montserrat", sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.05em;
        }

        .cancel:hover {
            background: rgba(33, 42, 53, 0.1);
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
               /* #title{
                    font-size: 10px;
                    margin-bottom: 10px;
                    display: flex;
                    justify-content: space-between;
                    flex-direction: row;
                }


                .tabs label{
                    font-size: 17px;
                    padding: 5px 10px;
                }*/



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
                height: 200px;
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
            <h2>Edit your account</h2>
        </div>
        <form method="post" action="">

            <input type="hidden" name="id" value="<?= $row['pid']; ?>">

            <div id="name" class="field">
                <label>First name</label>
                <input type="text" id="name" name="name" placeholder="Name" value="<?= $row['first_name'];  ?>">
            </div>
            <div id="name" class="field">
                <label>Last name</label>
                <input type="text" id="name" name="last_name" placeholder="Name" value="<?= $row['last_name'];  ?>">
            </div>

            <div id="duration" class="field">
                <label>Date of birth</label>
                <input type="date" id="duration" name="dob" placeholder="DOB" value="<?= $row['DOB']; ?>">
            </div>

            <div id="price" class="field">
                <label>Phone number</label>
                <input type="text" id="price" name="phone" placeholder="Phone" value ="<?= $row['phone']; ?>">
            </div>

            <div id="price" class="field">
                <label>Email</label>
                <input type="email" id="price" name="email" placeholder="Email" value ="<?= $row['email']; ?>">
            </div>

            <div id="price" class="field">
                <label>Password</label>
                <input type="password" id="price" name="pass" placeholder="Password" value ="<?= $row['p_password']; ?>">
            </div>

            <div id="submit">
                <button class=submit type="submit">Submit</button>
                <a href="../admin/admin_page.php?tab=settings" class="cancel">Cancel</a>
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
