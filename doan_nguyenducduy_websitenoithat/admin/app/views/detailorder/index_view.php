<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <h2 class="text-center">Danh sách chi tiết đơn hàng !!!</h2>
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
                <div class="col-md-3">

                    <a href="<?php echo site_url('detailorder/index') ?>" title="" class="btn btn-primary">View All</a>
                </div>
                <div class="col-md-9">
                    <form method="post" action="<?php echo site_url('detailorder/search') ?>">
                        <button type="submit" id="btnSearch" id="btnSearch" class="btn btn-info pull-right"><span class="glyphicon glyphicon-search"></span></button>
                        <input class="form-control pull-right" style="width: 300px;" type="text" name="txtSearch" id="txtSearch" placeholder="Nhập từ khóa" value="<?php //echo $keyword; ?>">
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên KH</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Tên sản phẩm</th>
                       <!--  <th>Hình ảnh</th> -->
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Trạng thái</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    foreach ($info as $key => $ord): ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $ord['TenKH']; ?></td>
                            <td><?php echo $ord['SDT']; ?></td>
                            <td><?php echo $ord['email']; ?></td>
                            <td><?php echo $ord['DiaChi']; ?></td>
                            <td><?php echo $ord['TenSp']; ?></td>
                            <!-- <td><img width="60" height="60" src="<?php //echo PATH_IMG_BOOK . $ord['HinhAnh']; ?>" alt=""></td> -->
                            <td><?php echo $ord['QTY']; ?></td>
                            <td><?php echo $ord['ThanhTien']; ?></td>
                            <td class="success">Đã thanh tóán</td>
                            <td><a href="<?php echo site_url('detailorder/export').'?id='.$ord['id_hoadon'];?>" class="btn btn-info">Xuất hóa đơn <i class="fa fa-file-text" aria-hidden="true"></i></a></td>
                            <td><a onclick="deleteData(<?php echo $ord['id_hoadon']; ?>)" title="" class="btn btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        <?php $i++; endforeach; ?>
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
    function deleteData(id){
        if (confirm("Bạn có muốn xóa không")) {
            window.location.href = "<?php echo base_url().'detailorder/delete?id='; ?>"+id;
        }
    }
</script>