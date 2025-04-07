$(document).ready(function () {
  // Toggle dot menu
  $(document).on("click", ".dot", function (e) {
    e.stopPropagation(); // Prevent immediate close
    const $menu = $(this).siblings(".dot-menu");
    $(".dot-menu").not($menu).hide(); // Hide other menus
    $menu.toggle(); // Toggle this menu
  });

  // Close menu on outside click
  $(document).on("click", function () {
    $(".dot-menu").hide();
  });

  // Prevent click inside the menu from closing it
  $(document).on("click", ".dot-menu", function (e) {
    e.stopPropagation();
  });

  $(document).on("click", "#folderdelete", function () {
    var id = $(this).data("id");

    Swal.fire({
      title: "Are you sure?",
      text: "You won’t be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        // AJAX request to delete
        $.ajax({
          url: "../php/delete_folder.php",
          type: "POST",
          data: { id: id },
          success: function (response) {
            Swal.fire(
              "Deleted!",
              "Your folder has been deleted.",
              "success"
            ).then(() => {
              $.ajax({
                url: "../php/fetchfolderforadmin.php", // PHP script to fetch events
                type: "GET",
                success: function (response) {
                  $("#folders").html(response);
                },
                error: function () {
                  $("#folders").html("<p>Error loading events.</p>");
                },
              });
            });
          },
          error: function () {
            Swal.fire(
              "Error",
              "There was an issue deleting the folder.",
              "error"
            );
          },
        });
      }
    });
  });

  $(document).on("click", "#folderrename", function () {
    var folderId = $(this).data("id");

    Swal.fire({
      title: "Rename Folder",
      input: "text",
      inputLabel: "Enter new folder name",
      inputPlaceholder: "New folder name",
      showCancelButton: true,
      confirmButtonText: "Rename",
      preConfirm: (newName) => {
        if (!newName) {
          Swal.showValidationMessage("Folder name cannot be empty");
        }
        return newName;
      },
    }).then((result) => {
      if (result.isConfirmed) {
        const newFolderName = result.value;

        // Send AJAX to rename
        $.ajax({
          url: "../php/rename_folder.php",
          type: "POST",
          data: { id: folderId, foldername: newFolderName },
          success: function (response) {
            Swal.fire("Renamed!", "Folder has been renamed.", "success").then(
              () => {
                $.ajax({
                  url: "../php/fetchfolderforadmin.php", // PHP script to fetch events
                  type: "GET",
                  success: function (response) {
                    $("#folders").html(response);
                  },
                  error: function () {
                    $("#folders").html("<p>Error loading events.</p>");
                  },
                });
              }
            );
          },
          error: function () {
            Swal.fire("Error", "Unable to rename folder.", "error");
          },
        });
      }
    });
  });

  $.ajax({
    url: "../php/fetchfolderforadmin.php", // PHP script to fetch events
    type: "GET",
    success: function (response) {
      $("#folders").html(response);
    },
    error: function () {
      $("#folders").html("<p>Error loading events.</p>");
    },
  });
  $("#newfolder").click(function () {
    $.ajax({
      url: "../php/generateUniqueID.php",
      type: "GET",
      dataType: "json",
      success: function (response) {
        $("#folderId").val(response.unique_id);
      },
    });
  });
  $("#folderForm").submit(function (e) {
    e.preventDefault();

    $.ajax({
      url: "../php/add_folder.php",
      method: "POST",
      data: {
        folderId: $("#folderId").val(),
        folderName: $("#folderName").val(),
      },
      success: function (response) {
        if (response.trim() === "success") {
          Swal.fire({
            icon: "success",
            title: "Folder Added",
            text: "The folder was added successfully!",
            confirmButtonColor: "#3085d6",
          }).then(() => {
            $("#addFolderModal").modal("hide");
            $("#folderForm")[0].reset();
            $.ajax({
              url: "../php/fetchfolderforadmin.php", // PHP script to fetch events
              type: "GET",
              success: function (response) {
                $("#folders").html(response);
              },
              error: function () {
                $("#folders").html("<p>Error loading events.</p>");
              },
            });
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Failed",
            text: "Error saving the folder.",
            confirmButtonColor: "#d33",
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "AJAX Error",
          text: "An error occurred while submitting the form.",
          confirmButtonColor: "#d33",
        });
      },
    });
  });
});
