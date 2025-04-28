document.getElementById("username").addEventListener("input", function () {
	const username = this.value;
	const error = document.getElementById("username-error");
	error.textContent =
		username.length < 3 ? "Username must be at least 3 characters" : "";
});
document.getElementById("email").addEventListener("input", function () {
	const email = this.value;
	const error = document.getElementById("email-error");
	const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	error.textContent = regex.test(email) ? "" : "Invalid email format";
});
document.getElementById("password").addEventListener("input", function () {
	const password = this.value;
	const error = document.getElementById("password-error");
	error.textContent =
		password.length < 6 ? "Password must be at least 6 characters" : "";
});
