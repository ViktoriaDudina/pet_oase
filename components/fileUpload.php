<?php
function fileUpload($picture, $source = "default"){

    if($picture["error"] == 4){
        $pictureName = "avatar.png";

        if($source == "default"){
            $pictureName = "default.jpg";
        }

        $message = "No picture has been chosen, but you can upload an image later :)" ;
    }else{
        $checkIfImage = getimagesize($picture["tmp_name" ]);
        $message = $checkIfImage ? "Ok" : "Not an image";
    }

    if($message == "Ok"){
        $ext = strtolower(pathinfo($picture["name" ],PATHINFO_EXTENSION));
        $pictureName = uniqid("" ). "." . $ext;
        $destination = "assets/{$pictureName}" ;

        if($source == "default"){
            $destination = "./assets/{$pictureName}" ;
        }

        move_uploaded_file($picture["tmp_name" ], $destination);
    }elseif($message == "Not an image"){
        $pictureName = "avatar.png";
        $message = "the file that you selected is not an image, you can upload a picture later" ;
    }

    return  [$pictureName, $message];
}

?>