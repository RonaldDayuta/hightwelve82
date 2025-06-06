<?php
session_start();

//include_once "calendar.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Webpage/index.php");
    exit();
}

// Get session variables for displaying the profile
$first_name = $_SESSION['user_first-name'];
$middle_name = $_SESSION['user_middle-name'];
$last_name = $_SESSION['user_last-name'];
$suffix = $_SESSION['user_suffix'];
$username = $_SESSION['user_username'];
$profile = $_SESSION['user_image'];
$email = $_SESSION['user_email'];
$id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/indexwithcms.css" />
    <title>High Twelve Lodge No.82</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../Information/Lodge Logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg w-100 px-3">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Logo & Title -->
            <div class="d-flex align-items-center">
                <img src="../Information/Lodge Logo.png" alt="Logo" class="navbar-logo" />
                <h2 class="mb-0 ms-2">HIGH TWELVE MASONIC LODGE NO. 82</h2>
            </div>

            <!-- Navbar Toggle Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="Home" class="nav-link" aria-current="page" href="#">
                            <span class="material-icons-outlined"> home </span>
                            Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false" id="eventnav">
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
                        <a id="Repository" href="#" class=" nav-link">
                        <span class="material-icons-outlined">folder</span>
                            Repository
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
                        <a class="nav-link" href="../php/userlogout.php">
                            <button>Logout</button>
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
                    <img src="<?php echo $profile; ?>" alt="" />
                    <span>
                        <?php 
                            // Bagong variable para sa display name lang
                            $display_name = $_SESSION['user_first-name'];

                            // Idagdag ang middle initial kung hindi ito NULL, empty, o "N/A"
                            if (!empty($_SESSION['user_middle-name']) && $_SESSION['user_middle-name'] !== "N/A") {
                                $display_name .= ' ' . substr($_SESSION['user_middle-name'], 0, 1) . '.';
                            }

                            // Idagdag ang last name
                            $display_name .= ' ' . $_SESSION['user_last-name'];

                            // Idagdag ang suffix kung hindi ito "N/A"
                            if (!empty($_SESSION['user_suffix']) && $_SESSION['user_suffix'] !== "N/A") {
                                $display_name .= ' ' . $_SESSION['user_suffix'];
                            }

                            // I-display ang pangalan nang may encoding protection
                            echo htmlspecialchars($display_name, ENT_QUOTES, 'UTF-8'); 
                        ?>
                    </span>
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
                                <input id="search-member" class="form-control me-2" type="search" placeholder="Search"
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

    <div class="modal fade" id="manageaccoutmodal" tabindex="-1" aria-labelledby="manageaccoutmodalLabel"
        aria-hidden="true">
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
                            <label class="form-label">Profile Image (Leave if you don't want to change)</label>
                            <input type="file" accept=".jpeg, .png, .gif, .jpg" class="form-control" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="first-name" class="form-label">First Name</label>
                            <input type="text" id="first-name" name="first-name" class="form-control" value="<?php echo $first_name ?>"
                                placeholder="First Name" required />
                        </div>
                        <div class="mb-3">
                            <label for="middle-name" class="form-label">Middle Name</label>
                            <input type="text" id="middle-name" name="middle-name" class="form-control" value="<?php echo $middle_name ?>"
                                placeholder="Middle Name, if w/o Middle Name type N/A" required />
                        </div>
                        <div class="mb-3">
                            <label for="last-name" class="form-label">Last Name</label>
                            <input type="text" id="last-name" name="last-name" value="<?php echo $last_name ?>" class="form-control" placeholder="Last Name"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="suffix" class="form-label">Suffix</label>
                            <select style="text-align: center;" id="suffix" name="suffix" class="form-control" required>
                                <option value="" disabled <?= empty($suffix) ? 'selected' : '' ?>>Select Suffix</option>
                                <option value="N/A" <?= $suffix == "N/A" ? 'selected' : '' ?>>N/A</option>
                                <option value="Sr." <?= $suffix == "Sr." ? 'selected' : '' ?>>Sr.</option>
                                <option value="Jr." <?= $suffix == "Jr." ? 'selected' : '' ?>>Jr.</option>
                                <option value="I" <?= $suffix == "I" ? 'selected' : '' ?>>I</option>
                                <option value="II" <?= $suffix == "II" ? 'selected' : '' ?>>II</option>
                                <option value="III" <?= $suffix == "III" ? 'selected' : '' ?>>III</option>
                                <option value="IV" <?= $suffix == "IV" ? 'selected' : '' ?>>IV</option>
                                <option value="V" <?= $suffix == "V" ? 'selected' : '' ?>>V</option>
                                <option value="VI" <?= $suffix == "VI" ? 'selected' : '' ?>>VI</option>
                                <option value="VII" <?= $suffix == "VII" ? 'selected' : '' ?>>VII</option>
                                <option value="VIII" <?= $suffix == "VIII" ? 'selected' : '' ?>>VIII</option>
                                <option value="IX" <?= $suffix == "IX" ? 'selected' : '' ?>>IX</option>
                                <option value="X" <?= $suffix == "X" ? 'selected' : '' ?>>X</option>
                            </select>
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
                            <label class="form-label">Password (Leave emty if don't want to change password)</label>
                            <input type="password" class="form-control" name="password" />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <span id="edit-button-text">Update Account</span>
                                <div id="edit-spinner" class="spinner-border spinner-border-sm" role="status"
                                    style="display: none;"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/User.js"></script>
</body>

</html>