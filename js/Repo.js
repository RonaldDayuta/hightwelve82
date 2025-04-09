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

  $(document).on("click", ".openfolder", function () {
    var name = $(this).data("name");
    var id = $(this).data("id");
    $("#main").load("../Webpage/AdminRepoInside.php", function () {
      $("#insidefoldername").text(name);
      $("#openupload").click(function () {
        $("#folderid").val(id);
        $.ajax({
          url: "../php/generateUniqueID.php",
          type: "GET",
          dataType: "json",
          success: function (response) {
            $("#fileid").val(response.unique_id);
          },
        });
      });
      $.ajax({
        url: "../php/fetchfileinsidefolder.php", // PHP script to fetch events
        type: "GET",
        data: { id: id },
        success: function (response) {
          $("#tfiles").html(response);
        },
        error: function () {
          $("#tfiles").html("<p>Error loading events.</p>");
        },
      });
      $("#uploadFormPDF").on("submit", function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
          url: "../php/upload.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: function () {
            Swal.fire({
              title: "Uploading...",
              text: "Please wait while we upload your file.",
              didOpen: () => {
                Swal.showLoading();
              },
              allowOutsideClick: false,
              allowEscapeKey: false,
              showConfirmButton: false,
            });
          },
          success: function (response) {
            Swal.close(); // Close loading

            if (response.toLowerCase().includes("success")) {
              Swal.fire({
                icon: "success",
                title: "Uploaded!",
                text: response,
              });
              $("#uploadFormPDF")[0].reset();
              $("#uploadModal").modal("hide");
              $.ajax({
                url: "../php/fetchfileinsidefolder.php",
                type: "GET",
                data: { id: id },
                success: function (response) {
                  $("#tfiles").html(response);
                },
                error: function () {
                  $("#tfiles").html("<p>Error loading events.</p>");
                },
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Upload Failed",
                text: response,
              });
            }
          },
          error: function () {
            Swal.close();
            Swal.fire({
              icon: "error",
              title: "Server Error",
              text: "An error occurred while uploading.",
            });
          },
        });
      });
    });

    $(document).on("click", "#downloadpdffile", function (e) {
      e.preventDefault();
      // Get the value from the input field
      var Id = $(this).data("id");

      // Validate that the input is not empty
      if (Id) {
        // Create the URL with the project ID
        var url = "../php/Downloadpdffile.php?id=" + Id; // PHP script to handle download

        // Open the file download in the same tab
        window.open(url, "_self"); // Use '_self' to download in the same tab
      } else {
        alert("Please enter a valid Project ID.");
      }
    });

    $(document).on("click", "#deletepdffile", function () {
      var fileid = $(this).data("id");

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
            url: "../php/delete_pdf.php",
            type: "POST",
            data: { fileid: fileid },
            success: function (response) {
              Swal.fire(
                "Deleted!",
                "Your File has been deleted.",
                "success"
              ).then(() => {
                $.ajax({
                  url: "../php/fetchfileinsidefolder.php", // PHP script to fetch events
                  type: "GET",
                  data: { id: id },
                  success: function (response) {
                    $("#tfiles").html(response);
                  },
                  error: function () {
                    $("#tfiles").html("<p>Error loading events.</p>");
                  },
                });
              });
            },
            error: function () {
              Swal.fire(
                "Error",
                "There was an issue deleting the File.",
                "error"
              );
            },
          });
        }
      });
    });

    $(document).on("click", "#viewpdffile", function () {
      const file = $(this).data("file");
      const previewFrame = $("#previewFrame");
      const modal = $("#previewModal");

      previewFrame.attr("src", file); // Adjust path if needed
      modal.css("display", "flex");
    });

    $(document).on("click", "#close-btn-preview", function () {
      $("#previewModal").hide();
      $("#previewFrame").attr("src", ""); // Reset
    });
  });

  $("#backbuttoninside").click(function () {
    $("#main").load("../Webpage/AdminRepo.php");
  });

  // Modify fetchFolders to fetch folders on pressing Enter
  function fetchFolders(searchQuery = "") {
    let url = searchQuery
      ? "../php/SearchFolder.php"
      : "../php/FolderTable.php";

    $.ajax({
      url: url,
      type: "GET",
      data: searchQuery ? { search: searchQuery } : {},
      success: function (data) {
        $("#folders").html(data);
      },
      error: function (xhr, status, error) {
        console.error("Error fetching folders:", error);
        console.log("Server response:", xhr.responseText);
      },
    });
  }

  // Fetch folders on page load
  fetchFolders();

  // Trigger search on Enter key press
  $("#search-folder").on("keydown", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();  // Prevent form submission
      let searchQuery = $(this).val().trim();
      console.log(searchQuery);
      fetchFolders(searchQuery);
    }
  });

  $("#search-file").on("keyup", function (e) {
    if (e.key === "Enter") {
      const searchQuery = $(this).val().trim();
      const folderId = $("#folderid").val(); // make sure this exists and is set
  
      $.ajax({
        url: "../php/SearchFile.php",
        type: "GET",
        data: { search: searchQuery, folderid: folderId },
        success: function (data) {
          $("#tfiles").html(data);
        },
        error: function (xhr, status, error) {
          console.error("Error searching files:", error);
          console.log("Response:", xhr.responseText);
        },
      });
    }
  });  
});
