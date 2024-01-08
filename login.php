<?php
    require_once 'config.php';
   
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>RecipeRealm Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="Fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="CSS/loginstyle.css">

		<style>
			 .error-message {
				color: #dc3545;
				margin-bottom: 15px;
        }
		</style>
	</head>

	<body>

		<div class="wrapper" style="background-image: url('Images/loginBG.jpg');  background-size: cover; background-position: center center;">
			<div class="inner">
				<div class="image-holder">
					<img src="images/loginForm.jpg" alt="">
				</div>

				

				<form action="login.php" method="post">
					<h3>Login</h3>

					<?php
					if(isset($_POST['login'])){
						$username = $_POST["userName"];
						$password = $_POST["Password"];

						$sql = "SELECT id, uusername FROM users
								WHERE
								uusername='$username' AND upassword='$password'";

						$result = $conn ->query($sql);

						if($result->num_rows>0){
							session_start();

							$row = $result->fetch_assoc();
							$_SESSION["user_id"] = $row["id"];
							$_SESSION["user_name"] = $row["uusername"];

							header("Location: homepage.php");
						}
						else{
							echo '<p class="error-message">Invalid username or password.</p>';
						}
					}
				?>
					
					<div class="form-wrapper">
						<input type="text" placeholder="Username" class="form-control" name="userName" required>
						<i class="zmdi zmdi-account"></i>
					</div>
				
					
					<div class="form-wrapper">
						<input type="password" placeholder="Password" class="form-control" name="Password" required>
						<i class="zmdi zmdi-lock"></i>
					</div>
					
					<button type="submit" name="login">Login
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
                  <div>
                     <br>
                   <a href="register.php"><center>New to Here? Register Now</center></a>
                  </div>
				</form>
			</div>
		</div>
		
	</body>
</html>