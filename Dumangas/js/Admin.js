$(document).ready(function () {
  $("#main").load("../Webpage/AdminHome.php");
  $("#Home").addClass("active");

  $("#Home").click(function () {
    $("#main").load("../Webpage/AdminHome.php");
    $("#Home").addClass("active");
    $("#Accounts").removeClass("active");
    $("#Calendar").removeClass("active");
  });

  $("#Accounts").click(function () {
    $("#main").load("../Webpage/AdminAccount.php");
    $("#Accounts").addClass("active");
    $("#Home").removeClass("active");
    $("#Calendar").removeClass("active");
  });

  $("#Calendar").click(function () {
    $("#main").load("../Webpage/AdminCalendar.php");
    $("#Calendar").addClass("active");
    $("#Accounts").removeClass("active");
    $("#Home").removeClass("active");
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
                <img src="${meeting.image}" alt="${meeting.title}" />
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
});
