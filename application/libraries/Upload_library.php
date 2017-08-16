<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_library
{
    var $CI = '';
    function __construct()
    {
        $this->CI = & get_instance();
    }

    /*
    * upload singel file
    * $upload_path : path file
    * $file_name : name file upload
    */
    public function upload($upload_path = '', $file_name)
    {
        $config = $this->config($upload_path);
        $this->CI->load->library('upload', $config);
        
        // load upload library
        if ($this->CI->upload->do_upload($file_name)) {
            $data = $this->CI->upload->data();
        } else {
            $data = $this->CI->upload->display_errors();
        }
        
        return $data;
    }

     /*
     * upload multifield
    * $upload_path : path file
    * $file_name : name file upload
    */
    public function upload_multifield($upload_path = '', $file_name)
    {
        $config = $this->config($upload_path);
        $this->CI->load->library('upload', $config);
        // save file data
        $file  = $_FILES[$file_name];
        $count = count($file['name']);
        $arr_list = array();

        for ($i=0; $i<=$count-1; $i++) {
            $_FILES['userfile']['name']     = $file['name'][$i];  
            $_FILES['userfile']['type']     = $file['type'][$i]; 
            $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i]; 
            $_FILES['userfile']['error']    = $file['error'][$i]; 
            $_FILES['userfile']['size']     = $file['size'][$i]; 
            // load upload library
            $this->CI->load->library('upload', $config);

            if ($this->CI->upload->do_upload()) {
                $data = $this->CI->upload->data();
                $arr_list[$i] = $data['file_name'];
            }
        }

        return $arr_list;
    }

    /*
    * path file
    */
    public function config($upload_path = '')
    {
        //Khai bao bien cau hinh
        $config = array();
        //thuc mục chứa file
        $config['upload_path']   = $upload_path;
        //Định dạng file được phép tải
        $config['allowed_types'] = 'jpg|png|gif';
        //Dung lượng tối đa
        $config['max_size']      = '5000';
        //Chiều rộng tối đa
        // $config['max_width']     = '1028';
        //Chiều cao tối đa
        // $config['max_height']    = '1028';

        return $config;
    }
}
