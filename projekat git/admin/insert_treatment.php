<?php
    session_start();

    mysqli_report(MYSQLI_REPORT_ERROR);

    require_once '../db_credentials.php';
    $conn = mysqli_connect(db_host, db_user, db_password, "dentist_office");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = trim($_POST['name']);
        $duration = trim($_POST['duration']);
        $price = trim($_POST['price']);
        $category = trim($_POST['type']);

        if(empty($name) || empty($duration) || empty($price) || empty($category)){
            header("Location: add_new_treatment.php?error=empty");
            exit();
        }

        if(!is_numeric($duration) || (int)$duration <=0){
            header("Location: add_new_treatment.php?error=duration");
            exit();
        }

        if(!is_numeric($price) || (float)$price < 0){
            header("Location: add_new_treatment.php?error=price");
            exit();
        }

        $name = $conn -> real_escape_string(trim($_POST['name']));
        $duration = (int) trim($_POST['duration']);
        $price = (float) trim($_POST['price']);
        $category = $conn -> real_escape_string(trim($_POST['type']));

        $category_query = mysqli_query($conn, "SELECT cid 
                                                     FROM category
                                                     WHERE c_name = '$category'");

        $category_query_row = mysqli_fetch_assoc($category_query);
        $categoryID = $category_query_row['cid'];

        $sql =  "INSERT INTO treatment (t_name, t_duration, price, category) VALUES
                                        ('$name', $duration, $price, $categoryID)";

        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: admin_page.php?tab=treatments&success=1");
            exit();
        }
        else{
            die("Database error: " . $conn->error);
        }
    }
?>