<?php  

      $image = get_image($row->image, $row->gender); 
    ?>
    
        <div class="card m-1 shadow-sm" style="max-width: 12rem; min-width: 12rem;">
        <!-- <div class="card-header">User Profile</div> -->
        <img src="<?=$image?>" class=" rounded-circle card-img-top w-75 d-block mx-auto mt-2" alt="card image cap" style="height: 100px; width: 50px">
        
        <div class="card-body" >
        <center><h6 class="card-title"><?=$row->firstname?> <?=$row->lastname?></h6>
        <p class="card-text"><?=str_replace("_"," ",$row->rank)?></p>
        <a href="<?=ROOT?>/profile/<?=$row->user_id?>" class="btn btn-primary">Profile</a> 
       <?php if(isset($_GET['select'])):?>
         <button name="selected" value="<?=$row->user_id?>" class="btn btn-danger float-right">Select</button> </center>
        <?php endif;?>
      </div>
</div>
