$(document).ready(function () {
  // Function to load accounts
  function loadAccounts() {
    $.ajax({
      url: "php/ViewAccounts.php",
      type: "POST",
      cache: false,
      success: function (data) {
        $("#table-accounts").html(data);
        /*************  ✨ Codeium Command ⭐  *************/
        /**
         * Handles errors when loading accounts
         * @param {jqXHR} xhr - The jqXHR object
         * @param {String} status - The status of the request
         * @param {String} error - The error message
         */
        /******  f0edccd5-1cfa-4c52-b765-5ddd21241116  *******/
      },
      error: function (xhr, status, error) {
        console.error("Error loading accounts:", error);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Failed to load accounts. Please try again.",
        });
      },
    });
  }

  loadAccounts();

  // ADD ACCOUNT
  $("#form-add-account").submit(async function (event) {
    event.preventDefault();
    let formData = new FormData(this);

    try {
      let response = await fetch("php/AddAccount.php", {
        method: "POST",
        body: formData,
      });
      let result = await response.json();

      if (result.success) {
        Swal.fire({ icon: "success", title: "Success", text: result.message });
        $("#form-add-account")[0].reset();
        loadAccounts();
      } else {
        Swal.fire({ icon: "error", title: "Error", text: result.message });
      }
    } catch (error) {
      console.error("Request failed:", error);
      Swal.fire({
        icon: "error",
        title: "Request Failed",
        text: "Server error. Please try again.",
      });
    }
  });

  // DELETE ACCOUNT
  $(document).on("click", ".btndelete", function () {
    let row = $(this).closest("tr");
    let email = row.find("td:first").text().trim(); // Ensure email is correctly obtained
    let id = $(this).data("id");

    console.log("Deleting email:", email); // Debugging output
    console.log("Deleting ID:", id); // Debugging output

    if (!email) {
      Swal.fire("Error!", "Email not found.", "error");
      return;
    }

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "php/DeleteAccount.php",
          type: "POST",
          data: { id: id },
          success: function (response) {
            console.log("Response from PHP:", response); // Debugging output
            let result = JSON.parse(response);
            if (result.success === "Delete") {
              Swal.fire("Deleted!", result.message, "success");
              loadAccounts(); // Assuming loadAccounts() refreshes the account list
            } else {
              Swal.fire("Error!", result.message, "error");
            }
          },
          error: function () {
            Swal.fire("Error!", "Server error. Please try again.", "error");
          },
        });
      }
    });
  });


  // UPDATE ACCOUNT - Fetch Data and Show in Modal
  $(document).on("click", ".btnupdate", function () {
    let id = $(this).data("id");

    Swal.fire({
      title: "Fetching Data...",
      text: "Please wait while we retrieve the account details.",
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    $.ajax({
      url: "php/fetchaccountinfo.php",
      type: "POST",
      data: { id: id },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          Swal.close(); // Isara ang loading Swal

          $("#update-id").val(response.data.ID);
          $("#update-email").val(response.data.Email);
          $("#update-username").val(response.data.Username);
          $("#update-password").val(response.data.DecryptedPassword);
          $("#update-position").val(response.data.WebPosition);
          $("#update-status").val(response.data.Status);

          $("#updateModal").modal("show");
        } else {
          Swal.fire("Error", response.message, "error");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", xhr.responseText);
        Swal.fire(
          "Error",
          "An error occurred while fetching the account data.",
          "error"
        );
      },
    });
  });

  // UPDATE ACCOUNT - Submit Form
  $("#form-update-account").submit(function (event) {
    event.preventDefault();

    // Get the button and spinner elements
    var buttonText = document.getElementById("button-text");
    var spinner = document.getElementById("spinner");

    // Hide button text and show the spinner
    buttonText.style.display = "none";
    spinner.style.display = "inline-block";  // Show the spinner

    // Disable the submit button to prevent multiple submissions
    document.getElementById("update-account-btn").disabled = true;

    let formData = $(this).serialize();

    $.ajax({
      url: "php/UpdateAccount.php",
      type: "POST",
      data: formData,
      success: function (response) {
        let result = JSON.parse(response);
        if (result.success === "Updated") {
          Swal.fire({
            icon: "success",
            title: "Updated!",
            text: result.message,
          });
          $("#updateModal").modal("hide");
          loadAccounts();
        } else {
          Swal.fire({ icon: "error", title: "Error", text: result.message });
        }
      },
      error: function () {
        Swal.fire("Error!", "Server error. Please try again.", "error");
      },
      complete: function () {
        // After the request is complete, restore the button
        buttonText.style.display = "inline";
        spinner.style.display = "none"; // Hide the spinner
        document.getElementById("update-account-btn").disabled = false; // Enable the button again
      }
    });
  });

});

loadAccounts();
