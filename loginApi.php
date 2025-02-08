<?php
    include("connect.php");
    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];    
        if(empty($email) || empty($password)) {
            $response['error'] = '001';
            $response['message'] = 'Please Fill All Fields';
        }else{
            $check_user = "SELECT * FROM user WHERE email ='$email' OR user = '$email' AND password = '$password'";
            $check_query = mysqli_query($conn, $check_user);
            
            if(mysqli_num_rows($check_query) > 0){
                $_SESSION["User"] = mysqli_fetch_assoc(mysqli_query($conn,$check_user));
                $response['error'] = '000';
                $response['message'] = 'Login Success';
            }else{
                $response["error"] = "002";
                $response["message"] = "Login Error";
            }
        }
        echo json_encode($response);
    }
?>