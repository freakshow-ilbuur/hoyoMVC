<?php
class Pages extends Controller {
    public function __construct(){
     
    }
    public function about (){
        
        $this->view('pages/index');
    }
    public function index()
    {
        
        $data = array(
            'title'=>'Framework Works'
        );
        $this->view('pages/index',$data);
    }
}