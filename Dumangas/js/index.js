$(document).ready(function () {
  $("#officers").removeClass("active").addClass("inactive");
  $("#Events").removeClass("active").addClass("inactive");
  $("#News").removeClass("active").addClass("inactive");
  $("#Activities").removeClass("active").addClass("inactive");

  $("#HomeNav, #AboutNav, #HistoryNav").click(function () {
    $("#main").removeClass("inactive").addClass("active");
    $("#officers").removeClass("active").addClass("inactive");
    $("#Events").removeClass("active").addClass("inactive");
    $("#News").removeClass("active").addClass("inactive");
    $("#Activities").removeClass("active").addClass("inactive");
  });

  $("#EventsNav").click(function () {
    $("#main").removeClass("active").addClass("inactive");
    $("#officers").removeClass("active").addClass("inactive");
    $("#Events").removeClass("inactive").addClass("active");
    $("#News").removeClass("active").addClass("inactive");
    $("#Activities").removeClass("active").addClass("inactive");
  });

  $("#NewsNav").click(function () {
    $("#main").removeClass("active").addClass("inactive");
    $("#officers").removeClass("active").addClass("inactive");
    $("#Events").removeClass("active").addClass("inactive");
    $("#News").removeClass("inactive").addClass("active");
    $("#Activities").removeClass("active").addClass("inactive");
  });

  $("#ActivitiesNav").click(function () {
    $("#main").removeClass("active").addClass("inactive");
    $("#officers").removeClass("active").addClass("inactive");
    $("#Events").removeClass("active").addClass("inactive");
    $("#News").removeClass("active").addClass("inactive");
    $("#Activities").removeClass("inactive").addClass("active");
  });

  $("#OfficersNav").click(function () {
    $("#main").removeClass("active").addClass("inactive");
    $("#officers").removeClass("inactive").addClass("active");
    $("#Events").removeClass("active").addClass("inactive");
    $("#News").removeClass("active").addClass("inactive");
    $("#Activities").removeClass("active").addClass("inactive");
  });

  $("#btn-login").on("click", function () {
    $(".login").addClass("loginactive");
    $("#navbar").addClass("inactive");
    $("body").css("overflow", "hidden");
  });
  $("#to-content").on("click", function () {
    $(".login").removeClass("loginactive");
    $("#navbar").removeClass("inactive");
    $("body").css("overflow", "");
  });

  $("#form-login").submit(function (event) {
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: "../php/Login.php",
      method: "POST",
      data: formData,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Login Successful!",
            text: "Welcome, " + response.position + "!",
          }).then(() => {
            if (response.position === "Admin") {
              window.location.href = "../Webpage/Admin.php";
            } else if (response.position === "User") {
              window.location.href = "../Webpage/User.php";
            }
          });
        } else {
          let errorMessage = response.message;

          if (errorMessage.includes("Invalid Password")) {
            errorMessage =
              "Incorrect Email or Username or Password. Please try again.";
          } else if (
            errorMessage.includes("Invalid Email") ||
            errorMessage.includes("Invalid Email or Username")
          ) {
            errorMessage = "Invalid Email or Username. Please try again.";
          }

          Swal.fire({
            icon: "error",
            title: "Login Failed",
            text: errorMessage,
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Request Failed",
          text: "There was a problem with the server or network. Please try again.",
        });
      },
    });
  });

  $.ajax({
    url: "../php/fetchofficerinfoforindex.php",
    type: "GET",
    dataType: "json",
    success: function (response) {
      let officersHtml = "";

      $.each(response, function (index, officer) {
        officersHtml += `
                    <div class="officer-container">
                      <div class="officer-card">
                        <div class="officer-bg"
                          style="background-image: linear-gradient(
                            to top,
                            rgba(0, 0, 0, 1) 10%,
                            rgba(0, 0, 0, 0.5) 20%,
                            rgba(0, 0, 0, 0) 90%
                          ), url('${officer.image}');">
                        </div>
                        <h3>${officer.name}</h3>
                        <span>${officer.position}</span>
                      </div>
                    </div>
                `;
      });

      $("#officer-list").html(officersHtml);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching officers:", error);
    },
  });

  $.ajax({
    url: "../php/fetcheventsformainpage.php", // PHP script to fetch events
    type: "GET",
    success: function (response) {
      $("#events-list").html(response);
    },
    error: function () {
      $("#events-list").html("<p>Error loading events.</p>");
    },
  });

  $.ajax({
    url: "../php/fetchnewsformainpage.php", // PHP script to fetch events
    type: "GET",
    success: function (response) {
      $("#news-list").html(response);
    },
    error: function () {
      $("#news-list").html("<p>Error loading events.</p>");
    },
  });

  $.ajax({
    url: "../php/fetchactformainpage.php", // PHP script to fetch events
    type: "GET",
    success: function (response) {
      $("#activies-list").html(response);
    },
    error: function () {
      $("#activies-list").html("<p>Error loading events.</p>");
    },
  });
});
