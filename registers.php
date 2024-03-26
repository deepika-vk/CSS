<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }

  .nav {
    background-color: hsl(99, 90%, 58%) ;
    padding: 20px;
  }

  .logo h1 {
    margin: 5px;
    
    color: black;
  }

  .container {
    background-image: url('chris-ensminger-yJDZTDeHeG8-unsplash.jpg');
    background-size: cover;
    background-position: center;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .box {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .form-box {
    max-width: 400px;
    width: 100%;
    text-align: center;
  }

  .field {
    margin-bottom: 20px;
  }

  .field label {
    display: block;
    margin-bottom: 5px;
  }

  .field input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
  }

  .field .btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .field .btn:hover {
    background-color: #45a049;
  }

  .links {
    margin-top: 20px;
  }

  .links a {
    color: #007bff;
    text-decoration: none;
  }

  .links a:hover {
    text-decoration: underline;
  }

</style>
</head>
<body>

<div class="nav">
    <div class="logo">
        <h1>FarmEasy</h1>
    </div>
</div>

<div class="container">
    <div class="box form-box">
        <?php 
            include("php/config.php");
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['password'];

                //verifying the unique email
                $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");

                if(mysqli_num_rows($verify_query) !=0 ){
                    echo "<div class='message'>
                              <p>This email is used, Try another One Please!</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                }
                else{
                    mysqli_query($con,"INSERT INTO users(Username,Email,Age,Password) VALUES('$username','$email','$age','$password')") or die("Error Occurred");
                    echo "<div class='message'>
                              <p>Registration successful!</p>
                          </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Login Now</button>";
                }
            } else {
        ?>
        <header><h1><b>Sign Up</b></h1></header>
        <br>
        <form action="" method="post">
            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Register" required>
            </div>

            <div class="links">
                Already a member? <a href="index.php">Sign In</a>
            </div>
        </form>
        <?php } ?>
    </div>
</div>

</body>
</html>
