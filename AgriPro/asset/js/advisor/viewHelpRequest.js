function searchHelpRequest() {
  let search = document.getElementById("search").value.trim();
  let json = { search: search };
  let data = JSON.stringify(json);

  let xhttp = new XMLHttpRequest();

  xhttp.open(
    "POST",
    "../../controller/advisor_controller/searchHelpRequest.php",
    true
  );
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("mydata=" + data);

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      updateTable(response);
    }
  };
}

function updateTable(helpRequests) {
  let table = document.getElementById("helpRequestTable");
  table.innerHTML = `
      <tr>
          <th>SN</th>
          <th>Name</th>
          <th>Category</th>
          <th colspan='2'>Query</th>
          <th>Request At</th>
          <th>Action</th>
      </tr>`;

  if (helpRequests.length > 0) {
    helpRequests.forEach((request, index) => {
      let row = `
          <tr>
            <td style='text-align: center;'>${index + 1}</td>
            <td style='text-align: center;'>${request.name}</td>
            <td style='text-align: center;'>${request.category}</td>
            <td colspan='2' style='text-align: justify;'>${request.query}</td>
            <td style='text-align: center;'>${request.created_at}</td>
            <td style='text-align: center;'>
              <a href='feedbackHelpRequest.php?helpRequestId=${
                request.id
              }'> Feedback </a>
            </td>
          </tr>`;
      table.innerHTML += row;
    });
  } else {
    table.innerHTML += `
        <tr>
          <td colspan='7' style='text-align: center;'>No help requests found.</td>
        </tr>`;
  }
}

function viewPendingHelpRequest() {
  let xhttp = new XMLHttpRequest();

  xhttp.open(
    "POST",
    "../../controller/advisor_controller/viewPendingHelpRequest.php",
    true
  );
  xhttp.send();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      updateTable(response);
    }
  };
}

function viewResolvedHelpRequest() {
  let xhttp = new XMLHttpRequest();

  xhttp.open(
    "POST",
    "../../controller/advisor_controller/viewResolvedHelpRequest.php",
    true
  );
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      updateTableResolved(response);
    }
  };
}

function updateTableResolved(helpRequests) {
  let table = document.getElementById("helpRequestTable");
  table.innerHTML = `
      <tr>
          <th>SN</th>
          <th>Name</th>
          <th>Category</th>
          <th colspan='2'>Query</th>
          <th colspan='2'>Feedback</th>
      </tr>`;

  if (helpRequests.length > 0) {
    helpRequests.forEach((request, index) => {
      let row = `
          <tr>
            <td style='text-align: center;'>${index + 1}</td>
            <td style='text-align: center;'>${request.name}</td>
            <td style='text-align: center;'>${request.category}</td>
            <td colspan='2' style='text-align: justify;'>${request.query}</td>
            <td colspan='2' style='text-align: justify;'>${
              request.feedback
            }</td>
          </tr>`;
      table.innerHTML += row;
    });
  } else {
    table.innerHTML += `
        <tr>
          <td colspan='7' style='text-align: center;'>No help requests found.</td>
        </tr>`;
  }
}
