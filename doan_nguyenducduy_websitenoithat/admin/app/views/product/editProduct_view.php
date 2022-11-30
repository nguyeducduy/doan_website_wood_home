<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-center">Sửa Thông Tin Sản Phẩm</h2>
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
                        <?php foreach ($product as $k => $p): ?>
                        <form action="<?php echo site_url('product/edit').'?id='.$p['id_sanpham']; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="txtNameProduct">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" name="txtNameProduct" id="txtNameProduct" placeholder="Tên Sản Phẩm" value="<?php echo $p['TenSp']; ?>">
                                <input type="hidden" name="txthddProduct" value="<?php echo $p['TenSp']; ?>">
                            </div>

                            <div class="form-group">
						    <label for="slcType">Chọn loại bàn & ghế</label>
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
                                <label for="slcGT">Loại</label>
                                <select name="slcGT" class="form-control">
                                    <option value="1" <?php echo ($p['sex'] == 1)?'selected="selected"':""; ?> >Ghế </option>
                                    <option value="0" <?php echo ($p['sex'] == 0)?'selected="selected"':""; ?> > Bàn</option>
                                </select>
                            </div>

                            <div class="form-group">
						    <label for="txtGiaCu">Giá Cũ</label>
						    <input name="txtGiaCu" type="text" class="form-control" id="txtGiaCu" placeholder="Nhập giá" value="<?php echo $p['GiaCu']; ?>">
						  	</div>

						  	<div class="form-group">
						    <label for="txtGiaMoi">Giá Mới</label>
						    <input name="txtGiaMoi" type="text" class="form-control" id="txtGiaMoi" placeholder="Nhập giá" value="<?php echo $p['GiaMoi'] ?>">
						  	</div>

						  	<div class="form-group">
						    <label for="txtQTY">Số lượng</label>
						    <input name="txtQTY" type="text" class="form-control" id="txtQTY" placeholder="Nhập số lượng " value="<?php echo $p['SoLuong'] ?>">
						  	</div>

						  	<div class="form-group">
						    <label for="txtView">Số lượt xem</label>
						    <input name="txtView" type="text" class="form-control" id="txtView" placeholder="Nhập số lượt xem " value="<?php echo $p['SoLuotXem'] ?>">
						  	</div>

                            <div class="form-group">
                                <label for="slcStatus">Trạng Thái</label>
                                <select name="slcStatus" class="form-control">
                                        <option value="1" <?php echo ($p['status'] == 1)?'selected="selected"':""; ?> >Còn Hàng</option>
                                        <option value="0" <?php echo ($p['status'] == 0)?'selected="selected"':""; ?> >Hết Hàng</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Choose logo</label>
                                <input type="file" id="txtFile" name="txtFile">
                                <input type="hidden" name="hddFile" value="<?php echo $p['img_path']; ?>">
                                <br/>
                                <img src="<?php echo base_url().PATH_IMG_PRODUCT . $p['img_path']; ?>" alt="" width="150" height="150">
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