<?php

?>
<h3>Discussions</h3>
<hr />

<div class="container">
  <!-- Post form -->
  <form>
    <div class="input-group">
      <textarea class="form-control" aria-label="With textarea" placeholder="Write something" id="comment_body"></textarea>
    </div>
    <button type="button" class="btn btn-primary mt-3" onclick='postComment();'>Update</button>
  </form>
  <hr />
  <!-- Replies and posts from other users -->
  <div class="posts">
    <h2 class="my-2">Posts</h2>

    <!-- show message if no comments exists -->

    <?php
    if (!isset($comments)) { ?>
      <p class="lead">Its lonely in here! Be the first one to start the discussion</p>
      <?php } else {
      foreach ($comments as $comment) {
      ?>
        <div class="card my-2">
          <div class="card-header">
            <?php echo $comment["username"] ?>
          </div>
          <div class="card-body">
            <!-- <h5 class="card-title">Special title treatment</h5> -->
            <p class="card-text">
              <?php echo $comment["comment"] ?>
            </p>
          </div>
        </div>
    <?php }
    } ?>
  </div>
</div>