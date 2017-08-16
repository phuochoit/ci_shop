<?php defined('BASEPATH') or exit('No direct script access allowed');
class Catalog extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('catalog_model');
    }

    // get list catalog
    public function index()
    {
        // get all catalog
        $list = $this->catalog_model->get_list();
        $this->data['list'] = $list;

        // get message by session
        $messages = $this->session->flashdata('message');
        $this->data['messages'] = $messages;

        // load view
        $this->data['temp'] = 'admin/catalog/index';
        $this->load->view('admin/main', $this->data);
    }

    // add new catalog
    public function add()
    {
        // load library and helper
        $this->load->library('form_validation');
        $this->load->helper('form');

        // check post value
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            // check validation
            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $site_title = $this->input->post('site_title');
                $meta_desc = $this->input->post('meta_desc');
                $meta_key = $this->input->post('meta_key');
                $sort_order = $this->input->post('sort_order');
                $parent_id = $this->input->post('parent_id');
                // get data by input
                $data = array(
                'name' => $name,
                'site_title' => $site_title,
                'meta_desc' => $meta_desc ,
                'meta_key' => $meta_key ,
                'sort_order' => intval($sort_order) ,
                'parent_id' => intval($parent_id) ,
                );
                // set data to database
                if ($this->catalog_model->create($data)) {
                    // set message
                        $this->session->set_flashdata('message', 'Add new success!');
                } else {
                        $this->session->set_flashdata('message', 'Add new failed!');
                }
                // redirect page
                redirect(admin_url('catalog'));
            }
        }
        
        // get data by parent_id
        $input['where'] = array('parent_id' => 0);
        $input['order'] = array('id','DESC');
        $list = $this->catalog_model->get_list_multiple_field($input, array('id','name'));
        $this->data['list'] = $list;

        // load view
        $this->data['temp'] = 'admin/catalog/add';
        $this->load->view('admin/main', $this->data);
    }

    // edit admin
    public function edit()
    {
        // load library and helper
        $this->load->library('form_validation');
        $this->load->helper('form');

        //get id edit admin
        $id = $this->uri->rsegment(3);
        $id = intval($id);

        // get info admin
        $info = $this->catalog_model->get_info($id);
        if (!$info) {
            $this->session->set_flashdata('message', 'This Catalog does not exist!');
            redirect(admin_url('catalog'));
        }
        $this->data['info'] = $info;
        // check post value
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            // check validation
            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $site_title = $this->input->post('site_title');
                $meta_desc = $this->input->post('meta_desc');
                $meta_key = $this->input->post('meta_key');
                $sort_order = $this->input->post('sort_order');
                $parent_id = $this->input->post('parent_id');
                // get data by input
                $data = array(
                    'name' => $name,
                    'site_title' => $site_title,
                    'meta_desc' => $meta_desc ,
                    'meta_key' => $meta_key ,
                    'sort_order' => intval($sort_order) ,
                    'parent_id' => intval($parent_id) ,
                );
                // set data to database
                if ($this->catalog_model->update($id, $data)) {
                    // set message
                        $this->session->set_flashdata('message', 'Update Catalog success!');
                } else {
                        $this->session->set_flashdata('message', 'Update Catalog failed!');
                }
                // redirect page
                redirect(admin_url('catalog'));
            }
        }

        // get data by parent_id
        $input['where'] = array('parent_id' => 0);
        $input['order'] = array('id','DESC');
        $list = $this->catalog_model->get_list_multiple_field($input, array('id','name'));
        $this->data['list'] = $list;

        // load view
        $this->data['temp'] = 'admin/catalog/edit';
        $this->load->view('admin/main', $this->data);
    }

    // delete data  catalog
    public function delete()
    {
        //get id delete catalog
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $this->__del($id);
        // redirect page catalog/index
        redirect(admin_url('catalog'));
    }

    public function delete_all()
    {
        //get id delete catalog
        $id = $this->input->post('ids');
        if (!empty($id)) {
            foreach ($id as $key => $v) {
               $this->__del($v,false);
            }
            
        }
    }

    function __del($id,$redirect = true){
        // get info admin
        $info = $this->catalog_model->get_info($id);
        if (!$info) {
            $this->session->set_flashdata('message', 'This Catalog does not exist!');
            if($redirect){
                 redirect(admin_url('catalog'));
            }else{
                return false;
            }
        }
        // check product of catalog
        $this->load->model('product_model');
        $product = $this->product_model->get_info_rule(array('catalog_id' => $id ),'id');

        if($product){
            
            $this->session->set_flashdata('message', 'Delete Catalog failed '.$info->name.' please delete all product of Catalog !');

            if($redirect){
                 redirect(admin_url('catalog'));
            }else{
                return false;
            }

        }

        // run delete
        if ($this->catalog_model->delete($id)) {
             // set message
            $this->session->set_flashdata('message', 'Delete Catalog success!');
        } else {
            $this->session->set_flashdata('message', 'Upadte Catalog failed!');
        }

    }
}
