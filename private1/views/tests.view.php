

<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

    <!-- <h5 class="card-group justify-content-center">Tests</h5> -->

    <nav class="navbar navbar-light bg-light">
    <form class="container-inline">
        <div class="input-group">
            
            <input name="find" value="<?=isset($_GET['find'])?$_GET['find']:'';?>" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            <div class="input-group-prepend">
                <button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
            </div>
        </div>
    </form>  

    <?php if(Auth::access('admin')):?>
    <i style="color:grey;"><b>NUMBER OF TESTS</b> <i class="btn btn-sm btn-primary mx-auto" style="border-radius: 10px 10px; height: 30px; box-shadow: 5px 5px 5px grey;"><b><?=$test_row2 ? count($test_row2):$test_row2 ?></b></i> </i>
    <?php else:?>
    <i style="color:grey;"><b>NUMBER OF TESTS</b> <i class="btn btn-sm btn-primary mx-auto" style="border-radius: 10px 10px; height: 30px; box-shadow: 5px 5px 5px grey;"><b><?=$test_row2 ? count($test_row2):$test_row2 ?></b></i> </i>
    <?php endif;?>
</nav>
    <!-- including a class table view on the class -->
   
            <?php include(views_path('tests')); ?> 
    </div>
    
    <?php $this->view('includes/footer')?>