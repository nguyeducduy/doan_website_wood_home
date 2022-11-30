<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="right">
  <h2>Theo loại bàn ghế</h2>
    <section class="grid-holder features-books">
    <?php foreach ($info as $k => $v): ?>
      <figure class="span4 slide first chinh1" style="position: relative;">
        <a href="<?php echo site_url('detail/index/'.vn2latin($v['TenSp']).'-'.$v['id_sanpham'] ); ?>"><img src="<?php echo base_url().PATH_IMG_PRODUCT.$v['img_path'] ?>" alt="" class="pro-img"/></a>
        <p>
            <span class="title text-center">
                <a href="<?php echo site_url('detail/index/'.vn2latin($v['TenSp']).'-'.$v['id_sanpham'] ); ?>" style="font-weight: bold"><?php echo $v['TenSp']; ?></a>
            </span>
        </p>
        <p>Thương Hiệu:
            <a class="nxb" href=""><?php echo $v['ten_nhanhieu']; ?></a>
        </p>
        <p>Loại bàn ghế:
            <a class="nxb" href="#"><?php echo $v['TenLoai']; ?></a>
        </p>
        <!-- <p>
            <i class="fa fa-eye" aria-hidden="true"></i> Lượt xem:  <?php //echo $v['SoLuotXem']; ?>
        </p> -->
        <div class="cart-price">
            <a class="cart-btn2" href="<?php echo site_url('cart/addCart/'.$v['id_sanpham']) ?>">Thêm vào giỏ hàng</a>
            <span class="price"><?php echo (!empty($v['GiaMoi']))?number_format($v['GiaMoi']):number_format($v['GiaCu']); ?> vnđ</span>
        </div>
      </figure>
    <?php endforeach; ?>
    </section>
    <div style="clear: both;"></div>
    <section class="grid-holder features-books text-center">
      <?php echo $page; ?>
    </section>
</section>