<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "recipedb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if(!$conn){
        die("Connection Faild!".mysqli_connect_error());
    }

  //  echo "Connected Successfully";
?>