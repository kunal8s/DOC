<?php

$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {


  include 'db_connect.php';
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  $existSql = "SELECT * FROM `login` WHERE username = '$username'";
  $result = mysqli_query($conn, $existSql);
  $numRows = mysqli_num_rows($result);

  if ($numRows > 0) {
    $showError = "User Already Exists";
  } else {

      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `login` (`username`, `password`, `email`) VALUES ('$username', '$hash', '$email');";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        $showAlert = "Successfully Signed Up";
      }
    
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Sign Up | Email or Mobile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 400px;
            transition: 0.3s all ease;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: #2d3436;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .toggle-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .toggle-btn {
            flex: 1;
            padding: 0.8rem;
            border: none;
            border-radius: 10px;
            background: #f0f0f0;
            color: #666;
            cursor: pointer;
            transition: 0.3s all ease;
        }

        .toggle-btn.active {
            background: #4ecdc4;
            color: white;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2d3436;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 1rem;
            transition: 0.3s all ease;
        }

        input:focus {
            outline: none;
            border-color: #4ecdc4;
        }

        .otp-section {
            display: none;
        }

        .send-otp {
            margin-top: 1rem;
            width: 100%;
            padding: 0.8rem;
            background: #4ecdc4;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s all ease;
        }

        .send-otp:hover {
            background: #45b7b0;
        }

        .checkbox-group {
            margin: 1.5rem 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-group input {
            width: auto;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: #ff6b6b;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s all ease;
        }

        .submit-btn:disabled {
            background: #ddd;
            cursor: not-allowed;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }
    </style>
</head>

<body>
    <div class="login-container">

        <div class="header">
            <h1>Welcome Back!</h1>
            <p>Please SignUp to continue</p>
            <?php
            if($showError) {
                echo "<p>".$showError."</p>";
            }else {
                echo '<p>'.$showAlert.'</p>';
            }
            ?>
        </div>


        <form method="POST">
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" name="username" id="name" required>
            </div>

            <div class="input-group email-section">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="input-group email-section">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" name="submit" class="submit-btn" >submit</button>
        </form>
    </div>

    
</body>

</html>