<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Active Account</title>
  <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h2 class="text-center">Kích hoạt TK</h2>
    <div class="row">
      <p>
      <?php echo isset($over)?$over:''; ?>
      <?php echo isset($success)?$success:''; ?>
      <?php echo isset($fail)?$fail:''; ?>
      <?php echo isset($succed)?$succed:''; ?>
      <?php echo isset($err)?$err:''; ?>
        
      </p>
      <a href="<?php echo site_url('login/index') ?>" title="" class="btn btn-primary">Đăng nhập</a>
      <a href="<?php echo site_url('signup/index'); ?>" title="" class="btn btn-primary">Đăng kí</a>
    </div>
  </div>
</body>
</html>