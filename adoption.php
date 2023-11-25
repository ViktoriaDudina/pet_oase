<?php
session_start();
require_once "./components/db_connect.php";

if (isset($_GET["pet_id"]) && isset($_GET["user_id"])) {
    $pet_id = $_GET["pet_id"];
    $user_id = $_GET['user_id'];


    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO pet_adoption (`user_id`, `pet_id`, `adoption_date`) VALUES ('$user_id','$pet_id','$date')";
    $result = $connect->query($sql);

    $sql2 = "UPDATE animals SET status = 'Adopted' WHERE pet_id = '$pet_id'";
    $result2 = $connect->query($sql2);
    if ($result && $result2) {
        echo "<a onclick='history.back()'><button class='btn btn-primary'>Back</button></a>";
        echo "<div class='alert alert-success'>
                <p>Great news! The animal has found a new home. Congratulations!</p>
            </div>";
    } else {
        echo "<a onclick='history.back()'><button class='btn btn-primary'>Back</button></a>";
        echo "<div class='alert alert-danger'>
                <p>Something was wrong. Please try again later.</p>
            </div>";
    }
} else {
    echo "<div class='alert alert-danger'>
            <p>Missing pet ID or user ID.</p>
        </div>";
}
mysqli_close($connect);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
