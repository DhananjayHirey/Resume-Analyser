<?php
require 'vendor/autoload.php';
use thiagoalessio\TesseractOCR\TesseractOCR;
// $file = $_FILES["fileToUpload"]["name"];
$text =  (new TesseractOCR('ResumeTemplate7.png'))
    ->run();
echo $text;
?>