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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/indexwithcms.css" />
    <title>Admin</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
        rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg w-100 px-3">
        <div
            class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Logo & Title -->
            <div class="d-flex align-items-center">
                <img
                    src="Information/Lodge Logo.png"
                    alt="Logo"
                    class="navbar-logo" />
                <h2 class="mb-0 ms-2">HIGHTWELVE82</h2>
            </div>

            <!-- Navbar Toggle Button for Mobile -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div
                class="collapse navbar-collapse justify-content-end"
                id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="Home" class="nav-link" aria-current="page" href="#">
                            <span class="material-icons-outlined"> home </span>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="Accounts" class="nav-link" href="#">
                            <span class="material-icons-outlined"> group </span>
                            Acccounts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="material-icons-outlined"> event </span>
                            Events
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="Calendar" class="nav-link"><span class="material-icons-outlined"> calendar_month </span>
                            Calendar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            <button>LogOut</button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="colleft-side col-lg-3 col-md-12">
                <div class="profile">
                    <img src="<?php echo $profile ?>" alt="" />
                    <span><?php echo $username ?></span>
                </div>
                <div class="cards-events">
                    <h3>Latest News</h3>
                    <div class="event-information">
                        <h3>News title</h3>
                        <span>Date</span>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos
                            odio dicta id dignissimos nihil hic ab dolore suscipit illo
                            optio eveniet qui, repudiandae iusto at harum porro provident
                            iste delectus.
                        </p>
                    </div>
                </div>
                <hr />
                <div class="cards-events">
                    <h3>Latest Events</h3>
                    <div class="event-information">
                        <h3>Events title</h3>
                        <span>Date</span>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos
                            odio dicta id dignissimos nihil hic ab dolore suscipit illo
                            optio eveniet qui, repudiandae iusto at harum porro provident
                            iste delectus.
                        </p>
                    </div>
                </div>
            </div>
            <div id="main" class="col-main col"></div>
            <div class="colright-side col-lg-3 col-md-12">
                <div class="cardmeeting">
                    <h3>Meetings</h3>
                    <div class="meetingalign">
                        <div class="meetinginfo">
                            <img src="Information/102 Years Logo.png" alt="" />
                            <div class="information">
                                <span>Meeting Title</span>
                                <span>Date: 18/02/2025</span>
                                <span>Time: 10 am</span>
                            </div>
                        </div>
                        <div class="meetinginfo">
                            <img src="Information/102 Years Logo.png" alt="" />
                            <div class="information">
                                <span>Meeting Title</span>
                                <span>Date: 18/02/2025</span>
                                <span>Time: 10 am</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="tablesmembers">
                    <ul>
                        <div class="search-acc">
                            <h3>Members</h3>
                            <form class="d-flex" role="search">
                                <input
                                    class="form-control me-2"
                                    type="search"
                                    placeholder="Search"
                                    aria-label="Search" />
                            </form>
                        </div>
                        <li>
                            <img src="Information/Lodge Logo.png" alt="" />
                            <span>Username</span>
                        </li>
                        <li>
                            <img src="Information/Lodge Logo.png" alt="" />
                            <span>Username</span>
                        </li>
                        <li>
                            <img src="Information/Lodge Logo.png" alt="" />
                            <span>Username</span>
                        </li>
                        <li>
                            <img src="Information/Lodge Logo.png" alt="" />
                            <span>Username</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/Admin.js"></script>
</body>

</html>