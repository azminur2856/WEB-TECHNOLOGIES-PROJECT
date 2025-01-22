function validateHelpRequestForm() {
  let errors = [];

  let name = document.getElementById("name").value.trim();
  if (name === "") {
    errors.push("Name is required.");
  } else {
    let valid = true;
    let parts = name.split(" ");
    for (let part of parts) {
      if (
        part === "" ||
        part[0] < "A" ||
        part[0] > "Z" ||
        !/^[A-Za-z]+$/.test(part)
      ) {
        valid = false;
        break;
      }
    }
    if (!valid) {
      errors.push(
        "All parts of the name must start with a capital letter and contain only alphabetic characters."
      );
    }
  }

  let email = document.getElementById("email").value.trim();
  if (email === "") {
    errors.push("Email is required.");
  } else {
    let hasAt = email.includes("@");
    let hasDot = email.includes(".");
    if (!hasAt || !hasDot) {
      errors.push("Invalid email format.");
    }
  }

  let category = document.getElementById("category").value.trim();
  if (category === "") {
    errors.push("Category is required.");
  }

  let query = document.getElementById("query").value.trim();
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
