<?php
$link = mysqli_connect('localhost', 'root', '', 'calendar');
if($link === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
$name = $date_started = $date_ended = $color = $calendar = "";
$name_err = $date_started_err = $date_ended_err = $color_err = "";

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

if(empty($_POST["color"])){
  $color_err = "Please enter a color of events.";
} else{
  $color = trim($_POST["color"]);
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
  .calendar {
    display: flex;
    flex-flow: column;
  }
  .calendar .header .month-year {
    font-size: 20px;
    font-weight: bold;
    color: #636e73;
    padding: 20px 0;
  }
  .calendar .days {
    display: flex;
    flex-flow: wrap;
  }
  .calendar .days .day_name {
    width: calc(100% / 7);
    border-right: 1px solid #2c7aca;
    padding: 20px;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: bold;
    color: #818589;
    color: #fff;
    background-color: #448cd6;
  }
  .calendar .days .day_name:nth-child(7) {
    border: none;
  }
  .calendar .days .day_num {
    display: flex;
    flex-flow: column;
    width: calc(100% / 7);
    border-right: 1px solid #e6e9ea;
    border-bottom: 1px solid #e6e9ea;
    padding: 15px;
    font-weight: bold;
    color: #7c878d;
    cursor: pointer;
    min-height: 100px;
  }
  .calendar .days .day_num span {
    display: inline-flex;
    width: 30px;
    font-size: 14px;
  }
  .calendar .days .day_num .event {
    margin-top: 10px;
    font-weight: 500;
    font-size: 14px;
    padding: 3px 6px;
    border-radius: 4px;
    background-color: #f7c30d;
    color: #fff;
    word-wrap: break-word;
  }
  .calendar .days .day_num .event.green {
    background-color: #51ce57;
  }
  .calendar .days .day_num .event.blue {
    background-color: #518fce;
  }
  .calendar .days .day_num .event.red {
    background-color: #ce5151;
  }
  .calendar .days .day_num:nth-child(7n+1) {
    border-left: 1px solid #e6e9ea;
  }
  .calendar .days .day_num:hover {
    background-color: #fdfdfd;
  }
  .calendar .days .day_num.ignore {
    background-color: #fdfdfd;
    color: #ced2d4;
    cursor: inherit;
  }
  .calendar .days .day_num.selected {
    background-color: #f1f2f3;
    cursor: inherit;
  }
  </style>
</head>
<?php
include 'calendar.php';
$calendar = new Calendar();
$calendar->add_event('Holiday', '2021-12-23', 9, 'red');
echo $calendar;

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
    <span class="invalid-feedback"><?php echo $name_err; ?></span>
  </div>
  <div class="form-group">
    <label>Date started</label>
    <input type="datetime" name="date" class="form-control <?php echo (!empty($date_started_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_started; ?>">
    <span class="invalid-feedback"><?php echo $date_started_err; ?></span>
  </div>
  <div class="form-group">
    <label>Date ended</label>
    <input type="datetime" name="date" class="form-control <?php echo (!empty($date_ended_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_ended; ?>">
    <span class="invalid-feedback"><?php echo $date_ended_err; ?></span>
  </div>
  <div class="form-group">
    <label>Color</label>
    <input type="color" name="color" class="form-control <?php echo (!empty($color_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $color; ?>">
    <span class="invalid-feedback"><?php echo $color_err; ?></span>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit" href="events.php">
  </div>
</div>
</form>
</div>
<?php



?>
</body>

</html>
