<?php
require 'vendor/autoload.php';
// Include OCR library
use thiagoalessio\TesseractOCR\TesseractOCR;

$conn = new mysqli("localhost", "root", "", "testing1");

if ($_FILES['file']['error'] == 0) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Ensure directory exists
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Extract text from image
        $extractedText = (new TesseractOCR($targetFilePath))->run();

        // Insert extracted text into database
        $stmt = $conn->prepare("INSERT INTO documents (filename, content) VALUES (?, ?)");
        $stmt->bind_param("ss", $fileName, $extractedText);
        $stmt->execute();

        echo "File uploaded and text extracted!";
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "File error!";
}
?>
