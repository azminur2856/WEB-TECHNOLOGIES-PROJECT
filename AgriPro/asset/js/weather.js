window.onload = function () {
  getGeoLocation();
};

function getGeoLocation() {
  if (navigator.permissions) {
    navigator.permissions
      .query({ name: "geolocation" })
      .then(function (result) {
        if (result.state === "granted") {
          navigator.geolocation.getCurrentPosition(function (position) {
            let latitude = position.coords.latitude;
            let longitude = position.coords.longitude;
            showLoadingMessage();
            sendGeoReceiveWeather(latitude, longitude);
          });
        } else if (result.state === "prompt") {
          navigator.geolocation.getCurrentPosition(
            function (position) {
              let latitude = position.coords.latitude;
              let longitude = position.coords.longitude;
              showLoadingMessage();
              sendGeoReceiveWeather(latitude, longitude);
            },
            function () {
              displayNoPermissionMessage();
            }
          );
        } else {
          displayNoPermissionMessage();
        }
      });
  } else if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;
        showLoadingMessage();
        sendGeoReceiveWeather(latitude, longitude);
      },
      function () {
        displayNoPermissionMessage();
      }
    );
  } else {
    displayNoPermissionMessage();
  }
}

function sendGeoReceiveWeather(latitude, longitude) {
  let json = { latitude: latitude, longitude: longitude };
  let data = JSON.stringify(json);

  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../controller/weather_data.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("mydata=" + data);

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      tableCreate(response);
    }
  };
}

function showLoadingMessage() {
  let weatherTable = document.getElementById("weather");
  weatherTable.innerHTML = `
      <tr>
        <th>Time</th>
        <th>Temperature (&deg;C)</th>
        <th>Humidity (%)</th>
        <th>Wind Speed (m/s)</th>
      </tr>
      <tr>
        <td colspan="4" align="center">Loading weather data...</td>
      </tr>
    `;
}

function displayNoPermissionMessage() {
  let weatherTable = document.getElementById("weather");
  weatherTable.innerHTML = `
      <tr>
        <th>Time</th>
        <th>Temperature (&deg;C)</th>
        <th>Humidity (%)</th>
        <th>Wind Speed (m/s)</th>
      </tr>
      <tr>
        <td colspan="4" align="center">Need location permission for weather data.</td>
      </tr>
    `;
}

function applyRowStyles() {
  const rows = document.querySelectorAll(".even-row");
  rows.forEach((row) => {
    row.style.backgroundColor = "whitesmoke";
  });
}

function tableCreate(weatherData) {
  let weatherTable = document.getElementById("weather");

  weatherTable.innerHTML = `
        <tr>
          <th>Index</th>
          <th>Time</th>
          <th>Temperature (&deg;C)</th>
          <th>Humidity (%)</th>
          <th>Wind Speed (m/s)</th>
        </tr>
      `;

  if (weatherData && weatherData.hourlyTimes) {
    weatherData.hourlyTimes.forEach((time, index) => {
      let row = document.createElement("tr");
      if (index % 2 === 1) row.classList.add("even-row");

      row.innerHTML = `
          <td>${index + 1}</td>
          <td>${time}</td>
          <td>${weatherData.hourlyTemperatures[index] ?? "N/A"}</td>
          <td>${weatherData.hourlyHumidity[index] ?? "N/A"}</td>
          <td>${weatherData.hourlyWindSpeeds[index] ?? "N/A"}</td>
        `;
      weatherTable.appendChild(row);
    });
  } else {
    let row = document.createElement("tr");
    let cell = document.createElement("td");
    cell.colSpan = 5;
    cell.textContent = "No data available";
    cell.style.textAlign = "center";
    row.appendChild(cell);
    weatherTable.appendChild(row);
  }
  applyRowStyles();
}
