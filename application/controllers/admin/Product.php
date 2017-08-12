<?php defined('BASEPATH') or exit('No direct script access allowed');
class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }

    // get list catalog
    public function index()
    {
        $this->load->library('pagination');
        
        // get all total rows
        $total_rows = $this->product_model->get_total();
        $this->data['total_rows'] = $total_rows;

        // pagination CI
        $config = array();
        $config['total_rows'] = $total_rows;
        $config['base_url']    = admin_url('product/index');
        $config['per_page']    = 10;
        $config['uri_segment'] = 4;
        $config['next_link']   = "Trang ke tiep";
        $config['prev_link']   = "Trang truoc";

        // create pagination
        $this->pagination->initialize($config);
        $segment = $this->uri->rsegment(4);
        $segment = intval($segment);

        // get data product
        $input = array();
        $input['limit'] = array($config['per_page'],$segment);
        $field = array('id','name','price','discount','created','image_link','buyed','view');
        // check serach prodcut
        $input['where'] = array();
        $id = intval($this->input->get('id'));
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }

        $name = $this->input->get('name');
        if($name)
        {
            $input['like'] = array('name',$name);
        }

        $catalog = intval($this->input->get('catalog'));
        if($catalog > 0)
        {
            $input['where']['catalog_id'] = $catalog;
        }

        $list = $this->product_model->get_list_multiple_field($input, $field);
        $this->data['list'] = $list;
        


        // get all catalog
        $this->load->model('catalog_model');
        $input['where'] = array('parent_id' => 0);
        $catalog = $this->catalog_model->get_list_multiple_field($input, array('id','name'));
        foreach ($catalog as $k => $val) {
            $input['where'] = array('parent_id' => $val->id);
            $subs = $this->catalog_model->get_list_multiple_field($input, array('id','name'));
            $val->subs = $subs;
        }
        $this->data['catalog'] = $catalog;

        // get message by session
        $messages = $this->session->flashdata('message');
        $this->data['messages'] = $messages;

        // load view
        $this->data['temp'] = 'admin/product/index';
        $this->load->view('admin/main', $this->data);
    }
}
