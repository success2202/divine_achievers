

<nav class="navbar navbar-light bg-light">
            <form class="container-inline">
                <div class="input-group">
                    
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
                </div>
            </form>
            </nav>
 <!-- including a class table view  on the class profile-->
 <?php $rows = $student_classes;?>

 <?php include(views_path('classes')); ?>



 