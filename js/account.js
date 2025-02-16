// add-account.js
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

  $("#form-add-account").submit(async function (event) {
    event.preventDefault();
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
        loadAccounts();
      } else {
        Swal.fire({ icon: "error", title: "Error", text: result.message });
      }
    } catch (error) {
      console.error("Request failed:", error);
      Swal.fire({ icon: "error", title: "Request Failed", text: "Server error. Please try again." });
    }
  });
});
