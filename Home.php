<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  * {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;
  border: 1px solid #ddd;
   border-radius: 4px;
   padding: 5px;
   width: 150px;
}

.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}


.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}

header {
  background-color: #F0F8FF;
  padding: 5px;
  text-align: center;
  font-size: 20px;
  color: black;
}
footer {
  background-color: #F0F8FF;
  padding: 10px;
  text-align: center;
  color: black;
  font-family: &#8478;
}
</style>
</head>
<header>
  <h1> Welcome to home page on your Calendar</h1>
  <a class="button" href="login.php" align="center">Login</a>
  <a class="button" href="registration.php">Registration</a>
</header>
<body>
  <center>
    <div class="slideshow-container">
<div class="mySlides fade">
  <div class="numbertext">1 / 2</div>
  <img src="calendar1.jpg" style="width:100%">
  <div class="text">Welcome</div>
</div>
<div class="mySlides fade">
  <div class="numbertext">2 / 2</div>
  <img src="calendar.png" style="width:100%">
  <div class="text">To your calendar</div>
</div>
</div>
<br>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
</div>
<script>
var slideIndex = 1;
showSlides(slideIndex);
function plusSlides(n) {
showSlides(slideIndex += n);
}
function currentSlide(n) {
showSlides(slideIndex = n);
}
function showSlides(n) {
var i;
var slides = document.getElementsByClassName("mySlides");
var dots = document.getElementsByClassName("dot");
if (n > slides.length) {slideIndex = 1}
if (n < 1) {slideIndex = slides.length}
for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
}
for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
}
slides[slideIndex-1].style.display = "block";
dots[slideIndex-1].className += " active";
}
</script>
  </center>
  <footer>
    <p>Made your own calendar</p>
  </footer>
</body>
</html>
