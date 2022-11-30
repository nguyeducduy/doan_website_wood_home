<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-center">Thêm Sản Phẩm</h2>
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
                        <a href="<?php echo site_url('product/index') ?>" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                        <form action="<?php echo site_url('product/add'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="txtNameProduct">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="txtNameProduct" id="txtNameProduct" placeholder="Tên sản phẩm">
                            </div>
							
							<div class="form-group">
						    <label for="slcType">Chọn loại sản phẩm</label>
						    <select name="slcType" class="form-control"> 
							    <?php foreach ($type as $key => $t): ?>
							    	<option value="<?php echo $t['id_loai']; ?>"><?php echo $t['TenLoai']; ?></option> 
							    <?php endforeach; ?>
						    </select>
						  	</div>

							<div class="form-group">
						    <label for="slcBrand">Chọn thương hiệu</label>
						    <select name="slcBrand" class="form-control"> 
							    <?php foreach ($brand as $key => $b): ?>
							    	<option value="<?php echo $b['id_nhanhieu']; ?>"><?php echo $b['ten_nhanhieu']; ?></option> 
							    <?php endforeach; ?>
						    </select>
						  	</div>

                            <div class="form-group">
                                <label for="slcGT">Loại </label>
                                <select name="slcGT" class="form-control">
                                    <option value="1" selected="selected">Bàn</option>
                                    <option value="0">Ghế</option>
                                </select>
                            </div>

                            <div class="form-group">
						    <label for="txtGia">Giá</label>
						    <input name="txtGia" type="text" class="form-control" id="txtGia" placeholder="Nhập giá">
						  	</div>

						  	<div class="form-group">
						    <label for="txtQTY">Số lượng</label>
						    <input name="txtQTY" type="text" class="form-control" id="txtQTY" placeholder="Nhập số lượng ">
						  	</div>

						  	<div class="form-group">
						    <label for="txtFile">Hình Ảnh</label>
						    <input type="file" id="txtFile" name="txtFile">
						  	</div>

                            <button name="btnSubmit1" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>