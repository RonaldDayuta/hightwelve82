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

  $("#to-signup").on("click", function () {
    $(".signup").addClass("active");
    $(".signin").addClass("active");
  });

  $("#to-signin").on("click", function () {
    $(".signup").removeClass("active");
    $(".signin").removeClass("active");
  });
});
