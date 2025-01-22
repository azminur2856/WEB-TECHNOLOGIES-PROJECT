function searchAppointments() {
  const searchValue = document.getElementById("search").value;
  const searchStatus = document.getElementById("search_status");

  if (searchValue === "") {
    searchStatus.innerText = "";
    return;
  }

  const xhttp = new XMLHttpRequest();
  xhttp.open(
    "POST",
    "../../controller/admin_controller/search_appointments.php",
    true
  );
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("query=" + encodeURIComponent(searchValue));

  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      const response = JSON.parse(this.responseText);

      const farmerAppointments = document.getElementById(
        "farmer_appointments_table"
      );
      farmerAppointments.innerHTML = response.farmer_appointments;

      const advisorAppointments = document.getElementById(
        "advisor_appointments_table"
      );
      advisorAppointments.innerHTML = response.advisor_appointments;

      if (
        response.farmer_appointments.trim() !== "" ||
        response.advisor_appointments.trim() !== ""
      ) {
        searchStatus.innerText = "Matched";
        searchStatus.style.color = "green";
      } else {
        searchStatus.innerText = "Not Matched";
        searchStatus.style.color = "red";
      }
    }
  };
}
