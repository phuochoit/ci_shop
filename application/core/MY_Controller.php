<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller 
{
    public $data = array();
    
    public function __construct() 
    {
        parent::__construct();
        // Your own constructor code

        $controller = $this->uri->segment(1);

        switch($controller)
        {
            case 'admin':{
                // is admin
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
        # code...
    }
}
