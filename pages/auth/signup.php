<?php 
  require "./controllers/controller.signup.php";
  require "../_includes/header.php";
  require "../_includes/body.php";
?>
<div class="container mt-3">
  <form id="form-register">

    <?php if (!empty($error_general)) { ?>

      <div class="alert alert-danger" role="alert">
        <?php echo $error_general ?>
      </div>

    <?php } else if (!empty($success_message)) { ?>

      <div class="alert alert-success" role="alert">
        <?php echo $success_message ?>
      </div>

    <?php } ?>

    <div class="form-group">
      <label for="">Username</label>

      <?php if (!empty($error_username)) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $error_username ?>
        </div>
      <?php } ?>

      <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelpId" placeholder="Enter Username">

    </div>
    <div class="form-group">
      <label for="">Email</label>


      <?php if (!empty($error_email)) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $error_email ?>
        </div>
      <?php } ?>

      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="Enter email">

    </div>
    <div class="form-group">
      <label for="">Pasword</label>

      <?php if (!empty($error_password)) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $error_password ?>
        </div>
      <?php } ?>

      <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelpId" placeholder="Enter password">
    </div>

    <div class="form-group">
      <label for="">Confirm Pasword</label>


      <?php if (!empty($error_confirm)) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $error_confirm ?>
        </div>
      <?php } ?>

      <input type="password" class="form-control" name="confirmPassword" id="confirmPass" aria-describedby="emailHelpId" placeholder="Re-enter password">
    </div>
    <button type="button" class="btn btn-primary" onclick="register();">Register</button>
  </form>
  <p class="form-text text-muted">
    Already have an account ? <a href="./signin.php">Click here.</a>
  </p>

</div>

<!-- Load Javascripts  -->
<script src="./public/js/auth.register.js"></script>
<?php require "../_includes/footer.php" ?>