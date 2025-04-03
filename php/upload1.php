<?php
$dir = "uploads/";
$file = $dir . basename($_FILES["file"]["name"]);


$uploadOk = 1;
$imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));


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


if (file_exists($file)) {
  echo "<script>alert('Sorry, file already exists.')</script>";
  $uploadOk = 0;
}


if ($_FILES["file"]["size"] > 500000) {
  echo "<script>alert('Sorry, your file is too large.')</script>";
  $uploadOk = 0;
}


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
  $uploadOk = 0;
}


if ($uploadOk == 0) {
  echo "<script>alert('Sorry, your file was not uploaded.')</script>";

} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $file)) {
    echo "<script>alert('The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.')</script>";
  } else {
    echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
  }
}


?>