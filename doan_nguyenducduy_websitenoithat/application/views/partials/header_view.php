<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php ob_start(); ?>

<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta http-equiv="cache-control" content="no-cache"/>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1"/>
        <meta name="viewport" content="width=device-width"/>
        <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/css/style1.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/css/bs.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/css/range-slider.css" rel="stylesheet" type="text/css"/>

        <script src="<?php echo base_url(); ?>public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/lib.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/bxslider.js"></script>
        <script src="<?php echo base_url(); ?>public/js/range-slider.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.zoom.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/bookblock.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/custom.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/social.js"></script>
        <script src="<?php echo base_url(); ?>public/js/formValidation.min1.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/js/formValidation.min2.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/js/index1.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.bpopup.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('.social_active').hoverdir( {} );
            $('#ex1').zoom();
        });
        </script>
    </head>
    <body>
        <div class="wrapper">
            <header id="main-header">
                <section class="container-fluid container">
                    <section class="row-fluid">
                        <section class="span4">
                            <h1 id="logo"> <a href="#"><img src="<?php echo base_url(); ?>public/images/logo1.png"/></a> </h1>
                            <h2 id="text_logo"> <a href="#"> wood home</a></h2>
                        </section>
                        <section class="span8">
                            <ul class="top-nav2">
                                <li><a href="<?php echo site_url('cart/index'); ?>">Giỏ hàng <i class="fa fa-shopping-cart" aria-hidden="true"></i><span style="color: red">&nbsp;&nbsp; <?php echo $countCart; ?> </span></a></li>
                                <?php if (empty($fullname)): ?>
                                    <li><a href="<?php echo site_url('login/index') ?>">Đăng nhập</a></li>
                                <?php endif ?>
                                
                                <?php if (!empty($fullname)): ?>
                                    <li><a href="#">Hello : <?php echo $fullname; ?></a></li>
                                <?php endif ?>
                                

                                <li><a href="<?php echo site_url('signup/index'); ?>">Đăng kí</a></li>
                                <?php if (!empty($fullname)): ?>
                                    <li><a href="<?php echo site_url('home/logout') ?>">Đăng xuất</a></li>
                                <?php endif ?>
                                
                            </ul>
                            <div class="col-xs-12">
                                <form method="post" action="<?php echo site_url('home/search') ?>">
                                <button type="submit" id="btnSearch" id="btnSearch" class="btn btn-info pull-right"><span class="glyphicon glyphicon-search"></span></button>
                                <input class="form-control pull-right" style="width: 300px;" type="text" name="txtSearch" id="txtSearch" placeholder="Nhập từ khóa" value="<?php echo isset($keyword)?$keyword:''; ?>">
                            </form>
                            </div>
                        </section>
                    </section>
                </section>
                <button id="menu1" style="font-size: 23px;background-color: #E5E5E5;height: 40px;line-height: 40px; width: 40px; text-align: center  " class="navbar-toggler pull-xs-right hidden-sm-up collapsed" type="button" data-toggle="collapse" data-target=".menu1" aria-expanded="false">
                    ☰
                </button>
                <nav id="nav">
                    <nav class="navbar menu1">
                        <div class="container-fluid">
                            <ul class="nav navbar-nav">
                                <li <?php echo ($module == 'home')?'class="active"' : ""; ?>> <a href="<?php echo site_url('home/index') ?>">Trang chủ</a> </li>
                                <li> <a href="#">Giới thiệu</a></li>
                                <li><a href="#">Khuyến mãi</a></li>
                                <li><a href="#">Hỗ trợ khách hàng</a></li>
                                <li><a href="#">Liên hệ & Địa chỉ</a></li>
                            </ul>
                        </div>
                    </nav>
                </nav>
            </header>
            <section id="content-holder" class="container-fluid container">
                <section class="row-fluid">