function fetchFarmerAppointments() {
  const farmerId = document.getElementById("farmer_id").value;
  const jsonData = JSON.stringify({ farmer_id: farmerId });

  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "viewAppointment.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("mydata=" + jsonData);

  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      const response = JSON.parse(this.responseText);

      if (response.status === "success") {
        const appointments = response.appointments;
        const tableBody = document.getElementById("appointments-list");

        if (appointments.length === 0) {
          tableBody.innerHTML =
            '<tr><td colspan="6">No confirmed appointments found.</td></tr>';
        } else {
          tableBody.innerHTML = appointments
            .map(
              (appointment) => `
                        <tr>
                            <td>${appointment.advisor_name}</td>
                            <td>${appointment.phone_number}</td>
                            <td>${appointment.appointment_date}</td>
                            <td>${appointment.appointment_time}</td>
                            <td>${appointment.service}</td>
                            <td>${appointment.details}</td>
                        </tr>
                    `
            )
            .join("");
        }
      } else {
        alert("Error: " + response.message);
      }
    }
  };
}

document.addEventListener("DOMContentLoaded", fetchFarmerAppointments);
