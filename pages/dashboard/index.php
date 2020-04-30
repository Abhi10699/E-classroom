<?php require("./controllers/controller.index.php") ?>
<?php require("../_includes/header.php") ?>

<!-- <link rel="stylesheet" href="./public/css/style.css"> -->

<?php require("../_includes/body.php"); ?>


<!-- Load controller -->

<div class="container mt-3">
  <h2>Your Classrooms..</h2>
  <hr>
  <div class="card-columns">
    <?php
    if (!isset($MyClassrooms_student)) {?>
      <p>You can join classroom by pressing <i class="fas fa-plus"></i> icon</p>
    <?php } else {
      foreach ($MyClassrooms_student as $classroom) { ?>
        <div class="card">
          <img class="card-img-top" width="100" height="180" src="https://static.vecteezy.com/packs/media/components/home/masthead-vectors/img/lavakidneys_800x400@2x-2db5e5a0c944e2b16a11a18674570f76.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">
              <?php echo $classroom["classroom_name"] ?>
            </h4>
            <p class="card-text">
              <?php echo $classroom["description"] ?>
            </p>
            <a href="<?php echo "/pages/dashboard/pages/classroom.php?id=" . $classroom["classroom_id"] ?>" class="btn btn-primary">Go to classroom</a>
          </div>
        </div>
    <?php
      }
    } ?>
    <!-- <button type="button" class="btn btn-primary" onclick="updateContent();">Update</button> -->
  </div>

  <h2>Your Lectures..</h2>
  <hr>
  <div class="card-columns">
    <?php
    if ((isset($MyClassrooms_teacher) && $MyClassrooms_teacher["error"] == true)) { ?>
      <p>You can join classroom by pressing <i class="fas fa-plus"></i> icon</p>
    
    <?php } else {

      foreach ($MyClassrooms_teacher as $classroom) { ?>
        <div class="card">
          <img class="card-img-top" width="100" height="180" src="https://i2.wp.com/www.topofandroid.com/wp-content/uploads/2015/05/Android-L-Material-Design-Wallpapers-14.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">
              <?php echo $classroom["classroom_name"] ?>
            </h4>
            <p class="card-text">
              <?php echo $classroom["description"] ?>
            </p>
            <a href="<?php echo "/pages/dashboard/pages/classroom.php?id=" . $classroom["classroom_id"] ?>" class="btn btn-primary">Go to classroom</a>
          </div>
        </div>
    <?php }
    }
    ?>
  </div>
</div>

<script src="./public/js/dashboard.index.js"></script>
<?php require("../_includes/footer.php") ?>