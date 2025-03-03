$(document).ready(function () {
  $("#officers").removeClass("active").addClass("inactive");
  $("#Events").removeClass("active").addClass("inactive");
  $("#News").removeClass("active").addClass("inactive");
  $("#Activities").removeClass("active").addClass("inactive");
  $("#post").removeClass("active").addClass("inactive");

  $("#HomeNav, #AboutNav, #HistoryNav").click(function () {
    $("#main").removeClass("inactive").addClass("active");
    $("#officers").removeClass("active").addClass("inactive");
    $("#Events").removeClass("active").addClass("inactive");
    $("#News").removeClass("active").addClass("inactive");
    $("#Activities").removeClass("active").addClass("inactive");
    $("#post").removeClass("active").addClass("inactive");
  });

  $("#EventsNav").click(function () {
    $("#main").removeClass("active").addClass("inactive");
    $("#officers").removeClass("active").addClass("inactive");
    $("#Events").removeClass("inactive").addClass("active");
    $("#News").removeClass("active").addClass("inactive");
    $("#Activities").removeClass("active").addClass("inactive");
    $("#post").removeClass("active").addClass("inactive");
  });

  $("#NewsNav").click(function () {
    $("#main").removeClass("active").addClass("inactive");
    $("#officers").removeClass("active").addClass("inactive");
    $("#Events").removeClass("active").addClass("inactive");
    $("#News").removeClass("inactive").addClass("active");
    $("#Activities").removeClass("active").addClass("inactive");
    $("#post").removeClass("active").addClass("inactive");
  });

  $("#ActivitiesNav").click(function () {
    $("#main").removeClass("active").addClass("inactive");
    $("#officers").removeClass("active").addClass("inactive");
    $("#Events").removeClass("active").addClass("inactive");
    $("#News").removeClass("active").addClass("inactive");
    $("#Activities").removeClass("inactive").addClass("active");
    $("#post").removeClass("active").addClass("inactive");
  });

  $("#OfficersNav").click(function () {
    $("#main").removeClass("active").addClass("inactive");
    $("#officers").removeClass("inactive").addClass("active");
    $("#Events").removeClass("active").addClass("inactive");
    $("#News").removeClass("active").addClass("inactive");
    $("#Activities").removeClass("active").addClass("inactive");
    $("#post").removeClass("active").addClass("inactive");
  });

  $("#ContentNav").click(function () {
    $("#main").removeClass("active").addClass("inactive");
    $("#officers").removeClass("active").addClass("inactive");
    $("#Events").removeClass("active").addClass("inactive");
    $("#News").removeClass("active").addClass("inactive");
    $("#Activities").removeClass("active").addClass("inactive");
    $("#post").removeClass("inactive").addClass("active");
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

  $.ajax({
    url: "../php/fetchpost.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let postContainer = $("#cms");
      postContainer.html("");

      data.forEach((post, index) => {
        let imagesHTML = "";
        let modalImages = "";
        let imagesArray = post.post_image; // This is now an array
        let fullDescription = post.description.replace(/\n/g, "<br>");
        let shortDescription =
          fullDescription.length > 100
            ? fullDescription.substring(0, 100) + "..."
            : fullDescription;

        if (Array.isArray(imagesArray) && imagesArray.length > 0) {
          imagesHTML = `<img src="${imagesArray[0]}" alt="Post Image" class="post-img"/>`;

          imagesArray.forEach((image) => {
            modalImages += `<img src="${image}" alt="Full Image" class="modal-img"/>`;
          });

          if (imagesArray.length > 1) {
            imagesHTML += `<div class="more-images-btn" data-index="${index}">+${
              imagesArray.length - 1
            } More</div>`;
          }
        }

        let postHTML = `
          <div class="viewpostcontainer">
              <div class="profile-post">
                  <img src="${post.profile}"/>
                  <div class="name-dateposted">
                      <h3>${post.Username}</h3>
                      <span>${post.date}</span>
                  </div>
              </div>
              <p class="post-description" data-full="${fullDescription}">
                ${shortDescription} 
                ${
                  fullDescription.length > 100
                    ? '<span class="see-more4" style="cursor: pointer; color: #6c9bcf;">See More</span>'
                    : ""
                }
              </p>
              <div class="post-images">${imagesHTML}</div>
          </div>
  
          <!-- Modal for showing all images -->
          <div id="modal-${index}" class="modals">
            <span class="close-btn" data-index="${index}">&times;</span>
            <div class="modal-contents">${modalImages}</div>
          </div>
        `;
        postContainer.append(postHTML);
      });
    },
    error: function (error) {
      console.log("Error fetching posts:", error);
    },
  });

  // Event delegation for "See More" and "See Less"
  $(document).on("click", ".see-more4", function () {
    let parent = $(this).closest(".post-description");
    let fullText = parent.data("full");

    if ($(this).text() === "See More") {
      parent.html(
        fullText +
          ' <span class="see-more4" style="cursor: pointer; color: #6c9bcf;"><br>See Less</br></span>'
      );
    } else {
      let shortText = fullText.substring(0, 100) + "...";
      parent.html(
        shortText +
          ' <span class="see-more4" style="cursor: pointer; color: #6c9bcf;">See More</span>'
      );
    }
  });

  $(document).on("click", ".more-images-btn", function () {
    let index = $(this).data("index");
    $(`#modal-${index}`).addClass("active");
    $("body").css("overflow", "hidden");
  });

  // Use event delegation to handle modal closing
  $(document).on("click", ".close-btn", function () {
    let index = $(this).data("index");
    $(`#modal-${index}`).removeClass("active");
    $("body").css("overflow", "");
  });

  document.querySelectorAll(".toggle-password").forEach((button) => {
    button.addEventListener("click", function () {
      let input = this.previousElementSibling;
      let icon = this.querySelector("i");

      if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("fa-eye", "fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.replace("fa-eye-slash", "fa-eye");
      }
    });
  });
  //See more and See Less eventListener
  $(document).on("click", ".see-more-btn1", function () {
    let parent = $(this).closest(".event-text");
    let fullText = parent.attr("data-full");

    if ($(this).text() === "See More") {
      parent.html(
        fullText +
          ' <span class="see-more-btn1" style="cursor: pointer; color: #6c9bcf;"><br/>See Less</span>'
      );
    } else {
      let shortText = fullText.substring(0, 100) + "...";
      parent.html(
        shortText +
          ' <span class="see-more-btn1" style="cursor: pointer; color: #6c9bcf;">See More</span>'
      );
    }
  });
});
