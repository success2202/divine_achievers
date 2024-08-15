<?php

function get_var($key, $default = ""){
    if(isset($_POST[$key]))
    {
        return $_POST[$key]; 
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
    if(file_exists("../private/views/" . $view . ".inc.php")){
       return("../private/views/" . $view . ".inc.php");
    }else{
        return("../private/views/404.view.php");
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
    $id_str = "'" . implode("','", $class_ids) . "'";
    $query = "select * from tests where class_id in ($id_str)";
    $tests_model = new Tests_model();
    $tests = $tests_model->query($query);

    $my_tests = array_column($tests, 'test_id');
    if(in_array($my_test_id, $my_tests)){
        return true;
    }
   
    return false;
}