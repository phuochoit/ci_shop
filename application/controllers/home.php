<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Home extends MY_Controller {
        public function index(){
            $data = array();
            $data['temp'] = 'site/home/index';
            $this->load->view('site/layout',$data);
        }
    }
?>