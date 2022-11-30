<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
      <section class="span3">
            <div class="side-holder">
                <article class="banner-ad">
                    <img src="<?php echo base_url(); ?>public/images/khuyenmai1.jpg" alt=""/>
                </article>
            </div>
            <div class="side-holder">
                <article class="shop-by-list">
                    <h2>Danh mục sản phẩm</h2>
                    <div class="side-inner-holder">
                        <strong class="title">Thương Hiệu</strong>
                        <ul class="side-list">
                        <?php foreach ($brand as $key => $value): ?>
                          <li><a href="<?php echo site_url('brand/index').'?id='.$value['id_nhanhieu']; ?>"><?php echo $value['ten_nhanhieu'] ?></a></li>
                        <?php endforeach ?>
                        </ul>
                        <strong class="title">Loại bàn </strong>
                        <ul class="side-list">
                        <?php foreach ($typeMan as $key => $value): ?>
                          <li><a href="<?php echo site_url('type/index').'?id='.$value['id_loai']; ?>"><?php echo $value['TenLoai'] ?></a></li>
                        <?php endforeach ?>
                        </ul>
                        <strong class="title">Loại ghế </strong>
                        <ul class="side-list">
                        <?php foreach ($typeWoman as $key => $value): ?>
                          <li><a href="<?php echo site_url('type/index').'?id='.$value['id_loai']; ?>"><?php echo $value['TenLoai'] ?></a></li>
                        <?php endforeach ?>
                        </ul>
                        <strong class="title">Giá</strong>
                        <ul class="side-list">
                            <li><a href="<?php echo site_url('price/index').'?id=1'; ?>">Từ 10,000đ - 199,000đ</a></li>
                            <li><a href="<?php echo site_url('price/index').'?id=2'; ?>">Từ 200,000đ - 499,000đ</a></li>
                            <li><a href="<?php echo site_url('price/index').'?id=3'; ?>">Lớn hơn 500,000đ</a></li>
                        </ul>
                    </div>
                </article>
            </div>
            <div class="side-holder">
                <!-- <article class="l-reviews">
                    <h2>Sách xem nhiều nhất</h2>
                    <div class="side-inner-holder">
                        <article class="r-post sach_xem_nhieu">
                            <div class="r-img-title">
                                <a href="#"><img src=""/></a>
                                <div class="r-det-holder span6">
                                    <a href="#"><strong class="r-author"><b>Chí Phèo</b></strong></a>
                                </div>
                                <div class="r-det-holder span6">
                                    <span class="r-by">Tác giả:<a href="#">Nam Cao</a>
                                    </span>
                                    <span class="r-by">Thể loại:<a href="#">Văn Học</a>
                                    </span>
                                    <span class="r-by">Giá: 200,000 vnđ
                                    </span>
                                    <span class="r-by">Lượt xem: 350
                                    </span>
                                </div>
                            </div>
                            <hr >
                        </article>
                    </div>
                </article> -->
            </div>
        </section>
    </section>
</section>