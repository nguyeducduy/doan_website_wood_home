<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/style2.css">
    <script src="<?php echo base_url() ?>public/js/jquery-1.12.0.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="login-box animated fadeInUp" style="max-width:340px">
      <form>
        <div class="box-header">
          <h2>Đăng nhập</h2>
        </div>
        <label for="username">Tên đăng nhập</label>
        <br/>
        <input type="text" name="txtTenDangNhap" id="username">
        <br/>
        <label for="password">Mật khẩu</label>
        <br/>
        <input type="password" name="txtMatKhau" id="password">
        <br/>
        <input id="btnLogin" type="button" name="btnSubmit" value="Đăng nhập"/>
        <input id="btnReset" type="button" name="btnReset" value="reset"/>
        <br/>
        <a href="register.php" title="">Đăng ký</a>
        <span>|</span>
        <a href="index.php" title="">Trang chủ</a>
      </form>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#btnLogin').click(function(){
        var username = $.trim($('#username').val());
        var password = $.trim($('#password').val());
        if (!username.length || !password.length) 
        {
          alert("Vui long nhap tai khoan va mat khau");
        } 
        else {
          $.ajax({
            url: "<?php echo site_url('login/handle'); ?>",
            type: 'POST',
            data:{'user': username, 'pass': password},
            success: function(res){
              var obj = $.parseJSON(res);
              if (obj.result == "ERR") {
                alert('user or pass ko dung');
              }
              else if (obj.result == 'FAIL') {
                alert('Vui long nhap user va pass');
              }
              else if (obj.result == 'OK') {
                window.location.href = "<?php echo site_url('home/index') ?>";
              }else{
                return FALSE;
              }
            }
          });
        }
      });
    });
  </script>
</body>
</html>