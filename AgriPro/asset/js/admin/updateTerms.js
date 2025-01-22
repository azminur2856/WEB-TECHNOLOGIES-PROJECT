document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("updateTermsForm");
  const termsText = document.getElementById("termsText");
  const updateMessageDiv = document.getElementById("updateMessage");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    fetch("../../controller/admin_controller/termsController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({ action: "update", terms: termsText.value }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          updateMessageDiv.innerHTML = `<p style="color:green;">${data.message}</p>`;
        } else {
          updateMessageDiv.innerHTML = `<p style="color:red;">${data.message}</p>`;
        }
      })
      .catch((error) => {
        console.error("Error updating terms:", error);
        updateMessageDiv.innerHTML =
          '<p style="color:red;">An error occurred while updating terms.</p>';
      });
  });
});
