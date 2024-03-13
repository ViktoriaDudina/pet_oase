<?php

session_start();

if (!isset($_SESSION['user']) && !isset($_SESSION['adm'])) {
    header("Location: ./login.php");
    exit;
}

if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

// Проверяем, что сессия админа есть, но нет сессии пользователя, иначе админ будет перенаправлен на dashboard.php
// if (isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
//     header("Location: /Code%20Review%205/dashboard.php");
//     exit;
// }



require_once "./components/db_connect.php";
$userId = $_SESSION['adm'];

$sql = "SELECT * FROM users WHERE user_id = $userId";
$result = mysqli_query($connect, $sql);

if (!$result) {
    echo "Query error: " . mysqli_error($connect);
    exit;
}

$row = mysqli_fetch_assoc($result);

$sqlUsers = "SELECT * FROM users WHERE status != 'adm'";
$resultUsers = mysqli_query($connect, $sqlUsers);

if (!$resultUsers) {
    echo "Query error: " . mysqli_error($connect);
    exit;
}

$layout = "";

if (mysqli_num_rows($resultUsers) > 0) {
    while ($userRow = mysqli_fetch_assoc($resultUsers)) {
        $layout .= "<div>
            <div class='card' style='width: 18rem;'>
                <img src='pictures/{$userRow["picture"]}' class='card-img-top' alt='...' style='width: 40px;'>
                <div class='card-body'>
                    <h5 class='card-title'>{$userRow["first_name"]} {$userRow["last_name"]}</h5>
                    <p class='card-text'>{$userRow["email"]}</p>
                    <p class='card-text'>{$userRow["address"]}</p>
                    <a href='update.php?user_id={$userRow["user_id"]}' class='btn btn-warning'>Update</a>
                </div>
            </div>
        </div>";
    }
} else {
    $layout .= "No results found!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?= $row["first_name"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets/<?= $row["picture"] ?>" alt="user pic" width="30" height="24">
        </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Products</a>
            </li>

<!--            ПРОВЕРИТЬ ПРАВИЛЬНОСТЬ ССЫЛОК!!!!!!-->

            <li class="nav-item">
                <a class="nav-link" href="update_log.php?user_id=<?= $row["user_id"] ?>">edit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php?logout">Logout</a>
            </li>


        </ul>
    </div>
</nav>
<h2 class="text-center">Welcome <?= $row["first_name"] . " " . $row["last_name"] ?></h2>

<div class="container">
    <div class="row row-cols-3">
        <?= $layout ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>