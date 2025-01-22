const timeField = document.getElementById("appointment_time");
const dateField = document.getElementById("appointment_date");
const responseMessage = document.getElementById("response-message");

function validateTime(timeValue) {
  const timeParts = timeValue.split(":");
  const validationMessage = timeField.nextElementSibling;

  if (
    timeParts.length !== 2 ||
    isNaN(timeParts[0]) ||
    isNaN(timeParts[1]) ||
    Number(timeParts[0]) < 0 ||
    Number(timeParts[0]) > 23 ||
    Number(timeParts[1]) < 0 ||
    Number(timeParts[1]) > 59
  ) {
    validationMessage.innerText = "Select a valid time";
    validationMessage.style.color = "red";
    return false;
  } else {
    validationMessage.innerText = "Valid";
    validationMessage.style.color = "green";
    return true;
  }
}

function validateDate(dateValue) {
  const validationMessage = dateField.nextElementSibling;

  if (dateValue === "" || new Date(dateValue) < new Date()) {
    validationMessage.innerText = "Select a valid future date";
    validationMessage.style.color = "red";
    return false;
  } else {
    validationMessage.innerText = "Valid";
    validationMessage.style.color = "green";
    return true;
  }
}

timeField.addEventListener("input", function () {
  validateTime(timeField.value);
});

dateField.addEventListener("input", function () {
  validateDate(dateField.value);
});

document
  .getElementById("submit-reschedule")
  .addEventListener("click", function () {
    const appointmentId = document.getElementById("appointment_id").value;
    const appointmentDate = dateField.value;
    const appointmentTime = timeField.value;

    const isDateValid = validateDate(appointmentDate);
    const isTimeValid = validateTime(appointmentTime);

    if (!isDateValid || !isTimeValid) {
      responseMessage.textContent = "Please correct the highlighted errors.";
      return;
    }

    const data = {
      appointment_id: appointmentId,
      appointment_date: appointmentDate,
      appointment_time: appointmentTime,
    };

    const xhttp = new XMLHttpRequest();
    xhttp.open(
      "POST",
      "../../controller/advisor_controller/rescheduleAppointmentCheck.php",
      true
    );
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4) {
        if (this.status === 200) {
          const response = JSON.parse(this.responseText);

          if (response.status === "success") {
            alert("Reschedule appointment successful");
            window.location.href = "manageAppoinment.php";
          } else {
            responseMessage.textContent = response.message;
            responseMessage.style.color = "red";
          }
        } else {
          responseMessage.textContent = "An error occurred. Please try again.";
        }
      }
    };

    xhttp.send(JSON.stringify(data));
  });
