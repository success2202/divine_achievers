
<?php $this->view('includes/header') ?>

    <div class="container-fluid">
       <form action="" method="Post">
   <div class="p-4 mx-auto shadow rounded" style="margin-top: 50px; width: 100%; max-width: 310px;">
   <h4 class="text-center">DIVINE ACHIEVERS </h4>
   <img src="<?=ROOT?>/assets/logo1.png" class=" border border-primary d-block mx-auto rounded-circle" style="width: 100px" alt="">
   
   <h3 class="text-center">Login</h3>
   <?php if(count($errors)>0):?>
   <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong>
  <?php foreach($errors as $error):?>
    <br><?=$error?>
    <?php endforeach;?>
  <span  type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> <br>
    <span aria-hidden="true">&times;</span>
</span>
</div>
<?php endif;?>
<input class="form-control" value="<?=get_var('email')?>" type="email" name="email" placeholder="email" autofocus> <br>
<input class="form-control" value="<?=get_var('password')?>" type="password" id="myInput" name="password" placeholder="password"> 
<input type="checkbox" onclick="myFunction()"> &nbsp;Show Password  <br> <br>

<center> <button class="btn btn-primary">Login</button> </center>

<!-- <a  href="<?=ROOT?>/signup">
<button class="btn btn-info float-right">Sign-Up</button>
</a> -->
</div>
</form>
    </div>

  <script>

  function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script> 
    
    <?php $this->view('includes/footer') ?>