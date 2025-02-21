$(document).ready(function () {
  function loadcms() {
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

          if (Array.isArray(imagesArray) && imagesArray.length > 0) {
            // Show only the first image in the post
            imagesHTML = `<img src="${imagesArray[0]}" alt="Post Image" class="post-img"/>`;

            // Prepare all images for the modal
            imagesArray.forEach((image) => {
              modalImages += `<img src="${image}" alt="Full Image" class="modal-img"/>`;
            });

            // Show "+X More" button if more than 1 image
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
                <p>${post.description}</p>
                <div class="post-images">${imagesHTML}</div>
                <div class="buttons-post">
                  <button id="update_post" data-id="${post.ID}"><span class="material-icons-outlined">edit</span></button>
                  <button id="delete_post" data-id="${post.ID}"><span class="material-icons-outlined">delete</span></button>
                </div>
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

    $(document).on("click", "#update_post", function () {
      let id = $(this).data("id");
      console.log(id);
    });
  }

  loadcms();

  $("#addPostForm").submit(function (e) {
    e.preventDefault(); // Prevent form from refreshing the page

    let addButton = $("#btn-post");
    let spinner = $("#spinner");
    let buttonText = $("#button-text");

    // Show the spinner and change the button text
    spinner.show();
    buttonText.text("Posting..."); // Change text to "Adding..."
    addButton.prop("disabled", true); // Disable the button

    let formData = new FormData(this);

    $.ajax({
      url: "../php/addpost.php", // PHP file to handle insertion
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json", // Ensure response is treated as JSON
      success: function (response) {
        if (response.success) {
          Swal.fire({
            title: "Success!",
            text: response.message,
            icon: "success",
            confirmButtonText: "OK",
          }).then(() => {
            $("#addPostForm")[0].reset(); // Reset the form
            $("#addpost").modal("hide"); // Close the modal
            loadcms(); // Reload posts
            spinner.hide();
            buttonText.text("Post");
            addButton.prop("disabled", false);
          });
        } else {
          Swal.fire({
            title: "Error!",
            text: response.message,
            icon: "error",
            confirmButtonText: "OK",
          });
        }
      },
      error: function () {
        Swal.fire({
          title: "Error!",
          text: "Something went wrong!",
          icon: "error",
          confirmButtonText: "OK",
        });
      },
    });
  });
});
