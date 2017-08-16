<?php $this->load->view('admin/news/head', $this->data)?>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Thêm mới Tin Tức</h6>
        </div>
        <form id="form" class="form" action="" method="post" enctype="multipart/form-data">
           <fieldset>
                <div class="formRow">
                    <label class="formLeft" for="param_title">Tên:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="title" id="param_title" _autocheck="true" type="text" value=""></span>
                        <span name="title_autocheck" class="autocheck"></span>
                        <div name="title_error" class="clear error"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                    <div class="formRight">
                        <div class="left"><input type="file" id="image_link" name="image_link"></div>
                        <div name="image_error" class="clear error"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_intro">Mô tả:</label>
                    <div class="formRight">
                        <span class="oneTwo"><textarea name="intro" id="param_intro" rows="4" cols=""></textarea></span>
                        <span name="intro_autocheck" class="autocheck"></span>
                        <div name="intro_error" class="clear error"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="formRow">
                    <label class="formLeft" for="param_site_title">Title:</label>
                    <div class="formRight">
                        <span class="oneTwo"><textarea name="site_title" id="param_site_title" rows="4" cols=""></textarea></span>
                        <span name="site_title_autocheck" class="autocheck"></span>
                        <div name="site_title_error" class="clear error"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_meta_desc">Meta description:</label>
                    <div class="formRight">
                        <span class="oneTwo"><textarea name="meta_desc" id="param_meta_desc" rows="4" cols=""></textarea></span>
                        <span name="meta_desc_autocheck" class="autocheck"></span>
                        <div name="meta_desc_error" class="clear error"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_meta_key">Meta keywords:</label>
                    <div class="formRight">
                        <span class="oneTwo"><textarea name="sale" id="param_meta_key" rows="4" cols=""></textarea></span>
                        <span name="meta_key_autocheck" class="autocheck"></span>
                        <div name="meta_key_error" class="clear error"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft">Nội dung:</label>
                    <div class="formRight">
                        <textarea name="content" id="param_content" class="editor"></textarea>
                        <div name="content_error" class="clear error"></div>
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
