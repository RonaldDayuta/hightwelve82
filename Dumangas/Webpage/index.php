<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/index.css" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Google Material Icons Outlined -->
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>HighTwelve82</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-navbar col-lg-12 col-md-12 col-sm-12">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <h2 class="navbar-brand">
                            <span class="spanhigh">H</span>IGH
                            <span class="spanhigh">T</span>WELVE<span class="spanhigh">82</span>
                        </h2>
                        <button
                            class="navbar-toggler"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarNavAltMarkup"
                            aria-controls="navbarNavAltMarkup"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div
                            class="collapse navbar-collapse justify-content-end"
                            id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <div class="tab" id="Home">
                                    <a class="nav-link">Home</a>
                                </div>
                                <div class="tab" id="Officers">
                                    <a class="nav-link">Officers</a>
                                </div>
                                <li class="nav-item dropdown">
                                    <a
                                        class="nav-link dropdown-toggle"
                                        data-bs-toggle="dropdown"
                                        href="#"
                                        role="button"
                                        aria-expanded="false">Contact</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">Directory</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Lodge Locator</a>
                                        </li>
                                    </ul>
                                </li>
                                <button id="btn-login" class="btn-login" type="button">
                                    LogIn
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="main" id="main"></div>
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
                            The Most Worshipful Grand Lodge of Free and Accepted Masons of
                            the Philippines
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-6 col-md-6 col-sm-12 col-signin-signup mt-5 mx-auto">
                    <div class="signin">
                        <h2>Login</h2>
                        <span>Input the needed details to log in</span>
                        <form id="form-login">
                            <input
                                id="login-email"
                                name="login-email"
                                class="form-control"
                                type="text"
                                placeholder="Email Address or Username"
                                required />
                            <input
                                id="login-password"
                                name="login-password"
                                class="form-control"
                                type="password"
                                placeholder="Password"
                                required />
                            <button type="submit" class="signin-btn">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/index.js"></script>
</body>

</html>