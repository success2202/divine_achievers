<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width:1100px;">
<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

  <nav class="navbar navbar-light bg-light">
            <form class="container-inline">
                <div class="input-group">
                <input name="find" value="<?=isset($_GET['find'])?$_GET['find']:'';?>" type="text" class="form-control" placeholder="search student" aria-label="Username" aria-describedby="basic-addon1">
                 <div class="input-group-prepend">
                      <button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
                    </div>
              </div>
            </form>
          
        <a href="<?=ROOT?>/signup?mode=students">
          <button class="btn btn-sm btn-primary" style="border-radius: 10px 10px;  box-shadow: 5px 5px 5px grey;"><i class="fa fa-user-graduate"></i>&nbsp;&nbsp;Add New Student</button>
        </a>
      </nav>

<div class="card-group justify-content-center">
<?php if($rows): ?>
  <?php foreach($rows as $row):?>

    <?php include(views_path('user')) ?> 
    
  <?php endforeach; ?>
<?php else: ?>
<h4>No student found </h4>
<?php endif; ?>

</div>
<?php $pager->display(); ?>

    </div>
    
  
    <?php $this->view('includes/footer')?>