async function register(){
 const username = document.getElementById("username").value;
 const email = document.getElementById("email").value;
 const password = document.getElementById("password").value;
 const confirmPass = document.getElementById("confirmPass").value;
 const form = document.getElementById("form-register");
 const formData = new FormData(form);

 formData.append("username",username);
 formData.append("email",email);
 formData.append("password",password);
 formData.append("confirmPassword",confirmPass);


 const response = await fetch("./controllers/controller.signup.php",{
   method:"post",
   body:formData
 })

 const result = await response.text();
 const data = await result;

 console.log(data);

 if(data == 1){
   // registered successfully
   console.log("Success");
 }
 else{
   // something went wrong bro.
   console.log("failed");

 }
}
