document.addEventListener("DOMContentLoaded", () => {
  // Fetch advisors via AJAX
  function loadAdvisors() {
    const xhttp = new XMLHttpRequest();
    xhttp.open(
      "POST",
      "../../controller/farmer_controller/paymentController.php",
      true
    );
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("action=getAdvisors");
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        const advisors = JSON.parse(this.responseText);
        const advisorSelect = document.getElementById("advisor_id");
        advisors.forEach((advisor) => {
          const option = document.createElement("option");
          option.value = advisor.id;
          option.textContent = advisor.username;
          advisorSelect.appendChild(option);
        });
      }
    };
  }

  // Validate and submit payment via AJAX
  document
    .getElementById("paymentForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      const amount = parseFloat(document.getElementById("amount").value);
      const paymentResponse = document.getElementById("paymentResponse");

      // Check if the amount is less than 100
      if (amount < 100) {
        paymentResponse.textContent =
          "Error: Payment amount must be at least 100.";
        paymentResponse.style.color = "red"; // Set error message color to red
        return;
      }

      const formData = new FormData(this);
      const xhttp = new XMLHttpRequest();
      xhttp.open(
        "POST",
        "../../controller/farmer_controller/paymentController.php",
        true
      );
      xhttp.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
      );
      xhttp.send(new URLSearchParams(formData).toString());
      xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
          const response = JSON.parse(this.responseText);
          if (response.success) {
            window.location.href = "payment_success.php";
          } else {
            paymentResponse.textContent = response.error;
            paymentResponse.style.color = "red"; // Set error message color to red
          }
        }
      };
    });

  // Load advisors on page load
  loadAdvisors();
});
