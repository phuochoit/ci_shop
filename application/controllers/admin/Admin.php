<?php defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }
    // default page
    public function index()
    {
        $input = array();
        //get list admin
        $list = $this->admin_model->get_list();
        $this->data['list'] = $list;

        // get total admin
        $total = $this->admin_model->get_total();
        $this->data['total'] = $total;

        // get message by session
        $messages = $this->session->flashdata('message');
        $this->data['messages'] = $messages;

        $this->data['temp'] = 'admin/admin/index';
        $this->load->view('admin/main', $this->data);
    }

    // check your name
    public function check_username()
    {
        $username = $this->input->post('username');
        $where = array('username' => $username );

        if($this->admin_model->check_exists($where)){
            $this->form_validation->set_message(__FUNCTION__ ,'Username Already exists');
            return false;
        }else{
            return true;
        }
    }

    
    // add admin
    public function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        // check post value
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
            $this->form_validation->set_rules('username', 'Tài Khoản Đăng Nhập', 'required|callback_check_username');
            $this->form_validation->set_rules('password', 'Mật Khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập Lại Mật Khẩu', 'required|matches[password]');
            // check validation
            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $username = $this->input->post('username');
                $password = $this->input->post('re_password');
                $data = array(
                    'name' => $name,
                    'username' => $username,
                    'password' => md5($password) ,
                );
                // set data to database
                if($this->admin_model->create($data)){
                    // set message
                    $this->session->set_flashdata('message', 'Add new success!');
                }else{
                    $this->session->set_flashdata('message', 'Add new failed!');
                }
                // redirect page
                redirect(admin_url('admin'));
            }
        }
        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/main', $this->data);
    }

    // edit admin
    public function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');


        //get id edit admin 
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        // get info admin
        $info = $this->admin_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message', 'This Admin does not exist!');
            redirect(admin_url('admin'));
        }
        $this->data['info'] = $info;

        // check post value
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
            $this->form_validation->set_rules('username', 'Tài Khoản Đăng Nhập', 'required|callback_check_username');
            // check value password
            if($this->input->post('password')){
                $this->form_validation->set_rules('password', 'Mật Khẩu', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Nhập Lại Mật Khẩu', 'required|matches[password]');
            }
            // check validation
            if($this->form_validation->run()){
                $name = $this->input->post('name');
                $username = $this->input->post('username');
                $data = array(
                    'name' => $name,
                    'username' => $username,
                );
                // check value password
                if($this->input->post('password')){
                    $data['password'] = md5($this->input->post('re_password'));
                }

                // set data to database
                if($this->admin_model->update($id,$data)){
                    // set message
                    $this->session->set_flashdata('message', 'Upadte Admin success!');
                }else{
                    $this->session->set_flashdata('message', 'Upadte Admin failed!');
                }
                // redirect page admin/index
                redirect(admin_url('admin'));

            }
        }
        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/main', $this->data);

    }

    // delete data 
    public function delete()
    {
        //get id delete admin 
        $id = $this->uri->rsegment(3);
        $id = intval($id);

        // get info admin
        $info = $this->admin_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message', 'This Admin does not exist!');
            redirect(admin_url('admin'));
        }

        // run delete
        if($this->admin_model->delete($id)){
             // set message
            $this->session->set_flashdata('message', 'Delete Admin success!');
        }else{
            $this->session->set_flashdata('message', 'Upadte Admin failed!');
        }

        // redirect page admin/index
        redirect(admin_url('admin'));
        
    }
}
