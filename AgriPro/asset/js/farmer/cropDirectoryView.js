document.addEventListener("DOMContentLoaded", function () {
  // Function to fetch crop data using XMLHttpRequest
  function fetchCrops() {
    const xhttp = new XMLHttpRequest();
    xhttp.open(
      "GET",
      "../../controller/farmer_controller/cropDirectory.php?ajax=1",
      true
    );
    xhttp.send();

    xhttp.onreadystatechange = function () {
      if (xhttp.readyState === 4 && xhttp.status === 200) {
        const data = JSON.parse(xhttp.responseText);
        const cropTable = document.getElementById("cropTable");
        cropTable.innerHTML = ""; // Clear the table

        data.forEach((crop) => {
          const row = document.createElement("tr");
          const cell = document.createElement("td");
          const link = document.createElement("a");

          link.href = `../controller/cropDetail.php?id=${crop.id}`;
          link.textContent = crop.name;

          cell.appendChild(link);
          row.appendChild(cell);
          cropTable.appendChild(row);
        });
      }
    };
  }

  // Fetch crops when the page loads
  fetchCrops();

  // Example: Sending data using XMLHttpRequest
  function sendData(jsonData) {
    const xhttp = new XMLHttpRequest();
    xhttp.open(
      "POST",
      "../../controller/farmer_controller/submitCropData.php",
      true
    );
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("mydata=" + jsonData);

    xhttp.onreadystatechange = function () {
      if (xhttp.readyState === 4 && xhttp.status === 200) {
        console.log("Data sent successfully:", xhttp.responseText);
      }
    };
  }

  // Example usage of sendData (you can customize this based on your form or inputs)
  const exampleData = JSON.stringify({ key: "value" });
  sendData(exampleData); // Remove or modify as needed
});
