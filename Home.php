<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <style>
  h1 {
    text-align: center;
    text-transform: uppercase;
    color: black;
  }
  .btn-group button {
    background-color:#00ace6;
    padding: 10px 24px;
    cursor: pointer;
    float: center;
  }
  .btn-group:after {
    content: "";
    clear: both;
    display: table;
  }

  .button {
    background-color: #00ace6;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;
    overflow: auto;
    white-space: nowrap;
  }
  .button:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
  }
</style>
</head>
<body>
  <h1> Welcome to home page on your Calendar</h1>
  <center>

    <a class="button" href="login.php" align="center">Login</a>
    <a class="button" href="registration.php">Registration</a>

  </center>
</body>
</html>
