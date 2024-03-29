﻿<?php require_once 'header.php'; ?>

<!-- Header Area End Here -->
<!-- Main Banner 1 Area Start Here -->
<div class="main-banner2-area">
    <div class="container">
        <div class="main-banner2-wrapper">
            <h1>C2C Projesine Hoşgeldiniz</h1>
            <p>Aramak istediğiniz ürünü lütfen giriniz...</p>
            <form action="arama-detay" method="POST">
                <div class="banner-search-area input-group">
                    <input class="form-control" minlength="3" name="searchkeyword" placeholder="aradığınız ürün adını giriniz . . ." type="text">
                    <span class="input-group-addon">
                        <button type="submit" name="searchsayfa">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Main Banner 1 Area End Here -->
<!-- Trending Products Area Start Here -->
<div class="trending-products-area section-space-default">
    <?php require_once 'cok-satanlar.php' ?>
</div>
<!-- Trending Products Area End Here -->
<!-- Newest Products Area Start Here -->
<div class="newest-products-area bg-secondary section-space-default">
    <div class="container">
        <h2 class="title-default">Öne Çıkan Ürünler</h2>
    </div>
    <div class="container-fluid" id="isotope-container">
        <div class="isotope-classes-tab isotop-box-btn-white">
        </div>
        <div class="row featuredContainer">
            <?php
            $urunsor = $db->prepare("SELECT urun.*,kategori.*,kullanici.* 
            FROM urun 
            INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id 
            INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id 
            where urun_onecikar=:onecikar and urun_durum=:durum 
            order by urun_zaman,urun_onecikar 
            DESC 
            limit 8");
            $urunsor->execute(array(
                'onecikar' => 1,
                'durum' => 1
            ));
            while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 yenigelen plugins">
                    <div class="single-item-grid">
                        <div class="item-img">
                            <a href="urun-<?= seo($uruncek['urun_ad']) . "-" . $uruncek['urun_id'] ?>"><img style="width: 451px; height: 252px;" src="<?= $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive"></a>
                            <div class="trending-sign" data-tips="Öne Çıkan Ürün"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                        </div>
                        <div class="item-content flex" style="height: 200px;">
                            <div class="item-info">
                                <h3><a href="urun-<?= seo($uruncek['urun_ad']) . "-" . $uruncek['urun_id'] ?>"><?= kisalt($uruncek['urun_ad'], 0, 15) ?></a></h3>
                                <span><a href=" kategoriler-<?= seo($uruncek['kategori_ad']) . "-" . $uruncek['kategori_id'] ?>"><?= $uruncek['kategori_ad'] ?></a></span>
                                <div class="price"><?= fiyat($uruncek['urun_fiyat']) ?> ₺</div>
                            </div>
                            <div class="item-profile">
                                <div class="profile-title">
                                    <div class="img-wrapper"><img style="width: 38px; height: 38px;" src="<?= $uruncek['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>
                                    <span><?= $uruncek['kullanici_ad'] . " " . kisalt($uruncek['kullanici_soyad'], 0, 1) ?></span>
                                </div>
                                <div class="profile-rating">
                                    <!-- <a href="#"><b>Tüm Ürünleri</b></a> -->
                                    <ul>
                                        <?php require_once 'yildiz.php'; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>

    </div>
</div>
<!-- Newest Products Area End Here -->

<!-- Why Choose Area Start Here -->
<!-- <div class="why-choose-area bg-primaryText section-space-default">
    <div class="container">
        <h2 class="title-textPrimary">Why You Choose Foxtar Market Place?</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-gift" aria-hidden="true"></i></a>
                    <h3><a href="#">Easily Buy & Sell </a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                    <h3><a href="#">Quality Products</a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-lock" aria-hidden="true"></i></a>
                    <h3><a href="#">100% Secure Payment</a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Why Choose Area End Here -->

<!-- Author Banner Area Start Here -->
<div class="author-banner-area">
    <div class="author-banner-wrapper">
        <div id="ri-grid" class="author-banner-bg ri-grid header text-center">
            <ul class="ri-grid-list">
                <li><a href="#"><img src="img/banner/2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/4.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/4.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img/banner/9.jpg" alt=""></a></li>
            </ul>
        </div>
        <div class="author-banner-content">
            <ul>
                <li>
                    <p>Aylık <span> 20.000</span> Alıcı/Satıcı Buluşturuyor!</p>
                </li>
                <li><a href="kategoriler" class="btn-fill-textPrimary">Ürünlere Git</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Author Banner Area End Here -->
<?php require_once 'footer.php'; ?>