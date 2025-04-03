<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // If not logged in, redirect to access.html
    header("Location: access.php");
    exit; // Ensure no further code is executed after the redirect
}

$_SESSION['loading_shown'] = true; // Set session variable
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Information/Lodge Logo.ico">
    <title>Loading....</title>
</head>
<style>
    #loading-screen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: black;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

/* Clock Container */
.clock {
  position: relative;
  width: 120px;
  height: 120px;
  border: 5px solid white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Clock Numbers */
.clock span {
  position: absolute;
  font-size: 14px;
  font-weight: bold;
  color: white;
}
.num12 {
  top: 5px;
  left: 50%;
  transform: translateX(-50%);
}
.num3 {
  right: 5px;
  top: 50%;
  transform: translateY(-50%);
}
.num6 {
  bottom: 5px;
  left: 50%;
  transform: translateX(-50%);
}
.num9 {
  left: 5px;
  top: 50%;
  transform: translateY(-50%);
}

/* Clock Hands */
.hand {
  position: absolute;
  width: 3px;
  height: 40px;
  background: white;
  bottom: 50%;
  left: 50%;
  transform-origin: bottom;
}
.hour-hand {
  animation: rotateHour 6s linear infinite;
}
.minute-hand {
  height: 50px;
  animation: rotateMinute 3s linear infinite;
}

/* Animations */
@keyframes rotateHour {
  from {
    transform: translateX(-50%) rotate(0deg);
  }
  to {
    transform: translateX(-50%) rotate(360deg);
  }
}
@keyframes rotateMinute {
  from {
    transform: translateX(-50%) rotate(0deg);
  }
  to {
    transform: translateX(-50%) rotate(720deg);
  }
}

</style>
<body>
<div id="loading-screen">
        <div class="clock">
            <div class="hand hour-hand"></div>
            <div class="hand minute-hand"></div>
            <span class="num12">12</span>
            <span class="num3">3</span>
            <span class="num6">6</span>
            <span class="num9">9</span>
        </div>
    </div>
</body>
<script>
    setTimeout(() => {
        window.location.href = "Webpage/index.php";  // Redirect after 2 seconds
    }, 2000);
</script>
</html>
