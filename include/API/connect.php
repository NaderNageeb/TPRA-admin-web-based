<?php 

// database Connection

$conn = mysqli_connect("localhost","root","","tpra_db");
mysqli_set_charset($conn,'UTF8');
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET CHARACTER SET utf8');
// this line to make my json api accept arabic language
header('Content-Type: application/json; charset=utf-8');
// this line to make my json api accept arabic language

global $conn; 


if($conn){
   // echo "connection is good";
}else{
    echo "Database Not Found";
}

// i used this function for security to filtr the request;
function filterRequest($requestname)
{
    global $conn; 

    return mysqli_escape_string($conn, htmlspecialchars(strip_tags($_POST[$requestname])));

}













?>