function validateFeedbackForm() {
  let errors = [];

  let feedback = document.getElementById("feedback").value.trim();
  if (feedback === "") {
    errors.push("Feedback is required.");
  } else {
    let wordCount = feedback.split(/\s+/).length;
    if (wordCount < 5) {
      errors.push("Feedback must contain at least 5 words.");
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
