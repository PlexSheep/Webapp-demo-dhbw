<?php
define("rep", 1);
require 'common.php';
$target_dir = "img/useruploads/";
// if the original image is foo.png, the uploaded name will be something like
// 040c4c0c6032d0c0fc1407f963bc0c2c-foo.png
// This ensures that the file ending is kept, the original title is preserved for the user, and
// images will not collide when random_int() returns the same number two times.
$file_name_parts = explode('.', $_FILES["fileToUpload"]["name"]);
$file_extension = array_pop($file_name_parts);
$file_name_without_extension = join(" ", $file_name_parts);
print_r($file_name_without_extension);
echo "<br>";
$filename = (string)(md5(random_int(0, PHP_INT_MAX)) . "-" . substr($file_name_without_extension, 0, 27)) . "." . substr($file_extension, 0, 3);
$target_file = $target_dir . $filename;
print_r($target_file);
echo "<br>";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
// the limit here is 2**24 which is 2MiB iirc
if ($_FILES["fileToUpload"]["size"] > 16777216) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    // add the file to the database, then upload.
    $conn = new DatabaseConnection($ini_array);
    $recipe = $conn->get_recepe_by_id($_POST['recipe']);
    $query = "UPDATE `recipie` SET `image_path` = '" . $filename ."' WHERE `recipie`.`id` = '" . $recipe['id'] . "' ";
    $result = $conn->query_database($query);
    print_r($result);
    if (!$result) {
        die("could not set image path in db.");
    }
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
