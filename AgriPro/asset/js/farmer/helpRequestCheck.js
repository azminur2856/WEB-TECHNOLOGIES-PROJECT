function validateHelpRequestForm() {
  let errors = [];

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
