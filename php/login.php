<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    // $pass = hash('sha256',$email,$pass);
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "resume";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        echo("Error: Could Not Connect to Database!");
    }

    // $sql = "SELECT * FROM `info` WHERE `email`='$email'";
    // $result = mysqli_query($conn,$sql);
    // $num_rows = mysqli_num_rows($result);
    // if($num_rows>0){
    //     while($row = mysqli_fetch_assoc($result)){
    //         if(password_verify($pass,$row['password'])){
    //             if(preg_match('/@smartmatch\\.com/i',$email)){
    //                 header("Location: admin_portal.html");
    //                 exit();
    //             }
    //             else{
    //                 header("Location: user_portal.html");
    //                 exit();
    //             }
    //         }
    //         else{
    //             echo $pass." ".$row['password'];
    //         }
    //     }
    // }
    // else{
    //     echo"Email not found";
    // }




    // // Use prepared statement to fetch the password
    $stmt = $conn->prepare("SELECT * FROM info WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($pass,$row['password'])) { 
            if (preg_match('/@smartmatch\\.com/i', $email)) {
                session_start();
                $_SESSION['name']=$row['full_name'];
                $_SESSION['file_ref']=$row['file_ref'];
                $_SESSION['id']=$row['id'];
                $_SESSION['p_no']=$row['phone'];
                $_SESSION['reg_no']=$row['reg_number'];
                $_SESSION['email']=$row['email'];
                echo "aLogging in...";
            } else {
                session_start();
                $_SESSION['name']=$row['full_name'];
                $_SESSION['file_ref']=$row['file_ref'];
                $_SESSION['id']=$row['id'];
                $_SESSION['p_no']=$row['phone'];
                $_SESSION['reg_no']=$row['reg_number'];
                $_SESSION['email']=$row['email'];
                echo "uLogging in...";
            }
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Email not found";
    }

    $stmt->close();
    $conn->close();
}
?>
