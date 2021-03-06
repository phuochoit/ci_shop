<?php $this->load->view('admin/product/head', $this->data)?>
<div class="wrapper">
	<!-- Form -->
	<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img src="<?php print public_url('/admin/')?>images/icons/dark/add.png" class="titleIcon">
					<h6>Cập nhật Sản phẩm</h6>
				</div>
				<ul class="tabs">
					<li><a href="#tab1">Thông tin chung</a></li>
					<li><a href="#tab2">SEO Onpage</a></li>
					<li><a href="#tab3">Bài viết</a></li>
				</ul>
				<div class="tab_container">
					<div id="tab1" class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo">
                                    <input name="name" id="param_name" _autocheck="true" type="text" value="<?php print $info->name;?>">
                                </span>
								<span name="name_autocheck" class="autocheck"></span>
								<div name="name_error" class="clear error"><?php print form_error('name');?></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
							<div class="formRight">
								<div class="left">
                                    <input id="image_link" name="image_link" type="file">
                                    
                                </div>
                                <div class="view_image" style="width: 100%;float: left; margin-top: 10px;">
                                    <img src="<?php print base_url('upload/product/'.$info->image_link);?>" alt="" style="height:50px;"/>
                                </div>
								<div name="image_error" class="clear error"><?php print form_error('image_link');?></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label class="formLeft">Ảnh kèm theo:</label>
							<div class="formRight">
								<div class="left">
                                    <input id="image_list" name="image_list[]" multiple="" type="file">
                                </div>
                                <div class="view_image" style="width: 100%;float: left; margin-top: 10px;">
									<?php if(!empty($image_list)):?>
                                    <?php $image_list = json_decode($info->image_list);?>
                                    <?php foreach ($image_list as $key => $val) :?>
                                        <img src="<?php print base_url('upload/product/'.$val);?>" alt="" style="height:50px; float:left;margin-right:10px;"/>
									<?php endforeach;?>
									<?php endif;?>
                                </div>
								<div name="image_list_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
						<!-- Price -->
						<div class="formRow">
							<label class="formLeft" for="param_price">
							Giá :
							<span class="req">*</span>
							</label>
							<div class="formRight">
								<span class="oneTwo">
								    <input name="price" style="width:100px" id="param_price" class="format_number" _autocheck="true" type="text" value="<?php print $info->price;?>">
								    <img class="tipS" title="Giá bán sử dụng để giao dịch" style="margin-bottom:-8px" src="<?php print public_url('/admin/')?>crown/images/icons/notifications/information.png">
								</span>
								<span name="price_autocheck" class="autocheck"></span>
								<div name="price_error" class="clear error"><?php print form_error('price');?></div>
							</div>
							<div class="clear"></div>
						</div>
						<!-- Price -->
						<div class="formRow">
							<label class="formLeft" for="param_discount">
							Giảm giá (%) 
							<span></span>:
							</label>
							<div class="formRight">
								<span>
								    <input name="discount" style="width:100px" id="param_discount" class="format_number" type="text" value="<?php print $info->discount;?>">
								    <img class="tipS" title="Phần trăm giảm giá" style="margin-bottom:-8px" src="<?php print public_url('/admin/')?>crown/images/icons/notifications/information.png">
								</span>
								<span name="discount_autocheck" class="autocheck"></span>
								<div name="discount_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label class="formLeft" for="param_catalog">Thể loại:<span class="req">*</span></label>
							<div class="formRight">
								<select name="catalog" _autocheck="true" id="param_catalog" class="left">
									<option value="">Lựa chọn danh mục</option>
                                    <?php foreach ($catalog as $k => $val) :?>
                                    <?php if (count($val->subs) > 1) :?>
									<optgroup label="<?php print $val->name;?>">
										<?php foreach ($val->subs as $ks => $vals) :?>
                                            <option value="<?php print $vals->id;?>" <?php print ($vals->id == $info->catalog_id) ? 'selected' : '';?>> <?php print $vals->name;?></option>
                                        <?php endforeach;?>
                                    </optgroup>
                                    <?php else :?>
                                        <option value="<?php print $val->id;?>" <?php print ($vals->id == $info->catalog_id) ? 'selected' : '';?>><?php print $val->name;?> </option>
                                    <?php endif;?>
                                    <?php endforeach;?>
								</select>
								<span name="catalog_autocheck" class="autocheck"></span>
								<div name="catalog_error" class="clear error"><?php print form_error('catalog');?></div>
							</div>
							<div class="clear"></div>
						</div>
						<!-- warranty -->
						<div class="formRow">
							<label class="formLeft" for="param_warranty">
							Bảo hành :
							</label>
							<div class="formRight">
								<span class="oneFour">
                                    <input name="warranty" id="param_warranty" type="text" value="<?php print $info->warranty;?>">
                                </span>
								<span name="warranty_autocheck" class="autocheck"></span>
								<div name="warranty_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label class="formLeft" for="param_gifts">Tặng quà:</label>
							<div class="formRight">
								<span class="oneTwo">
                                    <textarea name="gifts" id="param_gifts" rows="4" cols=""><?php print $info->gifts;?></textarea>
                                </span>
								<span name="gifts_autocheck" class="autocheck"></span>
								<div name="gifts_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow hide"></div>
					</div>
					<div id="tab2" class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft" for="param_site_title">Title:</label>
							<div class="formRight">
								<span class="oneTwo">
                                    <textarea name="site_title" id="param_site_title" _autocheck="true" rows="4" cols=""><?php print $info->site_title;?></textarea>
                                </span>
								<span name="site_title_autocheck" class="autocheck"></span>
								<div name="site_title_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">Meta description:</label>
							<div class="formRight">
								<span class="oneTwo">
                                    <textarea name="meta_desc" id="param_meta_desc" _autocheck="true" rows="4" cols=""><?php print $info->meta_desc;?></textarea>
                                </span>
								<span name="meta_desc_autocheck" class="autocheck"></span>
								<div name="meta_desc_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label class="formLeft" for="param_meta_key">Meta keywords:</label>
							<div class="formRight">
								<span class="oneTwo">
                                    <textarea name="meta_key" id="param_meta_key" _autocheck="true" rows="4" cols=""><?php print $info->meta_key;?></textarea>
                                </span>
								<span name="meta_key_autocheck" class="autocheck"></span>
								<div name="meta_key_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow hide"></div>
					</div>
					<div id="tab3" class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft">Nội dung:</label>
							<div class="formRight">
								<textarea name="content" id="param_content" class="editor">
                                    <?php print $info->content;?>
                                </textarea>
								<div name="content_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow hide"></div>
					</div>
				</div>
				<!-- End tab_container-->
				<div class="formSubmit">
					<input value="Cập Nhật" class="redB" type="submit">
					<input value="Hủy bỏ" class="basic" type="reset">
				</div>
				<div class="clear"></div>
			</div>
		</fieldset>
	</form>
</div>
