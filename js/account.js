$(document).ready(function () {
  function loadAccounts() {
    $.ajax({
      url: "php/ViewAccounts.php",
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
      Swal.fire({ icon: "error", title: "Request Failed", text: "Server error. Please try again." });
    }
  });

  // DELETE ACCOUNT
  $(document).on("click", ".btndelete", function () {
    let row = $(this).closest("tr");
    let email = row.find("td:first").text().trim(); // Siguraduhin na may email na nakuha

    console.log("Deleting email:", email); // Debugging output

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
          data: { email: email },
          success: function (response) {
            console.log("Delete Response:", response); // Debugging output
            let result = JSON.parse(response);
            if (result.success) {
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
  $(document).on("click", ".btnupdate", function () {
    let row = $(this).closest("tr");
    let email = row.find("td:first").text().trim();
    let username = row.find("td:eq(1)").text().trim();
    let password = row.find("td:eq(2)").text().trim();
    let webPosition = row.find("td:eq(3)").text().trim();
    let status = row.find("td:eq(4)").text().trim();

    console.log("Editing:", { email, username, password, webPosition, status }); // Debugging output

    if (!email) {
      Swal.fire("Error!", "Email not found.", "error");
      return;
    }

    $("#update-email").val(email);
    $("#update-username").val(username);
    $("#update-password").val(password);
    $("#update-webPosition").val(webPosition);
    $("#update-status").val(status);

    $("#updateModal").modal("show");
  });

  // UPDATE ACCOUNT - Submit Form
  $("#form-update-account").submit(function (event) {
    event.preventDefault();
    let formData = $(this).serialize();

    console.log("Updating with data:", formData); // Debugging output

    $.ajax({
      url: "php/UpdateAccount.php",
      type: "POST",
      data: formData,
      success: function (response) {
        console.log("Update Response:", response); // Debugging output
        let result = JSON.parse(response);
        if (result.success) {
          Swal.fire({ icon: "success", title: "Updated!", text: result.message });
          $("#updateModal").modal("hide");
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
});
