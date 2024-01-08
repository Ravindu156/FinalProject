<?php
    //session_start();
    require_once 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RecipeRealm Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="CSS/loginstyle.css">

    <style>
        .error {
            color: #FF0000;
            font-size: 11px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="wrapper" style="background-image: url('Images/loginBG.jpg');  background-size: cover; background-position: center center;">
        <div class="inner">
            <div class="image-holder">
                <img src="images/loginForm.jpg" alt="">
            </div>

            <!--PHP  register form handling-->
            <?php
            //register values validation and insertion
            $fnameErr = $lnameErr = $usernameErr = $emailErr = $passwordErr = $conpasswordErr = $curuserErr = "";
            $fname = $lname = $username = $email = $password = $conpassword = "";

            if (isset($_POST['register'])) {
                $fname = $_POST["firstname"];
                $lname = $_POST["lastname"];
                $username = $_POST["username"];
                $email = $_POST["emailaddress"];
                $password = $_POST["password"];
                $conpassword = $_POST["confirmpassword"];

                //fname validation
                if (empty($fname)) {
                    $fnameErr = "Firstname is required";
                } else {
                    if (!preg_match("/^[a-zA-Z]*$/", $fname)) {
                        $fnameErr = "Only letters and white space allowed in firstname";
                        $fname = "";
                    } else {
                        $fname = test_input($fname);
                    }
                }

                //lname validation
                if (empty($lname)) {
                    $lnameErr = "Lastname is required";
                } else {
                    if (!preg_match("/^[a-zA-Z]*$/", $lname)) {
                        $lnameErr = "Only letters and white space allowed in lastname";
                        $lname = "";
                    } else {
                        $lname = test_input($lname);
                    }
                }

                //username validation
                if (empty($username)) {
                    $usernameErr = "Username is required";
                } else {
                    $username = test_input($username);
                }

                //email validation
                if (empty($email)) {
                    $emailErr = "Email is required";
                } else {
                    //check if email address is well-format
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Invalid email format";
                        $email = "";
                    } else {
                        $email = test_input($email);
                    }
                }

                //user password validation
                if (empty($password)) {
                    $passwordErr = "Password is required";
                } else {
                    //Add additional password validation rules
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $specialChars = preg_match('/[^\w]/', $password);

                    //password length validation
                    if (strlen($password) < 8 || strlen($password) > 20) {
                        $passwordErr = "Password must be between 8 and 20 characters";
                        $password = "";
                    } else {
                        $password = test_input($password);
                    }
                }

                // Validate confirm password
                if (empty($conpassword)) {
                    $conpasswordErr = "Password Confirm is required";
                } elseif ($password !== $conpassword) {
                    $conpasswordErr = "Passwords do not match";
                } else {
                    $conpassword = test_input($conpassword);
                }

                //get the registered user from the database (same username and password)
                $curusersql = "SELECT uusername, upassword
                                FROM users
                                WHERE uusername ='$username' OR upassword = '$password'";

                $curuserres = mysqli_query($conn, $curusersql);

                //check the username or password already there
                if (mysqli_num_rows($curuserres) > 0) {
                    $curuserErr = "Username or Password already Exists";
                } else {
                    if ($fnameErr == "" && $lnameErr == "" && $usernameErr == "" && $passwordErr == "" && $emailErr == "" && $curuserErr == "" && $conpasswordErr == "") {
                        // Escape input values for SQL query
                        $fname = mysqli_real_escape_string($conn, $fname);
                        $lname = mysqli_real_escape_string($conn, $lname);
                        $username = mysqli_real_escape_string($conn, $username);
                        $email = mysqli_real_escape_string($conn, $email);
                        $password = mysqli_real_escape_string($conn, $password);

                        $sql = "INSERT INTO users (fname, lname, uemail, uusername, upassword)
                                VALUES ('$fname', '$lname', '$email', '$username', '$password')";

                        $result = $conn->query($sql);

                        if ($result) {
                            header("Location: login.php");
                        } else {
                            echo "Error: Registration Failed! " . $sql . "<br>" . $conn->error;
                        }
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

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <h3>Registration Form</h3>

                <p><span class="requiredlabel">* required filed</span></p>
               <!-- <span class="error">*<?php echo $curuserErr; ?></span><br>-->

                <div class="form-group">
               <span class="error">*<?php echo $fnameErr; ?></span><input type="text" placeholder="First Name" class="form-control" name="firstname" required>
                <span class="error">*<?php echo $lnameErr; ?></span><input type="text" placeholder="Last Name" class="form-control" name="lastname" required>
                </div>
                <div class="form-wrapper">
                <span class="error">*<?php echo $usernameErr; ?></span><input type="text" placeholder="Username" class="form-control" name="username" required>
                    <i class="zmdi zmdi-account"></i>
                </div>
                <div class="form-wrapper">
                <span class="error">*<?php echo $emailErr; ?></span><input type="text" placeholder="Email Address" class="form-control" name="emailaddress" required>
                    <i class="zmdi zmdi-email"></i>
                </div>

                <div class="form-wrapper">
                <span class="error">*<?php echo $passwordErr; ?></span><input type="password" placeholder="Password" class="form-control" name="password" required>
                    <i class="zmdi zmdi-lock"></i>
                </div>
                <div class="form-wrapper">
                <span class="error">*<?php echo $conpasswordErr; ?></span><input type="password" placeholder="Confirm Password" class="form-control" name="confirmpassword" required>
                    <i class="zmdi zmdi-lock"></i>
                </div>
                <button type="submit" name="register">Register
                    <i class="zmdi zmdi-arrow-right"></i>
                </button>
                <div>
                    <br>
                    <a href="login.php"><center>Already Have an Account? Login Here</center></a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
