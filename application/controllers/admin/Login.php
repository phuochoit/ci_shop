<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller {
    public function index()  {
        $data = array();
            $data['temp'] = 'admin/login/index';
            $this->load->view('admin/login/index',$data);
    }
}
