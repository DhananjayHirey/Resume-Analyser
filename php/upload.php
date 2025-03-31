<?php
session_start();
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$id = $_SESSION['id'];

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    echo "<script>Alert('File is an image - " . $check["mime"] . ".')</script>";
    $uploadOk = 1;
  } else {
    echo "<script>alert('File is not an image.')</script>";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "<script>alert('Sorry, file already exists.')</script>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 500000) {
  echo "<script>alert('Sorry, your file is too large.')</script>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<script>alert('Sorry, your file was not uploaded.')</script>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "<script>alert('The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.')</script>";
  } else {
    echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
  }
}

require 'vendor/autoload.php';
use thiagoalessio\TesseractOCR\TesseractOCR;

$text =  (new TesseractOCR($target_file))
->run();


// Connecting to the DBase
$servername = "localhost";
$username = "root";
$password = "";
$database = "resume";

//creating a connection
$conn = mysqli_connect($servername,$username,$password,$database);
$sql = "UPDATE `info` SET `file_ref` = '$target_file' WHERE `info`.`id` = $id;";
$result = mysqli_query($conn,$sql);
$sql = "UPDATE `info` SET `file_text` = '$text' WHERE `info`.`id` = $id;";
$result = mysqli_query($conn,$sql);

$_SESSION['file_ref']=$target_file;
?>