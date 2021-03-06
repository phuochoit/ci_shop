<?php defined('BASEPATH') or exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    public $data = array();
    
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

        $controller = $this->uri->segment(1);

        switch ($controller) {
            case 'admin':{
                // is admin
                $this->load->helper('admin');
                $this->__check_login();
                break;
            }
            default:
            {
                // is use
                break;
            }
        }
    }

    private function __check_login()
    {
        $controller = $this->uri->rsegment(1);
        $controller = strtolower($controller);
        $login = $this->session->userdata('login');
        if (!$login && $controller != 'login') {
            redirect(admin_url('login'));
        }

        if($login && $controller == 'login'){
             redirect(admin_url('admin'));
        }
    }
}
