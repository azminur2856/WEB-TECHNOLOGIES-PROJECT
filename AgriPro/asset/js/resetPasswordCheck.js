function validateResetPasswordForm() {
  let errors = [];

  let email = document.getElementById("hemail").value.trim();
  if (email === "") {
    errors.push("Please request OTP first by preassing Send OTP Button.");
  }

  let otp = document.getElementById("otp").value.trim();
  if (otp === "") {
    errors.push("OTP is required.");
  } else if (otp.length !== 6 || !/^[0-9]{6}$/.test(otp)) {
    errors.push("OTP must be 6 digits and contain only numbers.");
  }

  let password = document.getElementById("password").value.trim();
  if (password === "") {
    errors.push("Password is required.");
  } else {
    if (password.length < 8) {
      errors.push("Password must be at least 8 characters long.");
    }
    if (!/[!@#$%]/.test(password)) {
      errors.push(
        "Password must contain at least one special character (@, #, $, or %)."
      );
    }
  }

  let repassword = document.getElementById("repassword").value.trim();
  if (repassword === "") {
    errors.push("Confirm Password is required.");
  } else if (password !== repassword) {
    errors.push("Passwords do not match.");
  }

  let ul = document.getElementById("errorListReset");
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
