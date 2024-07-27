<?php
//login controller

class Login extends controller
{
    function index()
    {
        $errors = array();
        
        if(count($_POST) > 0)
        {
            $user = new User();
            if($row = $user->where('email', $_POST['email']))
            {
                $row = $row[0];
                if(password_verify($_POST['password'], $row->password))
                {
                    $school = new School();
                    $school_row = $school->first('school_id', $row->school_id);
                    $row->school_name = $school_row->school;
                    Auth::authenticate($row);
                    $this->redirect('home');
                }
                
            } 
                $errors['email'] = "wrong email or pasword";
            
        }
          $this->view('login',['errors'=>$errors]);
    }
    
}