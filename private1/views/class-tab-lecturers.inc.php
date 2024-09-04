<nav class="navbar navbar-light bg-light">
            <form class="container-inline">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
                    </div>
                   <input type="text" class="form-control" placeholder="lecturer's name" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </form>  
            <div> 

<?php if(Auth::access('teacher')):?>     
           <a href="<?=ROOT?>/single_class/lecturersadd/<?=$row->class_id?>?select=true">
          <button class="btn btn-sm btn-primary" style="border-radius: 10px 10px;  box-shadow: 5px 5px 5px grey;"><i class="fa fa-plus">&nbsp;&nbsp;Add New Teacher</i></button>
        </a>
       
        <a href="<?=ROOT?>/single_class/lecturersremove/<?=$row->class_id?>?select=true">
          <button class="btn btn-sm btn-primary" style="border-radius: 10px 10px;  box-shadow: 5px 5px 5px grey;"><i class="fa fa-minus">&nbsp;&nbsp;Remove Teacher</i></button>
        </a>
<?php endif;?>

        </div>  
    </nav>
    <br>
<div class="card-group justify-content-center">
    <?php if(is_array($lecturers)):?>
        <?php foreach ($lecturers as $lecturer) :?>
            <?php
                $row = $lecturer->user;
                include(views_path('user'));
        ?>
      <?php endforeach;?>
      <?php else:?>  
        <center><h4>No Teacher were found in this class</h4></center>
      <?php endif;?>   
</div>
<?php $pager->display(); ?>