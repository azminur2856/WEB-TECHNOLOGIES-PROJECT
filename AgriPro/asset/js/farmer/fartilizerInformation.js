document.getElementById("fertilizerForm").onsubmit = function (e) {
  e.preventDefault(); // Prevent form submission

  var landSize = document.getElementById("land_size").value;
  var cropType = document.getElementById("crop_type").value;

  // Prepare data as JSON
  var data = {
    land_size: landSize,
    crop_type: cropType,
  };

  // Convert data to URL-encoded query string
  var jsonData = JSON.stringify(data);

  // Create XMLHttpRequest
  var xhttp = new XMLHttpRequest();

  // Open the request
  xhttp.open(
    "POST",
    "../../controller/farmer_controller/FertilizerController.php",
    true
  );

  // Set content type to application/x-www-form-urlencoded
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // Send the request with the data
  xhttp.send("mydata=" + encodeURIComponent(jsonData));

  // Handle the response
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      var response = JSON.parse(this.responseText);

      if (response.status === "success") {
        // Display fertilizer requirements
        var resultHTML = "<h3>Fertilizer Requirements:</h3>";
        resultHTML += "<ul>";
        resultHTML += "<li>Nitrogen (N): " + response.N + " kg</li>";
        resultHTML += "<li>Phosphate (P2O5): " + response.P2O5 + " kg</li>";
        resultHTML += "<li>Potash (K2O): " + response.K2O + " kg</li>";
        resultHTML += "</ul>";

        document.getElementById("results").innerHTML = resultHTML;
      } else {
        // Display error message
        document.getElementById("results").innerHTML =
          "<p style='color:red;'>" + response.message + "</p>";
      }
    }
  };
};
