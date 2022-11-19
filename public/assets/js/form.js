// viewpassword
const viewpassword = document.querySelector(".viewpassword");
viewpassword.addEventListener("click", () => {
  if (password.type === "password") {
    password.type = "text";
    viewpassword.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
  } else {
    password.type = "password";
    viewpassword.innerHTML = `<i class="fa-solid fa-eye"></i>`;
  }
});

const validPassword = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])/;

// --------------------------------
// ---------------------Password
// --------------------------------
password.addEventListener("input", () => {
  if (password.value.match(validPassword)) {
    passwordTextError.textContent = "";
    confirmPassword.disabled = false;
  } else {
    confirmPassword.disabled = true;
    confirmPassword.value = "";
    passwordTextError.innerHTML = `
        <span>Le mot de passe doit contenir :</span>
        <ul>
        <li id="specialCharacters">Un caractére spéciaux</li>
        <li id="uppercaseCharacters">Une majuscule</li>
        <li id="lowercaseCharacters">Une minuscule</li>
        <li id="numberCharacters">Un nombre</li>
        </ul>
        `;
    if (password.value.match(/(?=.*[!@#$%^&*])/)) {
      specialCharacters.style.display = "none";
    }
    if (password.value.match(/(?=.*[A-Z])/)) {
      uppercaseCharacters.style.display = "none";
    }
    if (password.value.match(/(?=.*[a-z])/)) {
      lowercaseCharacters.style.display = "none";
    }
    if (password.value.match(/(?=.*[0-9])/)) {
      numberCharacters.style.display = "none";
    }
  }
});

// -------------------------------------
// ---------------------Confirm Password
// -------------------------------------
confirmPassword.addEventListener("input", () => {
  if (password.value == confirmPassword.value) {
    confirmPasswordTextError.textContent = "";
  } else {
    confirmPasswordTextError.textContent =
      "Les mots de passe ne sont pas identique";
  }
});