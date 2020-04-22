async function login(){
 const email = document.getElementById("email").value;
 const password = document.getElementById("password").value;
 const form = document.getElementById("login-form");
 const formData = new FormData(form);

 formData.append("email",email);
 formData.append("password",password);

 const res = await fetch("./controllers/controller.signin.php",{
   method:"post",
   body:formData
 })

 const data = await res.json();

 console.log(data);
 if(data.authenticated){
   window.location="/pages/dashboard/";
 }

 else{
   console.log("Failed");
 }
}