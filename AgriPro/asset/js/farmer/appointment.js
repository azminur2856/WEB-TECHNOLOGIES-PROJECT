document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("appointmentForm");
  const submitBtn = document.getElementById("submitBtn");
  const messageDiv = document.getElementById("message");

  const advisorField = document.getElementById("advisor");
  const phoneField = document.getElementById("phone");
  const dateField = document.getElementById("date");
  const timeField = document.getElementById("time");
  const serviceField = document.getElementById("service");
  const detailsField = document.getElementById("details");

  function validateAdvisor(advisorValue) {
    if (advisorValue === "") {
      advisorField.nextElementSibling.innerText =
        "Advisor selection is required!";
      advisorField.nextElementSibling.style.color = "red";
      return false;
    } else {
      advisorField.nextElementSibling.innerText = "Valid";
      advisorField.nextElementSibling.style.color = "green";
      return true;
    }
  }

  function validatePhone(phoneValue) {
    let isValid = true;

    if (phoneValue.length !== 11) {
      isValid = false;
    }

    if (phoneValue[0] !== "0" || phoneValue[1] !== "1") {
      isValid = false;
    }

    for (let i = 0; i < phoneValue.length; i++) {
      if (phoneValue[i] < "0" || phoneValue[i] > "9") {
        isValid = false;
        break;
      }
    }

    if (!isValid) {
      phoneField.nextElementSibling.innerText =
        "Input 11 digit, where first two digits will start with 0 and 1";
      phoneField.nextElementSibling.style.color = "red";
    } else {
      phoneField.nextElementSibling.innerText = "Valid";
      phoneField.nextElementSibling.style.color = "green";
    }

    return isValid;
  }

  function validateDate(dateValue) {
    const today = new Date().toISOString().split("T")[0];
    if (dateValue === "" || dateValue < today) {
      dateField.nextElementSibling.innerText =
        "Select a date; you cannot select a previous date.";
      dateField.nextElementSibling.style.color = "red";
      return false;
    } else {
      dateField.nextElementSibling.innerText = "Valid";
      dateField.nextElementSibling.style.color = "green";
      return true;
    }
  }

  function validateTime(timeValue) {
    const timeParts = timeValue.split(":");
    if (
      timeParts.length !== 2 ||
      isNaN(timeParts[0]) ||
      isNaN(timeParts[1]) ||
      Number(timeParts[0]) < 0 ||
      Number(timeParts[0]) > 23 ||
      Number(timeParts[1]) < 0 ||
      Number(timeParts[1]) > 59
    ) {
      timeField.nextElementSibling.innerText = "Select time";
      timeField.nextElementSibling.style.color = "red";
      return false;
    } else {
      timeField.nextElementSibling.innerText = "Valid";
      timeField.nextElementSibling.style.color = "green";
      return true;
    }
  }

  function validateService(serviceValue) {
    if (serviceValue === "") {
      serviceField.nextElementSibling.innerText = "Please select a service";
      serviceField.nextElementSibling.style.color = "red";
      return false;
    } else {
      serviceField.nextElementSibling.innerText = "Valid";
      serviceField.nextElementSibling.style.color = "green";
      return true;
    }
  }

  function validateDetails(detailsValue) {
    if (detailsValue.trim() === "") {
      detailsField.nextElementSibling.innerText =
        "Please fill out the details box";
      detailsField.nextElementSibling.style.color = "red";
      return false;
    } else {
      detailsField.nextElementSibling.innerText = "Valid";
      detailsField.nextElementSibling.style.color = "green";
      return true;
    }
  }

  advisorField.addEventListener("input", function () {
    validateAdvisor(advisorField.value);
  });
  phoneField.addEventListener("input", function () {
    validatePhone(phoneField.value);
  });
  dateField.addEventListener("input", function () {
    validateDate(dateField.value);
  });
  timeField.addEventListener("input", function () {
    validateTime(timeField.value);
  });
  serviceField.addEventListener("input", function () {
    validateService(serviceField.value);
  });
  detailsField.addEventListener("input", function () {
    validateDetails(detailsField.value);
  });

  submitBtn.addEventListener("click", function (e) {
    e.preventDefault();

    const advisorValid = validateAdvisor(advisorField.value);
    const phoneValid = validatePhone(phoneField.value);
    const dateValid = validateDate(dateField.value);
    const timeValid = validateTime(timeField.value);
    const serviceValid = validateService(serviceField.value);
    const detailsValid = validateDetails(detailsField.value);

    if (
      advisorValid &&
      phoneValid &&
      dateValid &&
      timeValid &&
      serviceValid &&
      detailsValid
    ) {
      const formData = new FormData(form);
      const xhttp = new XMLHttpRequest();
      xhttp.open(
        "POST",
        "../../controller/farmer_controller/appointmentCheck.php",
        true
      );

      xhttp.onload = function () {
        const response = JSON.parse(this.responseText);
        messageDiv.innerHTML = "";

        if (response.status === "error") {
          response.messages.forEach((error) => {
            const p = document.createElement("p");
            p.style.color = "red";
            p.textContent = error;
            messageDiv.appendChild(p);
          });
        } else if (response.status === "success") {
          alert("Appointment Successful!");
          window.location.href = "takeAppoinment.php";
        }
      };

      xhttp.send(formData);
    } else {
      messageDiv.innerHTML =
        '<p style="color: red;">Please correct the errors above.</p>';
    }
  });
});
