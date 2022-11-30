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
                    <a href="<?php echo site_url('typeproduct/add') ?>" title="" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>  Thêm bàn ghế</a>
                    <a href="<?php echo site_url('typeproduct/index'); ?>" title="" class="btn btn-primary">View All</a>
                </div>
                <div class="col-lg-9">
                    <form method="post" action="<?php echo site_url('typeproduct/search') ?>">
                        <button type="submit" id="btnSearch" id="btnSearch" class="btn btn-info pull-right"><span class="glyphicon glyphicon-search"></span></button>
                        <input class="form-control pull-right" style="width: 300px;" type="text" name="txtSearch" id="txtSearch" placeholder="Nhập từ khóa" value="<?php //echo $keyword; ?>">
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại</th>
                        <th>Trạng thái</th>
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
                            <td><?php echo $val['TenLoai']; ?></td>
                            <td><?php echo ($val['gioitinh']==1)?"Bàn":"Ghế"; ?></td>
                            <td><?php echo ($val['status']==1)?"Còn Hàng" : "Hết Hàng"; ?></td>
                            <td><?php echo $val['created_at']; ?></td>
                            <td><a href="<?php echo site_url('typeproduct/edit').'?id='.$val['id_loai'];?>" title="" class="btn btn-warning">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                            <td><a onclick="deleteType(<?php echo $val['id_loai']; ?>)" title="" class="btn btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        <?php $i++;  endforeach; ?>
                    </tbody>
                </table>
                <section class="grid-holder features-books">
                    <?php echo $page; ?>
                </section>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function deleteType(id){
        if (confirm("Bạn có muốn xóa không")) {
            window.location.href = "<?php echo base_url().'typeproduct/delete?id='; ?>"+id;
        }
    }
</script>