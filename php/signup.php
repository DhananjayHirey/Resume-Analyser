<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['name']);
    $phone = trim($_POST['phn_number']);
    $reg_number = trim($_POST['reg_number']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "!Invalid email format";
        exit;
    }

    // Validate phone number format (10-digit number)
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        echo "!Invalid phone number format";
        exit;
    }

    // Password strength validation
    if (strlen($pass) < 8 || !preg_match('/[A-Z]/', $pass) || !preg_match('/[a-z]/', $pass) || !preg_match('/\d/', $pass) || !preg_match('/[\W]/', $pass)) {
        echo "!Password must be at least 8 characters long, include one uppercase letter, one lowercase letter, one digit, and one special character";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($pass,PASSWORD_DEFAULT);

    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "user_details";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    // if ($conn->connect_error) {
    //     die("<scrip>alert('Database connection failed');</script>");
    // }

    // Check if email or registration number already exists
    $stmt = $conn->prepare("SELECT email, reg_number FROM info WHERE email = ? OR reg_number = ?");
    $stmt->bind_param("ss", $email, $reg_number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email or Registration number already registered. Login instead!";
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    // Insert new user with prepared statement
    $stmt = $conn->prepare("INSERT INTO info (full_name, phone, reg_number, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $phone, $reg_number, $email, $hashed_password);
    
    if ($stmt->execute()) {
        echo "Signup successful! You can now login.";
    } else {
        echo $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
