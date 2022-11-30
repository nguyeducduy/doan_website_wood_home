<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <?php if($this->session->flashdata('success')){ ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php }else if($this->session->flashdata('error')){ ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php }else if($this->session->flashdata('warning')){ ?>
                <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
                </div>
                <?php } ?>
                <div class="col-lg-3">
                    <a href="<?php echo site_url('product/add') ?>" title="" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>  Add Product</a>
                    <a href="<?php echo site_url('product/index'); ?>" title="" class="btn btn-primary">View All</a>
                </div>
                <div class="col-lg-9">
                    <form method="post" action="<?php echo site_url('product/search') ?>">
                    <button type="submit" id="btnSearch" id="btnSearch" class="btn btn-info pull-right"><span class="glyphicon glyphicon-search"></span></button>
                    <input class="form-control pull-right" style="width: 300px;" type="text" name="txtSearch" id="txtSearch" placeholder="Nhập từ khóa" value="<?php //echo $keyword; ?>">
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá Cũ</th>
                        <th>Giá Mới</th>
                        <th>Loại bàn & ghế</th>
                        <th>Thương hiệu</th>
                        <th>loại</th>
                        <th>Số lượng</th>
                        <th>Số lượt xem</th>
                        <th>Ngày tạo</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($info as $key => $val):
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $val['TenSp']; ?></td>
                            <td><img height="100" width="100" src="<?php echo base_url().PATH_IMG_PRODUCT.$val['img_path']; ?>" alt=""></td>
                            <td><?php echo number_format($val['GiaCu'])." VNĐ";; ?></td>
                            <td><?php echo number_format($val['GiaMoi'])." VNĐ"; ?></td>
                            <td><?php echo $val['TenLoai']; ?></td>
                            <td><?php echo $val['ten_nhanhieu']; ?></td>
                            <td><?php echo ($val['sex']==1)?"Bàn":"ghế"; ?></td>
                            <td><?php echo $val['SoLuong']; ?></td>
                            <td><?php echo $val['SoLuotXem']; ?></td>
                            <td><?php echo $val['created_at']; ?></td>
                            <td><a href="<?php echo site_url('product/edit').'?id='.$val['id_sanpham'];?>" title="" class="btn btn-warning">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                            <td><a onclick="deleteProduct(<?php echo $val['id_sanpham']; ?>)" title="" class="btn btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        <?php $i++;  endforeach; ?>
                    </tbody>
                </table>
                <section class="grid-holder features-books text-center">
                    <?php echo $page; ?>
                </section>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function deleteProduct(id){
        if (confirm("Bạn có muốn xóa không")) {
            window.location.href = "<?php echo base_url().'product/delete?id='; ?>"+id;
        }
    }
</script>