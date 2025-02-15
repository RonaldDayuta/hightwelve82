<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/admin.css" />
    <title>ADMIN</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <nav class="navbar navbar-expand-lg d-lg-none bg-body-tertiary">
          <a class="navbar-brand" href="#"
            >HIGH<span class="danger">TWELVE82</span></a
          >
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <div class="tabs" id="navbar-tabs-account">
              <div class="icon">
                <span class="material-icons-outlined"> account_circle </span>
              </div>
              <div>Accounts</div>
            </div>
            <div class="tabs" id="navbar-tabs-event">
              <div class="icon">
                <span class="material-icons-outlined"> event </span>
              </div>
              <div>Events</div>
            </div>
            <div class="tabs" id="navbar-tabs-calendar">
              <div class="icon">
                <span class="material-icons-outlined"> calendar_month </span>
              </div>
              <div>Calendar</div>
            </div>
            <div class="tabs" id="navbar-tabs-manage">
              <div class="icon">
                <span class="material-icons-outlined"> manage_accounts </span>
              </div>
              <div>Manage Account</div>
            </div>
            <div class="tabs">
              <div class="icon">
                <span class="material-icons-outlined"> logout </span>
              </div>
              <div>LogOut</div>
            </div>
          </div>
        </nav>
        <div class="col-sidebar col-lg-1.5 col-md-12 col-sm-12">
          <div class="logo">
            <img src="img/logo.png" alt="" />
            <h2>HIGH <span class="danger">TWELVE82</span></h2>
          </div>
          <div class="sidebar">
            <div class="tabs" id="sidebar-tabs-account">
              <div class="icon">
                <span class="material-icons-outlined"> account_circle </span>
              </div>
              <div class="tabs-name">Accounts</div>
            </div>
            <div class="tabs" id="sidebar-tabs-event">
              <div class="icon">
                <span class="material-icons-outlined"> event </span>
              </div>
              <div class="tabs-name">Events</div>
            </div>
            <div class="tabs" id="sidebar-tabs-calendar">
              <div class="icon">
                <span class="material-icons-outlined"> calendar_month </span>
              </div>
              <div class="tabs-name">Calendar</div>
            </div>
            <div class="tabs" id="sidebar-tabs-manage">
              <div class="icon">
                <span class="material-icons-outlined"> manage_accounts </span>
              </div>
              <div class="tabs-name">Manage Account</div>
            </div>
            <div class="tabs">
              <div class="icon">
                <span class="material-icons-outlined"> logout </span>
              </div>
              <div class="tabs-name">LogOut</div>
            </div>
          </div>
        </div>
        <div
          class="col-main col-lg-8.5 col-md-12 col-sm-12 order-lg-1 order-2"
          id="main"
        ></div>
        <div class="col-right col-lg-2 col-md-12 col-sm-12 order-lg-2 order-1">
          <div class="profile">
            <div class="email-position">
              <span>mason@gmail.com</span>
              <span>Grand Master</span>
            </div>
            <img src="img/MW_Cayanan_Temp__website-removebg-preview_1.png" alt="" />
          </div>
          <div class="lates-event">
            <h2>Latest Event Updates!</h2>
            <h3>Events Title</h3>
            <span
              >Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam
              molestias voluptatum numquam modi, accusantium eaque ipsam
              quibusdam non rem. Quia eos vel, repudiandae esse recusandae
              temporibus eius consequuntur fugit ipsam!</span
            >
          </div>
          <div class="members">
            <h2>Members</h2>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Profile</th>
                  <th scope="col">Name</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img
                      src="img/MW_Cayanan_Temp__website-removebg-preview_1.png"
                      alt=""
                    />
                  </td>
                  <td>MW Ariel T. Cayanan</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="js/admin.js"></script>
  </body>
</html>
