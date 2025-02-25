<?php
session_start();

//include_once "calendar.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../Webpage/index.php");
    exit();
}

// Get session variables for displaying the profile
$username = $_SESSION['admin_username'];
$profile = $_SESSION['admin_image'];
$email = $_SESSION['admin_email'];
$pos = $_SESSION['admin_pos'];
$id = $_SESSION['admin_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/indexwithcms.css" />
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
                    src="../Information/Lodge Logo.png"
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
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-expanded="false"
                            id="eventnav">
                            <span class="material-icons-outlined">
                                event
                            </span>Events</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a id="eventdrop" class="dropdown-item" href="#">
                                    <span class="material-icons-outlined">
                                        event
                                    </span>Events</a>
                            </li>
                            <li>
                                <a id="newsdrop" class="dropdown-item" href="#">
                                    <span class="material-icons-outlined">
                                        newspaper
                                    </span>News-Today</a>
                            </li>
                            <li>
                                <a id="meetdrop" class="dropdown-item" href="#">
                                    <span class="material-icons-outlined">
                                        groups
                                    </span>Meeting</a>
                            </li>
                            <li>
                                <a id="actdrop" class="dropdown-item" href="#">
                                    <span class="material-icons-outlined">
                                        local_activity
                                    </span>Activities</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a id="Calendar" href="#" class=" nav-link">
                            <span class="material-icons-outlined"> calendar_month </span>
                            Calendar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="Officers" href="#" class=" nav-link">
                            <span class="material-icons-outlined"> group </span>
                            Officers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#manageaccoutmodal">
                            <span class="material-icons-outlined">
                                manage_accounts
                            </span>
                            Manage Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../php/adminlogout.php">
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
                        <h3 id="news_h3">Loading...</h3>
                        <span id="news_span">Loading...</span>
                        <p id="news_p">Loading news details...</p>
                    </div>
                </div>
                <hr />
                <div class="cards-events">
                    <h3>Latest Events</h3>
                    <div class="event-information">
                        <h3 id="event_h3">Loading...</h3>
                        <span id="event_span">Loading...</span>
                        <p id="event_p">Loading...</p>
                    </div>
                </div>
            </div>
            <div id="main" class="col-main col"></div>
            <div class="colright-side col-lg-3 col-md-12">
                <div class="cardmeeting">
                    <h3>Meetings</h3>
                    <div id="meeting-cards">
                        <div class="meetingalign">
                            <div class="meetinginfo">
                                <img src="../Information/102 Years Logo.png" alt="" />
                                <div class="information">
                                    <span>Loading...</span>
                                    <span>Loading...</span>
                                    <p>Loading...</p>
                                </div>
                            </div>
                        </div>
                        <div class="meetingalign">
                            <div class="meetinginfo">
                                <img src="../Information/102 Years Logo.png" alt="" />
                                <div class="information">
                                    <span>Loading...</span>
                                    <span>Loading...</span>
                                    <p>Loading...</p>
                                </div>
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
                        <div id="members">

                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="manageaccoutmodal" tabindex="-1" aria-labelledby="manageaccoutmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageaccoutmodalLabel">Manage Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img style="display: block;
            margin: 0 auto 20px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;" src="<?php echo $profile ?>" alt="Profile Image" class="profile-img">
                    <form id="updateAccountForm">
                        <input type="text" name="id" value="<?php echo $id ?>" hidden>
                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" class="form-control" name="image">
                            <small class="text-muted">Leave empty if you don't want to change the image.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $email ?>" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" />
                            <small class="text-muted">Leave empty if you don't want to change the password.</small>
                        </div>
                        <input type="hidden" id="updateposition" value="<?php echo $pos ?>">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <span id="edit-button-text">Update Account</span>
                                <div id="edit-spinner" class="spinner-border spinner-border-sm" role="status" style="display: none;"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/Admin.js"></script>
</body>

</html>