$(document).ready(function () {
  $("#main").load("../Webpage/IndexHome.php");

  $("#Home").on("click", function () {
    $("#main").load("../Webpage/IndexHome.php");
  });
  $("#Officers").on("click", function () {
    $("#main").load("../Webpage/IndexOfficer.php");
  });

  $("#btn-login").on("click", function () {
    $(".login").addClass("actives");
    $("body").css("overflow", "hidden");
  });
  $("#to-content").on("click", function () {
    $(".login").removeClass("actives");
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

  $.ajax({
    url: "../php/fetchofficerinfoforindex.php",
    type: "GET",
    dataType: "json",
    success: function (response) {
      let officersHtml = "";

      $.each(response, function (index, officer) {
        officersHtml += `
                <div class="officers-card">
                    <img src="${officer.image}" alt="Officer Image" />
                    <div class="text-overlay">
                        <h2>${officer.name}</h2>
                        <h3>${officer.position}</h3>
                    </div>
                </div>
            `;
      });

      $("#officers").html(officersHtml);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching officers:", error);
    },
  });
});
