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

  $user_name = $password = $confirm_password = $email = "";
  $user_name_err = $password_err = $confirm_password_err = $email_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["user_name"])){
      $user_name_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["user_name"]))){
      $user_name_err = "Username can only contain letters, numbers, and underscores.";
    } else{
      $sql = "SELECT `id` FROM `users`";

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

    if(empty($_POST["email"])){
      $email_err = "Please enter a email.";
    } elseif(strlen(trim($_POST["email"])) < 6){
      $email_err = "Email must have atleast @gmail.com or @abv.bg or other.";
    } else{
      $email = trim($_POST["email"]);
    }

    if(empty($_POST["password"])){
      $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
      $password_err = "Password must have atleast 6 characters.";
    } else{
      $password = trim($_POST["password"]);
    }

    if(empty($_POST["confirm_password"])){
      $confirm_password_err = "Please confirm password.";
    } else{
      $confirm_password = trim($_POST["confirm_password"]);
      if(empty($password_err) && ($password != $confirm_password)){
        $confirm_password_err = "Password did not match.";
      }
    }

    if (!empty($user_name) || !empty($email) ||  !empty($password) || !empty($confirm_password)){

      $INSERT = "INSERT INTO `users`(`user_name`, `email`, `password`, `confirm_password`) VALUES (?,?,?,?)";
      $stmt = $link->prepare($INSERT);
      $stmt->bind_param("ssss",$user_name, $email, $password, $confirm_password);
      $stmt->execute();
      $stmt->bind_result($user_name, $email, $password, $confirm_password);
      $stmt->store_result();
      $rnum = $stmt->num_rows;
      if($rnum == 0)
      {
        $stmt->close();
        header("location:registartion.php");
      }
      else {
        alert("All fields are required");
      }
      $stmt->close();
      $stmt1->close();
      $link->close();
    }
  }
  else {
    echo "All fields are required..";
    die();
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
          <input type="text" name="username" class="form-control <?php echo (!empty($user_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user_name; ?>">
          <span class="invalid-feedback"><?php echo $user_name_err; ?></span>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
          <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
          <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8">
    <script type="text/javascript">
    $(function(){
      $('#register').click(function(e){
        var valid = this.form.checkValidity();
        if(valid){
          var user_name = $('#user_name').val();
          var email = $('#email').val();
          var password = $('#password').val();
          var repied_password = $('#repied_password').val();
          e.preventDefault();
          $.ajax({
            type: 'POST',
            url: 'process.php',
            data: {firstname: firstname,lastname: lastname,email: email,phonenumber: phonenumber,password: password},
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
