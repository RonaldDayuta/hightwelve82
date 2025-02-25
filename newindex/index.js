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
    $("body").css("overflow", "hidden");
  });
  $("#to-content").on("click", function () {
    $(".login").removeClass("loginactive");
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
            }
          });
        } else {
          let errorMessage = response.message;

          if (errorMessage.includes("Invalid Password")) {
            errorMessage = "Incorrect password. Please try again.";
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
});
