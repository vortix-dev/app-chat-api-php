<?php
require 'connect.php';
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['user'];
    $email = $_POST['email'];
    $password = $_POST['password'];    
    if(empty($name) || empty($username) || empty($email) || empty($password)) {
        $response['error'] = '001';
        $response['message'] = 'Please Fill All Fields';
    }else{
        $id=$_SESSION['User']['id'];
        $update_query = "UPDATE user SET name='$name', user='$username', email='$email', password='$password' WHERE id='$id'";
        $result = mysqli_query($conn, $update_query);
            
        if($result){
            $response["error"] = "000";
            $response["message"] = "Update Success";
        }else{
            $response["error"] = "003";
            $response["message"] = "Failed Update";
        }
    }
}
echo json_encode($response);
?>


