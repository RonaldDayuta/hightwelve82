$(document).ready(function () {
  function loadofficers() {
    $.ajax({
      url: "../php/Viewofficers.php",
      type: "POST",
      cache: false,
      success: function (data) {
        $("#table-Officers").html(data);
      },
      error: function (xhr, status, error) {
        console.error("Error loading officers:", error);
      },
    });
  }

  loadofficers();

  $("#addOfficerForm").submit(function (event) {
    event.preventDefault();
    let formData = new FormData(this);
    var selectedValue = $("#officerPosition").val(); // "1-Manager"
    var parts = selectedValue.split("-");
    var position_id = parts[0];
    var position_name = parts[1];
    formData.append("officerPositionNumber", position_id);
    formData.append("officerPositionWord", position_name);
    $("#button-text").text("Adding...");
    $("#spinner").show();

    $.ajax({
      url: "../php/Addofficers.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        $("#button-text").text("Add Officer");
        $("#spinner").hide();
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
            confirmButtonText: "OK",
          }).then(() => {
            $("#addOfficerForm")[0].reset(); // Reset the form
            loadofficers();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message || "Error adding officer.",
            confirmButtonText: "OK",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "An unexpected error occurred.",
          confirmButtonText: "OK",
        });
      },
    });
  });

  $(document).on("click", "#officer-update", function () {
    let officerID = $(this).data("id");
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
          url: "../php/fetchofficerinfo.php", // Fetch officer details
          type: "POST",
          data: { officerID: officerID },
          dataType: "json",
          success: function (response) {
            if (response.success) {
              $("#editOfficerID").val(response.data.ID);
              $("#editOfficerName").val(response.data.Name);
              $("#editPositionDescription").val(response.data.PosDecs);
              var myModal = new bootstrap.Modal(
                document.getElementById("editOfficerModal")
              );
              myModal.show();
            } else {
              Swal.fire("Error", "Failed to fetch officer details.", "error");
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

  $("#editOfficerForm").submit(function (event) {
    event.preventDefault();
    let formData = new FormData(this);
    var selectedValue = $("#editOfficerPosition").val(); // "1-Manager"
    var parts = selectedValue.split("-");
    var position_id = parts[0];
    var position_name = parts[1];
    formData.append("officerPositionNumber", position_id);
    formData.append("officerPositionWord", position_name);

    $("#edit-button-text").text("Updating...");
    $("#edit-spinner").show();

    $.ajax({
      url: "../php/Updateofficer.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        $("#edit-button-text").text("Update Officer");
        $("#edit-spinner").hide();
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Updated!",
            text: response.message,
            confirmButtonText: "OK",
          }).then(() => {
            var modalEl = document.getElementById("editOfficerModal");
            var modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) {
              modalInstance.hide();
            }
            $("#editOfficerForm")[0].reset();
            loadofficers();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message || "Update failed.",
            confirmButtonText: "OK",
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "An unexpected error occurred.",
          confirmButtonText: "OK",
        });
      },
    });
  });

  $(document).on("click", "#officer-delete", function () {
    let officerID = $(this).data("id");

    Swal.fire({
      title: "Are you sure?",
      text: "This officer will be permanently deleted!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../php/Deleteofficers.php",
          type: "POST",
          data: { officerID: officerID },
          dataType: "json",
          success: function (response) {
            if (response.success) {
              Swal.fire({
                icon: "success",
                title: "Deleted!",
                text: "Officer has been deleted.",
                confirmButtonText: "OK",
              }).then(() => {
                loadofficers();
              });
            } else {
              Swal.fire("Error", "Failed to delete officer.", "error");
            }
          },
          error: function () {
            Swal.fire("Error", "An unexpected error occurred.", "error");
          },
        });
      }
    });
  });

  $("#search-officer").on("keyup", function () {
    let searchText = $(this).val().trim(); // Get the input value and trim spaces

    if (searchText !== "") {
      $.ajax({
        url: "../php/SearchOfficer.php",
        type: "POST",
        data: { search: searchText }, // Use "search" to handle both date & title
        beforeSend: function () {
          $("#table-Officers").html("<p>Loading...</p>"); // Show loading text
        },
        success: function (response) {
          $("#table-Officers").html(response);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error: " + error);
          $("#table-Officers").html("<p>Error fetching officers.</p>");
        },
      });
    } else {
      loadofficers();
    }
  });
});
