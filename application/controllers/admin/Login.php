<?php defined('BASEPATH') or exit('No direct script access allowed');
class Login extends MY_Controller
{
    public function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if ($this->input->post()) {
                $this->form_validation->set_rules('login', 'Login', 'callback_check_login');
                if($this->form_validation->run()){
                    $this->session->set_userdata('login',true);
                    redirect(admin_url('home'));
                }
        }
        $data = array();
        $data['temp'] = 'admin/login/index';
        $this->load->view('admin/login/index', $data);
    }

    public function check_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->model('admin_model');
        $where = array(
           'username' => $username,
           'password' => md5($password)
        );
        if ($this->admin_model->check_exists($where)) {
            return true;
        }else{
            $this->form_validation->set_message(__FUNCTION__,'The account or password is incorrect!');
            return false;
        }
    }
}
