<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['User'])) {
    $receiver = $_POST['receiver'];
    $sender = $_SESSION['User']['id'];
    if(empty($receiver)) {
        $response['error'] = '001';
        $response['message'] = 'Please Fill Field';
    }else{
        $check_receiver = "SELECT * FROM user WHERE user ='$receiver' OR name = '$receiver'";
        $check_query = mysqli_query($conn, $check_receiver);    
        if(mysqli_num_rows($check_query) > 0){
            $row = mysqli_fetch_assoc($check_query);
            $receiver = $row["id"];
            $check_query = "SELECT * FROM message WHERE sender ='$sender' AND receiver='$receiver'";
            $result = mysqli_query($conn, $check_query);        
            if($result){
                while ($row = mysqli_fetch_assoc($result)) {
                    $response['message'][] = $row; 
                }
            }
        }else{
            $response["error"] = "002";
            $response["message"] = "Account not found";
        }
    }



}

echo json_encode($response);


?>
