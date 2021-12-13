<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php
  session_start();
  $link = mysqli_connect('localhost', 'root', '', 'calendar');
  if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: registration.php");
    exit;
  }
  $user_name = $password = $email = "";
  $user_name_err = $password_err = $login_err = $email_err = "";


  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["user_name"])){
      $user_name_err = "Please enter username.";
    } else{
      $user_name = trim($_POST["user_name"]);
    }
    if(empty($_POST["email"])){
      $email_err = "Please enter email.";
    } else{
      $email = trim($_POST["email"]);
    }

    if(empty($_POST["password"])){
      $password_err = "Please enter your password.";
    } else{
      $password = trim($_POST["password"]);
    }

    if(empty($user_name_err) && empty($password_err)){

      $sql = "SELECT `id`, `user_name`, `email`, `password` FROM `users` WHERE `user_name` = ?";

      if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = $user_name;

        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) == 1){

            mysqli_stmt_bind_result($stmt, $id, $user_names, $hashed_password);
            if(mysqli_stmt_fetch($stmt)){
              if(password_verify($password, $hashed_password)){
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["user_name"] = $user_name;
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $password;

                header("location: events.php");
              } else{
                $login_err = "Invalid username or password.";
              }
            }
          } else{
            $login_err = "Invalid username or password.";
          }
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    body{ font: 14px sans-serif; }
    .wrapper{ width: 360px; padding: 20px;
    }
    </style>
  </head>
  <body>
    <center>
    <div class="wrapper">
      <h2>Login</h2>
      <p>Please fill in your credentials to login.</p>
    </center>
      <?php
      if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
      }
      ?>
      <div class="container mt-3">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="form-group" class="form-floating mt-3 mb-3">
            <label>Username</label>
            <input type="text" name="username" id="text" placeholder="Enter username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user_name; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
          </div>
          <div class="form-group" class="form-floating mb-3 mt-3">
            <label>Email</label>
            <input type="text" name="email" id="email" placeholder="Enter email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
          </div>
          <div class="form-group" class="form-floating mt-3 mb-3">
            <label>Password</label>
            <input type="password" name="password" id="pwd" placeholder="Enter password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit" href="events.php">
          </div>
          <p>Don't have an account? <a href="registration.php">Sign up now</a>.</p>
        </form>
      </div>
    </div>
  </body>
  </html>
