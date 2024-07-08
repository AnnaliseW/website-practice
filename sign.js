document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login");
    const createAccountForm = document.querySelector("#createAccount");

    document.querySelector("#linkCreateAccount").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.add("form--hidden");
        createAccountForm.classList.remove("form--hidden");
    });

    document.querySelector("#linkLogIn").addEventListener("click", e => {
        e.preventDefault();
        loginForm.classList.remove("form--hidden");
        createAccountForm.classList.add("form--hidden");
    });

    loginForm.addEventListener("submit", e => {
        e.preventDefault();
        // Perform AJAX/Fetch Login
        setFormMessage(loginForm, "error", "Invalid Username or Password");
    });

    const firstNameInput = document.querySelector("#signUpFirstName");
    const lastNameInput = document.querySelector("#signUpLastName");
    const emailInput = document.querySelector("input[name='email']");
    const usernameInput = document.querySelector("input[name='user_name']");
    const passwordInput = document.querySelector("input[name='password']");
    const confirmPasswordInput = document.querySelector("input[type='password']:last-of-type");

    firstNameInput.addEventListener("blur", () => {
        validateInput(firstNameInput);
    });

    lastNameInput.addEventListener("blur", () => {
        validateInput(lastNameInput);
    });

    emailInput.addEventListener("blur", () => {
        validateEmail(emailInput);
    });

    usernameInput.addEventListener("blur", () => {
        validateInput(usernameInput);
    });

    passwordInput.addEventListener("blur", () => {
        validatePassword(passwordInput);
    });

    confirmPasswordInput.addEventListener("blur", () => {
        validateConfirmPassword(passwordInput, confirmPasswordInput);
    });

    function validateInput(inputElement) {
        const inputValue = inputElement.value.trim();
        if (inputValue === "") {
            setInputError(inputElement, `${getFieldName(inputElement)} is required`);
        } else {
            clearInputError(inputElement);
        }
    }

    function validateEmail(emailElement) {
        const emailValue = emailElement.value.trim();
        if (!isValidEmail(emailValue)) {
            setInputError(emailElement, "Please enter a valid email address");
        } else {
            clearInputError(emailElement);
        }
    }

    function validatePassword(passwordElement) {
        const passwordValue = passwordElement.value.trim();
        if (passwordValue.length < 8) {
            setInputError(passwordElement, "Password must be at least 8 characters long");
        } else {
            clearInputError(passwordElement);
        }
    }

    function validateConfirmPassword(passwordElement, confirmPasswordElement) {
        const confirmPasswordValue = confirmPasswordElement.value.trim();
        const passwordValue = passwordElement.value.trim();
        if (confirmPasswordValue !== passwordValue) {
            setInputError(confirmPasswordElement, "Passwords do not match");
        } else {
            clearInputError(confirmPasswordElement);
        }
    }

    function isValidEmail(email) {
        // Basic email validation with regular expression
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    function getFieldDisplayName(inputElement) {
        return inputElement.placeholder || inputElement.name;
    }

    function setInputError(inputElement, message) {
        const errorElement = inputElement.parentElement.querySelector(".form__input-error-message");
        errorElement.textContent = message;
        inputElement.classList.add("form__input--error");
    }

    function clearInputError(inputElement) {
        const errorElement = inputElement.parentElement.querySelector(".form__input-error-message");
        errorElement.textContent = "";
        inputElement.classList.remove("form__input--error");
    }
});

