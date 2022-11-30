<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng ký thành viên</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style2.css">
    <script src="<?php echo base_url(); ?>public/js/jquery-1.12.0.min.js"></script>
</head>
<body>
    <div class="container">
      <div class="login-box animated fadeInUp" style="max-width:340px">
      <p>
      <?php echo $fail; ?>
      <?php echo $success; ?>
      <?php echo $error; ?>

      <?php echo validation_errors(); ?></p>
        <form action="<?php echo site_url('signup/add') ?>" method="POST" >
          <div class="box-header">
            <h2>Đăng Ký</h2>
          </div>
          <label for="username">Tên đăng nhập</label>
          <br/>
          <input type="text" name="txtTenDangNhap" id="username">
          <br/>
          <label for="password">Mật khẩu</label>
          <br/>
          <input type="password" name="txtMatKhau" id="password">
          <br/>
          <label for="txtEmail">Email</label>
          <br/>
          <input type="email" name="txtEmail" id="txtEmail">
          <br/>
          <label for="txtHoTen">Họ Tên</label>
          <br/>
          <input type="text" name="txtHoTen" id="txtHoTen">
          <br/>
          <label for="txtAddress">Địa chỉ</label>
          <br/>
          <input type="text" name="txtAddress" id="txtAddress">
          <br/>
          <!-- <label for="txtPhone">Số Điện Thoại</label>
          <br/>
          <input type="text" name="txtPhone" id="txtPhone">
          <br/> -->
          <input type="submit" name="btnSubmit" value="Đăng ký"/>
          <input type="reset" name="btnReset" value="reset"/>
          <br/>
          <a href="<?php echo site_url('login/index') ?>" title="">Đăng nhập</a>
          <span>|</span>
          <a href="<?php echo site_url('signup/index'); ?>" title="">Trang chủ</a>
      </form>
    </div>
  </div>
</body>
</html>