<?php
//statistics controller

class Statistics extends controller
{
    function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $user = new User();
        $school_id = Auth::getschool_id();

        $query = "select * from users where school_id = :school_id && rank in ('student') order by id desc ";
        $arr['school_id'] = $school_id;
        
        $data = $user->query($query,$arr);
        
        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['students', 'students'];
        if(Auth::access('reception')){ 
          $this->view('statistics',[
            'rows'=>$data,
            'crumbs'=>$crumbs,
            
        ]);

        }else{
         $this->view('access-denied');
        }
    }
    
}


