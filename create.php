<?php

require_once 'components/db_connect.php';
require_once 'components/fileUpload.php';

if(isset($_POST["Create"])){
    $name = $_POST["name"];
    $picture = fileUpload($_FILES["picture"], "default");
    $age = $_POST["age"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $size = $_POST["size"];
    $breed = $_POST["breed"];
    $vaccinated = $_POST["vaccinated"];
    $status = $_POST["status"];




    $sql = "INSERT INTO `animals` (`name`, `picture`, `age`, `description`, `location`, `size`, `breed`, `vaccinated`, `status`) 
        VALUES ('$name', '$picture[0]', '$age', '$description', '$location', '$size', '$breed', '$vaccinated', '$status')";


    if(mysqli_query($connect, $sql)){
        echo "
            <div class='alert alert-success' role='alert'>
                New product created!
            </div>";
    }
    else {
        echo "
            <div class='alert alert-danger' role='alert'>
                Something went wrong!
            </div>";
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
            <option value="Vaccinated">Vaccinated</option>
            <option value="Not vaccinated">Not vaccinated</option>
        </select>
        <br>
        <br>
        <label class="form-label">
            Status:
        </label>
        <select name="status">
            <option value="Available">Available</option>
            <option value="Adopted">Adopted</option>
        </select>
        <br>
        <br>



        <label class="form-label">Photo:
        </label>
        <input type="file" name="picture" class="form-control">

        <br>

        <input type="submit" name="Create" value="Create" class="btn btn-success">


    </form>
</div>

<?php require_once 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>