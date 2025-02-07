<?php
    $conn = mysqli_connect("localhost","root","","chat");
    if(!$conn){
        echo"eror";
    }
    session_start();

?>