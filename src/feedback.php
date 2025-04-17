<?php
// Process form submission only for AJAX requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set headers for JSON response
    header('Content-Type: application/json');
    
    // Database configuration
    $servername = "localhost";
    $username = "root";  // Change to your database username
    $password = "";      // Change to your database password
    $dbname = "plagiarism_checker";  // Change to your database name
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    
    // Check connection
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
        exit;
    }
    
    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) !== TRUE) {
        echo json_encode(['success' => false, 'message' => 'Error creating database: ' . $conn->error]);
        exit;
    }
    
    // Select the database
    $conn->select_db($dbname);
    
    // Create table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS feedback (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        description TEXT NOT NULL,
        stars INT(1) DEFAULT 5,
        submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql) !== TRUE) {
        echo json_encode(['success' => false, 'message' => 'Error creating table: ' . $conn->error]);
        exit;
    }
    
    // Get form data and sanitize
    $name = isset($_POST['name']) ? $conn->real_escape_string(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : '';
    $description = isset($_POST['message']) ? $conn->real_escape_string(trim($_POST['message'])) : '';
    $stars = isset($_POST['stars']) ? intval($_POST['stars']) : 5; // Default to 5 stars if not provided
    
    // Validate data
    if (empty($name) || empty($email) || empty($description)) {
        echo json_encode(['success' => false, 'message' => 'Please fill all required fields']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }
    
    // Ensure stars is between 1 and 5
    if ($stars < 1 || $stars > 5) {
        $stars = 5; // Default to 5 if invalid
    }
    
    // Insert data into database
    $sql = "INSERT INTO feedback (name, email, description, stars) 
            VALUES (?, ?, ?, ?)";
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssi", $name, $email, $description, $stars);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Feedback submitted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error submitting feedback: ' . $stmt->error]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
    }
    
    // Close connection
    $conn->close();
    
    // Exit to prevent HTML output for AJAX requests
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback - Plagiarism Checker</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 600px;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 10px;
            text-align: center;
        }

        p {
            color: #7f8c8d;
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            margin-top: 15px;
            display: block;
            font-weight: 500;
            color: #2c3e50;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px 15px;
            margin-top: 5px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            background-color: #fff;
            color: #333;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input::placeholder,
        textarea::placeholder {
            color: #bdc3c7;
        }

        input:focus,
        textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            margin: 15px 0;
        }

        .rating input {
            display: none;
        }

        .rating label {
            position: relative;
            width: 30px;
            font-size: 30px;
            color: #e0e0e0;
            cursor: pointer;
            margin: 0 5px;
        }

        .rating label:before {
            content: "★";
            position: absolute;
            opacity: 1;
        }

        .rating input:checked~label:before {
            color: #f1c40f;
        }

        .rating label:hover:before,
        .rating label:hover~label:before {
            color: #f1c40f;
            opacity: 0.8;
        }

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 14px 20px;
            font-size: 16px;
            border-radius: 8px;
            margin-top: 25px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s;
            font-weight: 500;
        }

        button:hover {
            background-color: #2980b9;
            transform: scale(1.02);
        }

        #thankYouMessage {
            margin-top: 25px;
            padding: 20px;
            background-color: #e8f8f5;
            border: 1px solid #abebc6;
            border-radius: 10px;
            color: #27ae60;
            text-align: center;
        }

        #errorMessage {
            margin-top: 25px;
            padding: 20px;
            background-color: #fdedec;
            border: 1px solid #f5b7b1;
            border-radius: 10px;
            color: #e74c3c;
            text-align: center;
        }

        .hidden {
            display: none;
        }

        .loader {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        h2 {
            margin-bottom: 10px;
            font-size: 20px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>We Value Your Feedback</h1>
        <p>Let us know how we can improve your experience.</p>
        <form id="feedbackForm">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required />

            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" placeholder="example@mail.com" required />

            <label>Your Rating</label>
            <div class="rating">
                <input type="radio" id="star5" name="stars" value="5" checked />
                <label for="star5"></label>
                <input type="radio" id="star4" name="stars" value="4" />
                <label for="star4"></label>
                <input type="radio" id="star3" name="stars" value="3" />
                <label for="star3"></label>
                <input type="radio" id="star2" name="stars" value="2" />
                <label for="star2"></label>
                <input type="radio" id="star1" name="stars" value="1" />
                <label for="star1"></label>
            </div>

            <label for="message">Your Feedback</label>
            <textarea id="message" name="message" placeholder="Write your feedback here..." rows="5"
                required></textarea>

            <button type="submit" id="submitBtn">Submit Feedback</button>
        </form>

        <div id="loadingIndicator" class="hidden">
            <div class="loader"></div>
            <p>Submitting your feedback...</p>
        </div>

        <div id="thankYouMessage" class="hidden">
            <h2>Thank you!</h2>
            <p>We appreciate your feedback and will use it to improve our services.</p>
        </div>

        <div id="errorMessage" class="hidden">
            <h2>Oops!</h2>
            <p id="errorText">Something went wrong. Please try again later.</p>
        </div>
    </div>

    <script>
        document.getElementById("feedbackForm").addEventListener("submit", function (e) {
            e.preventDefault();

            // Show loading indicator
            document.getElementById("loadingIndicator").classList.remove("hidden");
            document.getElementById("feedbackForm").classList.add("hidden");
            document.getElementById("thankYouMessage").classList.add("hidden");
            document.getElementById("errorMessage").classList.add("hidden");

            // Collect form data
            const formData = new FormData(this);

            // Send AJAX request
            fetch(window.location.href, {
                method: "POST",
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Server responded with an error');
                    }
                    return response.json();
                })
                .then(data => {
                    // Hide loading indicator
                    document.getElementById("loadingIndicator").classList.add("hidden");

                    if (data.success) {
                        // Show thank you message
                        document.getElementById("thankYouMessage").classList.remove("hidden");
                        // Reset form
                        this.reset();
                    } else {
                        // Show error message
                        document.getElementById("errorText").textContent = data.message || "Something went wrong. Please try again.";
                        document.getElementById("errorMessage").classList.remove("hidden");
                        document.getElementById("feedbackForm").classList.remove("hidden");
                    }
                })
                .catch(error => {
                    // Hide loading indicator
                    document.getElementById("loadingIndicator").classList.add("hidden");

                    // Show error message
                    document.getElementById("errorText").textContent = "Network error. Please check your connection and try again.";
                    document.getElementById("errorMessage").classList.remove("hidden");
                    document.getElementById("feedbackForm").classList.remove("hidden");

                    console.error("Error:", error);
                });
        });
    </script>
</body>

</html>