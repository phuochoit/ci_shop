<?php $this->load->view('admin/admin/head', $this->data)?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Thêm mới Quản Trị Viên</h6>
        </div>
        <form id="form" class="form" action="" method="post" enctype="multipart/form-data">
           <fieldset>
                <div class="formRow">
                    <label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="name" id="param_name" _autocheck="true" type="text" value="<?php print set_value('name')?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php print form_error('name');?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_username">User Name:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="username" id="param_username" _autocheck="true" type="text" value="<?php print set_value('username')?>">
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php print form_error('username');?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_password">Mật Khẩu:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="password" id="param_password" _autocheck="true" type="password">
                        </span>
                       
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php print form_error('password');?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_re_password">Nhập Lại Mật Khẩu:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="re_password" id="param_re_password" _autocheck="true" type="password"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php print form_error('re_password');?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formSubmit">
                    <input value="Thêm mới" class="redB" type="submit">
                </div>
            </fieldset>
        </form>
    </div>
</div>