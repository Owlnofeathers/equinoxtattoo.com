<?php

function uploadTo($directory) { // function for uploading images into a given directory

    global $message;
    $target_dir = $directory;
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $message = '<div class="alert alert-success" role="alert">File is an image - ' . $check["mime"] . '.</div>';
            $uploadOk = 1;
        } else {
            $message = '<div class="alert alert-danger" role="alert">File is not an image.</div>';
            $uploadOk = 0;
        } 
        // Check if file already exists
        if (file_exists($target_file)) {
            $message = '<div class="alert alert-danger" role="alert">Sorry, file already exists.</div>';
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $message = '<div class="alert alert-danger" role="alert">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
             $message = '<div class="alert alert-danger" role="alert">Sorry, your file was not uploaded.</div>';
         // if everything is ok, try to upload file
         } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                 $message = '<div class="alert alert-success" role="alert">The file '.basename( $_FILES["fileToUpload"]["name"]).'  has been uploaded.</div>';
            } else {
                $message = '<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>';
            }
         }
    } 
}

function uploadTo2($directory) { // function for uploading images into a second given directory

    global $message;
    $target_dir = $directory;
    $target_file = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit2"])) {
        $check = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
        if($check !== false) {
            $message = '<div class="alert alert-success" role="alert">File is an image - ' . $check["mime"] . '.</div>';
            $uploadOk = 1;
        } else {
            $message = '<div class="alert alert-danger" role="alert">File is not an image.</div>';
            $uploadOk = 0;
        }  
        // Check if file already exists
        if (file_exists($target_file)) {
            $message = '<div class="alert alert-danger" role="alert">Sorry, file already exists.</div>';
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $message = '<div class="alert alert-danger" role="alert">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
             $message = '<div class="alert alert-danger" role="alert">Sorry, your file was not uploaded.</div>';
         // if everything is ok, try to upload file
         } else {
            if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) {
            } else {
                $message = '<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>';
            }
         }
    } 
}

function uploadTo3($directory) { // function for uploading images into a third given directory, replace image  function, 
                                    //this one does not check for image already exists
    global $message;
    $target_dir = $directory;
    $target_file = $target_dir . basename($_FILES["fileToUpload3"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit3"])) {
        $check = getimagesize($_FILES["fileToUpload3"]["tmp_name"]);
        if($check !== false) {
            $message = '<div class="alert alert-success" role="alert">File is an image - ' . $check["mime"] . '.</div>';
            $uploadOk = 1;
        } else {
            $message = '<div class="alert alert-danger" role="alert">File is not an image.</div>';
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $message = '<div class="alert alert-danger" role="alert">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
             $message = '<div class="alert alert-danger" role="alert">Sorry, your file was not uploaded.</div>';
         // if everything is ok, try to upload file
         } else {
            if (move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_file)) {
                 $message = '<div class="alert alert-success" role="alert">The file '.basename( $_FILES["fileToUpload3"]["name"]).'  has been uploaded.</div>';
            } else {
                $message = '<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>';
            }
         }
    } 
}

?>