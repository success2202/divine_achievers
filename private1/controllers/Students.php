<?php
//students  controller

class Students extends controller
{
    function index()
    {
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $user = new User();
        $school_id = Auth::getschool_id();

        $limit = 20;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $query = "select * from users where school_id = :school_id && rank in ('student') order by id desc limit $limit offset $offset";
        $arr['school_id'] = $school_id;

        $query2 = "select * from users where school_id = :school_id && rank in ('student')";
        $arr2['school_id'] = $school_id;
        $data2= $user->query($query2,$arr2);
        

        if(isset($_GET['find']))
        {
            $find = '%' . $_GET['find'] . '%';
            $query = "select * from users where school_id = :school_id && rank in ('student') && (firstname like :find || lastname like :find) order by id desc limit $limit offset $offset";
            $arr['find'] = $find; 
        }
        
        $data = $user->query($query,$arr);
        
        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['students', 'students'];
        if(Auth::access('reception')){ 
          $this->view('students',[
            'rows'=>$data,
            'row2'=>$data2,
            'crumbs'=>$crumbs,
            'pager'=>$pager
        ]);

        }else{
         $this->view('access-denied');
        }
    }
    
}


