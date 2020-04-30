// Navbar functions
async function createClassroom() {
  const classroomName = document.getElementById("classroom_name").value;
  const description = document.getElementById("classroom_desc").value;
  const fd = new FormData();

  fd.append("classroom_name", classroomName);
  fd.append("description", description);
  fd.append("action", "createClassroom");

  const res = await fetch(
    "/pages/_includes/controllers/controller.navbar.php",
    {
      method: "post",
      body: fd,
    }
  );

  const data = await res.json();
  // check for any errors
  if (data.error) {
    alert(data.error.message);
    return;
  } else {
    window.location = "/pages/dashboard";
  }
}

async function joinClassroom() {
  const classroom_id = parseInt(document.getElementById("classroom_id").value);
  const fd = new FormData();

  fd.append("classroom_id", classroom_id);
  fd.append("action", "joinClassroom");

  const res = await fetch(
    "/pages/_includes/controllers/controller.navbar.php",
    {
      method: "post",
      body: fd,
    }
  );

  const data = await res.json();
  // check for any errors
  if (data.error) {
    alert(data.error.message);
    return;
  } else {
    window.location = "/pages/dashboard";
  }

  // update the UI with new classrooms;
}

async function logout() {
  const fd = new FormData();
  fd.append("action","logout");
  const res = await fetch("./controllers/controller.navbar.php", {
    method:"post",
    body:fd
  });

  const data = await res.json();

  if(data.logout){
    window.location="/";
  }
}
