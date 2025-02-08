<?php
require 'connect.php';
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['User'])) {
    $sender = $_SESSION['User'] ['id'];
    $receiver = $_POST['receiver'];
    $message = $_POST['message'];
    $date = date("Y-m-d-H-i-s");
    if(empty($receiver) || empty($message)) {
        $response['error'] = '001';
        $response['message'] = 'Please Fill All Fields';
    }else{
        $check_receiver = "SELECT * FROM user WHERE user ='$receiver' OR name = '$receiver'";
        $check_query = mysqli_query($conn, $check_receiver);    
        if(mysqli_num_rows($check_query) > 0){
            $row = mysqli_fetch_assoc($check_query);
            $receiver = $row["id"];
            $insert_query = "INSERT INTO message(sender,receiver,message,date) VALUES ('$sender','$receiver','$message','$date')";
            $result = mysqli_query($conn, $insert_query);        
            if($result){
                $response["error"] = "000";
                $response["message"] = "Send Success";
            }
        }else{
            $response["error"] = "002";
            $response["message"] = "Account not found";
        }
    }        
}
echo json_encode($response);

