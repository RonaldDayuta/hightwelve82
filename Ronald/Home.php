<?php
session_start();

//include_once "calendar.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
  header("Location: index.php");
  exit();
}

// Get session variables for displaying the profile
$username = $_SESSION['admin_username'];
$profile = $_SESSION['admin_image'];
$email = $_SESSION['admin_email'];
$id = $_SESSION['admin_id'];

?>

<div class="home">
  <div class="post-container">
    <div class="post">
      <img src="<?php echo $profile ?>" alt="" />
      <button>Want to Post?</button>
    </div>
    <hr />
    <button>
      <span class="material-icons-outlined"> image </span>
      Photo
    </button>
  </div>
  <div class="viewpostcontainer">
    <div class="profile-post">
      <img src="Information/Lodge Logo.png" alt="" />
      <div class="name-dateposted">
        <h3>Username</h3>
        <span>Date</span>
      </div>
    </div>
    <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus eveniet
      odio quisquam aliquam quaerat a ratione optio reprehenderit, sequi sit,
      explicabo porro, sunt hic! Repudiandae facere soluta sapiente quis
      debitis.
    </p>
    <img src="Information/102 Years Logo.png" alt="" />
  </div>
  <div class="viewpostcontainer">
    <div class="profile-post">
      <img src="Information/Lodge Logo.png" alt="" />
      <div class="name-dateposted">
        <h3>Username</h3>
        <span>Date</span>
      </div>
    </div>
    <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus eveniet
      odio quisquam aliquam quaerat a ratione optio reprehenderit, sequi sit,
      explicabo porro, sunt hic! Repudiandae facere soluta sapiente quis
      debitis.
    </p>
    <img src="Information/Lodge Logo.png" alt="" />
  </div>
  <div class="viewpostcontainer">
    <div class="profile-post">
      <img src="Information/Lodge Logo.png" alt="" />
      <div class="name-dateposted">
        <h3>Username</h3>
        <span>Date</span>
      </div>
    </div>
    <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus eveniet
      odio quisquam aliquam quaerat a ratione optio reprehenderit, sequi sit,
      explicabo porro, sunt hic! Repudiandae facere soluta sapiente quis
      debitis.
    </p>
    <img
      src="Information/Lodge Officers Jewels/1 Worshipful Master.png"
      alt="" />
  </div>
  <div class="viewpostcontainer">
    <div class="profile-post">
      <img src="Information/Lodge Logo.png" alt="" />
      <div class="name-dateposted">
        <h3>Username</h3>
        <span>Date</span>
      </div>
    </div>
    <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus eveniet
      odio quisquam aliquam quaerat a ratione optio reprehenderit, sequi sit,
      explicabo porro, sunt hic! Repudiandae facere soluta sapiente quis
      debitis.
    </p>
    <img src="Information/Lodge Officers Jewels/10 Junior Deacon.png" alt="" />
  </div>
  <div class="viewpostcontainer">
    <div class="profile-post">
      <img src="Information/Lodge Logo.png" alt="" />
      <div class="name-dateposted">
        <h3>Username</h3>
        <span>Date</span>
      </div>
    </div>
    <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus eveniet
      odio quisquam aliquam quaerat a ratione optio reprehenderit, sequi sit,
      explicabo porro, sunt hic! Repudiandae facere soluta sapiente quis
      debitis.
    </p>
    <img src="Information/Lodge Officers Jewels/15 Historian.png" alt="" />
  </div>
  <div class="viewpostcontainer">
    <div class="profile-post">
      <img src="Information/Lodge Logo.png" alt="" />
      <div class="name-dateposted">
        <h3>Username</h3>
        <span>Date</span>
      </div>
    </div>
    <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus eveniet
      odio quisquam aliquam quaerat a ratione optio reprehenderit, sequi sit,
      explicabo porro, sunt hic! Repudiandae facere soluta sapiente quis
      debitis.
    </p>
    <img src="Information/Lodge Officers Jewels/16 Orator.png" alt="" />
  </div>
  <div class="viewpostcontainer">
    <div class="profile-post">
      <img src="Information/Lodge Logo.png" alt="" />
      <div class="name-dateposted">
        <h3>Username</h3>
        <span>Date</span>
      </div>
    </div>
    <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus eveniet
      odio quisquam aliquam quaerat a ratione optio reprehenderit, sequi sit,
      explicabo porro, sunt hic! Repudiandae facere soluta sapiente quis
      debitis.
    </p>
    <img src="Information/102 Years Logo without DS.png" alt="" />
  </div>
</div>