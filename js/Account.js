$(document).ready(function () {
  function loadAccounts() {
    $.ajax({
      url: "../php/ViewAccounts.php",
      type: "POST",
      cache: false,
      success: function (data) {
        $("#table-accounts").html(data);
      },
      error: function (xhr, status, error) {
        console.error("Error loading accounts:", error);
      },
    });
  }

  loadAccounts();

  // ADD ACCOUNT
  $("#form-add-account").submit(async function (event) {
    event.preventDefault();

    let addButton = $("#add-event-btn");
    let spinner = $("#spinner");
    let buttonText = $("#button-text");

    spinner.show();
    buttonText.text("Adding...");
    addButton.prop("disabled", true);

    let formData = new FormData(this);

    try {
      let response = await fetch("../php/AddAccount.php", {
        method: "POST",
        body: formData,
      });
      let result = await response.json();

      if (result.success) {
        Swal.fire({ icon: "success", title: "Success", text: result.message });
        $("#form-add-account")[0].reset();
        spinner.hide();
        buttonText.text("Add Accounts");
        addButton.prop("disabled", false);
        loadAccounts();
      } else {
        Swal.fire({ icon: "error", title: "Error", text: result.message });
        spinner.hide();
        buttonText.text("Add Accounts");
        addButton.prop("disabled", false);
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
  $(document).on("click", "#account-delete", function () {
    let row = $(this).closest("tr");
    let email = row.find("td:first").text().trim();
    let id = $(this).data("id");

    console.log("Deleting email:", email);
    console.log("Deleting ID:", id);

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
        // Show loading indicator
        Swal.fire({
          title: "Deleting...",
          text: "Please wait while we process the request.",
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });

        $.ajax({
          url: "../php/DeleteAccount.php",
          type: "POST",
          data: { id: id },
          success: function (response) {
            let result = JSON.parse(response);
            if (result.success === "Delete") {
              Swal.fire("Deleted!", result.message, "success");
              loadAccounts();
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
  $(document).on("click", "#account-update", function () {
    let id = $(this).data("id");

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, Update it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../php/fetchaccountinfo.php",
          type: "POST",
          data: { id: id },
          dataType: "json",
          success: function (response) {
            if (response.status === "success") {
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
      }
    });
  });

  // UPDATE ACCOUNT - Submit Form
  $("#form-update-account").submit(function (event) {
    event.preventDefault();

    let spinner = $("#spinners");
    let buttonText = $("#button-texts");

    spinner.show();
    buttonText.text("Updating...");

    let formData = $(this).serialize();

    console.log("Updating with data:", formData); // Debugging output

    $.ajax({
      url: "../php/UpdateAccount.php",
      type: "POST",
      data: formData,
      success: function (response) {
        console.log("Update Response:", response); // Debugging output
        let result = JSON.parse(response);
        if (result.success === "Updated") {
          Swal.fire({
            icon: "success",
            title: "Updated!",
            text: result.message,
          });
          $("#updateModal").modal("hide");
          spinner.hide();
          buttonText.text("Update Account");
          loadAccounts();
        } else {
          Swal.fire({ icon: "error", title: "Error", text: result.message });
        }
      },
      error: function () {
        Swal.fire("Error!", "Server error. Please try again.", "error");
      },
    });
  });

  $("#search-account").on("keyup", function () {
    let searchText = $(this).val().trim(); // Get the input value and trim spaces

    if (searchText !== "") {
      $.ajax({
        url: "../php/SearchAcc.php",
        type: "POST",
        data: { search: searchText }, // Use "search" to handle both date & title
        beforeSend: function () {
          $("#table-accounts").html("<p>Loading...</p>"); // Show loading text
        },
        success: function (response) {
          $("#table-accounts").html(response);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error: " + error);
          $("#table-accounts").html("<p>Error fetching Accounts.</p>");
        },
      });
    } else {
      loadAccounts();
    }
  });
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
