<?php
require_once "./components/db_connect.php";

$error = false;

function cleanInputs($input)
{
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

$first_name = $last_name = $password = $email = $phone_number = $address = "";
$first_nameError = $last_nameError = $passwordError = $emailError = $phone_numberError = $addressError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sign-up"])) {
    $first_name = isset($_POST["first_name"]) ? cleanInputs($_POST["first_name"]) : "";
    $last_name = isset($_POST["last_name"]) ? cleanInputs($_POST["last_name"]) : "";
    $password = isset($_POST["password"]) ? cleanInputs($_POST["password"]) : "";
    $email = isset($_POST["email"]) ? cleanInputs($_POST["email"]) : "";
    $phone_number = isset($_POST["phone_number"]) ? cleanInputs($_POST["phone_number"]) : "";
    $address = isset($_POST["address"]) ? cleanInputs($_POST["address"]) : "";
    $picture = isset($_POST["picture"]) ? cleanInputs($_POST["picture"]) : "";

    if ($_FILES["picture"]["error"] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["picture"]["tmp_name"];
        $picture = basename($_FILES["picture"]["name"]);
        move_uploaded_file($tmp_name, "../assets/" . $picture);
    }


    if (empty($first_name)) {
        $error = true;
        $first_nameError = "Please enter your first name";
    } elseif (strlen($first_name) < 3) {
        $error = true;
        $first_nameError = "Name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $first_name)) {
        $error = true;
        $first_nameError = "Name must contain only letters and spaces.";
    }


    if (empty($last_name)) {
        $error = true;
        $last_nameError = "Please enter your last name";
    } elseif (strlen($last_name) < 3) {
        $error = true;
        $last_nameError = "Last name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
        $error = true;
        $last_nameError = "Last name must contain only letters and spaces.";
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } else {
        // Check if email already exists in the database
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Provided email is already in use";
        }
    }


    if (empty($password)) {
        $error = true;
        $passwordError = "Password can't be empty!";
    } elseif (strlen($password) < 6) {
        $error = true;
        $passwordError = "Password must have at least 6 characters.";
    }

    if (!$error) {
        $password = hash("sha256", $password);

        $sql = "INSERT INTO users (first_name, last_name, password, email, phone_number, address, picture) 
            VALUES ('$first_name','$last_name','$password','$email','$phone_number','$address','$picture')";

        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo   "<div class='alert alert-success'>
               <p>New account has been created successfully</p>
           </div>";
        } else {
            echo   "<div class='alert alert-danger'>
               <p>Something was wrong. Please try again later.</p>
           </div>";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
<div class="container">
    <h1 class="text-center">Sign Up</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="<?= $first_name ?>">
            <span class="text-danger"><?= $first_nameError ?></span>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" value="<?= $last_name ?>">
            <span class="text-danger"><?= $last_nameError ?></span>
        </div>
        <div class="mb-3">
    <label for="picture" class="form-label">Profile picture</label>
    <input type="file" class="form-control" id="picture" name="picture">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
            <span class="text-danger"><?= $emailError ?></span>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone number</label>
            <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number" value="<?= $phone_number ?>">
            <span class="text-danger"><?= $phone_numberError ?></span>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?= $address ?>">
            <span class="text-danger"><?= $addressError ?></span>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <span class="text-danger"><?= $passwordError ?></span>
        </div>
        <button name="sign-up" type="submit" class="btn btn-primary">Create an account</button>

        <span>Already have an account? <a href="/login.php">Sign in here</a></span>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>