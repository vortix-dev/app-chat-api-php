<?php
session_start();
session_unset(); 
session_destroy(); 

$response["error"] = "000";
$response["message"] = "Logged out";


header("Content-Type: application/json");
echo json_encode($response);
exit();




?>