$(document).ready(function () {
  $("#main").load("../Webpage/UserHome.php");
  $("#Home").addClass("active");

  $("#Home").click(function () {
    $("#main").load("../Webpage/UserHome.php");
    $("#Home").addClass("active");
    $("#Accounts").removeClass("active");
    $("#Calendar").removeClass("active");
    $("#Officers").removeClass("active");
    $("#eventnav").removeClass("active");
    $("#eventdrop").removeClass("actives");
    $("#newsdrop").removeClass("actives");
    $("#meetdrop").removeClass("actives");
    $("#actdrop").removeClass("actives");
  });

  $("#eventdrop").click(function () {
    $("#main").load("../Webpage/UserEvent.php");
    $("#eventdrop").addClass("actives");
    $("#newsdrop").removeClass("actives");
    $("#meetdrop").removeClass("actives");
    $("#actdrop").removeClass("actives");
    $("#eventnav").addClass("active");
    $("#Officers").removeClass("active");
    $("#Calendar").removeClass("active");
    $("#Accounts").removeClass("active");
    $("#Home").removeClass("active");
  });

  $("#newsdrop").click(function () {
    $("#main").load("../Webpage/UserNews.php");
    $("#newsdrop").addClass("actives");
    $("#eventdrop").removeClass("actives");
    $("#meetdrop").removeClass("actives");
    $("#actdrop").removeClass("actives");
    $("#eventnav").addClass("active");
    $("#Officers").removeClass("active");
    $("#Calendar").removeClass("active");
    $("#Accounts").removeClass("active");
    $("#Home").removeClass("active");
  });

  $("#meetdrop").click(function () {
    $("#main").load("../Webpage/UserMeeting.php");
    $("#meetdrop").addClass("actives");
    $("#newsdrop").removeClass("actives");
    $("#eventdrop").removeClass("actives");
    $("#actdrop").removeClass("actives");
    $("#eventnav").addClass("active");
    $("#Officers").removeClass("active");
    $("#Calendar").removeClass("active");
    $("#Accounts").removeClass("active");
    $("#Home").removeClass("active");
  });

  $("#actdrop").click(function () {
    $("#main").load("../Webpage/UserAct.php");
    $("#actdrop").addClass("actives");
    $("#meetdrop").removeClass("actives");
    $("#newsdrop").removeClass("actives");
    $("#eventdrop").removeClass("actives");
    $("#eventnav").addClass("active");
    $("#Officers").removeClass("active");
    $("#Calendar").removeClass("active");
    $("#Accounts").removeClass("active");
    $("#Home").removeClass("active");
  });

  $.ajax({
    url: "../php/fetchnewsforadmin.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let newsList = "";

      if (Array.isArray(data) && data.length > 0) {
        data.forEach(news => {
          let fullText = news.description.replace(/\n/g, "<br>");
          let shortText = fullText.length > 100 ? fullText.substring(0, 100) + "..." : fullText;
          newsList += `
                    <div class="event-information">
                        <h3>${news.title}</h3>
                        <span>${news.event_date}</span>
                        <p class="news-description" data-full="${fullText}">
                            ${shortText}
                            ${fullText.length > 100 ? '<br><span class="see-more1" style="cursor: pointer; color: #6c9bcf;">See More</span>' : ''}
                        </p>
                    </div>
                    <hr/>
                `;
        });
      } else {
        newsList = `
                <div class="event-information">
                    <h3>No News</h3>
                    <p>No Latest available.</p>
                </div>
            `;
      }
      $(".cards-events:eq(0)").html(`
            <h3>Latest News</h3>
            ${newsList}
        `); // **Replaces the entire events section**
    },
    error: function (xhr, status, error) {
      console.error("Error fetching events:", error);
    },
  });

  // Attach the "See More / See Less" click event
  $(document).on("click", ".see-more1", function () {
    let parent = $(this).closest(".news-description");
    let fullText = parent.data("full");

    if ($(this).text() === "See More") {
      parent.html(fullText + '<br><span class="see-more1" style="cursor: pointer; color: #6c9bcf;">See Less</span>');
    } else {
      let shortText = fullText.substring(0, 100) + "...";
      parent.html(shortText + '<br><span class="see-more1" style="cursor: pointer; color: #6c9bcf;">See More</span>');
    }
  });

  $.ajax({
    url: "../php/fetcheventforadmin.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let eventList = "";

      if (Array.isArray(data) && data.length > 0) {
        data.forEach((event) => {
          let fullText = event.description.replace(/\n/g, "<br>");
          let shortText = fullText.length > 100 ? fullText.substring(0, 100) + "..." : fullText;

          eventList += `
                    <div class="event-information">
                        <h3>${event.title}</h3>
                        <span>${event.event_date}</span>
                        <p class="event-description" data-full="${fullText}">
                            ${shortText}
                            ${fullText.length > 100 ? '<br><span class="see-more2" style="cursor: pointer; color: #6c9bcf;">See More</span>' : ''}
                        </p>
                    </div>
                    <hr />
                `;
        });
      } else {
        eventList = `
                <div class="event-information">
                    <h3>No Events</h3>
                    <p>No events available.</p>
                </div>
            `;
      }

      $(".cards-events:eq(1)").html(`
            <h3>Latest Events</h3>
            ${eventList}
        `);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching events:", error);
    },
  });

  // Attach the "See More / See Less" click event
  $(document).on("click", ".see-more2", function () {
    let parent = $(this).closest(".event-description");
    let fullText = parent.data("full");

    if ($(this).text() === "See More") {
      parent.html(fullText + '<br><span class="see-more2" style="cursor: pointer; color: #6c9bcf;">See Less</span>');
    } else {
      let shortText = fullText.substring(0, 100) + "...";
      parent.html(shortText + '<br><span class="see-more2" style="cursor: pointer; color: #6c9bcf;">See More</span>');
    }
  });

  $.ajax({
    url: "../php/fetchmeetingforadmin.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let meetingsList = "";

      if (Array.isArray(data) && data.length > 0) {
        data.forEach(meeting => {
          let fullText = meeting.description.replace(/\n/g, "<br>");
          let shortText = fullText.length > 100 ? fullText.substring(0, 100) + "..." : fullText;

          meetingsList += `
                    <div class="meetingalign">
                        <div class="meetinginfo">
                            <img src="${meeting.image}" alt="Meeting Image" />
                            <div class="information">
                                <span>${meeting.title}</span>
                                <span>${meeting.event_date}</span>
                                <p class="meeting-description" data-full="${fullText}" data-short="${shortText}">
                                    ${shortText}
                                    ${fullText.length > 100 ? '<br><span class="see-more3" style="cursor: pointer; color: #6c9bcf;">See More</span>' : ''}
                                </p>
                            </div>
                            <hr/>
                        </div>
                    </div>
                `;
        });
      } else {
        meetingsList = `
                <div class="meetingalign">
                    <h3>No Meetings</h3>
                    <p>No meetings available.</p>
                </div>
            `;
      }

      $("#meeting-cards").html(meetingsList);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching meetings:", error);
    },
  });

  // "See More / See Less" functionality
  $(document).on("click", ".see-more3", function () {
    let parent = $(this).closest(".meeting-description");
    let fullText = parent.data("full");
    let shortText = parent.data("short");

    if ($(this).text() === "See More") {
      parent.html(fullText + '<br><span class="see-more3" style="cursor: pointer; color: #6c9bcf;">See Less</span>');
    } else {
      parent.html(shortText + '<br><span class="see-more3" style="cursor: pointer; color: #6c9bcf;">See More</span>');
    }
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
            window.location.href = "../php/userlogout.php"; // Redirect to logout to refresh session
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

  function fetchMembers(searchQuery = "") {
    let url = searchQuery
      ? "../php/SearchMember.php"
      : "../php/Membertableforadmin.php";

    $.ajax({
      url: url,
      type: "GET",
      data: searchQuery ? { search: searchQuery } : {}, // Only send search query if it exists
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
  }

  // Fetch all members on page load
  fetchMembers();

  // Search functionality
  $("#search-member").on("keyup", function () {
    let searchQuery = $(this).val().trim();
    fetchMembers(searchQuery);
  });
});
