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
                            <a class="nav-link" id="AboutNav" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="HistoryNav" href="#history">History</a>
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
                            <a class="nav-link" id="ContentNav" href="#post">PostContent</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="OfficersNav" href="#Officers">Officers</a>
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
                    <div class="col-lg-4 col-md-4 col-sm-12">
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
                    <div class="col-lg-4 col-md-4 col-sm-12">
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
                    <div class="col-lg-4 col-md-4 col-sm-12">
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
                        <h3>About</h3>
                    </div>
                </div>
                <div class="container">
                    <div class="row row1">
                        <h1>High Twelve Masonic Lodge No. 82</h1>
                        <p>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;On
                            June 25, 1922, sixteen members of the Craft belonging to three
                            lodges in this Grand Jurisdiction got together to practice the
                            ritual on the conferral of degrees. Imbued with the desire to
                            promote the best interests of the Order, it dawned upon them to
                            organize a new lodge. Upon the suggestion of Bro. Severino
                            Karganilla, the name "High Twelve" was adopted for the new lodge.
                            <br />
                            <br />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A
                            petition for dispensation, signed by the sixteen members, was
                            prepared and the recommendation of three lodges working in Manila
                            was secured. On July 20, 1922, Grand Master Quintin Paredes,
                            issued a dispensation authorizing the petitioners to form a lodge
                            The Grand Master designated Filomeno Galang as the first
                            Worshipful Master of the Lodge.
                            <br />
                            <br />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The
                            unyielding determination of the founders and the good record of
                            the lodge while working under dispensation resulted in the
                            favorable recommendation of the Committee on Charters during to
                            Eleventh Annual Communication of the Grand Lodge on January 23,
                            1923. Thus, the lodge was issued a charter as High-Twelve Lodge
                            No. 82. On February 17, 1923 Grand Master Frederic H. Stevens
                            formally constituted the lodge and installed its officers in
                            public ceremonies conducted at the Blue Lodge Hall of the Masonic
                            Temple at the Escolta in Manila.
                            <br />
                            <br />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;And
                            so, from a casual gathering of sixteen inspired members of the
                            Craft there came into being High-Twelve Lodge No. 82 which now
                            counts with more than one hundred active members. The record made
                            by the lodge during the more than eighty years of its fruitful
                            existence stands out as a glowing tribute to its founders, to its
                            officers and its members who, from year to year, have carried on
                            the work of promoting universal brotherhood through the practice
                            of the principal tenets of the Masonic Institution - Brotherly
                            Love, Relief and Truth.
                            <br />
                            <br />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proficiency
                            in the rituals of Masonry has been the perennial trademark of High
                            Twelve Lodge. Some of its members who have distinguished
                            themselves with their accurate execution of the Monitor are
                            Francisco Olizon, Felipe Carbonilia, Adriano R. Rivera, Jose
                            Intal, Dominador Escosa, Gregorio Cariaga, Fidel Manalo, Baldomero
                            Reyes and, of course, the longtime Senior Grand Lecturer
                            Hermogenes P. Oliveros. Men who have distinguished themselves in
                            the Masonic fraternity and in Philippine society also graced to
                            roster of this lodge. To name a few we have Mauro Baradi, PGM;
                            Charles Mosebrook, PGM; Gen. Manuel D. Mandac, PGM; Domingo C.
                            Bascarra; Regino G. Padua; and Prisco N. Evangelista. It should
                            also be mentioned that this lodge almost mothered a lodge in
                            China. In the 1930's one of its members, Eduardo Co Seteng, was
                            the Mayor of Amoy, China. On September 16, 1933 he entertained
                            over 100 Masons who held membership in Philippine lodges. The
                            organization of a Masonic lodge in Amoy was discussed.
                            Preliminarily, they agreed to form a Masonic Club and named Mayor
                            Co Seteng as chairman of the organizing committee. In spite of
                            their early enthusiasm, however, they never went beyond the
                            "Masonic Club" stage.
                            <br />
                            <br />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Among
                            the present leaders of the lodge are Gigi Ancajas, Charles G.
                            Agar, Rolando C. Chill, Reuynaldo Cortez, Larry Uy, Genaro T.
                            Cabreros, Felix D. Ramos, Jr., George L. So, Arturo E. Fadriquela
                            and Bienvenuto C. Alegre.
                        </p>
                    </div>
                </div>
            </div>

            <div id="history" class="content-history container-fluid">
                <div class="background-container-history">
                    <div class="container">
                        <h3>History</h3>
                    </div>
                </div>
                <div class="container">
                    <div class="row row1">
                        <h1>Brief history of Masonry in the Philippines</h1>
                        <p>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Masonry
                            existed in England long before the creation of the first Grand
                            Lodge, so was Philippine Masonry already alive even before the
                            formation of the Grand Lodge of the Philippine Islands. In 1856,
                            for example, Primera Luz Filipina, the first Masonic lodge in the
                            Philippines, was formed by Jose Malcampo y Monge, a navy ensign
                            who subsequently became Governor General of the Philippines.
                            <br />
                            <br />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Primera
                            Luz was chartered by Gran Oriente Luisitano and admitted only
                            Spaniards in its fold. Subsequently, three other lodges were
                            established one after the other: the first by the Germans, the
                            second by the British consul in Nagtahan, and the third by the
                            Spaniards in Pandacan.
                            <br />
                            <br />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;On
                            December 19, 1912, three lodges namely (Manila 342, Cavite 350,
                            and Corregidor 386) that were chartered under the Constitution of
                            the Grand Lodge of California which later changed to Manila 1,
                            Cavite 2 and Corregidor 3 finally succeeded in establishing the
                            Grand Lodge of Free and Accepted Masons of the Philippine Islands,
                            the forerunner of what is now officially known as the Most
                            Worshipful Grand Lodge of Free and Accepted Masons of the
                            Philippines.
                            <br />
                            <br />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Not
                            only that, Dr, Serafin Quiazon, head of the National Historical
                            Institute of the Republic of the Philippines, while researching in
                            London on the British trade with the Philippines, stumbled upon a
                            significant piece of historical data. Guissippe Garibaldi, that
                            brilliant Italian revolutionary whom President Abraham Lincoln
                            offered a command in the United States Army during the American
                            Civil War, captained a vessel that anchored in Manila Bay sometime
                            in the middle of the nineteenth century. There is little doubt
                            that the tenets of the Craft landed with Garibaldi in the sandy
                            beaches of the Philippine Islands during that period.
                        </p>
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
            <h3>Post Content</h3>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="../js/index.js"></script>
</body>

</html>