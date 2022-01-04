<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php
  session_start();
  include 'connection.php';

  $user_name = $password = $confirm_password = $email = "";
  $user_name_err = $password_err = $confirm_password_err = $email_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["user_name"])){
      $user_name_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["user_name"]))){
      $user_name_err = "Username can only contain letters, numbers, and underscores.";
    } else{
      $sql = $_POST["sql"];
      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_user_name);
        $param_user_name = $_POST["user_name"];
        if(mysqli_stmt_execute($stmt)){

          mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) == 1){
            $user_name_err = "This username is already taken.";
          } else{
            $user_name = $_POST["user_name"];
          }
        } else{
          echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
      }
    }

    if(empty($_POST["email"])){
      $email_err = "Please enter a email.";
    } elseif(strlen(trim($_POST["email"])) < 6){
      $email_err = "Email must have atleast @gmail.com or @abv.bg or other.";
    } else{
      $email = $_POST["email"];
    }

    if(empty($_POST["password"])){
      $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
      $password_err = "Password must have atleast 6 characters.";
    } else{
      $password = $_POST["password"];
    }

    if(empty($_POST["confirm_password"])){
      $confirm_password_err = "Please confirm password.";
    } else{
      $confirm_password =$_POST["confirm_password"];
      if(empty($password_err) && ($password != $confirm_password)){
        $confirm_password_err = "Password did not match.";
      }
    }



    if (!empty($user_name) || !empty($email) ||  !empty($password) || !empty($confirm_password)){
      $Insert = "INSERT INTO `users`(`user_name`, `email`, `password`, `confirm_password`) VALUES (?, ?, ?, ?)";
      $stmt = $link->prepare($Insert);
      $stmt->bind_param("ssss", $user_name, $email, $password, $confirm_password);
      $stmt->execute();
      $stmt->bind_result($user_name, $email, $password, $confirm_password);
      $stmt->store_result();
      $rnum = $stmt->num_rows;
      if($rnum == 0)
      {
        $stmt->close();
        header("location:");
      }
      else {
        alert("All fields are required");
      }
      $stmt->close();
      $stmt1->close();
      $link->close();
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    body, html{
      height: 100%;
      font: 14px sans-serif;
      background-image: url('home-banner.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }
    .bgimg{
      background-image: url('home-banner.jpg');
      min-height: 100%;
      background-position: center;
      background-size: covser;
      .wrapper{ width: 360px; padding: 20px;
      }
      </style>
    </head>
    <body>
      <center>
        <br><br>
        <div class="wrapper">
          <h2>Registration</h2>
          <p>Please fill this form to create an account.</p>
        </center>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="container mt-3" method="post">
          <div class="form-group" class="form-floating mb-3 mt-3">
            <label for="text">Username</label>
            <input required type="text" name="user_name" id="text" placeholder="Enter username" class="form-control <?php echo (!empty($user_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user_name; ?>">
            <span class="invalid-feedback"><?php echo $user_name_err; ?></span>
          </div>
          <div class="form-group" class="form-floating mb-3 mt-3">
            <label for="email">Email</label>
            <input required type="email" name="email" id="email" placeholder="Enter email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
          </div>
          <div class="form-group" class="form-floating mb-3 mt-3">
            <label for="pwd">Password</label>
            <input required type="password" name="password" id="pwd" placeholder="Enter password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
          </div>
          <div class="form-group" class="form-floating mb-3 mt-3">
            <label for="pwd">Confirm Password</label>
            <input required type="password" name="confirm_password" id="pwd" placeholder="Enter again password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit" href="events.php">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
          </div>
          <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
      <script type="text/javascript">
      $(function(){
        $('#register').click(function(e){
          var valid = this.form.checkValidity();
          if(valid){
            var user_name = $('#user_name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            e.preventDefault();
            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {user_name: user_name,,email: email,password: password, confirm_password : confirm_password},
              success: function(data){
                Swal.fire({
                  'title': 'Successful',
                  'text': data,
                  'type': 'success'
                })
              },
              error: function(data){
                Swal.fire({
                  'title': 'Errors',
                  'text': 'There were errors while saving the data.',
                  'type': 'error'
                })
              }
            });
          }else{
          }
        });
      });
      </script>
    </body>
    </html>
