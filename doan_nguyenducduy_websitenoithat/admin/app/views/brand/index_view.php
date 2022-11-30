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
                    <a href="<?php echo site_url('brands/add') ?>" title="" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>  Add Trademark</a>
                    <a href="<?php echo site_url('brands/index'); ?>" title="" class="btn btn-primary">View All</a>
                </div>
                <div class="col-lg-9">
                    <form method="post" action="<?php echo site_url('brands/search') ?>">
                    <button type="submit" id="btnSearch" id="btnSearch" class="btn btn-info pull-right"><span class="glyphicon glyphicon-search"></span></button>
                    <input class="form-control pull-right" style="width: 300px;" type="text" name="txtSearch" id="txtSearch" placeholder="Nhập từ khóa" value="<?php //echo $keyword; ?>">
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Thương Hiệu</th>
                        <th>Logo</th>
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
                            <td><?php echo $val['ten_nhanhieu']; ?></td>
                            <td><img height="100" width="100" src="<?php echo base_url().PATH_IMG_BRAND.$val['image']; ?>" alt=""></td>
                            <td><?php echo ($val['status']==1)?"Còn Hàng" : "Hết Hàng"; ?></td>
                            <td><?php echo $val['created_at']; ?></td>
                            <td><a href="<?php echo site_url('brands/edit').'?id='.$val['id_nhanhieu'];?>" title="" class="btn btn-warning">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
<!--                            <td><button onclick="deleteBrand(<?php ////echo $val['id_nhanhieu']; ?>//)" title="" class="btn btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></button></td> -->
                            <td><a onclick="deleteBrand(<?php echo $val['id_nhanhieu']; ?>)" title="" class="btn btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
    // cach 1
//    function deleteBrand(id) {
//        if (confirm("Bạn có muốn xóa không")) {
//            if (id == '') {
//                alert('ERROR');
//            } else {
//                $.ajax({
//                    url: '<?php //echo site_url('brands/delete1') ?>//',
//                    type: 'POST',
//                    data: {'id': id},
//                    success: function (res) {
//                        var obj = $.parseJSON(res);
//                        if (obj.result == 'FAIL') {
//                            alert('Du lieu sai');
//                        } else if (obj.result == 'ERR') {
//                            alert('Xoa that bai');
//                        } else if (obj.result == 'OK') {
//                            alert('Xoa thanh cong');
//                            window.location.reload(true);
//                        } else {
//                            return false;
//                        }
//                    }
//                });
//            }
//        }
//    }

    // cach 2
    function deleteBrand(id){
        if (confirm("Bạn có muốn xóa không")) {
            window.location.href = "<?php echo base_url().'brands/delete?id='; ?>"+id;
        }
    }
</script>