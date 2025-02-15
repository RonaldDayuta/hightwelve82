$(document).ready(function () {
  $("#form-add-account").submit(function (event) {
    event.preventDefault();

    let formData = new FormData(this);

    $.ajax({
      url: "AddAccount.php",
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.message.includes("Account added successfully!")) {
          Swal.fire({
            icon: "success",
            title: "Added Success!",
            text: "Account Added Successfully",
          });
          $("#form-add-account")[0].reset();
        } else if (response.message.includes("Database error!")) {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "An unexpected error occurred. Please check the inputed Details.",
          });
        } else if (response.message.includes("Failed to upload image")) {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Failed to upload imag. Try Again or Change the Image",
          });
        } else if (response.message.includes("Passwords do not match!")) {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Passwords do not match!",
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text:
              response.message ||
              "An unexpected error occurred. Please try again.",
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Request Failed",
          text: "There was a problem with the server. Please try again.",
        });
      },
    });
  });
});
