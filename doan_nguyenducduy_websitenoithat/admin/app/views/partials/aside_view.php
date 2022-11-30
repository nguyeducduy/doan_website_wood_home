<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() ?>../public/images/quantri.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>adm</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li <?php echo ($module == 'dashboard') ? 'class="active"' : ''; ?>>
                <a href="<?php echo site_url('dashboard/index'); ?>"><i class="fa fa-home"></i>Trang chủ</a>
            </li>
            <li <?php echo ($module == 'product') ? 'class="active"' : ''; ?>>
                <a href="<?php echo site_url('product/index'); ?>"><i class="fa fa-book"></i>Quản lý sản phẩm</a>
            </li>
            <li <?php echo ($module == 'brands') ? 'class="active"' : ''; ?>>
                <a href="<?php echo site_url('brands/index'); ?>"><i class="fa fa-th"></i>Thương Hiệu </a>
            </li>
            <li <?php echo ($module == 'typeproduct') ? 'class="active"' : ''; ?>>
                <a href="<?php echo site_url('typeproduct/index'); ?>"><i class="fa fa-th"></i>Loại bàn ghế</a>
            </li>
            <li <?php echo ($module == 'orders') ? 'class="active"':'';?>>
                <a href="<?php echo site_url('orders/index') ?>"><i class="fa fa-th"></i>Đơn hàng</a>
            </li>
            <li <?php echo ($module == 'detailorder') ? 'class="active"' : ''; ?>>
                <a href="<?php echo site_url('detailorder/index'); ?>"><i class="fa fa-th"></i>Chi tiết đơn hàng</a>
            </li>
            <li <?php echo ($module == 'member') ? 'class="active"' : ''; ?>>
                <a href="<?php echo site_url('member/index'); ?>"><i class="fa fa-th"></i>Thành viên</a>
            </li>
            <!-- <li>
                <a><i class="fa fa-th"></i>Thống kê</a>
            </li>
            <li>
                <a><i class="fa fa-th"></i>Báo cáo</a>
            </li> -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>