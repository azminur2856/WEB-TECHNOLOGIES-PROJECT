function validateHelpRequestForm(category, query) {
  let errors = [];

  if (category === "") {
    errors.push("Category is required.");
  }

  if (query === "") {
    errors.push("Query is required.");
  } else {
    let wordCount = query.split(/\s+/).length;
    if (wordCount < 5) {
      errors.push("Query must contain at least 5 words.");
    }
  }

  let ul = document.getElementById("errorList");
  ul.innerHTML = "";

  for (let error of errors) {
    let li = document.createElement("li");
    li.textContent = error;
    li.style.color = "red";
    li.style.fontSize = "14px";
    li.style.fontWeight = "bold";
    ul.appendChild(li);
  }

  return errors.length === 0;
}

function submitHelpRequest() {
  let email = document.getElementById("email").value.trim();
  let category = document.getElementById("category").value.trim();
  let query = document.getElementById("query").value.trim();

  if (!validateHelpRequestForm(category, query)) {
    return;
  }

  let xhttp = new XMLHttpRequest();
  xhttp.open(
    "POST",
    "../../controller/farmer_controller/getUserIdByEmailAjax.php",
    true
  );
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("email=" + encodeURIComponent(email));

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      if (response.success) {
        let userId = response.userId;

        let json = {
          userId: userId,
          category: category,
          query: query,
        };

        let data = JSON.stringify(json);

        let xhttpHelpRequest = new XMLHttpRequest();
        xhttpHelpRequest.open(
          "POST",
          "../../controller/farmer_controller/helpRequestCheckAjax.php",
          true
        );
        xhttpHelpRequest.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        xhttpHelpRequest.send("mydata=" + data);

        xhttpHelpRequest.onreadystatechange = function () {
          if (
            xhttpHelpRequest.readyState == 4 &&
            xhttpHelpRequest.status == 200
          ) {
            let helpResponse = JSON.parse(xhttpHelpRequest.responseText);
            if (helpResponse.success) {
              const successMessage = document.getElementById("formSuccess");
              successMessage.innerText = helpResponse.message;
              document.getElementById("formError").innerText = "";
              document.getElementById("errorList").innerHTML = "";

              // Clear form fields
              document.getElementById("category").value = "";
              document.getElementById("query").value = "";

              // Hide success message after 3 seconds
              setTimeout(() => {
                successMessage.innerText = "";
              }, 3000);
            } else {
              document.getElementById("formSuccess").innerText = "";
              document.getElementById("formError").innerText =
                helpResponse.message || "Errors found!";
              let errorList = document.getElementById("errorList");
              errorList.innerHTML = "";
              if (helpResponse.errors) {
                for (let error of helpResponse.errors) {
                  let li = document.createElement("li");
                  li.textContent = error;
                  li.style.color = "red";
                  li.style.fontSize = "14px";
                  li.style.fontWeight = "bold";
                  errorList.appendChild(li);
                }
              }
            }
          }
        };
      } else {
        document.getElementById("formError").innerText =
          "Unable to fetch user ID. Please try again.";
      }
    }
  };
}
