<!doctype html>
<html lang="en">
    <head>
        <?php $this->load->view('site/head');?>
    </head>
<body>
    <a href="#" id="back_to_top">
        <img src="<?php print public_url()?>/site/images/top.png">
    </a>
    <div class="wraper">
        <div class="header">
            <?php $this->load->view('site/header');?>
        </div>
        <div id="container">
            <div class="left">
                 <?php $this->load->view('site/left');?>
            </div>
            <div class="content">
                <?php
                    if(isset($temp)){
                        $this->load->view($temp);
                    }                
                ?>
            </div>
            <div class="right">
                <?php $this->load->view('site/right');?>
            </div>
            <div class="clear"> </div>
        </div>
        <center>
			<img src="<?php print public_url()?>/site/images/bank.png"> 
        </center>
        <div class="footer">
            <?php $this->load->view('site/footer');?>
        </div>
    </div>
</body>
</html>