<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php
  $link = mysqli_connect('localhost', 'root', '', 'calendar');
  if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  $user_name = $password = $repied_password = $email = "";
  $user_name_err = $password_err = $confirm_password_err = $email_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["user_name"]))){
      $user_name_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["user_name"]))){
      $user_name_err = "Username can only contain letters, numbers, and underscores.";
    } else{
      $sql = "SELECT `id` FROM `registrations` WHERE `user_name` = ?";

      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = trim($_POST["user_name"]);

        if(mysqli_stmt_execute($stmt)){

          mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) == 1){
            $username_err = "This username is already taken.";
          } else{
            $username = trim($_POST["user_name"]);
          }
        } else{
          echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
      }
    }

    if(empty(trim($_POST["email"]))){
      $email_err = "Please enter a email.";
    } elseif(strlen(trim($_POST["email"])) < 6){
      $email_err = "Password must have atleast 6 characters.";
    } else{
      $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["password"]))){
      $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
      $password_err = "Password must have atleast 6 characters.";
    } else{
      $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["repied_password"]))){
      $confirm_password_err = "Please confirm password.";
    } else{
      $repied_password = trim($_POST["repied_password"]);
      if(empty($password_err) && ($password != $repied_password)){
        $confirm_password_err = "Password did not match.";
      }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

      $sql = "INSERT INTO `registrations`( `user_name`, `email`, `password`, `repied_password`)  VALUES (?, ?, ?, ?)";
      $result = mysqli_query($link, $sql);

      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        $param_username = $user_name;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        if(mysqli_stmt_execute($stmt)){
          header("location: login.php");
        } else{
          echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
      }
    }

    mysqli_close($link);
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body{ font: 14px sans-serif; }
    .wrapper{ width: 360px; padding: 20px; }
    </style>
  </head>
  <body>
    <center>
      <div class="wrapper">
        <h2>Registration</h2>
        <p>Please fill this form to create an account.</p>
      </center>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user_name; ?>">
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
          <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $repied_password; ?>">
          <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
      </form>
    </div>
  </body>
  </html>
