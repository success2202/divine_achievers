<?php

function get_var($key, $default = "", $method = "post"){
    $data = $_POST;
    if($method == "get"){
        $data = $_GET;
    }

    if(isset($data[$key]))
    {
        return $data[$key]; 
    }

    return $default;
}

function get_select($key, $value){
    if(isset($_POST[$key])){
        if($_POST[$key] == $value){
            return "selected";
        }
    }
    return "";

}

function esc($var){
    return htmlspecialchars($var);

}

 function random_string($length){
    $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $text = "";
    for($x = 0; $x < $length; $x++){
        $random = rand(0,61);
        $text .= $array[$random];
    }
    return $text;
   }

   function random_st($length){
    $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j');
    $text = "";
    for($x = 0; $x < $length; $x++){
        $random = rand(0,20);
        $text .= $array[$random];
    }
    return $text;
   }

function get_date($date)
{
    return date("jS M, Y", strtotime($date));
    //return date("jS F, Y", strtotime($date));
}

function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function get_image($image, $gender='male'){
    if(!file_exists($image))
      {
        $image = ROOT.'/assets/user.png';
        if($gender == 'female')
        {
          $image = ROOT.'/assets/user_female.png';
        }
      }else{
        $class = new Image();
        $image = ROOT."/". $class->profile_thumb($image);
    }
      return $image;
}


//returning the view path
function views_path($view){
    if(file_exists("../private1/views/" . $view . ".inc.php")){
       return("../private1/views/" . $view . ".inc.php");
    }else{
        return("../private1/views/404.view.php");
    }
}

function upload_image($FILES){
    if(count($FILES) > 0 )
        {
        //we have an immage 
        $allowed[] = "image/jpg";
        $allowed[] = "image/png";
        $allowed[] = "image/jpeg";
        $allowed[] = "image/gif";

        if($FILES['image']['error'] == 0 && in_array($FILES['image']['type'], $allowed))
            {
            $folder = "uploads/";
            if(!file_exists($folder)){
                mkdir($folder, 0777, true);
            }
            $destination = $folder . time() . "_". $FILES['image']['name'];
            move_uploaded_file($FILES['image']['tmp_name'], $destination);
            return $destination;
            } 
        
        }   
        return false;

}

function has_taken_test($test_id){
    return "No";
}

function can_take_test($my_test_id){
    
$class = new Classes_model();
    $mytable = "class_students";
    if(Auth::getRank() != 'student'){
    return false;
    }

    $query = "select * from $mytable where user_id = :user_id && disabled = 0";
    $data['stdnt_classes'] = $class->query($query,['user_id'=>Auth::getUser_id()]);
    
    //getting the class the student belong to
    $data['student_classes'] = array();
    if($data['stdnt_classes']){
        foreach ($data['stdnt_classes'] as $key => $arow) {
        $data['student_classes'][] = $class->first('class_id', $arow->class_id);
        }
    }
    //collect class ids
    $class_ids =[];
    foreach($data['student_classes'] as $key => $class_row){
    $class_ids[] = $class_row->class_id;
    
    }
    //converting an array into a string
    $id_str = "'". implode("','", $class_ids) ."'";
    $query = "select * from tests where class_id in ($id_str)";
    $tests_model = new Tests_model();
    $tests = $tests_model->query($query);

    $my_tests = array_column($tests, 'test_id');
    if(in_array($my_test_id, $my_tests)){
        return true;
    }
   
    return false;
}


 function get_answer($saved_answers, $id)
{
    if(!empty($saved_answers)){
        foreach($saved_answers as $row) {
            if($id == $row->question_id)
            {
                return $row->answer;
            }
        }
    }
    return '';
}


function get_mark($saved_answers, $id)
{
    if(!empty($saved_answers)){
        foreach($saved_answers as $row) {
            if($id == $row->question_id)
            {
                return $row->answer_mark;
            }
        }
    }
    return '';
}

function get_answer_mark($saved_answers, $id)
{
    if(!empty($saved_answers)){
        foreach($saved_answers as $row) {
            if($id == $row->question_id)
            {
                return $row->answer_mark;
            }
        }
    }
    return '';
}


//getting the test and userid for the test view percentage
function get_answer_percentage($test_id, $user_id)
{
    $quest = new Questions_model();
    $questions = $quest->query('select * from test_questions where test_id =:test_id', ['test_id'=>$test_id]);
   
    $answers = new Answers_model();
    $query = "select question_id,answer from answers where user_id = :user_id && test_id = :test_id";
    $saved_answers = $answers->query($query,[
            'user_id'=> $user_id,
            'test_id'=> $test_id,
            
    ]);

    $total_answer_count = 0;
    if(!empty($questions))
    {
        foreach($questions as $quest){
            $answer = get_answer($saved_answers, $quest->id);
            if(trim($answer) != ""){
                $total_answer_count++;
            }
        }
    }
    if($total_answer_count > 0)
    {
        $total_questions = count($questions);
        return round(($total_answer_count / $total_questions) * 100);
    }

    return 0;
}

//getting the test and userid for the test mark view percentage
function get_mark_percentage($test_id, $user_id)
{
    $quest = new Questions_model();
    $questions = $quest->query('select * from test_questions where test_id =:test_id', ['test_id'=>$test_id]);
   
    $answers = new Answers_model();
    $query = "select question_id,answer,answer_mark from answers where user_id = :user_id && test_id = :test_id";
    $saved_answers = $answers->query($query,[
            'user_id'=> $user_id,
            'test_id'=> $test_id,
            
    ]);

    $total_answer_count = 0;
    if(!empty($questions))
    {
        foreach($questions as $quest){
            $answer = get_mark($saved_answers, $quest->id);
            if(trim($answer) > 0){
                $total_answer_count++;
            }
        }
    }
    if($total_answer_count > 0)
    {
        $total_questions = count($questions);
        return round(($total_answer_count / $total_questions) * 100);
    }

    return 0;
}



function get_score_percentage($test_id, $user_id)
{
    $quest = new Questions_model();
    $questions = $quest->query('select * from test_questions where test_id =:test_id', ['test_id'=>$test_id]);
   
    $answers = new Answers_model();
    $query = "select question_id,answer,answer_mark from answers where user_id = :user_id && test_id = :test_id";
    $saved_answers = $answers->query($query,[
            'user_id'=> $user_id,
            'test_id'=> $test_id,
            
    ]);

    $total_answer_count = 0;
    if(!empty($questions))
    {
        foreach($questions as $quest){
            $answer = get_mark($saved_answers, $quest->id);
            if(trim($answer) == 1){
                $total_answer_count++;
            }
        }
    }
    if($total_answer_count > 0)
    {
        $total_questions = count($questions);
        return round(($total_answer_count / $total_questions) * 100);
    }

    return 0;
}


function get_to_mark_count()
{
   
    $tests = new Tests_model();
    if(Auth::access('admin')){ 
       //nested querry
       $arr['school_id'] = Auth::getSchool_id();
         $query = "select * from answered_test where test_id IN (select test_id from tests where school_id = :school_id) && submitted = 1 && marked = 0";
         
         $to_mark = $tests->query($query,$arr);
        
     }else{
        

    //$mytable = "class_lecturers";
    $arr['user_id'] = Auth::getUser_id();  

    $query = "select * from answered_test where test_id in (select test_id from tests where class_id IN (SELECT class_id FROM `class_lecturers` WHERE user_id = :user_id)) && submitted = 1 && marked = 0";
    $to_mark = $tests->query($query,$arr);
    
}
    

    return count($to_mark); 
}

//return unsubmitted test on the test nav
function get_unsubmitted_tests(){
    if(Auth::getRank() == "student"){

        $tests_class = new Tests_model();
        $query = "select id from tests where class_id in (select class_id from class_students where user_id = :user_id) and test_id not in (SELECT test_id FROM answered_test where user_id = :user_id && submitted = 1) && disabled = 0";
        $data = $tests_class->query($query,['user_id'=>Auth::getUser_id()]);

        if($data){
            return count($data);
        }
            
    }

    return 0; 
}

//return unsubmitted test on the test row
function get_unsubmitted_tests_row(){
    if(Auth::getRank() == "student"){

        $tests_class = new Tests_model();
        $query = "select test_id from tests where class_id in (select class_id from class_students where user_id = :user_id) and test_id not in (SELECT test_id FROM answered_test where user_id = :user_id && submitted = 1)";
        $data = $tests_class->query($query,['user_id'=>Auth::getUser_id()]);

        if($data){
            return array_column($data, 'test_id');
        }
            
    }

    return [];
    
}

function get_submitted_tests_row(){
    if(Auth::getRank() == "student"){

        $tests_class = new Tests_model();
        $query = "select test_id from tests where class_id in (select class_id from class_students where user_id = :user_id) and test_id not in (SELECT test_id FROM answered_test where user_id = :user_id && submitted = 0)";
        $data = $tests_class->query($query,['user_id'=>Auth::getUser_id()]);

        if($data){
            return array_column($data, 'test_id');
        }
            
    }

    return [];
    
}

function get_years(){
    $arr = array();
    $db = new Database();
    $query = "select date from classes order by id asc limit 1";
    $row = $db->query($query);

    if($row){
        $year = date("Y",strtotime($row[0]->date));
        $arr[] = $year;
        $current_year = date("Y",time());

        while($year < $current_year){
            $year += 1;
            $arr[] = $year;
        }
    }else{
        $arr[] = date("Y",time());
    }
    rsort($arr);
    return $arr;
}


switch_year();
function switch_year(){
    if(!isset($_SESSION['USER']))
    {
        $_SESSION['USER'] = (object)[];
        $_SESSION['USER']->year = date("Y",time());
    }

    if(!empty($_GET['school_year'])){
        $year = (int)$_GET['school_year'];
        $_SESSION['USER']->year = $year;
        
    }
}

function add_get_vars(){
    $text = '';
    if(!empty($_GET))
    {
        foreach($_GET as $key => $value){
            if($key != "url"){
                $text .= "<input type='hidden' name='$key' value='$value' />";
            }
        }
    }
    return $text;
}

// function get_class_student_count()
// {
   
    
//     if(Auth::access('teacher')){ 
//        //nested querry
//        $student_count = new Students_model();
//        //$classes = new CLasses_model();
//       // $query = "select * from class_students where class_id = :class_id && disabled = 0 ";
//        $query ="SELECT class_id FROM class_students where class_id in (SELECT class_id FROM classes)";
       
//        $data =  $student_count->query($query,['class_id'=>Auth::getClass_id()]);
       
        
//    } 
  
//     if($data ){
//         return count($data ); 
//     }else{
//         return 0; 
//     }
// }


// switch_year();
// function switch_year(){
//     if(!isset($_SESSION['USER']))
//     {
//         $_SESSION['USER'] = (object)[];
//     }

//     if(!empty($_GET['school_year'])){
//         $year = (int)$_GET['school_year'];
//         $_SESSION['USER']->year = $year;
        
//     } 
// }