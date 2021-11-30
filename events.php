<?php
$link = mysqli_connect('localhost', 'root', '', 'calendar');
if($link === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
$name = $date_started = $date_ended = $flag_name = $calendar = "";
$name_err = $date_started_err = $date_ended_err = $flag_name_err = "";

if(empty($_POST["name"])){
  $name_err = "Please enter a name of events.";
} else{
  $name = trim($_POST["name"]);
}

if(empty($_POST["date_started"])){
  $date_started_err = "Please enter a date start of events.";
} else{
  $date_started = trim($_POST["date_started"]);
}

if(empty($_POST["date_ended"])){
  $date_ended_err = "Please enter a date end of events.";
} else{
  $date_ended = trim($_POST["date_ended"]);
}
$insert = "INSERT INTO `events`( `name`, `date_started`, `date_ended`)  VALUES (`$name`, `$date_started`, `$date_ended`)";
$result = mysqli_query($link, $insert);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

</head>
</body>

</html>
