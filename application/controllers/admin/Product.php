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
        if ($id > 0) {
            $input['where']['id'] = $id;
        }

        $name = $this->input->get('name');
        if ($name) {
            $input['like'] = array('name',$name);
        }

        $catalog = intval($this->input->get('catalog'));
        if ($catalog > 0) {
            $input['where']['catalog_id'] = $catalog;
        }

        $list = $this->product_model->get_list_multiple_field($input, $field);
        $this->data['list'] = $list;
        
        // get all catalog
        $catalog = $this->__get_all_catalog();
        $this->data['catalog'] = $catalog;

        // get message by session
        $messages = $this->session->flashdata('message');
        $this->data['messages'] = $messages;

        // load view
        $this->data['temp'] = 'admin/product/index';
        $this->load->view('admin/main', $this->data);
    }
    /*
    * add product
    */
    public function add()
    {
        // load library and helper
        $this->load->library('form_validation');
        $this->load->helper('form');

        // check post value
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');
            $this->form_validation->set_rules('catalog', 'Danh Mục', 'required');

            // check validation
            if ($this->form_validation->run()) {
                $upload_path = './upload/product';
                $this->load->library('upload_library');

                // upload image_link
                $upload_data = $this->upload_library->upload($upload_path, 'image_link');
                $image_link = '';
                if (isset($upload_data['file_name'])) {
                    $image_link = $upload_data['file_name'];
                }

                // upload image_list
                $image_list = array();
                $image_list = $this->upload_library->upload_multifield($upload_path, 'image_list');
                $image_list = json_encode($image_list);
                $date = new DateTime();

                // get data by input
                $data = array(
                    'name'          => $this->input->post('name'),
                    'catalog_id'    => $this->input->post('catalog'),
                    'price'         => str_replace(",", "", $this->input->post('price')),
                    'image_link'    => $image_link ,
                    'image_list'    => $image_list ,
                    'discount'      => $this->input->post('discount') ,
                    'warranty'      => $this->input->post('warranty') ,
                    'gifts'         => $this->input->post('gifts'),
                    'content'       => $this->input->post('content') ,
                    'meta_key'      => $this->input->post('meta_key') ,
                    'site_title'    => $this->input->post('site_title') ,
                    'meta_desc'     => $this->input->post('meta_desc') ,
                    'created'       => $date->getTimestamp() ,
                );
                // set data to database
                if ($this->product_model->create($data)) {
                    // set message
                        $this->session->set_flashdata('message', 'Add new success!');
                } else {
                        $this->session->set_flashdata('message', 'Add new failed!');
                }
                // redirect page
                redirect(admin_url('product'));
            }
        }

        // get all catalog
        $catalog = $this->__get_all_catalog();
        $this->data['catalog'] = $catalog;

        // load view
        $this->data['temp'] = 'admin/product/add';
        $this->load->view('admin/main', $this->data);
    }

    /*
    * edit product
    */
    public function edit()
    {
        // load library and helper
        $this->load->library('form_validation');
        $this->load->helper('form');

        // check id product
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $info = $this->product_model->get_info($id);
        if (!$info) {
            $this->session->set_flashdata('message', 'This Product does not exist!');
            redirect(admin_url('product'));
        }
        $this->data['info'] = $info;
        // check post value
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');
            $this->form_validation->set_rules('catalog', 'Danh Mục', 'required');

            // check validation
            if ($this->form_validation->run()) {
                $upload_path = './upload/product';
                $this->load->library('upload_library');

                // upload image_link
                $upload_data = $this->upload_library->upload($upload_path, 'image_link');
                $image_link = '';
                if (isset($upload_data['file_name'])) {
                    $image_link = $upload_data['file_name'];
                }
                if (!empty($image_link)) {
                    $data['image_link'] = $image_link;
                }

                // upload image_list
                $image_list = array();
                $image_list = $this->upload_library->upload_multifield($upload_path, 'image_list');
                if (!empty($image_list)) {
                    $data['image_list'] = json_encode($image_list);
                }

                // get data by input
                $data = array(
                    'name'          => $this->input->post('name'),
                    'catalog_id'    => $this->input->post('catalog'),
                    'price'         => str_replace(",", "", $this->input->post('price')),
                    'discount'      => $this->input->post('discount') ,
                    'warranty'      => $this->input->post('warranty') ,
                    'gifts'         => $this->input->post('gifts'),
                    'content'       => $this->input->post('content') ,
                    'meta_key'      => $this->input->post('meta_key') ,
                    'site_title'    => $this->input->post('site_title') ,
                    'meta_desc'     => $this->input->post('meta_desc')
                );
        
                // set data to database
                if ($this->product_model->update($id, $data)) {
                    // set message
                    $this->session->set_flashdata('message', 'Update product success!');
                } else {
                    $this->session->set_flashdata('message', 'Update product failed!');
                }
                // redirect page
                redirect(admin_url('product'));
            }
        }

        // get all catalog
        $catalog = $this->__get_all_catalog();
        $this->data['catalog'] = $catalog;

        // load view
        $this->data['temp'] = 'admin/product/edit';
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
        redirect(admin_url('product'));
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
    
    /*
    * delete product
    */
    private function __del($id,$redirect = true)
    {
        // get info admin
        $info = $this->product_model->get_info($id);
        if (!$info) {
            $this->session->set_flashdata('message', 'This Product does not exist!');
            if($redirect){
                redirect(admin_url('product'));
            }else{
                return false;
            }
            
        }
        
        // run delete$this->__del($id);
        if ($this->product_model->delete($id)) {
             // set message
            $this->session->set_flashdata('message', 'Delete Product success!');
        } else {
            $this->session->set_flashdata('message', 'Upadte Product failed!');
        }
        
        // delete image
        $image_path = './upload/product/';
        $image_link = $image_path.$info->image_link;
        if (file_exists($image_link)) {
            unlink($image_link);
        }

        if (!empty($info->image_list)) {
             $image_list = json_decode($info->image_list);
            foreach ($image_list as $k => $v) {
                $image_link = $image_path.$v;
                if (file_exists($image_link)) {
                    unlink($image_link);
                }
            }
        }
    }
    // get all catalog
    public function __get_all_catalog()
    {
        $this->load->model('catalog_model');
        $input['where'] = array('parent_id' => 0);
        $catalog = $this->catalog_model->get_list_multiple_field($input, array('id','name'));
        foreach ($catalog as $k => $val) {
            $input['where'] = array('parent_id' => $val->id);
            $subs = $this->catalog_model->get_list_multiple_field($input, array('id','name'));
            $val->subs = $subs;
        }
        return $catalog;
    }
}
