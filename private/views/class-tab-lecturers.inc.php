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
           <a href="<?=ROOT?>/single_class/lecturersadd/<?=$row->class_id?>?select=true">
          <button class="btn btn-sm btn-primary"><i class="fa fa-plus">&nbsp;&nbsp;Add New lecturer</i></button>
        </a>

        <a href="<?=ROOT?>/single_class/lecturersremove/<?=$row->class_id?>?select=true">
          <button class="btn btn-sm btn-primary"><i class="fa fa-minus">&nbsp;&nbsp;Remove lecturer</i></button>
        </a>
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
        <center><h4>No Lecturers were found in this class</h4></center>
      <?php endif;?>   
</div>
<?php $pager->display(); ?>