<?php $this->load->view('admin/news/head', $this->data)?>

<div class="wrapper">
    <?php  $this->load->view('admin/message', $this->data);?>
    <div class="widget">
    
        <div class="title">
            <span class="titleIcon"><div class="checker" id="uniform-titleCheck"><span><input id="titleCheck" name="titleCheck" style="opacity: 0;" type="checkbox"></span></div></span>
            <h6>Danh sách Sản Phẩm</h6>
            <div class="num f12">Tổng số: <b><?php count($list);?></b></div>
        </div>
        
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
                <tr>
                    <td style="width:10px;"><img src="<?php print public_url('/admin/')?>images/icons/tableArrows.png" /></td>
                    <td style="width:80px;">Mã số</td>
                    <td style="width:100px;">Hình</td>
                    <td>Title</td>
                    <td>Mô tả</td>
                    <td style="width:100px;">Hành động</td>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <td colspan="7">
                         <div class="list_action itemActions">
                                <a href="#submit" id="submit" class="button blueB" url="<?php print admin_url('catalog/delete_all');?>">
                                    <span style='color:white;'>Xóa hết</span>
                                </a>
                         </div>
                            
                         <div class='pagination'>
                                                </div>
                    </td>
                </tr>
            </tfoot>
            
            <tbody  class="list_item">
                <?php foreach ($list as $k => $row) :?>
                <!-- Filter -->
                <tr class="row_<?php print $row->id;?>">
                    <td>
                        <input type="checkbox" name="id[]" value="<?php echo $row->id;?>" />
                    </td>
                    <td class="textC"><?php print $row->id;?></td>
                    <td>
                        <span title="<?php print $row->title;?>" class="tipS"><?php print $row->title;?></span>
                    </td>
                    <td>
                        <div class="image_thumb">
                            <img src="<?php print base_url('upload/news/'.$row->image_link);?>" height="50">
                            <div class="clear"></div>
                        </div>
                    </td>
                    <td>
                        <span title="<?php print $row->intro;?>" class="tipS"><?php print $row->intro;?></span>
                    </td>
                    <td class="option">
                        <a href="<?php print admin_url('news/edit/'.$row->id);?>" title="Chỉnh sửa" class="tipS ">
                            <img src="<?php print public_url('/admin/')?>images/icons/color/edit.png" />
                        </a>
                        <a href="<?php print admin_url('news/delete/'.$row->id);?>" title="Xóa" class="tipS verify_action" >
                            <img src="<?php print public_url('admin/')?>images/icons/color/delete.png" />
                        </a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        
    </div>
</div>