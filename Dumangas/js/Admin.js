$(document).ready(function () {
  $("#main").load("../Webpage/AdminHome.php");
  $("#Home").addClass("active");

  $("#Home").click(function () {
    $("#main").load("../Webpage/AdminHome.php");
    $("#Home").addClass("active");
    $("#Accounts").removeClass("active");
    $("#Calendar").removeClass("active");
    $("#Officers").removeClass("active");
  });

  $("#Accounts").click(function () {
    $("#main").load("../Webpage/AdminAccount.php");
    $("#Accounts").addClass("active");
    $("#Home").removeClass("active");
    $("#Calendar").removeClass("active");
    $("#Officers").removeClass("active");
  });

  $("#Calendar").click(function () {
    $("#main").load("../Webpage/AdminCalendar.php");
    $("#Calendar").addClass("active");
    $("#Accounts").removeClass("active");
    $("#Home").removeClass("active");
    $("#Officers").removeClass("active");
  });

  $("#Officers").click(function () {
    $("#main").load("../Webpage/Adminofficers.php");
    $("#Officers").addClass("active");
    $("#Calendar").removeClass("active");
    $("#Accounts").removeClass("active");
    $("#Home").removeClass("active");
  });

  $("#Officers").click(function () {
    $("#main").load("../Webpage/Adminofficers.php");
    $("#Officers").addClass("active");
    $("#Calendar").removeClass("active");
    $("#Accounts").removeClass("active");
    $("#Home").removeClass("active");
  });

  $("#eventdrop").click(function () {
    $("#eventdrop").addClass("actives");
    $("#newsdrop").removeClass("actives");
    $("#meetdrop").removeClass("actives");
    $("#actdrop").removeClass("actives");
    $("#eventnav").addClass("active");
  });

  $("#newsdrop").click(function () {
    $("#newsdrop").addClass("actives");
    $("#eventdrop").removeClass("actives");
    $("#meetdrop").removeClass("actives");
    $("#actdrop").removeClass("actives");
    $("#eventnav").addClass("active");
  });

  $("#meetdrop").click(function () {
    $("#meetdrop").addClass("actives");
    $("#newsdrop").removeClass("actives");
    $("#eventdrop").removeClass("actives");
    $("#actdrop").removeClass("actives");
    $("#eventnav").addClass("active");
  });

  $("#actdrop").click(function () {
    $("#actdrop").addClass("actives");
    $("#meetdrop").removeClass("actives");
    $("#newsdrop").removeClass("actives");
    $("#eventdrop").removeClass("actives");
    $("#eventnav").addClass("active");
  });

  $.ajax({
    url: "../php/fetchnewsforadmin.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      $("#news_h3").text(data.title);
      $("#news_span").text(data.event_date);
      $("#news_p").text(data.description);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching event:", error);
    },
  });

  $.ajax({
    url: "../php/fetcheventforadmin.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      $("#event_h3").text(data.title);
      $("#event_span").text(data.event_date);
      $("#event_p").text(data.description);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching event:", error);
    },
  });

  $.ajax({
    url: "../php/fetchmeetingforadmin.php", // Adjust path
    type: "GET",
    dataType: "json",
    success: function (data) {
      if (data.length > 0) {
        let meetingsHTML = "";
        data.forEach(function (meeting) {
          meetingsHTML += `
            <div class="meetingalign">
              <div class="meetinginfo">
                <img src="${meeting.image}" />
                <div class="information">
                  <span>${meeting.title}</span>
                  <span>${meeting.event_date}</span>
                  <p>${meeting.description}</p>
                </div>
              </div>
            </div>
          `;
        });

        $("#meeting-cards").html(meetingsHTML); // Append meetings
      } else {
        $("#meeting-cards").html("<p>No meetings available.</p>");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching meetings:", error);
      console.log("Server Response:", xhr.responseText);
    },
  });

  $.ajax({
    url: "../php/Membertableforadmin.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      if (data.length > 0) {
        let membersHTML = "";
        data.forEach(function (members) {
          membersHTML += `
            <li>
              <img src="${members.Profile}" alt="" />
              <span>${members.Username}</span>
            </li>
          `;
        });

        $("#members").html(membersHTML);
      } else {
        $("#members").html("<p>No members available.</p>");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching members:", error);
      console.log("Server Response:", xhr.responseText);
    },
  });

  $("#updateAccountForm").submit(function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let buttonText = $("#edit-button-text");
    let spinner = $("#edit-spinner");
    let submitButton = $("#updateAccountForm button[type='submit']");

    // Disable button & show loading spinner
    submitButton.prop("disabled", true);
    buttonText.hide();
    spinner.show();

    $.ajax({
      url: "../php/manageaccount.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (data) {
        if (data.success) {
          Swal.fire({
            title: "Update Successful!",
            text: data.message,
            icon: "info",
            confirmButtonText: "OK",
            allowOutsideClick: false,
          }).then(() => {
            window.location.href = "../php/logout.php"; // Redirect to logout to refresh session
          });
        } else {
          Swal.fire({
            title: "Update Failed",
            text: data.message,
            icon: "error",
            confirmButtonText: "Try Again",
          });
        }
      },
      error: function () {
        Swal.fire({
          title: "Error",
          text: "Something went wrong. Please try again later.",
          icon: "error",
          confirmButtonText: "OK",
        });
      },
      complete: function () {
        // Re-enable button & hide spinner
        submitButton.prop("disabled", false);
        buttonText.show();
        spinner.hide();
      },
    });
  });
});
