<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller {
    public function index()  {
        $data = array();
            $this->data['temp'] = 'admin/home/index';
            $this->load->view('admin/main',$this->data);
    }
}
