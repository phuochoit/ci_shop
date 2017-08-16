<?php defined('BASEPATH') or exit('No direct script access allowed');
class News extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
    }

    // get list catalog
    public function index()
    {
        // get all catalog
        $list = $this->news_model->get_list();
        $this->data['list'] = $list;

        // get message by session
        $messages = $this->session->flashdata('message');
        $this->data['messages'] = $messages;

        // load view
        $this->data['temp'] = 'admin/news/index';
        $this->load->view('admin/main', $this->data);
    }

    public function add()
    {
        // load library and helper
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        // load view
        $this->data['temp'] = 'admin/news/add';
        $this->load->view('admin/main', $this->data);
    }
}