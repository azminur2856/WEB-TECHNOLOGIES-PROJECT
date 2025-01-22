function validateSigninForm() {
  let errors = [];

  let email = document.getElementById("email").value.trim();
  if (email === "") {
    errors.push("Email is required!");
  } else {
    let hasAt = email.includes("@");
    let hasDot = email.includes(".");
    if (!hasAt || !hasDot) {
      errors.push("Invalid email format.");
    }
  }

  let password = document.getElementById("password").value.trim();
  if (password === "") {
    errors.push("Password is required!");
  } else if (password.length < 8) {
    errors.push("Invalid password!");
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
