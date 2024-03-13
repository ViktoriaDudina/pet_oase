<?php

require_once './components/db_connect.php';
require_once './components/fileUpload.php';

if (isset($_GET["pet_id"]) && !empty($_GET["pet_id"])) {
    $pet_id = $_GET["pet_id"];
    $sql = "SELECT * FROM `animals` WHERE pet_id = $pet_id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST["Update"])) {
        $name = !empty($_POST["name"]) ? $_POST["name"] : $row["name"];
        $age = !empty($_POST["age"]) ? $_POST["age"] : $row["age"];
        $description = !empty($_POST["description"]) ? $_POST["description"] : $row["description"];
        $location = !empty($_POST["location"]) ? $_POST["location"] : $row["location"];
        $size = !empty($_POST["size"]) ? $_POST["size"] : $row["size"];
        $breed = !empty($_POST["breed"]) ? $_POST["breed"] : $row["breed"];
        $vaccinated = !empty($_POST["vaccinated"]) ? $_POST["vaccinated"] : $row["vaccinated"];
        $status = !empty($_POST["status"]) ? $_POST["status"] : $row["status"];

        $picture = fileUpload($_FILES["picture"], "default");

        if ($_FILES["picture"]["error"] == 0) {
            $delete = "./assets/{$row['picture']}";
            if ($row["picture"] !== "default.jpg" && file_exists($delete)) {
                unlink($delete);
            }
            $sql = "UPDATE `animals` SET `name`='$name', `picture`='$picture[0]', `age`='$age', `description`='$description', `location`='$location', `size`='$size', `breed`='$breed', `vaccinated`='$vaccinated', `status`='$status' WHERE pet_id = $pet_id";
        } else {
            $sql = "UPDATE `animals` SET `name`='$name', `age`='$age', `description`='$description', `location`='$location', `size`='$size', `breed`='$breed', `vaccinated`='$vaccinated', `status`='$status' WHERE pet_id = $pet_id";
        }

        if (mysqli_query($connect, $sql)) {
            echo "<div class='alert alert-success' role='alert'>Information has been successfully updated!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Oops! Something went wrong... Try again!</div>";
        }
    }
} else {
    echo "ID is missing or invalid.";
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
            background-image: url("assets/bg.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>

</head>
<body>
<?php require_once 'components/navbar.php' ?>

<div class="container">
    <form class="m-5" action="" method="post" enctype="multipart/form-data">

        <br>
        <label class="form-label">
            Name:
        </label>
        <input type="text" name="name" placeholder="Name" class="form-control">

        <br>

        <label class="form-label">
            Breed:
        </label>
        <input type="text" name="breed" placeholder="Breed" class="form-control">

        <br>
        <label class="form-label">
            Age:
        </label>
        <input type="text" name="age" placeholder="Age" class="form-control">

        <br>

        <label class="form-label">
            Size:
        </label>
        <input type="text" name="size" placeholder="Size" class="form-control">

        <br>

        <label class="form-label">
            Location:
        </label>
        <input type="text" name="location" placeholder="Location" class="form-control">

        <br>

        <label class="form-label">
            Short description of the pet:
        </label>
        <input type="textarea" name="description" placeholder="Short description of the pet" class="form-control">

        <br>


        <br>
        <label class="form-label">
            Vaccinated:
        </label>
        <select name="vaccinated">
            <option value="Vaccinated" <?php echo $row["vaccinated"] == "Vaccinated" ? "selected" : "" ?>>Vaccinated</option>
            <option value="Not vaccinated" <?php echo $row["vaccinated"] == "Not vaccinated" ? "selected" : "" ?>>Not vaccinated</option>
        </select>
        <br>
        <br>
        <label class="form-label">
            Status:
        </label>
        <select name="status">
            <option value="Available" <?php echo $row["status"] == "Available" ? "selected" : "" ?>>Available</option>
            <option value="Adopted" <?php echo $row["status"] == "Adopted" ? "selected" : "" ?>>Adopted</option>
        </select>
        <br>
        <br>



        <label class="form-label">Photo:
        </label>
        <input type="file" name="picture" class="form-control">

        <br>

        <input type="submit" name="Update" value="Update" class="btn btn-success">


    </form>
</div>

<?php require_once 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>