<div class="table-responsive">
<a href="<?=ROOT?>/single_test/<?=$row->test_id?>">
    <button class="btn btn-sm float-right btn-primary"><i class="fa fa-chevron-left"></i> Back </button> 
</a>
<table class="table table-dark table-striped table-hover">
   <center><label>Students Scores</label> </center> 
    <tr><th>Student Name</th> <th>Scores</th></tr>

    <?php if($student_scores):?>
        <?php foreach ($student_scores as $score):?>
            <tr><td><?=$score->user->firstname?> <?=$score->user->lastname?></td><td><?=$score->score?>%</td></tr>
        <?php endforeach;?>
    <?php endif;?>
</table>
</div>