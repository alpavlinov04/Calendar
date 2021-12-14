<?php
include 'calendar.php';
$link = mysqli_connect('localhost', 'root', '', 'calendar');
if($link === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
$name = $date_started = $date_ended = $days = $color = $calendar = "";
$name_err = $date_started_err = $date_ended_err = $days_err = $color_err = "";

if(empty($_POST["name"])){
  $name_err = "Please enter a name of events.";
} else{
  $name = $_POST["name"];
}

if(empty($_POST["date_started"])){
  $date_started_err = "Please enter a date start of events.";
} else{
  $date_started = $_POST["date_started"];
}

if(empty($_POST["date_ended"])){
  $date_ended_err = "Please enter a date end of events.";
} else{
  $date_ended = $_POST["date_ended"];
}

if(empty($_POST["days"])){
  $days_err = "Please enter a count of events.";
} else{
  $days = $_POST["days"];
}

if(empty($_POST["color"])){
  $color_err = "Please choose a color of events.";
} else{
  $color = $_POST["color"];
}
if (!empty($name) || !empty($date_started) ||  !empty($date_ended) || !empty($color)){

  $INSERT = "INSERT INTO `events`(`name`, `date_started`, `date_ended`, `color`) VALUES (?, ?, ?, ?)";
  $stmt = $link->prepare($INSERT);
  $stmt->bind_param("ssss", $name, $date_started, $date_ended, $color);
  $stmt->execute();
  $stmt->bind_result($name, $date_started, $date_ended, $color);
  $stmt->store_result();
  $rnum = $stmt->num_rows;
  if($rnum == 0)
  {
    $stmt->close();
    header("location:events.php");
  }
  else {
    alert("All fields are required");
  }
  $stmt->close();
  $stmt1->close();
  $link->close();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <style>
  header {
    background-color: #F0F8FF;
    padding: 5px;
    text-align: center;
    font-size: 20px;
    color: black;
  }
  footer{
    background-color: #F0F8FF;
    padding: 5px;
    text-align: center;
    font-size: 20px;
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
    background-color: #8585ad;
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
<header>
  <h1>Made events</h1>
  <div class="logo">
    <img src="logo.jpg" alt="Calendar logo" width="125">
  </div>
  <a class="button" href="events.php" align="center">Return</a>
</header>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
    <span class="invalid-feedback"><?php echo $name_err; ?></span>
  </div>
  <div class="form-group">
    <label>Date started</label>
    <input type="datetime-local" name="date_started" class="form-control <?php echo (!empty($date_started_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_started; ?>">
    <span class="invalid-feedback"><?php echo $date_started_err; ?></span>
  </div>
  <div class="form-group">
    <label>Date ended</label>
    <input type="datetime-local" name="date_ended" class="form-control <?php echo (!empty($date_ended_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_ended; ?>">
    <span class="invalid-feedback"><?php echo $date_ended_err; ?></span>
  </div>
  <div class="form-group">
    <label>Color</label>
    <input type="color" name="color" class="form-control <?php echo (!empty($color_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $color; ?>">
    <span class="invalid-feedback"><?php echo $color_err; ?></span>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit" href="events.php">
    <input type="submit" class="btn btn-primary" value="Return" href="events.php">
  </div>

</div>
</form>
<footer>
  <p> Made your own calendar </p>

</footer>
</body>
</html>
