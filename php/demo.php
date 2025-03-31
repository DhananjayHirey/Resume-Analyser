<?php
    $pass = '##Password12';
    $email = 'dhananjayhirey2905@gmail.com';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "resume";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        echo("Error: Could Not Connect to Database!");
    }

$stmt = $conn->prepare("SELECT password FROM info WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo $row['password'].'\n';
        if (password_verify($pass,trim($row['password']))) { 
            if (preg_match('/@smartmatch\\.com/i', $email)) {
                echo "Veerified";
            } else {
                echo "Verified";
            }
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Email not found";
    }

    $stmt->close();
    $conn->close();



?>