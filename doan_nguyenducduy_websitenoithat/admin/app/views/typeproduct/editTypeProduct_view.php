<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-center">Sửa Thương Hiệu</h2>
                        <?php if($this->session->flashdata('err')){ ?>
                            <div class="alert alert-error">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>Error!</strong> <?php echo $this->session->flashdata('err'); ?>
                            </div>
                        <?php }else if($this->session->flashdata('warning')){ ?>
                            <div class="alert alert-warning">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['error']) && !empty(isset($_SESSION['error']))) { ?>
                            <div class="row">
                                <ul>
                                    <?php foreach ($_SESSION['error'] as $key => $value): ?>
                                        <?php if (!empty($value)): ?>
                                            <li style="color: red;"><?php echo $value; ?></li>
                                        <?php endif ?>
                                    <?php endforeach ?>

                                </ul>
                            </div>
                        <?php } ?>
                        <a href="<?php echo site_url('typeproduct/index') ?>" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                        <?php foreach ($typeproduct as $k => $b): ?>
                            <form action="<?php echo site_url('typeproduct/edit').'?id='.$b['id_loai']; ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="txtNameType">Tên Loại Quần Áo</label>
                                    <input type="text" class="form-control" name="txtNameType" id="txtNameType" placeholder="Tên Loại Quần Áo" value="<?php echo $b['TenLoai']; ?>">
                                    <input type="hidden" name="txthddType" value="<?php echo $b['TenLoai']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="slcGT">Loại</label>
                                    <select name="slcGT" class="form-control">
                                        <option value="1" <?php echo ($b['gioitinh'] == 1)?'selected="selected"':""; ?>>Bàn</option>
                                        <option value="0" <?php echo ($b['gioitinh'] == 0)?'selected="selected"':""; ?>>Ghế</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="slcStatus">Trạng Thái</label>
                                    <select name="slcStatus" class="form-control">
                                        <option value="1" <?php echo ($b['status'] == 1)?'selected="selected"':""; ?> >Còn Hàng</option>
                                        <option value="0" <?php echo ($b['status'] == 0)?'selected="selected"':""; ?> >Hết Hàng</option>
                                    </select>
                                </div>
                                <button name="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Sửa</button>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>