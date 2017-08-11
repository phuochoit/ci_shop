<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index() {
       $input = array();
       //get list admin
       $list = $this->admin_model->get_list();
       $this->data['list'] = $list;

       // get total admin
       $total = $this->admin_model->get_total();
       $this->data['total'] = $total;
       $this->data['temp'] = 'admin/admin/index';
       $this->load->view('admin/main',$this->data);

    }
}