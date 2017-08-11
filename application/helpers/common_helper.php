<?php
    if(!function_exists('public_url')){
        function public_url($url = ''){
            return base_url('public'.$url);
        }
    }
    
?>