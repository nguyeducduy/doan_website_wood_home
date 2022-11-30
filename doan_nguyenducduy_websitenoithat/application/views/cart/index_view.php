<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <style type="text/css">
    .table > tbody > tr > td {
      vertical-align: middle;
    }
    .myinput{width: 320px;}
    </style>
      <div class="row">
        <h3 class="text-center">
          <?php echo $mess; ?>
          <?php echo $success; ?>
          <?php echo $err; ?>
        </h3>
      </div>
      <div class="heading-bar">
          <a class="more-btn">Tiến hành kiểm tra</a>
      </div>

      <div class="table_gio_hang">
          <form method="POST" action="<?php echo site_url('cart/update_cart'); ?>" id="form_gio_hang">
              <table class="table table-hover table-striped" style="margin: 0px;padding: 0px;">
                  <tr>
                      <th>&nbsp;#</th>
                      <th>Tên sản phẩm</th>
                      <th>Ảnh</th>
                      <th class="center1">Giá</th>
                      <th class="center1">Số lượng</th>
                      <th class="center1" >Thành tiền</th>
                      <th>Xóa</th>
                  </tr>

                  <?php
                    $i =1 ; $totalMoney = 0;
                   foreach ($cart as $k => $v): ?>
                  <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $v['name']; ?></td>
                      <td>
                        <img src="<?php echo base_url().PATH_IMG_PRODUCT.$v['options']['image']; ?>" alt="">
                      </td>
                      <td class="center1"><?php echo number_format($v['price']); ?></td>
                      <td class="center1" ><input class="soluong1" required pattern="[0-9]{1,3}" title="Số lượng phải là chữ số và nhỏ hơn 4 kí tự" name="txtQty[<?php echo $v['rowid']; ?>]" size="2" type="text" value="<?php echo $v['qty'] ?>"/></td>
                      <td  class="center1 img_gio_hang"><?php echo number_format($v['qty']*$v['price']) ?></td>

                      <td >
                        <a href="<?php echo site_url('cart/delete/'.$v['rowid']); ?>"> <i class="icon-trash"></i></a>
                      </td>
                  </tr>
                  <?php $i++; $totalMoney +=$v['subtotal']; endforeach; ?>
                  <tr>
                    <td colspan="5">Tổng tiền: </td>
                    <td class="center1"> <span><?php echo number_format($totalMoney); ?></span></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="7" style="text-align: right">
                    <a href="<?php echo site_url('home/index') ?>" class="btn btn-primary" title="">Tiếp tục mua hàng</a>
                      <button type="submit" style="" class="btn btn-info">Cập nhật giỏ hàng</button>
                      <a href="<?php echo site_url('cart/deleteAll'); ?>" class="btn btn-warning">Xóa tất cả</a>
                    </td>
                  </tr>
              </table>
          </form>
      </div>

      <div class="heading-bar">
          <a class="more-btn">Tiến hành đặt hàng</a>
      </div>
      <div class="table_gio_hang">
        <form id="enableForm3" action="<?php echo site_url('cart/orders') ?>" method="POST" class="form-horizontal">
          <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label class="col-md-5 control-label">Họ Tên (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="text" value="<?php echo $fullname; ?>" class="form-control" name="txtHoTen" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Số điện thoại (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="text" value="<?php echo $phone; ?>" class="form-control" name="txtSoDienThoai" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Email (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="email" value="<?php echo $email ?>" class="form-control" name="txtEmail" />
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xs-12">
                <div class="form-group">
                  <label class="col-md-5 control-label">Địa chỉ (*)</label>
                  <div class="col-md-7">
                    <input class="myinput" type="text"  value="<?php echo $address; ?>" class="form-control" name="txtDiaChi" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-5 control-label">Ghi chú</label>
                  <div class="col-md-7">
                    <textarea style="width: 550px;" name="txtGhiChu" ></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <input type="submit" name="bnSubmit" class="btn btn-info btn-block" value="Đặt hàng"/>
              </div>
          </div>
        </form>
      </div>
  </section>
</section>