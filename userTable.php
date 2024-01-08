<?php
    require_once 'config.php';

    $sql = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(50) NOT NULL,
        lname VARCHAR(50) NOT NULL,
        uemail VARCHAR(150) NOT NULL,
        uusername VARCHAR(50) NOT NULL,
        upassword VARCHAR(50) NOT NULL
    )";

    if(mysqli_query($conn, $sql)){
        //echo "Table users Created Successfully";
    }

    else{
       // echo "Error in table Creation".mysql_error($conn);
    }
?>