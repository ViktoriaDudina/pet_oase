<?php

require_once "./components/db_connect.php";

if(isset($_GET["pet_id"]) && !empty($_GET["pet_id"])){
    $pet_id = $_GET["pet_id"];

    $deletePetAdoptionQuery = "DELETE FROM pet_adoption WHERE pet_id = $pet_id";
    mysqli_query($connect, $deletePetAdoptionQuery);

    $deleteAnimalQuery = "DELETE FROM animals WHERE pet_id = $pet_id";

    if(mysqli_query($connect, $deleteAnimalQuery)){
        mysqli_close($connect);
        echo "<div class='alert alert-success' role='alert'>Information has been successfully deleted!</div>";
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($connect);
    }
} else {
    mysqli_close($connect);
    header("Location: index.php");
    exit;
}

?>
