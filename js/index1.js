var swiper = new Swiper(".swiper", {
  slidesPerView: 1,
  spaceBetween: 0,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    428: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
});

let lightmode = localStorage.getItem("lightmode");
const switchmode = document.getElementById("switchmode");

const enablelightmode = () => {
  document.body.classList.add("lightmode");
  localStorage.setItem("lightmode", "active");
};

const disablelightmode = () => {
  document.body.classList.remove("lightmode");
  localStorage.setItem("lightmode", null);
};

if (lightmode === "active") enablelightmode();

switchmode.addEventListener("click", () => {
  lightmode = localStorage.getItem("lightmode");
  lightmode !== "active" ? enablelightmode() : disablelightmode();
});

$(document).ready(function () {
  $("#btn-login").on("click", function () {
    $(".login").addClass("actives");
    $("body").css("overflow", "hidden");
  });
  $("#to-content").on("click", function () {
    $(".login").removeClass("actives");
    $("body").css("overflow", "");
  });

  $("#to-signin").on("click", function () {
    $(".signup").removeClass("active");
    $(".signin").removeClass("active");
  });

  $("#form-login").submit(function (event) {
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: "php/Login.php",
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
              window.location.href = "indexwithcms.php";
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
