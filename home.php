<?php
session_start();

//if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
//    header("Location: /home.php");
//    exit;
//}
//if (isset($_SESSION['user'])) {
//    header("Location: /home.php");
//    exit;
//}
if (isset($_SESSION['adm'])) {
    header("Location: /dashboard.php");
    exit;
}

//if (!isset($_SESSION['user'])) {
//    header("Location: /login.php");
//    exit;
//}

require_once "./components/db_connect.php";

$sql = "SELECT * FROM `animals` WHERE `status` = 'Available'";
$result = mysqli_query($connect, $sql);

$cards = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cards .= "<div>
                <div class='card' style='width: 18rem;'>
                    <img src='assets/{$row['picture']}' class='card-img-top' alt='...' style='height: 350px; object-fit: cover; object-position: top;'>
                    <div class='card-body'>
                    <h5 class='card-title'>{$row['name']}</h5>
                    <p class='card-text'>Age: {$row['age']}</p>
                    <p class='card-text'>Breed: {$row['breed']}</p>
                    <p class='card-text'>About our darling: {$row['description']}</p>
                    <a href='details.php?pet_id={$row['pet_id']}' class='btn btn-primary'>Details</a>";

        if ($row['status'] === "Available" && isset($_SESSION['user'])) {
            $cards .= "<a href='adoption.php?pet_id={$row['pet_id']}&user_id={$_SESSION['user']}' class='btn btn-warning'>Take me home</a>
      ";
        }


        $cards .= "</div>
                </div>
              </div>";
    }
} else {
    $cards = "<p>No results found</p>
                </div>
                </div>
              </div>";
}

mysqli_close($connect);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code Review 5</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<style>
    body {
        background-image: url('assets/bg.jpg');
    }
</style>


<body>
    <?php require_once 'components/navbar.php'; ?>

    <div id="intro-example" class="p-5 text-center">
        <div class="mask " style="background-color: rgba(0, 0, 0, 0.7);">
            <div class="d-flex justify-content-center align-items-center h-100 p-5">
                <div class="text-white">
                    <h1 class="mb-3">Pet Oasis </h1>
                    <h5 class="mb-4">
                        Find Love, Adopt Joy - Pet Oasis Welcomes You!
                    </h5>
                    <a class="btn btn-outline-light btn-lg m-2" href="seniors.php" role="button" rel="nofollow" target="_blank"><img src="assets/paw.png" alt="">
                        <h2>Support our Seniors</h2>
                    </a>
                    <a class="btn btn-outline-light btn-lg m-2" href="all_pets.php" role="button" rel="nofollow" target="_blank"><img src="assets/paw.png" alt="">
                        <h2>Show all</h2>
                    </a>

                    <h1 class="mb-3 mt-5">Pets available:</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 gx-5 gy-5">
            <?= $cards; ?>
        </div>
    </div>


    <?php require_once 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>