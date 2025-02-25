$(document).ready(function () {
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
});
