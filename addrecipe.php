<?php
    session_start();
    require_once 'config.php';
?>

<?php
         //register values validation and insertion
         $usernameErr = $emailErr = $nameoffoodErr = $typeoffoodErr = $tasteoffoodErr = $ingredientsErr = $prepareErr = "";
         $username = $email = $nameoffood = $typeoffood = $tasteoffood = $ingredients = $prepare = "";

         if (isset($_POST['submit'])) {
             $username = $_POST["username"];
             $email = $_POST["email"];
             $nameoffood = $_POST["foodname"];
             $typeoffood = $_POST["foodtype"];
             $tasteoffood = $_POST["ans"];
             $ingredients = $_POST["ingredients"];
             $prepare = $_POST["prepare"];

            
          
             //username validation
             if (empty($username)) {
                 $usernameErr = "Username is required";
             }
             
             else {
                $username = test_input($username); 
             }

             //email validation
             if (empty($email)) {
                $emailErr = "Email is required";
            }
           
            else {
                //check if email address is well-format
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                    $email = "";
                } else {
                    $email = test_input($email);
                }
            }

            //foodname validation
            if (empty($nameoffood)) {
                $nameoffoodErr = "Name of food is required";
            } 
            else {
               $nameoffood = test_input($nameoffood); 
            }

           
           
            //ingredients validation
            if (empty($ingredients)) {
                $ingredientsErr = "Ingredients are required";
            } 
            else {
               $ingredients = test_input($ingredients); 
            }

            //prepare validation
            if (empty($prepare)) {
                $prepareErr = "Method is required";
            } 
            else {
               $prepare = test_input($prepare); 
            }

             if ($usernameErr == "" && $emailErr == "" && $nameoffoodErr == "" && $typeoffoodErr == "" && $tasteoffoodErr == "" && $ingredientsErr == "" && $prepareErr == "") {
    
                     $sql = "INSERT INTO addrecipe (uname, uemail, nameoffood, typeoffood, tasteoffood, ingredientsfood, preparefood)
                             VALUES ('$username', '$email', '$nameoffood', '$typeoffood', '$tasteoffood', '$ingredients', '$prepare')";

                     $result = mysqli_query($conn,$sql);
                     if ($result) {
                      // echo "Success";
                       //  header("Location:recipes.php");
                         
                         //exit();
                
                     } 
                     else {
                         echo "Error: Adding recipe Failed! " . $sql . "<br>" . $conn->error;
                     }
                 }
             
         }
         function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }           
?>

<?php
 
  $sql1 = "SELECT * FROM addrecipe
          WHERE
          uname='$username'";

  $result1 = $conn->query($sql1);

  if($result1->num_rows>0){
   
    $row = $result1->fetch_assoc();
    $_SESSION["user_username"] = $row["uname"];
    $_SESSION["user_nameoffood"] = $row["nameoffood"];
    $_SESSION["user_typeoffood"] = $row["typeoffood"];
    $_SESSION["user_tasteoffood"] = $row["tasteoffood"];
    $_SESSION["user_ingredients"] = $row["ingredientsfood"];
    $_SESSION["user_prepare"] = $row["preparefood"];

    header("Location:recipes.php");
  }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>

    <link rel="stylesheet" href="CSS/addrecipestyle.css">    

   <script>
        function showMessage() {
            alert("Added Recipe Successfull!");
            window.location.href = 'recipes.php';
        }
    </script>
</head>
<body>

<section class="navbar">
        <div class="container" style="width:100%; margin:0 auto; padding:1%; background:rgba(0,0,0,0.2);">
            <div class="logo">
                <a href="#" title="Logo">
                  <img src="images/logo1.png" alt="Restaurant Logo" class="img-responsive" style="width:50%;">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    
                    <li>
                        <a href="homepage.php">Home</a>
                    </li>
                    <li>
                        <a href="recipes.php">Recipies</a>
                    </li>
                   
                    <li>
                        <a href="contact.php">Contact Us</a>
                    </li>
                    
                    <li>
                        <a href="logout.php" style="color:rgb(196,37,47)">Log Out</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
<div class="formbold-main-wrapper">
 
  <div class="formbold-form-wrapper">
    <img src="Images/addrecipee.jpg" style="border-radius:10%;">


    <form action="addrecipe.php" method="POST" enctype="multipart/form-data">
      <div class="formbold-input-group">
      <p><span class="requiredlabel">* required filed</span></p>
        <label for="username" class="formbold-form-label"> Username </label>
        <span class="error">*<?php echo $usernameErr;?></span>
        <input
          type="text"
          name="username"
          id="username"
          placeholder="Enter username"
          class="formbold-form-input"
        />
      </div>

     
      <div class="formbold-input-group">
        <label for="email" class="formbold-form-label"> Email </label>
        <span class="error">*<?php echo $emailErr;?></span>
        <input
          type="email"
          name="email"
          id="email"
          placeholder="Enter your email"
          class="formbold-form-input"
        />
      </div>

      <div class="formbold-input-group">
        <label for="nameoffood" class="formbold-form-label"> Name Of the Food </label>
        <span class="error">*<?php echo $nameoffoodErr;?></span>
        <input
          type="text"
          name="foodname"
          id="foodname"
          placeholder="What is the food?"
          class="formbold-form-input"
        />
      </div>

      <div class="formbold-input-group">
        <label class="formbold-form-label">
          What type of Food?
        </label>
        <span class="error">*<?php echo $typeoffoodErr;?></span>

        <select class="formbold-form-select" name="foodtype" id="foodtype">
          <option value="Veg">Veg</option>
          <option value="Non-Veg">Non-Veg</option>
          <option value="Beverage">Beverage</option>
          <option value="Dessert">Dessert</option>
          <option value="Other">Other</option>
        </select>
      </div>

      <div class="formbold-input-group">
        <label class="formbold-form-label">
          What is the taste Food?
        </label>
        <span class="error">*<?php echo $tasteoffoodErr;?></span>

        <select class="formbold-form-select" name="ans" id="foodtype">
          <option value="Spicy">Spicy</option>
          <option value="Sweet">Sweet</option>
          <option value="Hot">Hot</option>
          <option value="Cool">Cool</option>
          <option value="Other">Other</option>
        </select>
      </div>

      <div>
        <label for="ingredients" class="formbold-form-label">
        Ingredients
        </label>
        <span class="error">*<?php echo $ingredientsErr;?></span>
        <textarea
          rows="6"
          name="ingredients"
          id="ingredients"
          placeholder="Type here..."
          class="formbold-form-input"
        ></textarea>
      </div>

      <div>
        <label for="method" class="formbold-form-label">
          How to prepare?
        </label>
        <span class="error">*<?php echo $prepareErr;?></span>
        <textarea
          rows="6"
          name="prepare"
          id="prepare"
          placeholder="Type here..."
          class="formbold-form-input"
        ></textarea>
      </div>

      <button class="formbold-btn" name="submit" onclick="showMessage()">Submit</button>
    </form>
  </div>
</div>

</body>
</html>