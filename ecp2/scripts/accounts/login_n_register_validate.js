function validateLogin() {
	var pwdField = document.getElementById("password");
	if (pwdField.value.length < 6) {
		pwdField.setCustomValidity("At least 6 characters");
	} else {
		pwdField.setCustomValidity("");
	}
}

function validateRegister () {
	var pwdField = document.getElementById("password");
	var retypeField = document.getElementById("retype");
	var rollField = document.getElementById("roll");
	if (pwdField.value.length < 6) {
		pwdField.setCustomValidity("At least 6 characters");
		retypeField.setCustomValidity("");
	} else if (pwdField.value != retypeField.value) {
		pwdField.setCustomValidity("");
		retypeField.setCustomValidity("Both passwords must match");
	} else {
		pwdField.setCustomValidity("");
		retypeField.setCustomValidity("");
	}

	if (rollField.validity.patternMismatch) {
		rollField.setCustomValidity("7 digit roll number");
	} else {
		rollField.setCustomValidity("");
	}
}

