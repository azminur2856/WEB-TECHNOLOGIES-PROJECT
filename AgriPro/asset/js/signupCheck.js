function validateSignupForm() {
  let errors = [];

  let type = document.querySelector('input[name="type"]:checked');
  if (!type) {
    errors.push("User type is required.");
  }

  let name = document.getElementById("name").value.trim();
  let nameParts = [];
  let currentPart = "";

  for (let char of name) {
    if (char === " " || char === "\t" || char === "\n") {
      if (currentPart !== "") {
        nameParts.push(currentPart);
        currentPart = "";
      }
    } else {
      currentPart += char;
    }
  }
  if (currentPart !== "") {
    nameParts.push(currentPart);
  }

  if (name === "") {
    errors.push("Name is required.");
  } else {
    let valid = true;
    for (let part of nameParts) {
      if (part[0] < "A" || part[0] > "Z") {
        valid = false;
        break;
      }
      for (let i = 1; i < part.length; i++) {
        if (part[i] < "a" || part[i] > "z") {
          valid = false;
          break;
        }
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

  let phone = document.getElementById("phone").value.trim();
  if (phone === "") {
    errors.push("Phone number is required.");
  } else {
    if (phone.length !== 10) {
      errors.push("Phone number must be exactly 10 digits long.");
    } else if (phone[0] !== "1") {
      errors.push("Phone number must start with '1'.");
    } else if (phone[1] < "3" || phone[1] > "9") {
      errors.push("The second digit must be between '3' and '9'.");
    } else {
      let validPhone = true;
      for (let char of phone) {
        if (char < "0" || char > "9") {
          validPhone = false;
          break;
        }
      }
      if (!validPhone) {
        errors.push("Phone number must contain only digits.");
      }
    }
  }

  let dob = document.getElementById("dob").value.trim();
  if (dob === "") {
    errors.push("Date of birth is required.");
  } else {
    let dobDate = new Date(dob);
    let currentDate = new Date();
    if (dobDate >= currentDate) {
      errors.push("Invalid or future date.");
    } else {
      let age = currentDate.getFullYear() - dobDate.getFullYear();
      let monthDiff = currentDate.getMonth() - dobDate.getMonth();
      if (
        monthDiff < 0 ||
        (monthDiff === 0 && currentDate.getDate() < dobDate.getDate())
      ) {
        age--;
      }
      if (age < 18) {
        errors.push("Applicant must be at least 18 years old.");
      }
    }
  }

  let gender = document.querySelector('input[name="gender"]:checked');
  if (!gender) {
    errors.push("Gender is required.");
  }

  let picture = document.getElementById("picture").files[0];
  if (!picture) {
    errors.push("Profile picture is required.");
  } else {
    let allowedExtensions = ["jpg", "jpeg", "png"];
    let fileExtension = picture.name.split(".").pop().toLowerCase();
    let isValidExtension = false;
    for (let ext of allowedExtensions) {
      if (fileExtension === ext) {
        isValidExtension = true;
        break;
      }
    }
    if (!isValidExtension) {
      errors.push("Invalid image format. Only jpg, jpeg, and png are allowed.");
    }
  }

  let password = document.getElementById("password").value;
  let confirmPassword = document.getElementById("repassword").value;
  if (password === "") {
    errors.push("Password is required.");
  } else {
    let hasSpecialChar = false;
    for (let char of password) {
      if (char === "@" || char === "#" || char === "$" || char === "%") {
        hasSpecialChar = true;
        break;
      }
    }
    if (password.length < 8) {
      errors.push("Password must be at least 8 characters long.");
    }
    if (!hasSpecialChar) {
      errors.push(
        "Password must contain at least one special character (@, #, $, or %)."
      );
    }
    if (password !== confirmPassword) {
      errors.push("Passwords do not match.");
    }
  }

  let agree = document.getElementById("agree").checked;
  if (!agree) {
    errors.push("You must agree to the terms and conditions.");
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
