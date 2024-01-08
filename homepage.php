<?php
    require_once 'config.php';
    session_start();

    if(!isset($_SESSION["user_id"])){
        header("Location:login.php");
    }

    $user_name = $_SESSION["user_name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<meta charset="UTF-8">
   
<meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>RecipeRealm-Home Page</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="CSS/homepagessstyle.css">    
    <link rel="stylesheet" href="CSS/homepagesssstyle.css">    

    <style>
        @import url(https://fonts.googleapis.com/css?family=Lato);

    </style>
</head>

<body>
    <header>

    <div class="content" style="">

    <section class="site" >
    <nav>
        <span style="color:#21D424">Welcome <?php echo $user_name?></span>
        <a href="recipes.php">Recipes</a>
        <a href="contact.php">Contact Us</a>
        <a href="logout.php" style="color:rgb(196,37,47)">Log Out</a> 
        
    </nav>
</section>

        <hgroup>
        <img src="Images/coffee-beans.png" alt="logo" style="width:200px; height:200px;">
        <br>
        <center><h2>Recipe Realm</h2></center>
        </hgroup>

       <!-- <center>
        <div class="welcome">
        <p><br>Welcome <?php echo $user_name?></p>
        </div>
        </center>-->
    </div>
    
    

    <div class="imageGellery">
      <center>
        <h2>Discover Recipes</h2>
        <img src="images/soup.jpg" width="200px" height="175px">
        <img src="images/apetizer.jpg" width="200px" height="175px"><br>
        <img src="images/mainmeal.jpg" width="200px" height="175px">
        <img src="images/desert.jpg" width="200px" height="175px">
    </div>

    <div class="overlay"></div>
    </header>

    <center><a href="recipes.php"><button>Veiw Recipes</button></a></center>

    <!-- social Section Starts Here -->
    <section class="social" height="100px">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
        <div class="container text-center">
            <p>All rights reserved. </p>
        </div>

    </section>
    <!-- social Section Ends Here -->

</body>
</html>