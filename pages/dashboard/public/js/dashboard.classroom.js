async function postComment(){
  const commentBody = document.getElementById("comment_body").value;
  const fd = new FormData();

  fd.append("comment_body",commentBody);
  fd.append("action","postComment");

  const res = await fetch("../controllers/controller.discussions.php",{
    method:"post",
    body:fd
  });

  const data = await res.json();
  
  if(data.error){
    alert("failed");
  }
  else{
    window.location = window.location;
  }
}