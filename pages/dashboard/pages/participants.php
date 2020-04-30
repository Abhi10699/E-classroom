<h3>Participants</h3>
<hr/>

<ul class="list-group">
  <?php
    if(!isset($participants)){ ?>
      <h3>Particpants Looks Empty!</h3>
    <?php }  
    else{
      foreach($participants as $participant){ ?>
        <li class="list-group-item"><?php echo $participant["username"];?></li>
       <?php
      }
    }?>
<ul>