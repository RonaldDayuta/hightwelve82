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
                      <div>
                        <h3>${post.Username}</h3>
                        <span>${post.date}</span>
                      </div>
                    </div>
                </div>
                <p class="post-description" data-full="${fullDescription}">
                  ${shortDescription} 
                  ${
                    fullDescription.length > 100
                      ? '<span class="see-more4" style="cursor: pointer;  color: #6c9bcf;">See More</span>'
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
            '<br><span class="see-more4" style="cursor: pointer; color: #6c9bcf;">See Less</span>'
        );
      } else {
        let shortText = fullText.substring(0, 100) + "...";
        parent.html(
          shortText +
            '<span class="see-more4" style="cursor: pointer; color: #6c9bcf;">See More</span>'
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

    $(document).on("click", "#update_post", function () {
      let id = $(this).data("id");
      let des = $(this).data("des");

      $("#edit_description").val(des);
      $("#post_id").val(id);
    });

    $("#editPostForm").submit(function (e) {
      e.preventDefault();

      let formData = new FormData(this);

      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to update this post?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, update it!",
      }).then((result) => {
        if (result.isConfirmed) {
          $("#button-text-post").text("Updating...");
          $("#spinner").show();
          $("#btn-update").prop("disabled", true); // Disable button
          $("#loadingOverlay").fadeIn(); // Show loading overlay

          $.ajax({
            url: "../php/update_post.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
              if (response.success) {
                Swal.fire("Updated!", response.message, "success");
                $("#editpost").modal("hide");
                $("#editPostForm")[0].reset();
                loadcms();
              } else {
                Swal.fire("Error!", response.message, "error");
              }
            },
            error: function () {
              Swal.fire("Error!", "Something went wrong!", "error");
            },
            complete: function () {
              $("#button-text-post").text("Update");
              $("#spinner").hide();
              $("#btn-update").prop("disabled", false); // Re-enable button
              $("#loadingOverlay").fadeOut(); // Hide loading overlay
            },
          });
        }
      });
    });

    $(document).on("click", "#delete_post", function () {
      let postId = $(this).data("id");
      let imagePaths = $(this).data("images");

      Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        preConfirm: () => {
          // Show loading state
          Swal.fire({
            title: "Deleting...",
            text: "Please wait while we process your request.",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
              Swal.showLoading();
            },
          });

          return $.ajax({
            url: "../php/delete_post.php",
            type: "POST",
            data: { post_id: postId, images: imagePaths },
            dataType: "json",
          })
            .then((response) => {
              if (!response.success) {
                throw new Error(response.message);
              }
              return response;
            })
            .catch((error) => {
              Swal.fire({
                title: "Error!",
                text: `Request failed: ${error}`,
                icon: "error",
              });
            });
        },
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deleted!",
            text: result.value.message,
            icon: "success",
            timer: 2000,
            showConfirmButton: false,
          }).then(() => {
            location.reload();
          });
        }
      });
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
      url: "../php/Addpost.php", // PHP file to handle insertion
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
