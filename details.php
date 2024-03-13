<?php
require_once './components/db_connect.php';

$cards = "";

if (isset($_GET["pet_id"]) && !empty($_GET["pet_id"])) {
    $pet_id = $_GET["pet_id"];

    $sql = "SELECT * FROM `animals` WHERE pet_id = $pet_id";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $cards .= "
        <div class='p-2'>
            <div class='card'>
                <img src='assets/{$row['picture']}' class='card-img-top mt-3' alt='...'>
                <div class='card-body'>
                    <h2 class='card-title'>{$row['name']}</h2>
                    <hr>
                    <h5 class='card-title'>Status: {$row['status']}</h5>
                    <p class='card-text'>Age: {$row['age']}</p>
                    <p class='card-text'>Breed: {$row['breed']}</p>
                    <p class='card-text'>Size: {$row['size']}</p>
                    <p class='card-text'>Location: {$row['location']}</p>
                    <p class='card-text'>Description: {$row['description']}</p> 
                    <p class='card-text'>Vaccinated: {$row['vaccinated']}</p>
                    <p class='card-text'>Status: {$row['status']}</p>
                    <a href='update.php?pet_id={$row['pet_id']}' class='btn btn-warning'>Update</a>
                    <a href='delete.php?pet_id={$row['pet_id']}' class='btn btn-danger'>Delete</a>
                </div>
            </div>
        </div>";
    } else {
        $cards = "No data found.";
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            background-image: url('assets/bg.jpg');
        }
        .card-img-top {
            width: 25%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            object-fit: cover;
        }
    </style>

</head>

<body>
<?php require_once 'components/navbar.php'; ?>
<div class="container">
    <?= $cards; ?>
</div>
<?php require_once 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>