<?php
$link = mysqli_connect('localhost', 'root', '', 'calendar');
if($link === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
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

  header {
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
<header>
  <h1>Made your calendar</h1>
  <div class="logo">
    <img src="logo.jpg" alt="Calendar logo" width="125">
  </div>
</header>
<?php

include 'calendar.php';
$calendar = new Calendar();
$calendar->add_event('Holiday', '2021-12-23', 9, 'red');
$calendar->add_event('Work', '2021-12-13', 2, 'green');
echo $calendar;
?>
<?php

?>
<a class="button" href="made_events.php" align="center">Made events</a>
<a class="button" href="Home.php" align="center">Home</a>
</body>
</html>
