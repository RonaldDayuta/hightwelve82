$(document).ready(function () {
  function loadmaster() {
    $.ajax({
      url: "../php/fetchpastmaster.php",
      type: "POST",
      caches: false,
      success: function (data) {
        $("#pastmastertbl").html(data);
      },
    });
  }
  loadmaster();

  $("#addPastMasterForm").submit(function (e) {
    e.preventDefault();

    let formdata = new FormData(this);

    $.ajax({
      url: "../php/Addpastmaster.php",
      type: "POST",
      data: formdata,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Add Success",
            text: response.message,
          }).then(() => {
            $("#addPastMasterForm")[0].reset();
            loadmaster();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Add Failed",
            text: response.message,
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", xhr.responseText);
        Swal.fire("Error", "An error occurred adding data.", "error");
      },
    });
  });

  $(document).on("click", "#deletepastmaster", function () {
    let id = $(this).data("id");

    Swal.fire({
      title: "Are you sure?",
      text: "This will delete the record permanently.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../php/Deletepastmaster.php",
          type: "POST",
          data: { id: id },
          dataType: "json",
          success: function (response) {
            if (response.success) {
              Swal.fire("Deleted!", response.message, "success");
              loadmaster();
            } else {
              Swal.fire("Error", response.message, "info");
            }
          },
          error: function (xhr, status, error) {
            console.error("AJAX Error:", xhr.responseText);
            Swal.fire(
              "Error",
              "An error occurred deleting the record.",
              "error"
            );
          },
        });
      }
    });
  });

  $(document).on("click", "#editpastmaster", function () {
    let id = $(this).data("id");

    $.ajax({
      url: "../php/fetchpastmasterinfo.php",
      type: "POST",
      data: { id: id },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#dateedit").val(response.data.date);
          $("#nameedit").val(response.data.name);
          $("#idedit").val(response.data.id);
        } else {
          Swal.fire("Update", response.message, "info");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", xhr.responseText);
        Swal.fire("Error", "An error occurred deleting the record.", "error");
      },
    });
  });

  $("#editPastMasterForm").submit(function (e) {
    e.preventDefault();

    let formdata = new FormData(this);

    $.ajax({
      url: "../php/updatepastmaster.php",
      type: "POST",
      data: formdata,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
            confirmButtonText: "OK",
          }).then(() => {
            var modalEl = document.getElementById("editPastMasterModal");
            var modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) {
              modalInstance.hide();
            }
            loadmaster();
          });
        } else {
          Swal.fire({
            icon: "info",
            title: "Error",
            text: response.message,
            confirmButtonText: "OK",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", xhr.responseText);
        Swal.fire("Error", "An error occurred deleting the record.", "error");
      },
    });
  });
});
