<?php
require 'connect.php';
header("Content-Type: application/json");

$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $response['users'][] = $row; 
    }
}else{
    $response['error'] = "No Users Found";
}
echo json_encode($response);


?>