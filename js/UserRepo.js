$(document).ready(function () {
  $.ajax({
    url: "../php/fetchfolderforuser.php", // PHP script to fetch events
    type: "GET",
    success: function (response) {
      $("#folders").html(response);
    },
    error: function () {
      $("#folders").html("<p>Error loading folders.</p>");
    },
  });
  $(document).on("click", ".openfolder", function () {
    var name = $(this).data("name");
    var id = $(this).data("id");
    $("#main").load("../Webpage/UserRepoInside.php", function () {
      $("#insidefoldername").text(name);
      $.ajax({
        url: "../php/fetchfileinsidefolderuser.php", // PHP script to fetch events
        type: "GET",
        data: { id: id },
        success: function (response) {
          $("#tfiles").html(response);
        },
        error: function () {
          $("#tfiles").html("<p>Error loading events.</p>");
        },
      });
      $("#search-file").on("keyup", function () {
        let searchText = $(this).val().trim(); // Get the input value and trim spaces

        if (searchText !== "") {
          $.ajax({
            url: "../php/SearchFileuser.php",
            type: "POST",
            data: { search: searchText }, // Use "search" to handle both date & title
            beforeSend: function () {
              $("#tfiles").html("<p>Loading...</p>"); // Show loading text
            },
            success: function (response) {
              $("#tfiles").html(response);
            },
            error: function (xhr, status, error) {
              console.error("AJAX Error: " + error);
              $("#tfiles").html("<p>Error fetching file.</p>");
            },
          });
        } else {
          $.ajax({
            url: "../php/fetchfileinsidefolderuser.php", // PHP script to fetch events
            type: "GET",
            data: { id: id },
            success: function (response) {
              $("#tfiles").html(response);
            },
            error: function () {
              $("#tfiles").html("<p>Error loading file.</p>");
            },
          });
        }
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
    $("#main").load("../Webpage/UserRepo.php");
  });

  $("#search-folder").on("keyup", function () {
    let searchText = $(this).val().trim(); // Get the input value and trim spaces

    if (searchText !== "") {
      $.ajax({
        url: "../php/SearchFolderuser.php",
        type: "POST",
        data: { search: searchText }, // Use "search" to handle both date & title
        beforeSend: function () {
          $("#folders").html("<p>Loading...</p>"); // Show loading text
        },
        success: function (response) {
          $("#folders").html(response);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error: " + error);
          $("#folders").html("<p>Error fetching folders.</p>");
        },
      });
    } else {
      $.ajax({
        url: "../php/fetchfolderforuser.php", // PHP script to fetch events
        type: "GET",
        success: function (response) {
          $("#folders").html(response);
        },
        error: function () {
          $("#folders").html("<p>Error loading folders.</p>");
        },
      });
    }
  });
});
