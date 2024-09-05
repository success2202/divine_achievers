<div id="wrapper">

<!-- Navigation -->



<div id="page-wrapper">

    <div class="container-fluid">

       


        <div class="row">
<div class="col-lg-3 col-md-6">
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-file-text fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">

<!-- this fetch posts and  count the number of post                 -->

<!-- // $sql = "SELECT * FROM posts";
// $select_all_post = mysqli_query($con, $sql);
// $post_count = mysqli_num_rows($select_all_post);
$post_count = recordCount('posts'); -->
<!-- display number of pages -->
<div class='huge'></div> 

         
                <div>Posts</div>
            </div>
        </div>
    </div>
    <a href="posts.php?source=view_dashboard_post">
        <div class="panel-footer">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
        </div>
    </a>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-green">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-comments fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">

<!-- fetch comments and count the number of comment in a post through the function recordCount -->
<div class='huge'></div> 

              <div>Comments</div>
            </div>
        </div>
    </div>
    <a href="comment.php?source=dashboard_comment">
        <div class="panel-footer">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
        </div>
    </a>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-yellow">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
<!-- fetch and count number of users through the function recordCount -->
<div class='huge'></div> 

                <div> Users</div>
            </div>
        </div>
    </div>
    <a href="users.php?source=all_users_dashboard">
        <div class="panel-footer">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
        </div>
    </a>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-red">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-list fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
<!-- display and count number of categories -->
<div class='huge'></div> 
                
                 <div>Categories</div>
            </div>
        </div>
    </div>
    <a href="dashboard_categories.php">
        <div class="panel-footer">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
        </div>
    </a>
</div>
</div>
</div>

<!-- /.row -->

<?php 
// $sql = "SELECT * FROM posts WHERE post_status = 'published'";
// $select_published_post = mysqli_query($con, $sql);
// $published_post_count = mysqli_num_rows($select_published_post);

$published_post_count = checkStatus('posts', 'post_status', 'published'); // this is a function that check status 

// $sql = "SELECT * FROM posts WHERE post_status = 'drafted'";
// $select_draft_post = mysqli_query($con, $sql);
// $draft_post_count = mysqli_num_rows($select_draft_post);

$draft_post_count = checkStatus('posts', 'post_status', 'drafted');

// $sql = "SELECT * FROM comments WHERE comment_status = 'approved'";
// $select_approved_comment = mysqli_query($con, $sql);
// $approved_comment_count = mysqli_num_rows($select_approved_comment);

$approved_comment_count = checkComment('comments', 'comment_status', 'approved');

// $sql = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
// $select_unapproved_comment = mysqli_query($con, $sql);
// $unapproved_comment_count = mysqli_num_rows($select_unapproved_comment);

$unapproved_comment_count = checkComment('comments', 'comment_status', 'unapproved');

// $sql = "SELECT * FROM users WHERE user_role = 'subscriber'";
// $select_subscribe_user = mysqli_query($con, $sql);
// $subscribe_user_count = mysqli_num_rows($select_subscribe_user);

$subscribe_user_count = checkRole('users', 'user_role', 'subscriber');

// $sql = "SELECT * FROM users WHERE user_role = 'admin'";
// $select_admin_user = mysqli_query($con, $sql);
// $admin_user_count = mysqli_num_rows($select_admin_user);

$admin_user_count = checkRole('users', 'user_role', 'admin');

// $sql = "SELECT * FROM categories WHERE user_role = 'subscriber'";
// $select_subscribe_user = mysqli_query($con, $sql);
// $subscribe_user_count = mysqli_num_rows($select_subscribe_user);

?>

<!-- displaying the chat  -->
<div class="row">
<script type="text/javascript">
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
['Data', 'Count'],

<?php 
$element_text = ['Active Posts', 'Comments', 'Users', 'Categories', 'Published Post', 'Draft Post', 'Approved Comment',
'Unapproved Com', 'Subscribed User', 'Admin User'];
$element_count = [$post_count, $comment_count, $user_count, $category_count, $published_post_count, $draft_post_count,
$approved_comment_count, $unapproved_comment_count, $subscribe_user_count, $admin_user_count];
// looping the element text and count
for($i =0;$i < 10;  $i++) {
echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
}

?>
// ['Posts', 1000],

]);

var options = {
chart: {
title: '',
subtitle: '',
}
};

var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>
<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
</div>

    
    <!-- /.container-fluid -->

</div>