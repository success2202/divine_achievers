

<nav class="navbar navbar-light bg-light">
            <form class="form-inline">
                <div class="input-group">
                    
                <input value="<?=!empty($_GET['find'])?$_GET['find']:''?>" name="find" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                <input type="hidden" name="tab" value="tests">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
                </div>
            </div>
            </form>
        </nav>

        <?php if($row->rank == 'student'):?>
            <?php include(views_path('marked')); ?> 
        <?php else:?>
            <?php include(views_path('tests')); ?>
        <?php endif;?>