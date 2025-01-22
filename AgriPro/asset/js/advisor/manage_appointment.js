function handleRequest(appointment_id, action) {
  const xhttp = new XMLHttpRequest();
  xhttp.open(
    "POST",
    "../../controller/advisor_controller/appointmentActions.php",
    true
  );
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      const response = JSON.parse(this.responseText);
      if (response.status === "success") {
        if (action === "cancel") {
          document.getElementById("appointment-" + appointment_id).remove();
        } else if (action === "reschedule") {
          window.location.href = "rescheduleAppointment.php";
        }
      } else {
        alert("Error: " + response.message);
      }
    }
  };

  xhttp.send("appointment_id=" + appointment_id + "&action=" + action);
}

document.querySelectorAll(".reschedule-btn").forEach((button) => {
  button.addEventListener("click", function () {
    const appointment_id = this.getAttribute("data-id");
    handleRequest(appointment_id, "reschedule");
  });
});

document.querySelectorAll(".cancel-btn").forEach((button) => {
  button.addEventListener("click", function () {
    const appointment_id = this.getAttribute("data-id");
    handleRequest(appointment_id, "cancel");
  });
});
