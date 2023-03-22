﻿<?php
require_once 'header.php';
giriskontrol();
?>
<!-- Header Area End Here -->
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
  <div class="container">
    <div class="pagination-wrapper">
    </div>
  </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
  <div class="container">
    <div class="row settings-wrapper">
      <?php require_once 'hesap-sidebar.php' ?>
      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
        <div class="settings-details tab-content">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section">Giden Mesajlar</h2>
            <div class="personal-info inner-page-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mesaj Tarihi</th>
                    <th scope="col">Gönderilen Kullanıcı</th>
                    <th scope="col">Detay</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $mesajsor = $db->prepare("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gel=kullanici.kullanici_id where mesaj.kullanici_gon=:id order by mesaj_okunma,mesaj_zaman DESC");
                  $mesajsor->execute(array(
                    'id' => $_SESSION['userkullanici_id']
                  ));
                  $say = 0;
                  while ($mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC)) {
                    $say++;
                    $kullanici_gon = $mesajcek['kullanici_gon'];
                  ?>
                    <tr>
                      <th scope="row"><?= $say ?></th>
                      <td><?= uzuntarih($mesajcek['mesaj_zaman']); ?></td>
                      <td><?= $mesajcek['kullanici_ad'] . " " . $mesajcek['kullanici_soyad'] ?></td>
                      <td><a href="mesaj-detay?gidenmesaj=ok&mesaj_id=<?= $mesajcek['mesaj_id'] ?>&kullanici_gon=<?= $mesajcek['kullanici_gon'] ?>"><button class="btn btn-primary btn-xs">Mesajı Oku</button></a></td>
                      <td>sil</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Settings Page End Here -->
<?php require_once 'footer.php'; ?>