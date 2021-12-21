<?php
session_start();
unset($_SESSION["user_name"]);
unset($_SESSION["password"]);


header('Refresh: 2; URL = Home.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  body, html{
    height: 100%;
    font: 14px sans-serif;
    background-image: url('home-banner.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
  }
  .bgimg {
    background-image: url('home-banner.jpg');
    min-height: 100%;
    background-position: center;
    background-size: cover;
  }
  .wrapper{ width: 360px; padding: 20px;
  }
  h1{
    color: white;
    font: 40px sans-serif;
  }
  </style>
</head>
<body>
  <center>
    <div class="wrapper">
      <br><br>
      <h1><?php echo 'You have cleaned session! Thank you!'; ?></h1>
    </body>
    </html>
