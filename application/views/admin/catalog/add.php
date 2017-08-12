<?php $this->load->view('admin/catalog/head', $this->data)?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Thêm mới Danh Mục Sản Phẩm</h6>
        </div>
        <form id="form" class="form" action="" method="post" enctype="multipart/form-data">
           <fieldset>
                <div class="formRow">
                    <label class="formLeft" for="param_name">Tên Danh Mục:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="name" id="param_name" _autocheck="true" type="text" value="<?php print set_value('name')?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php print form_error('name');?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_sort_order">Thự Tự Hiển Thị:</label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="sort_order" id="param_sort_order" _autocheck="true" type="text" value="<?php print set_value('sort_order')?>"></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php print form_error('sort_order');?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_parent_id">Danh Mục Cha:</label>
                    <div class="formRight">
                        <select name="parent_id" _autocheck="true" id="param_parent_id" class="left">
                            <option value="0">Lựa chọn danh mục</option>
                            <?php foreach ($list as $k => $val) : ?>
                                 <option value="<?php print $val->id;?>"><?php print $val->name;?></option> 
                            <?php endforeach;?>
					    </select>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php print form_error('parent_id');?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_site_title">Seo Tiêu Đề:</label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="site_title" id="param_ssite_title" _autocheck="true" type="text" value="<?php print set_value('site_title')?>">
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php print form_error('site_title');?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_meta_desc">Seo Mô Tả:</label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <textarea name="meta_desc" id="meta_desc" rows="4" cols=""><?php print set_value('meta_desc')?></textarea>
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php print form_error('meta_desc');?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_meta_key">Seo Meta Key:</label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <textarea name="meta_key" id="meta_key" rows="4" cols=""><?php print set_value('meta_key')?></textarea>
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php print form_error('meta_key');?></div>
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