<div class="content-wrapper right_col">
<style type="text/css" media="screen">
  th, td {
    border-bottom: 1px solid #ddd;
}
</style>
  <div class="row">
    <h2 class="text-center">Danh sách đơn hàng !!!</h2>
  </div>
  <div class="row">
  <?php foreach ($orders as $k => $o): ?>
    <div class="col-md-12" style="border-bottom: 2px dotted green ; margin: 20px 0px;background-color: #CCFFFF;">
      <div class="col-md-2">
        <p>
          <img width="100%" height="250px;" src="<?php echo base_url().PATH_IMG_PRODUCT.$o['imgProduct'] ?>" alt="">
        </p>
        <h3 class="text-center"><?php echo $o['nameProduct']; ?></h3>
      </div>
      <div class="col-md-10" style="background-color: white;">
        <div class="table-responsive">
          <table class="table table-bordered" style="margin-top: 10px;">
            <thead>
              <tr>
                <th>STT</th>
                <th>Tên KH</th>
                <th>SDT</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Số Lượng</th>
                <th>Thành Tiền</th>
                <th>Ngày Đặt</th>
                <th>Ghi Chú</th>
                <th colspan="3" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php if (isset($o['ltsOrder']) && !empty($o['ltsOrder'])): ?>
                <?php $i = 1; foreach ($o['ltsOrder'] as $k2 => $c): ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $c['TenKH']; ?></td>
                <td><?php echo $c['SDT'] ?></td>
                <td><?php echo $c['email'] ?></td>
                <td><?php echo $c['DiaChi'] ?></td>
                <td><?php echo $c['QTY'] ?></td>
                <td><?php echo $c['ThanhTien'] ?></td>
                <td><?php echo $c['create_at'] ?></td>
                <td><?php echo $c['GhiChu'] ?></td>
                <td><button onclick="updateOrders(<?php echo $c['id_donhang'] ?>, 1);" type="button" class="btn btn-small btn-primary">Xác nhận</button></td>
                <td><button onclick="updateOrders(<?php echo $c['id_donhang'] ?>, 2);" type="button" class="btn btn-small btn-danger"> Hủy</button></td>
               
              </tr>
                <?php $i++; endforeach; ?>
            <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
      <?php endforeach; ?>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
    function updateOrders(id, type){
    $.ajax({
      url: '<?php echo site_url('orders/update') ?>',
      type:'POST',
      data:{id:id, type:type},
      success: function(data){
        data = $.trim(data);
        if (data == 'ok') {
          alert("Thao tac thanh cong");
          window.location.reload(true);
        }
        else if (data == 'err') {
          alert('co loi xay ra');
          window.location.reload(true);
        }
        else if (data == 'errup') {
          alert('Xac nhan Tb');
          window.location.reload(true);
        }
        else if (data == 'errqty') {
          alert('Khong du sach ban');
          window.location.reload(true);
        }
        else if (data == 'errde') {
          alert('Xoa don hang tb');
          window.location.reload(true);
        }
      }
    });
}
</script>