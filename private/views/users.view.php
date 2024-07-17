<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
<?php $this->view('includes/crumbs')?>

<div class="card-group justify-content-center">
<?php if($rows): ?>
  <?php foreach($rows as $row):?>

<div class="card m-2 shadow-sm" style="max-width: 14rem; min-width: 14rem;">
 <div class="card-header">User Profile</div>
  <img src="<?=ROOT?>/assets/user.png" class="card-img-top" alt="card image cap">
  <div class="card-body">
    <h5 class="card-title"><?=$row->firstname?> <?=$row->lastname?></h5>
    <p class="card-text"><?=str_replace("_"," ",$row->rank)?></p>
    <a href="#" class="btn btn-primary">Profile</a>
  </div>
</div>
  <?php endforeach; ?>
<?php else: ?>
<h4>No User found at the moment</h4>
<?php endif; ?>
</div>
    </div>
    
   



    <?php $this->view('includes/footer')?>