$(document).ready(function () {
  $.ajax({
    url: "../php/fetchofficerinfoforindex.php",
    type: "GET",
    dataType: "json",
    success: function (response) {
      let officersHtml = "";

      $.each(response, function (index, officer) {
        officersHtml += `
                    <div class="officers-card">
                        <img src="${officer.image}" alt="Officer Image" />
                        <div class="text-overlay">
                            <h2>${officer.name}</h2>
                            <h3>${officer.position}</h3>
                        </div>
                    </div>
                `;
      });

      $("#officers").html(officersHtml);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching officers:", error);
    },
  });
});
