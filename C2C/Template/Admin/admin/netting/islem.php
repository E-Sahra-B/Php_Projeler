<?php
ob_start();
session_start();
require_once 'baglan.php';
include '../production/fonksiyon.php';


if (isset($_POST['genelayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_title=:ayar_title,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'ayar_title' => $_POST['ayar_title'],
		'ayar_description' => $_POST['ayar_description'],
		'ayar_keywords' => $_POST['ayar_keywords'],
		'ayar_author' => $_POST['ayar_author']
	));
	if ($update) {
		header("Location:../production/genel-ayar.php?durum=ok");
	} else {
		header("Location:../production/genel-ayar.php?durum=no");
	}
}

if (isset($_POST['iletisimayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_faks=:ayar_faks,
		ayar_mail=:ayar_mail,
		ayar_ilce=:ayar_ilce,
		ayar_il=:ayar_il,
		ayar_adres=:ayar_adres,
		ayar_mesai=:ayar_mesai
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'ayar_tel' => $_POST['ayar_tel'],
		'ayar_gsm' => $_POST['ayar_gsm'],
		'ayar_faks' => $_POST['ayar_faks'],
		'ayar_mail' => $_POST['ayar_mail'],
		'ayar_ilce' => $_POST['ayar_ilce'],
		'ayar_il' => $_POST['ayar_il'],
		'ayar_adres' => $_POST['ayar_adres'],
		'ayar_mesai' => $_POST['ayar_mesai']
	));
	if ($update) {
		header("Location:../production/iletisim-ayarlar.php?durum=ok");
	} else {
		header("Location:../production/iletisim-ayarlar.php?durum=no");
	}
}

if (isset($_POST['apiayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_analystic=:ayar_analystic,
		ayar_maps=:ayar_maps,
		ayar_zopim=:ayar_zopim
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'ayar_analystic' => $_POST['ayar_analystic'],
		'ayar_maps' => $_POST['ayar_maps'],
		'ayar_zopim' => $_POST['ayar_zopim']
	));
	if ($update) {
		header("Location:../production/api-ayarlar.php?durum=ok");
	} else {
		header("Location:../production/api-ayarlar.php?durum=no");
	}
}

if (isset($_POST['sosyalayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_facebook=:ayar_facebook,
		ayar_twitter=:ayar_twitter,
		ayar_youtube=:ayar_youtube,
		ayar_google=:ayar_google
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'ayar_facebook' => $_POST['ayar_facebook'],
		'ayar_twitter' => $_POST['ayar_twitter'],
		'ayar_youtube' => $_POST['ayar_youtube'],
		'ayar_google' => $_POST['ayar_google']
	));
	if ($update) {
		header("Location:../production/sosyal-ayar.php?durum=ok");
	} else {
		header("Location:../production/sosyal-ayar.php?durum=no");
	}
}

if (isset($_POST['mailayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_smtphost=:smtphost,
		ayar_smtpuser=:smtpuser,
		ayar_smtppassword=:smtppassword,
		ayar_smtpport=:smtpport
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'smtphost' => $_POST['ayar_smtphost'],
		'smtpuser' => $_POST['ayar_smtpuser'],
		'smtppassword' => $_POST['ayar_smtppassword'],
		'smtpport' => $_POST['ayar_smtpport']
	));
	if ($update) {
		Header("Location:../production/mail-ayar.php?durum=ok");
	} else {
		Header("Location:../production/mail-ayar.php?durum=no");
	}
}

if (isset($_POST['hakkimizdakaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE hakkimizda SET
		hakkimizda_baslik=:hakkimizda_baslik,
		hakkimizda_icerik=:hakkimizda_icerik,
		hakkimizda_video=:hakkimizda_video,
		hakkimizda_vizyon=:hakkimizda_vizyon,
		hakkimizda_misyon=:hakkimizda_misyon
		WHERE hakkimizda_id=0");
	$update = $ayarkaydet->execute(array(
		'hakkimizda_baslik' => $_POST['hakkimizda_baslik'],
		'hakkimizda_icerik' => $_POST['hakkimizda_icerik'],
		'hakkimizda_video' => $_POST['hakkimizda_video'],
		'hakkimizda_vizyon' => $_POST['hakkimizda_vizyon'],
		'hakkimizda_misyon' => $_POST['hakkimizda_misyon']
	));
	if ($update) {
		header("Location:../production/hakkimizda.php?durum=ok");
	} else {
		header("Location:../production/hakkimizda.php?durum=no");
	}
}

if (isset($_POST['admingiris'])) {
	$kullanici_mail = $_POST['kullanici_mail'];
	$kullanici_password = trim($_POST["kullanici_password"]);
	$kullanicisor = $db->prepare("SELECT * FROM kullanici 
	where kullanici_mail=:mail and kullanici_yetki=:yetki");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'yetki' => 5
	));
	$kayit = $kullanicisor->fetch(PDO::FETCH_ASSOC);
	if (password_verify($kullanici_password, $kayit["kullanici_password"])) {
		$_SESSION['kullanici_mail'] = $kullanici_mail;
		header("Location:../production/index.php");
		exit;
	} else {
		header("Location:../production/login.php?durum=no");
		exit;
	}
}

if (isset($_POST['kullaniciduzenle'])) {
	$kullanici_id = $_POST['kullanici_id'];
	$ayarkaydet = $db->prepare("UPDATE kullanici SET
		kullanici_gsm=:kullanici_gsm,
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_durum=:kullanici_durum
		WHERE kullanici_id={$_POST['kullanici_id']}");
	$update = $ayarkaydet->execute(array(
		'kullanici_gsm' => $_POST['kullanici_gsm'],
		'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
		'kullanici_durum' => $_POST['kullanici_durum']
	));
	if ($update) {
		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");
	} else {
		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
	}
}

if (isset($_GET['kullanicisil'])) {
	$sil = $db->prepare("DELETE from kullanici where kullanici_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['kullanici_id']
	));
	if ($kontrol) {
		header("location:../production/kullanici.php?sil=ok");
	} else {
		header("location:../production/kullanici.php?sil=no");
	}
}

if (isset($_POST['menuduzenle'])) {
	$menu_id = $_POST['menu_id'];
	$menu_seourl = seo($_POST['menu_ad']);
	$ayarkaydet = $db->prepare("UPDATE menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		WHERE menu_id={$_POST['menu_id']}");
	$update = $ayarkaydet->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_detay' => $_POST['menu_detay'],
		'menu_url' => $_POST['menu_url'],
		'menu_sira' => $_POST['menu_sira'],
		'menu_seourl' => $menu_seourl,
		'menu_durum' => $_POST['menu_durum']
	));
	if ($update) {
		Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=ok");
	} else {
		Header("Location:../production/menu-duzenle.php?menu_id=$menu_id&durum=no");
	}
}

if (isset($_GET['menusil']) == "ok") {
	islemkontrol();
	$sil = $db->prepare("DELETE from menu where menu_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['menu_id']
	));
	if ($kontrol) {
		header("location:../production/menu.php?sil=ok");
	} else {
		header("location:../production/menu.php?sil=no");
	}
}

if (isset($_POST['menukaydet'])) {
	$menu_seourl = seo($_POST['menu_ad']);
	$ayarekle = $db->prepare("INSERT INTO menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		");
	$insert = $ayarekle->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_detay' => $_POST['menu_detay'],
		'menu_url' => $_POST['menu_url'],
		'menu_sira' => $_POST['menu_sira'],
		'menu_seourl' => $menu_seourl,
		'menu_durum' => $_POST['menu_durum']
	));
	if ($insert) {
		Header("Location:../production/menu-ekle.php?durum=ok");
	} else {
		Header("Location:../production/menu-ekle.php?durum=no");
	}
}

if (isset($_POST['logoduzenle'])) {
	if ($_FILES['ayar_logo']['size'] > 1048576) {
		echo "Bu dosya boyutu çok büyük";
		Header("Location:../production/genel-ayar.php?durum=dosyabuyuk");
	}
	$izinli_uzantilar = array('jpg', 'gif', 'png');
	$ext = strtolower(substr($_FILES['ayar_logo']["name"], strpos($_FILES['ayar_logo']["name"], '.') + 1));
	if (in_array($ext, $izinli_uzantilar) === false) {
		echo "Bu uzantı kabul edilmiyor";
		Header("Location:../production/genel-ayar.php?durum=formathata");
		exit;
	}
	$uploads_dir = '../../img';
	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];
	$benzersizsayi = rand(10000, 11000);
	$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi . $name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi$name");
	$duzenle = $db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update = $duzenle->execute(array(
		'logo' => $refimgyol
	));
	if ($update) {
		$resimsilunlink = $_POST['eski_yol'];
		unlink("../../$resimsilunlink");
		Header("Location:../production/genel-ayar.php?durum=ok");
	} else {
		Header("Location:../production/genel-ayar.php?durum=no");
	}
}

if (isset($_POST['sliderkaydet'])) {
	$uploads_dir = '../../img/slider';
	@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
	@$name = $_FILES['slider_resimyol']["name"];
	$benzersizsayi1 = rand(10000, 11000);
	$benzersizsayi2 = rand(10000, 11000);
	$benzersizsayi3 = rand(10000, 11000);
	$benzersizsayi4 = rand(10000, 11000);
	$benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
	$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	$kaydet = $db->prepare("INSERT INTO slider SET
		slider_ad=:slider_ad,
		slider_sira=:slider_sira,
		slider_link=:slider_link,
		slider_resimyol=:slider_resimyol
		");
	$insert = $kaydet->execute(array(
		'slider_ad' => $_POST['slider_ad'],
		'slider_sira' => $_POST['slider_sira'],
		'slider_link' => $_POST['slider_link'],
		'slider_resimyol' => $refimgyol
	));
	if ($insert) {
		Header("Location:../production/slider-ekle.php?durum=ok");
	} else {
		Header("Location:../production/slider-ekle.php?durum=no");
	}
}

if (isset($_POST['sliderduzenle'])) {
	if ($_FILES['slider_resimyol']["size"] > 0) {
		$uploads_dir = '../../img/slider';
		@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
		@$name = $_FILES['slider_resimyol']["name"];
		$benzersizsayi1 = rand(10000, 11000);
		$benzersizsayi2 = rand(10000, 11000);
		$benzersizsayi3 = rand(10000, 11000);
		$benzersizsayi4 = rand(10000, 11000);
		$benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
		$duzenle = $db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum,
			slider_resimyol=:resimyol	
			WHERE slider_id={$_POST['slider_id']}");
		$update = $duzenle->execute(array(
			'ad' => $_POST['slider_ad'],
			'link' => $_POST['slider_link'],
			'sira' => $_POST['slider_sira'],
			'durum' => $_POST['slider_durum'],
			'resimyol' => $refimgyol,
		));
		$slider_id = $_POST['slider_id'];
		if ($update) {
			$resimsilunlink = $_POST['slider_resimyol'];
			unlink("../../$resimsilunlink");
			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");
		} else {
			Header("Location:../production/slider-duzenle.php?durum=no");
		}
	} else {
		$duzenle = $db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum		
			WHERE slider_id={$_POST['slider_id']}");
		$update = $duzenle->execute(array(
			'ad' => $_POST['slider_ad'],
			'link' => $_POST['slider_link'],
			'sira' => $_POST['slider_sira'],
			'durum' => $_POST['slider_durum']
		));
		$slider_id = $_POST['slider_id'];
		if ($update) {
			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");
		} else {
			Header("Location:../production/slider-duzenle.php?durum=no");
		}
	}
}

if (isset($_GET['slidersil']) == "ok") {
	islemkontrol();
	$sil = $db->prepare("DELETE from slider where slider_id=:slider_id");
	$kontrol = $sil->execute(array(
		'slider_id' => $_GET['slider_id']
	));
	if ($kontrol) {
		$resimsilunlink = $_GET['slider_resimyol'];
		unlink("../../$resimsilunlink");
		Header("Location:../production/slider.php?durum=ok");
	} else {
		Header("Location:../production/slider.php?durum=no");
	}
}

if (isset($_POST['kullanicikaydet'])) {
	$kullanici_adsoyad = htmlspecialchars($_POST['kullanici_adsoyad']);
	$kullanici_mail = htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_passwordone = $_POST['kullanici_passwordone'];
	$kullanici_passwordtwo = $_POST['kullanici_passwordtwo'];
	if ($kullanici_passwordone == $kullanici_passwordtwo) {
		if (strlen($kullanici_passwordone) >= 6) {
			$kullanicisor = $db->prepare("select * from kullanici where kullanici_mail=:mail");
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail
			));
			$say = $kullanicisor->rowCount();
			if ($say == 0) {
				$password = sha1(md5($kullanici_passwordone));
				$kullanici_yetki = 1;
				$kullanicikaydet = $db->prepare("INSERT INTO kullanici SET
					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_yetki=:kullanici_yetki
					");
				$insert = $kullanicikaydet->execute(array(
					'kullanici_adsoyad' => $kullanici_adsoyad,
					'kullanici_mail' => $kullanici_mail,
					'kullanici_password' => $password,
					'kullanici_yetki' => $kullanici_yetki
				));
				if ($insert) {
					header("Location:../../index.php?durum=loginbasarili");
				} else {
					header("Location:../../register.php?durum=basarisiz");
				}
			} else {
				header("Location:../../register.php?durum=mukerrerkayit");
			}
		} else {
			header("Location:../../register.php?durum=eksiksifre");
		}
	} else {
		header("Location:../../register.php?durum=farklisifre");
	}
}

if (isset($_POST['kullanicigiris'])) {
	echo $kullanici_mail = htmlspecialchars($_POST['kullanici_mail']);
	echo $kullanici_password = sha1(md5($_POST['kullanici_password']));
	$kullanicisor = $db->prepare("select * from kullanici where 
    kullanici_mail=:mail and 
    kullanici_yetki=:yetki and 
    kullanici_password=:password and 
    kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'yetki' => 1,
		'password' => $kullanici_password,
		'durum' => 1
	));
	$say = $kullanicisor->rowCount();
	if ($say == 1) {
		echo $_SESSION['userkullanici_mail'] = $kullanici_mail;
		header("Location:../../");
		exit;
	} else {
		header("Location:../../?durum=basarisizgiris");
	}
}

if (isset($_POST['kategoriduzenle'])) {
	$kategori_id = $_POST['kategori_id'];
	$kategori_seourl = seo($_POST['kategori_ad']);
	$kaydet = $db->prepare("UPDATE kategori SET
		kategori_ad=:ad,
		kategori_ust=:ust,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_sira=:sira
		WHERE kategori_id={$_POST['kategori_id']}");
	$update = $kaydet->execute(array(
		'ad' => $_POST['kategori_ad'],
		'ust' => $_POST['kategoriust_id'],
		'kategori_durum' => $_POST['kategori_durum'],
		'seourl' => $kategori_seourl,
		'sira' => $_POST['kategori_sira']
	));
	if ($update) {
		Header("Location:../production/kategori-duzenle.php?durum=ok&kategori_id=$kategori_id");
	} else {
		Header("Location:../production/kategori-duzenle.php?durum=no&kategori_id=$kategori_id");
	}
}

if (isset($_POST['kategoriekle'])) {
	$kategori_seourl = seo($_POST['kategori_ad']);
	$kaydet = $db->prepare("INSERT INTO kategori SET
		kategori_ad=:ad,
		kategori_ust=:ust,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_sira=:sira
		");
	$insert = $kaydet->execute(array(
		'ad' => $_POST['kategori_ad'],
		'ust' => $_POST['kategoriust_id'],
		'kategori_durum' => $_POST['kategori_durum'],
		'seourl' => $kategori_seourl,
		'sira' => $_POST['kategori_sira']
	));
	if ($insert) {
		Header("Location:../production/kategori-ekle.php?durum=ok");
	} else {
		Header("Location:../production/kategori-ekle.php?durum=no");
	}
}

if (isset($_GET['kategorisil']) == "ok") {
	$sil = $db->prepare("DELETE from kategori where kategori_id=:kategori_id");
	$kontrol = $sil->execute(array(
		'kategori_id' => $_GET['kategori_id']
	));
	if ($kontrol) {
		Header("Location:../production/kategori.php?sil=ok");
	} else {
		Header("Location:../production/kategori.php?sil=no");
	}
}

if (isset($_GET['urunsil']) == "ok") {
	$sil = $db->prepare("DELETE from urun where urun_id=:urun_id");
	$kontrol = $sil->execute(array(
		'urun_id' => $_GET['urun_id']
	));
	if ($kontrol) {
		Header("Location:../production/urun.php?sil=ok");
	} else {
		Header("Location:../production/urun.php?sil=no");
	}
}

if (isset($_POST['urunekle'])) {
	$urun_seourl = seo($_POST['urun_ad']);
	$kaydet = $db->prepare("INSERT INTO urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_video=:urun_video,
		urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
		urun_onecikar=:urun_onecikar,
		urun_stok=:urun_stok,	
		urun_seourl=:seourl		
		");
	$insert = $kaydet->execute(array(
		'kategori_id' => $_POST['kategori_id'],
		'urun_ad' => $_POST['urun_ad'],
		'urun_detay' => $_POST['urun_detay'],
		'urun_fiyat' => $_POST['urun_fiyat'],
		'urun_video' => $_POST['urun_video'],
		'urun_keyword' => $_POST['urun_keyword'],
		'urun_durum' => $_POST['urun_durum'],
		'urun_onecikar' => $_POST['urun_onecikar'],
		'urun_stok' => $_POST['urun_stok'],
		'seourl' => $urun_seourl
	));
	if ($insert) {
		Header("Location:../production/urun-ekle.php?durum=ok");
	} else {
		Header("Location:../production/urun-ekle.php?durum=no");
	}
}

if (isset($_POST['urunduzenle'])) {
	$urun_id = $_POST['urun_id'];
	$urun_seourl = seo($_POST['urun_ad']);
	$kaydet = $db->prepare("UPDATE urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_video=:urun_video,
		urun_onecikar=:urun_onecikar,
		urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
		urun_stok=:urun_stok,	
		urun_seourl=:seourl		
		WHERE urun_id={$_POST['urun_id']}");
	$update = $kaydet->execute(array(
		'kategori_id' => $_POST['kategori_id'],
		'urun_ad' => $_POST['urun_ad'],
		'urun_detay' => $_POST['urun_detay'],
		'urun_fiyat' => $_POST['urun_fiyat'],
		'urun_video' => $_POST['urun_video'],
		'urun_onecikar' => $_POST['urun_onecikar'],
		'urun_keyword' => $_POST['urun_keyword'],
		'urun_durum' => $_POST['urun_durum'],
		'urun_stok' => $_POST['urun_stok'],
		'seourl' => $urun_seourl
	));
	if ($update) {
		Header("Location:../production/urun-duzenle.php?durum=ok&urun_id=$urun_id");
	} else {
		Header("Location:../production/urun-duzenle.php?durum=no&urun_id=$urun_id");
	}
}

if (isset($_POST['yorumkaydet'])) {
	$gelen_url = $_POST['gelen_url'];
	$ayarekle = $db->prepare("INSERT INTO yorumlar SET
		yorum_detay=:yorum_detay,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id	
		");
	$insert = $ayarekle->execute(array(
		'yorum_detay' => $_POST['yorum_detay'],
		'kullanici_id' => $_POST['kullanici_id'],
		'urun_id' => $_POST['urun_id']
	));
	if ($insert) {
		Header("Location:$gelen_url?yorum=ok");
	} else {
		Header("Location:$gelen_url?yorum=no");
	}
}

if (isset($_GET['yorum_onay']) == "ok") {
	$duzenle = $db->prepare("UPDATE yorumlar SET
		yorum_onay=:yorum_onay
		WHERE yorum_id={$_GET['yorum_id']}");
	$update = $duzenle->execute(array(
		'yorum_onay' => $_GET['yorum_one']
	));
	if ($update) {
		Header("Location:../production/yorum.php?durum=ok");
	} else {
		Header("Location:../production/yorum.php?durum=no");
	}
}

if (isset($_GET['yorumsil']) == "ok") {
	$sil = $db->prepare("DELETE from yorumlar where yorum_id=:yorum_id");
	$kontrol = $sil->execute(array(
		'yorum_id' => $_GET['yorum_id']
	));
	if ($kontrol) {
		Header("Location:../production/yorum.php?durum=ok");
	} else {
		Header("Location:../production/yorum.php?durum=no");
	}
}

if (isset($_GET['urun_onecikar']) == "ok") {
	$duzenle = $db->prepare("UPDATE urun SET
		urun_onecikar=:urun_onecikar
		WHERE urun_id={$_GET['urun_id']}");
	$update = $duzenle->execute(array(
		'urun_onecikar' => $_GET['urun_one']
	));
	if ($update) {
		Header("Location:../production/urun.php?durum=ok");
	} else {
		Header("Location:../production/urun.php?durum=no");
	}
}

if (isset($_POST['sepetekle'])) {
	$ayarekle = $db->prepare("INSERT INTO sepet SET
		urun_adet=:urun_adet,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id	
		");
	$insert = $ayarekle->execute(array(
		'urun_adet' => $_POST['urun_adet'],
		'kullanici_id' => $_POST['kullanici_id'],
		'urun_id' => $_POST['urun_id']
	));
	if ($insert) {
		Header("Location:../../sepet?durum=ok");
	} else {
		Header("Location:../../sepet?durum=no");
	}
}

if (isset($_GET['sepetduzenle'])) {
	$kaydet = $db->prepare("UPDATE sepet SET
        urun_adet=:urun_adet    
        WHERE urun_id={$_GET['urun_id']}");
	$update = $kaydet->execute(array(
		'urun_adet' => $_GET['urun_adet']
	));
	if ($update) {
		Header("Location:../../sepet?durum=ok");
	} else {
		Header("Location:../../sepet?durum=no");
	}
}

if (isset($_GET['sepetsil']) == "ok") {
	$sil = $db->prepare("DELETE from sepet where sepet_id=:id");
	$kontrol = $sil->execute(array(
		'id' => $_GET['sepet_id']
	));
	if ($kontrol) {
		header("Location:../../sepet?sil=ok");
	} else {
		header("Location:../../sepet?sil=no");
	}
}

if (isset($_POST['urunfotosil'])) {
	$urun_id = $_POST['urun_id'];
	$checklist = $_POST['urunfotosec'];
	foreach ($checklist as $list) {
		$sil = $db->prepare("DELETE from urunfoto where urunfoto_id=:urunfoto_id");
		$kontrol = $sil->execute(array(
			'urunfoto_id' => $list
		));
	}
	if ($kontrol) {
		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=ok");
	} else {
		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=no");
	}
}

if (isset($_POST['kullanicibilgiguncelle'])) {
	$kullanici_id = $_POST['kullanici_id'];
	$sifre = sha1(md5($_POST['sifre']));
	$kullanici_passwordone = $_POST['kullanici_passwordone'];
	$kullanici_passwordtwo = $_POST['kullanici_passwordtwo'];
	$kullanicisor = $db->prepare("select * from kullanici where kullanici_id=:id");
	$kullanicisor->execute(array(
		'id' => $kullanici_id
	));
	$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
	if (!empty($kullanici_passwordone) and !empty($kullanici_passwordtwo && !empty($sifre))) {
		if ($kullanici_passwordone == $kullanici_passwordtwo) {
			if (strlen($kullanici_passwordone) >= 6) {
				if ($kullanicicek["kullanici_password"] == $sifre) {
					$kullaniciGuncelle = $db->prepare("UPDATE kullanici SET
				kullanici_adsoyad=:kullanici_adsoyad,
				kullanici_password=:kullanici_password,
				kullanici_il=:kullanici_il,
				kullanici_ilce=:kullanici_ilce,
				kullanici_adres=:kullanici_adres
				WHERE kullanici_id={$_POST['kullanici_id']}");
					$update = $kullaniciGuncelle->execute(array(
						'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
						'kullanici_password' => sha1(md5($kullanici_passwordone)),
						'kullanici_il' => $_POST['kullanici_il'],
						'kullanici_ilce' => $_POST['kullanici_ilce'],
						'kullanici_adres' => $_POST['kullanici_adres']
					));
					if ($update) {
						Header("Location:../../hesabim?durum=ok");
					} else {
						Header("Location:../../hesabim?durum=no");
					}
				} else {
					header("Location:../../hesabim?durum=eskisifreyanlis");
				}
			} else {
				header("Location:../../hesabim?durum=eksiksifre");
			}
		} else {
			header("Location:../../hesabim?durum=farklisifre");
		}
	} else {
		$kullaniciGuncelle = $db->prepare("UPDATE kullanici SET
				kullanici_adsoyad=:kullanici_adsoyad,
				kullanici_il=:kullanici_il,
				kullanici_ilce=:kullanici_ilce,
				kullanici_adres=:kullanici_adres
				WHERE kullanici_id={$_POST['kullanici_id']}");
		$update = $kullaniciGuncelle->execute(array(
			'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
			'kullanici_il' => $_POST['kullanici_il'],
			'kullanici_ilce' => $_POST['kullanici_ilce'],
			'kullanici_adres' => $_POST['kullanici_adres']
		));
		if ($update) {
			Header("Location:../../hesabim?durum=ok");
		} else {
			Header("Location:../../hesabim?durum=no");
		}
	}
}

if (isset($_POST['kullanicisifreguncelle'])) {
	$kullanici_eskipassword = trim($_POST['kullanici_eskipassword']);
	$kullanici_passwordone = trim($_POST['kullanici_passwordone']);
	$kullanici_passwordtwo = trim($_POST['kullanici_passwordtwo']);
	$kullanici_password = sha1(md5($kullanici_eskipassword));
	$kullanicisor = $db->prepare("select * from kullanici where kullanici_password=:password and kullanici_id=:id");
	$kullanicisor->execute(array(
		'password' => $kullanici_password,
		'id' => $_POST['kullanici_id']
	));
	$say = $kullanicisor->rowCount();
	if ($say == 0) {
		header("Location:../../sifre-guncelle?durum=eskisifre");
	} else {
		if ($kullanici_passwordone == $kullanici_passwordtwo) {
			if (strlen($kullanici_passwordone) >= 6) {
				$password = sha1(md5($kullanici_passwordone));
				$kullanici_yetki = 1;
				$kullanicisifreguncelle = $db->prepare("UPDATE kullanici SET
					kullanici_password=:kullanici_password
					WHERE kullanici_id={$_POST['kullanici_id']}");
				$update = $kullanicisifreguncelle->execute(array(
					'kullanici_password' => $password
				));
				if ($update) {
					header("Location:../../sifre-guncelle.php?durum=sifredegisti");
				} else {
					header("Location:../../sifre-guncelle.php?durum=no");
				}
			} else {
				header("Location:../../sifre-guncelle.php?durum=eksiksifre");
			}
		} else {
			header("Location:../../sifre-guncelle?durum=sifreleruyusmuyor");
			exit;
		}
	}
}

if (isset($_GET['aktifpasif']) == "ok") {
	$aktifPasif = $db->prepare("UPDATE kullanici SET
		kullanici_durum=:kullanici_durum
		WHERE kullanici_id={$_GET['kullanici_id']}");
	$degistir = $aktifPasif->execute(array(
		'kullanici_durum' => $_GET['durumdegis']
	));
	if ($degistir) {
		Header("Location:../production/kullanici.php?durum=ok");
	} else {
		Header("Location:../production/kullanici.php?durum=no");
	}
}

if (isset($_POST['admin-bilgi-guncelle'])) {
	if ($_FILES['kullanici_resim']["size"] > 0) {
		$uploads_dir = '../../img';
		@$tmp_name = $_FILES['kullanici_resim']["tmp_name"];
		@$name = $_FILES['kullanici_resim']["name"];
		$benzersizsayi1 = rand(10000, 11000);
		$benzersizsayi2 = rand(10000, 11000);
		$benzersizsayi3 = rand(10000, 11000);
		$benzersizsayi4 = rand(10000, 11000);
		$benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
		$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
		$duzenle = $db->prepare("UPDATE kullanici SET
			kullanici_adsoyad=:ad,
			kullanici_gsm=:tel,
			kullanici_durum=:durum,
			kullanici_resim=:kullanici_resim	
			WHERE kullanici_id={$_POST['kullanici_id']}");
		$update = $duzenle->execute(array(
			'ad' => $_POST['kullanici_adsoyad'],
			'tel' => $_POST['kullanici_gsm'],
			'durum' => $_POST['kullanici_durum'],
			'kullanici_resim' => $refimgyol,
		));
		if ($update) {
			$resimsilunlink = $_POST['kullanici_resimyol'];
			unlink("../../$resimsilunlink");
			Header("Location:../production/admin-bilgi-guncelle.php?&durum=ok");
		} else {
			Header("Location:../production/admin-bilgi-guncelle.php?durum=no");
		}
	} else {
		$duzenle = $db->prepare("UPDATE kullanici SET
			kullanici_adsoyad=:ad,
			kullanici_gsm=:tel,
			kullanici_durum=:durum		
			WHERE kullanici_id={$_POST['kullanici_id']}");
		$update = $duzenle->execute(array(
			'ad' => $_POST['kullanici_adsoyad'],
			'tel' => $_POST['kullanici_gsm'],
			'durum' => $_POST['kullanici_durum']
		));
		if ($update) {
			Header("Location:../production/admin-bilgi-guncelle.php?&durum=ok");
		} else {
			Header("Location:../production/admin-bilgi-guncelle.php?durum=no");
		}
	}
}

if (isset($_POST['bankaekle'])) {
	$kaydet = $db->prepare("INSERT INTO banka SET
		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_iban=:banka_iban
		");
	$insert = $kaydet->execute(array(
		'ad' => $_POST['banka_ad'],
		'banka_durum' => $_POST['banka_durum'],
		'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad'],
		'banka_iban' => $_POST['banka_iban']
	));
	if ($insert) {
		Header("Location:../production/banka.php?durum=ok");
	} else {
		Header("Location:../production/banka.php?durum=no");
	}
}

if (isset($_POST['bankaduzenle'])) {
	$banka_id = $_POST['banka_id'];
	$kaydet = $db->prepare("UPDATE banka SET
		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_iban=:banka_iban
		WHERE banka_id={$_POST['banka_id']}");
	$update = $kaydet->execute(array(
		'ad' => $_POST['banka_ad'],
		'banka_durum' => $_POST['banka_durum'],
		'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad'],
		'banka_iban' => $_POST['banka_iban']
	));
	if ($update) {
		Header("Location:../production/banka-duzenle.php?banka_id=$banka_id&durum=ok");
	} else {
		Header("Location:../production/banka-duzenle.php?banka_id=$banka_id&durum=no");
	}
}

if (isset($_GET['bankasil']) == "ok") {
	$sil = $db->prepare("DELETE from banka where banka_id=:banka_id");
	$kontrol = $sil->execute(array(
		'banka_id' => $_GET['banka_id']
	));
	if ($kontrol) {
		Header("Location:../production/banka.php?sil=ok");
	} else {
		Header("Location:../production/banka.php?sil=no");
	}
}

if (isset($_POST['bankasiparisekle'])) {
	$siparis_tip = "Banka Havalesi";
	$kaydet = $db->prepare("INSERT INTO siparis SET
		kullanici_id=:kullanici_id,
		siparis_tip=:siparis_tip,	
		siparis_banka=:siparis_banka,
		siparis_toplam=:siparis_toplam
		");
	$insert = $kaydet->execute(array(
		'kullanici_id' => $_POST['kullanici_id'],
		'siparis_tip' => $siparis_tip,
		'siparis_banka' => $_POST['siparis_banka'],
		'siparis_toplam' => $_POST['siparis_toplam']
	));
	if ($insert) {
		echo $siparis_id = $db->lastInsertId();
		echo "<hr>";
		$kullanici_id = $_POST['kullanici_id'];
		$sepetsor = $db->prepare("SELECT * FROM sepet where kullanici_id=:id");
		$sepetsor->execute(array(
			'id' => $kullanici_id
		));
		while ($sepetcek = $sepetsor->fetch(PDO::FETCH_ASSOC)) {
			$urun_id = $sepetcek['urun_id'];
			$urun_adet = $sepetcek['urun_adet'];
			$urunsor = $db->prepare("SELECT * FROM urun where urun_id=:id");
			$urunsor->execute(array(
				'id' => $urun_id
			));
			$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
			echo $urun_fiyat = $uruncek['urun_fiyat'];
			$kaydet = $db->prepare("INSERT INTO siparis_detay SET
				siparis_id=:siparis_id,
				urun_id=:urun_id,	
				urun_fiyat=:urun_fiyat,
				urun_adet=:urun_adet
				");
			$insert = $kaydet->execute(array(
				'siparis_id' => $siparis_id,
				'urun_id' => $urun_id,
				'urun_fiyat' => $urun_fiyat,
				'urun_adet' => $urun_adet
			));
		}
		if ($insert) { //Sipariş detay kayıtta başarıysa sepeti boşalt
			$sil = $db->prepare("DELETE from sepet where kullanici_id=:kullanici_id");
			$kontrol = $sil->execute(array(
				'kullanici_id' => $kullanici_id
			));
			Header("Location:../../siparislerim?durum=ok");
			exit;
		}
	} else {
		Header("Location:../../odeme.php?durum=no");
	}
}

if (isset($_POST['mailayarkaydet'])) {
	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayar_smtphost=:smtphost,
		ayar_smtpuser=:smtpuser,
		ayar_smtppassword=:smtppassword,
		ayar_smtpport=:smtpport
		WHERE ayar_id=0");
	$update = $ayarkaydet->execute(array(
		'smtphost' => $_POST['ayar_smtphost'],
		'smtpuser' => $_POST['ayar_smtpuser'],
		'smtppassword' => $_POST['ayar_smtppassword'],
		'smtpport' => $_POST['ayar_smtpport']
	));
	if ($update) {
		Header("Location:../production/mail-ayar.php?durum=ok");
	} else {
		Header("Location:../production/mail-ayar.php?durum=no");
	}
}

if (isset($_GET['urunaktifpasif']) == "ok") {
	$aktifPasif = $db->prepare("UPDATE urun SET
		urun_durum=:urun_durum
		WHERE urun_id={$_GET['urun_id']}");
	$degistir = $aktifPasif->execute(array(
		'urun_durum' => $_GET['durumdegis']
	));
	if ($degistir) {
		Header("Location:../production/urun.php?durum=ok");
	} else {
		Header("Location:../production/urun.php?durum=no");
	}
}
