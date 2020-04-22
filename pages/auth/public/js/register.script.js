async function register() {
  const username = document.getElementById("username").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const confirmPass = document.getElementById("confirmPass").value;
  const form = document.getElementById("form-register");
  const formData = new FormData(form);

  formData.append("username", username);
  formData.append("email", email);
  formData.append("password", password);
  formData.append("confirmPassword", confirmPass);

  const response = await fetch("./controllers/controller.signup.php", {
    method: "post",
    body: formData,
  });

  const result = await response.json();

  // redirect to dashboard if user is created successfully

  if (result.userCreated) {
    window.location = "/pages/dashboard/";
  } else {
    alert("Something went wrong");
  }
}
