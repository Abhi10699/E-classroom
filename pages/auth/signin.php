<!-- load includes -->
<?php require "../_includes/header.php" ?>
<?php require "../_includes/body.php" ?>

<div class="container mt-3">
  <form method="POST" id="login-form">
    <div class="form-group">
      <label for="">Email</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="Enter email">

    </div>
    <div class="form-group">
      <label for="">Pasword</label>
      <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelpId" placeholder="Enter Password">
    </div>
    <button type="button" class="btn btn-primary" onclick="login()">Submit</button>
  </form>
  <p class="form-text text-muted">
    Dont have an account ? <a href="./signup.php">Click here.</a>
  </p>
</div>

<!-- Load javascripts -->
<script src="./public/js/signin.script.js"></script>
<?php require "../_includes/footer.php" ?>