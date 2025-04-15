<?php
ob_start();
if(!isset($_SESSION)){
    session_start();

}
       $conn = mysqli_connect("localhost","root","","authentication");
     if(!$conn) 
     {
        die("Connectin Failed").mysqli_connect_error($conn);
    }
    ?>