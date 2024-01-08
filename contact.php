<?php
    require_once 'config.php';
    session_start();
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Contact us</title>
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link rel="stylesheet" href="CSS/contactusstyle.css">    
      <style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
      </style>

    <script>
        function showMessage() {
            alert("Submitted successfully! We will contact you as soon as possible. Thank you!");
            window.location.href = 'homepage.php';
        }
    </script>
   </head>
   <body>
    <div class="container">
    <center><img src="images/logo1.png" alt="Logo" class="img-responsive" style="width:12%; border-radius:50%;"></center>

        <div class="text">Contact us</div>

        <?php
            if(isset($_POST['submit'])){
                $fname = $_POST["Fname"];
                $lname = $_POST["Lname"];
                $email = $_POST["EmailAdd"];
                $msg = $_POST["Usermsg"];

                $sql = "INSERT INTO contact (fname,lname,uemail,usermsg)
                        VALUES ('$fname','$lname','$email','$msg')";

                $result = $conn->query($sql);

                if($result){
                   // echo "Submitted";
                   header("Location: homepage.php");
                }
                else{
                    echo "Error: Submited faild! ".$sql. "<br>" . $conn->error;
                }
            }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
              
           <div class="form-row">
              <div class="input-data">
                 <input type="text" name="Fname" required>
                 <div class="underline"></div>
                 <label for="">First Name</label>
              </div>
              <div class="input-data">
                 <input type="text" name="Lname" required>
                 <div class="underline"></div>
                 <label for="">Last Name</label>
              </div>
           </div>
           <div class="form-row">
              <div class="input-data">
                 <input type="text" name="EmailAdd" required>
                 <div class="underline"></div>
                 <label for="">Email Address</label>
              </div>
              
           </div>
           <div class="form-row">
              <div class="input-data textarea">
                 <textarea rows="8" cols="80" name="Usermsg" required></textarea>
                 <br />
                 <div class="underline"></div>
                 <label for="">Write your message</label>
                 <br />
                 <div class="form-row submit-btn">
                    <div class="input-data">
                       <div class="inner"></div>
                       <input type="submit" value="submit" name="submit" onclick="showMessage()">
                    </div>
                 </div>
              </div>
           </div>
        </form>
     </div>
   </body>
</html>