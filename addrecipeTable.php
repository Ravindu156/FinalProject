<?php
    require_once 'config.php';

    $sql = "CREATE TABLE addrecipe (
        id INT AUTO_INCREMENT PRIMARY KEY,
        uname VARCHAR(255) NOT NULL,
        uemail VARCHAR(255) NOT NULL,
        nameoffood VARCHAR(255) NOT NULL,
        typeoffood VARCHAR(255) NOT NULL,
        tasteoffood VARCHAR(255) NOT NULL,
        ingredientsfood VARCHAR(2000) NOT NULL,
        preparefood VARCHAR(255) NOT NULL
    )";

    if(mysqli_query($conn, $sql)){
       // echo "Table users Created Successfully";
    }

    else{
       // echo "Error in table Creation".mysql_error($conn);
    }
?>