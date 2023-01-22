﻿<?php
require_once 'header.php';
$urunsor = $db->prepare("SELECT * FROM urun where urun_id=:urun_id");
$urunsor->execute(array(
	'urun_id' => $_GET['urun_id']
));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
echo $say = $urunsor->rowCount();
if ($say == 0) {
	header("Location:index.php?durum=donttry");
	exit;
}
?>

<head>
	<!-- fancy Style -->
	<link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">
</head>
<div class="container">
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>
<div class="container">
	<div class="row">
	</div>
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $uruncek['urun_ad'] ?></div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="dt-img">
						<div class="detpricetag">
							<div class="inner"><?php echo $uruncek['urun_fiyat'] ?> TL</div>
						</div>
						<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
					</div>
					<div class="thumb-img">
						<a class="fancybox" href="images\sample-4.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-4.jpg" alt="" class="img-responsive"></a>
					</div>
					<div class="thumb-img">
						<a class="fancybox" href="images\sample-5.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-5.jpg" alt="" class="img-responsive"></a>
					</div>
					<div class="thumb-img">
						<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
					</div>
				</div>
				<div class="col-md-6 det-desc">
					<div class="productdata">
						<div class="infospan">Ürün Kodu <span><?php echo $uruncek['urun_id']; ?></span></div>
						<div class="infospan">Ürün Fiyat <span><?php echo $uruncek['urun_fiyat']; ?></span></div>
						<div class="clearfix"></div>
						<hr>
						<div class="form-group">
							<label for="qty" class="col-sm-2 control-label">Adet</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" value="1" name="urun_adet">
							</div>
							<div class="col-sm-4">
								<button class="btn btn-default btn-red btn-sm"><span class="addchart">Sepete Ekle</span></button>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="sharing">
							<div class="avatock"><span>
									<?php if ($uruncek['urun_stok'] >= 1) {
										echo "Stok Adeti : " . $uruncek['urun_stok'];
									} else {
										echo "Ürün Kalmadı";
									} ?>
								</span></div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-review">
				<ul id="myTab" class="nav nav-tabs shop-tab">
					<li class="active"><a href="#desc" data-toggle="tab">Açıklama</a></li>
					<li class=""><a href="#rev" data-toggle="tab">Yorumlar (0)</a></li>
				</ul>
				<div id="myTabContent" class="tab-content shop-tab-ct">
					<div class="tab-pane fade active in" id="desc">
						<p>
							<?php echo $uruncek['urun_detay'] ?>
						</p>
					</div>
					<div class="tab-pane fade" id="rev">
						<!-- Yorumlar Kısmı -->
						<p class="dash">
							<span>Jhon Doe</span> (11/25/2012)<br><br>
							Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.
						</p>
						<!-- Yorumlar Kısmı Bitiş -->
						<h4>Yorum Yazın</h4>
						<?php if (isset($_SESSION['userkullanici_mail'])) { ?>
							<form role="form">
								<div class="form-group">
									<textarea class="form-control" placeholder="Lütfen yorumunuzu buraya yazınız..." id="text"></textarea>
								</div>
								<button type="submit" class="btn btn-default btn-red btn-sm">Yorumu Gönder</button>
							</form>
						<?php } else { ?>
							Yorum yazabilmek için <a style="color:red" href="register">kayıt</a> olmalı yada üyemizseniz <a style="color:green" href="index">giriş</a> yapmalısınız...
						<?php } ?>
					</div>

				</div>
			</div>

			<div class="spacer"></div>
		</div><!--Main content-->
		<?php require_once 'sidebar.php' ?>
	</div>
</div>
<?php require_once 'footer.php' ?>