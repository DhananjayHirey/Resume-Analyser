<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

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
if ($_FILES["fileToUpload"]["size"] > 500000) {
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
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

require 'vendor/autoload.php';
use thiagoalessio\TesseractOCR\TesseractOCR;
// $file = $_FILES["fileToUpload"]["name"];
$text =  (new TesseractOCR($target_file))
    ->run();
echo $text;

// Connecting to the DBase
$servername = "localhost";
$username = "root";
$password = "";
$database = "resume";

//creating a connection
$conn = mysqli_connect($servername,$username,$password,$database);
$sql = "INSERT INTO `info` (`id`, `reg_number`, `email`, `password`,`created_at`,`full_name`,`phone`,`file_ref`,`file_text`) VALUES ('1', '123', 'email', 'pass','created','name','98905','$target_file','$text');";
$result = mysqli_query($conn,$sql);

?>