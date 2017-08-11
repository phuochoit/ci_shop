<?php
    if(!function_exists('admin_url')){
        function admin_url($url = ''){
            return base_url('admin/'.$url);
        }
    }
?>