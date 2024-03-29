<?php
$title = "Kullanıcı Listeleme";
require_once 'header.php';
$kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_yetki=:yetki");
$kullanicisor->execute(['yetki' => 1]);
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div>
              <?php
              if ($_GET['sil'] == "ok") { ?>
                <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  Kullanıcı Silme İşlemi Başarılı
                </div>
              <?php } elseif ($_GET['sil'] == "no") { ?>
                <div class="alert alert-danger">İşlem Başarısız
                </div>
              <?php }
              ?>
            </div>
            <h2>Kullanıcı Listeleme</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Tablo İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Ad Soyad</th>
                  <th>Mail Adresi</th>
                  <th>Telefon</th>
                  <th>Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                    <td><?php echo date("d-m-Y", strtotime($kullanicicek['kullanici_zaman'])) ?></td>
                    <td><?php echo $kullanicicek['kullanici_adsoyad'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_mail'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_gsm'] ?></td>
                    <td class="text-center">
                      <?php
                      if ($kullanicicek['kullanici_durum'] == 0) { ?>
                        <a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>&durumdegis=1&aktifpasif=ok"><button class="btn btn-secondary btn-xs">Aktif Yap</button></a>
                      <?php } elseif ($kullanicicek['kullanici_durum'] == 1) { ?>
                        <a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>&durumdegis=0&aktifpasif=ok"><button class="btn btn-success btn-xs">Pasif Yap</button></a>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <a href="kullanici-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a>
                    </td>
                    <td class="text-center">
                      <a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>&kullanicisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a>
                    </td>
                  </tr>
                <?php  }
                ?>
              </tbody>
            </table>
            <!-- Tablo İçerik Bitişi -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php require_once 'footer.php'; ?>