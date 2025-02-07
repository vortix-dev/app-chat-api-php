<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['user'];
    $email = $_POST['email'];
    $password = $_POST['password'];    
    if(empty($name) || empty($username) || empty($email) || empty($password)) {
        $response['error'] = '001';
        $response['message'] = 'Please Fill All Fields';
    }else{
        $check_user = "SELECT * FROM user WHERE email ='$email' OR user = '$username'";
        $check_query = mysqli_query($conn, $check_user);
        
        if(mysqli_num_rows($check_query) > 0){
            $response['error'] = '002';
            $response['message'] = 'Username Or Email Already Exists';
        }else{
            $insert_query = "INSERT INTO user(name,user,email,password) VALUES ('$name','$username','$email','$password')";
            $result = mysqli_query($conn, $insert_query);
            
            if($result){
                $response["error"] = "000";
                $response["message"] = "Register Success";
            }else{
                $response["error"] = "003";
                $response["message"] = "Failed Register";
            }
        }
    }
    echo json_encode($response);
}



?>