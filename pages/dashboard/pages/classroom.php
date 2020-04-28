<?php require("../controllers/controller.classroom.php"); ?>
<?php require("../../_includes/header.php") ?>

<link rel="stylesheet" href="../public/css/classroom.css">

<?php require("../../_includes/body.php"); ?>

<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-2">
      <?php echo $metadata["classroom_name"]; ?>
    </h1>
    <p class="lead">
      <?php echo $metadata["description"]; ?>
    </p>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <!-- TODO: Will add this later -->
    <div class="col-sm">
      <h3>Notices</h3>
      <hr>
      <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Header</div>
        <div class="card-body">
          <h5 class="card-title">Primary card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <?php require_once("./discussions.php"); ?>
    </div>
    <div class="col-sm">
      <?php require_once("./participants.php"); ?>
    </div>
  </div>
</div>

<script src="../public/js/dashboard.classroom.js"></script>
<?php require("../../_includes/footer.php") ?>