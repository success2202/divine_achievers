<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

    <!-- <h5 class="card-group justify-content-center">Classes</h5> -->

    <nav class="navbar navbar-light bg-light">
            <form class="container-inline">
                <div class="input-group">
                    
                   <input name="find" value="<?=isset($_GET['find'])?$_GET['find']:'';?>" type="text" class="form-control" placeholder="search class" aria-label="Username" aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                    <button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
                </div>
            </div>
        </form>   

<?php if(Auth::access('teacher')): ?>
        <a href="<?=ROOT?>/classes/add">
        <button class="btn-sm btn btn-primary" style="border-radius: 10px 10px;  box-shadow: 5px 5px 5px grey;"><i class="fa fa-university"></i>&nbsp;&nbsp;Add New Class</button>
        </a>
<?php endif;?>

    </nav>
    <!-- including a class table view on the class -->
            <?php include(views_path('classes')); ?> 
    </div>
    
    <?php $this->view('includes/footer')?>