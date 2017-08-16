<?php $this->load->view('admin/product/head', $this->data)?>
<div class="wrapper" id="main_product">
    <?php  $this->load->view('admin/message', $this->data);?>
    <div class="widget">
        <div class="title">
            <span class="titleIcon"><input id="titleCheck" name="titleCheck" type="checkbox"></span>
            <h6>
                Danh sách sản phẩm          
            </h6>
            <div class="num f12">Số lượng: <b><?php print $total_rows;?></b></div>
        </div>
        <table class="sTable mTable myTable" id="checkAll" width="100%" cellspacing="0" cellpadding="0">
            <thead class="filter">
                <tr>
                    <td colspan="6">
                        <form class="list_filter form" action="<?php print admin_url('product');?>" method="get">
                            <table width="80%" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td class="label" style="width:40px;">
											<label for="filter_id">Mã số</label>
										</td>
                                        <td class="item">
											<input name="id" id="filter_id" style="width:55px;" type="text" value="<?php print $this->input->get('id');?>">
										</td>
                                        <td class="label" style="width:40px;">
											<label for="filter_id">Tên</label>
										</td>
                                        <td class="item" style="width:155px;">
											<input name="name" value="<?php print $this->input->get('name');?>" id="filter_iname" style="width:155px;" type="text">
										</td>
                                        <td class="label" style="width:60px;">
											<label for="filter_status">Thể loại</label>
										</td>
                                        <td class="item">
                                            <select name="catalog">
                                                <option value=""></option>
                                                <!-- kiem tra danh muc co danh muc con hay khong -->
                                                <?php foreach ($catalog as $k => $val) :?>
                                                <?php if (count($val->subs) > 1) :?>
                                                <optgroup label="<?php print $val->name;?>">
                                                    <?php foreach ($val->subs as $ks => $vals) :?>
                                                        <option value="<?php print $vals->id;?>" <?php print ($vals->id == $this->input->get('catalog')) ? 'selected' : '';?>> <?php print $vals->name;?>     </option>
        
                                                    <?php endforeach;?>
                                                </optgroup>
                                                <?php else :?>
                                                    <option value="<?php print $val->id;?>" <?php print ($val->id == $this->input->get('catalog')) ? 'selected' : '';?>><?php print $val->name;?> </option>

                                                <?php endif;?>
                                                <?php endforeach;?>
                                                <!-- kiem tra danh muc co danh muc con hay khong -->

                                            </select>
                                        </td>
                                        <td style="width:150px">
                                            <input class="button blueB" value="Lọc" type="submit">
                                            <input class="basic" value="Reset" onclick="window.location.href = '<?php print admin_url('product');?>'; " type="reset">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </td>
                </tr>
            </thead>
            <thead>
                <tr>
                    <td style="width:21px;"><img src="<?php print public_url('/admin/')?>images/icons/tableArrows.png"></td>
                    <td style="width:60px;">Mã số</td>
                    <td>Tên</td>
                    <td>Giá</td>
                    <td style="width:75px;">Ngày tạo</td>
                    <td style="width:120px;">Hành động</td>
                </tr>
            </thead>
            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="6">
                        <div class="list_action itemActions">
                            <a href="#submit" id="submit" class="button blueB" url="<?php print admin_url('product/delete_all');?>">
                            <span style="color:white;">Xóa hết</span>
                            </a>
                        </div>
                        <div class="pagination">
                            <?php print $this->pagination->create_links();?>
                        </div>
                    </td>
                </tr>
            </tfoot>
            <tbody class="list_item">
            <?php foreach ($list as $k => $val) :?>
                <tr class="row_<?php print $val->id;?>">
                    <td><input name="id[]" value="<?php print $val->id;?>" type="checkbox"></td>
                    <td class="textC"><?php print $val->id;?></td>
                    <td>
                        <div class="image_thumb">
                            <img src="<?php print base_url('upload/product/'.$val->image_link);?>" height="50">
                            <div class="clear"></div>
                        </div>
                        <a href="#" class="tipS" title="" target="_blank">
                            <b><?php print $val->name;?></b>
                        </a>
                        <div class="f11">Đã bán: <?php print $val->buyed;?> | Xem: <?php print $val->view;?></div>
                    </td>
                    <td class="textR">
                        <?php if ($val->discount > 0) : ?>
                            <?php
                                $discount = ($val->discount * intval($val->price))  / 100;
                                $new_price = $val->price - $discount;  
                            ?>
                            <strong style="color:#f00"><?php print number_format($new_price);?></strong>
                            <p style="text-decoration:line-through"><?php print number_format($val->price);?></p>
                        <?php else :?>
                        <strong style="color:#f00"><?php print number_format($val->price);?></strong>
                        <?php endif;?>
                    </td>
                    <td class="textC">
                        <?php print date("d-j-Y" ,$val->created);?>
                    </td>
                    <td class="option textC">
                        <a href="<?php print admin_url('product/view/'.$val->id);?>" target="_blank" class="tipS" title="Xem chi tiết sản phẩm">
                            <img src="<?php print public_url('/admin/')?>images/icons/color/view.png">
                        </a>
                        <a href="<?php print admin_url('product/edit/'.$val->id);?>" title="Chỉnh sửa" class="tipS">
                            <img src="<?php print public_url('/admin/')?>images/icons/color/edit.png">
                        </a>
                        <a href="<?php print admin_url('product/delete/'.$val->id);?>" title="Xóa" class="tipS verify_action">
                            <img src="<?php print public_url('/admin/')?>images/icons/color/delete.png">
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
