$(document).ready(function () {
  function loadcms() {
    $.ajax({
      url: "../php/fetchpost.php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let postContainer = $("#cms"); // Change to your actual container
        postContainer.html(""); // Clear existing content

        data.forEach((post) => {
          let postHTML = `
                        <div class="viewpostcontainer">
                            <div class="profile-post">
                                 <img src="${post.profile}" alt="" />
                                <div class="name-dateposted">
                                     <h3>${post.Username}</h3>
                                     <span>${post.date}</span>
                                </div>
                            </div>
                             <p>${post.description}</p>
                            <img src="${post.post_image}" alt="" />
                        </div>
                        `;
          postContainer.append(postHTML);
        });
      },
      error: function (error) {
        console.log("Error fetching posts:", error);
      },
    });
  }

  loadcms();

  $("#addPostForm").submit(function (e) {
    e.preventDefault(); // Prevent form from refreshing the page

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
