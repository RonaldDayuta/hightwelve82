<?php
session_start();

// If loading screen was not shown, redirect to loading.php
if (!isset($_SESSION['loading_shown'])) {
    header("Location: ../index.php");
    exit();
}

// Reset session so loading appears again on next visit
unset($_SESSION['loading_shown']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>High Twelve Masonic Lodge No. 82</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../Information/Lodge Logo.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/index.css" />
</head>

<body>

    <div id="main-content">
        <!-- Fixed Dark Navbar -->
        <nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">High Twelve Masonic Lodge No. 82</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" id="HomeNav" href="#Home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="AboutNav" href="#about">History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="OfficersNav" href="#Officers">Officers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="RollNav" href="#Pastmaster">PastMasters</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="EventsNav" href="#Events">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="NewsNav" href="#News">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ActivitiesNav" href="#Activities">Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ContentNav" href="#post">BulletinBoard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="btn-login" href="#"><button>Login</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="main" class="main">
            <!-- Full Background Section -->
            <div id="Home" class="background-container-officer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 coltext">
                            <div class="text-content">
                                <h1>High Twelve Masonic Lodge No.82</h1>
                                <p>Masonic District NCR-D</p>
                                <p>
                                    Under the jurisdiction of the Most Worshipful Grand Lodge
                                    <br />
                                    of Free and Accepted Masons of the Philippines
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 colimg">
                            <img src="../Information/Lodge Logo.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="content-offficer container">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-4 col-sm-12" data-aos="zoom-in" data-aos-offset="500"
                        data-aos-duration="500">
                        <div class="officer-card">
                            <div class="officer-bg" style="
                  background-image: linear-gradient(
                      to top,
                      rgba(0, 0, 0, 1) 10%,
                      rgba(0, 0, 0, 0.5) 20%,
                      rgba(0, 0, 0, 0) 90%
                    ),
                    url('../Information/master.png');
                "></div>
                            <h3>Bro. Aguinaldo S. Sepnio</h3>
                            <span>Worshipful Master</span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12" data-aos="zoom-in" data-aos-offset="500"
                        data-aos-duration="700">
                        <div class="officer-card">
                            <div class="officer-bg" style="
                  background-image: linear-gradient(
                      to top,
                      rgba(0, 0, 0, 1) 10%,
                      rgba(0, 0, 0, 0.5) 20%,
                      rgba(0, 0, 0, 0) 90%
                    ),
                    url('../Information/swarden.png');
                "></div>
                            <h3>Bro. Victor Roman C. Cacal</h3>
                            <span>Senior Warden</span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12" data-aos="zoom-in" data-aos-offset="500"
                        data-aos-duration="900">
                        <div class="officer-card">
                            <div class="officer-bg" style="
                  background-image: linear-gradient(
                      to top,
                      rgba(0, 0, 0, 1) 10%,
                      rgba(0, 0, 0, 0.5) 20%,
                      rgba(0, 0, 0, 0) 90%
                    ),
                    url('../Information/jwarden.png');
                "></div>
                            <h3>Bro. Faustino B. Austria Jr.</h3>
                            <span>Junior Warden</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="about" class="content-about container-fluid">
                <div class="background-container-about">
                    <div class="container">
                        <h3>History</h3>
                    </div>
                </div>
                <div class="container">
                    <div class="row row1">
                        <h1>High Twelve Masonic Lodge No. 82</h1>
                        <p class="about-text">Loading content...</p> <!-- This will be replaced dynamically -->
                    </div>
                </div>
            </div>
        </div>
        <div id="Events" class="content-events container">
            <h3>Events</h3>
            <div id="events-list" class="event-list">
                <div class="events-card">
                    <img src="../Information/Lodge Officers Jewels/3 Junior Warden.png" alt="" />
                    <div class="description">
                        <h3>Title</h3>
                        <span>Date</span>
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                            Molestiae incidunt dignissimos minus illum voluptas, libero
                            laudantium animi ipsam laborum, modi reprehenderit velit, alias
                            non? Ex voluptatibus fuga maiores repellat suscipit.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="News" class="content-events container">
            <h3>News</h3>
            <div id="news-list" class="event-list">
                <div class="events-card">
                    <img src="../Information/Lodge Officers Jewels/3 Junior Warden.png" alt="" />
                    <div class="description">
                        <h3>Title</h3>
                        <span>Date</span>
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                            Molestiae incidunt dignissimos minus illum voluptas, libero
                            laudantium animi ipsam laborum, modi reprehenderit velit, alias
                            non? Ex voluptatibus fuga maiores repellat suscipit.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="Activities" class="content-events container">
            <h3>Activities</h3>
            <div id="activies-list" class="event-list">
                <div class="events-card">
                    <img src="../Information/Lodge Officers Jewels/3 Junior Warden.png" alt="" />
                    <div class="description">
                        <h3>Title</h3>
                        <span>Date</span>
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                            Molestiae incidunt dignissimos minus illum voluptas, libero
                            laudantium animi ipsam laborum, modi reprehenderit velit, alias
                            non? Ex voluptatibus fuga maiores repellat suscipit.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="post" class="container home">
            <div id="cms" class="cms">

            </div>
        </div>

        <div id="officers" class="content-officers container">
            <h3 class="h3">Officers of High Twelve Masonic Lodge No. 82</h3>
            <h3 class="h3">Masonic Year 2025-2026</h3>
            <div id="officer-list" class="officers-list col-12">
                <div class="officer-container">
                    <div class="officer-card">
                        <div class="officer-bg" style="
                            background-image: linear-gradient(
                            to top,
                            rgba(0, 0, 0, 1) 10%,
                            rgba(0, 0, 0, 0.5) 20%,
                            rgba(0, 0, 0, 0) 90%
                        ),
                        url('../Information/Lodge Logo.png');
                            "></div>
                        <h3>Bro. Victor Roman C. Cacal</h3>
                        <span>Senior Warden</span>
                    </div>
                </div>
            </div>
        </div>

        <div id="Pastmaster" class="roll">
            <div class="title">
                <img src="../Information/Masonic_PastMaster.svg.png" alt="">
                <h3>Roll of Past Masters</h3>
            </div>
            <div id="masterlist" class="masterlist">
                <div class="list">
                    <h3>Name</h3>
                    <span>1990-94</span>
                </div>            
            </div>
        </div>

        <div class="login">
            <div class="container">
                <div id="to-content" class="arrowback">
                    <span class="material-icons-outlined"> cancel </span>
                </div>
                <div class="rowlogin row">
                    <div class="col-lg-6 col-md-6 col-sm-12 container-logo-name">
                        <div class="logo">
                            <img src="../Information/Lodge Logo.png" alt="" />
                            <div class="name">
                                <h2>High Twelve Masonic Lodge No. 82</h2>
                                <span>
                                The Most Worshipful Grand Lodge of <br /> Free and Accepted Masons of
                                the Philippines
                                </span>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-signin-signup mt-5 mx-auto">
                        <div class="signin">
                            <h2>Login</h2>
                            <span>Input the needed details to log in</span>
                            <form id="form-login">
                                <input id="login-email" name="login-email" class="form-control" type="text"
                                    placeholder="Email Address or Username" required />
                                <div class="input-group">
                                    <input id="login-password" name="login-password" class="form-control"
                                        type="password" placeholder="Password" required />
                                    <button class="btn btn-outline-secondary toggle-password" type="button"><i
                                            class="fa fa-eye"></i></button>
                                </div>
                                <button type="submit" class="signin-btn">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="../js/index.js"></script>
    <script>
    AOS.init();
    </script>
</body>

</html>