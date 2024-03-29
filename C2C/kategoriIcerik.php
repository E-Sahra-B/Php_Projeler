<?php
while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
?>
    <div class="single-item-list">
        <div class="item-img">
            <img style="width: 238px; height: 178px;" src="<?= $uruncek['urunfoto_resimyol'] ?>" alt="<?= $uruncek['urun_ad'] ?>" class="img-responsive">
            <!-- <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>-->
        </div>
        <div class="item-content">
            <div class="item-info">
                <div class="item-title">
                    <h3><a href="urun-<?= seo($uruncek['urun_ad']) . "-" . $uruncek['urun_id'] ?>"><?= $uruncek['urun_ad'] ?></a></h3>
                    <span><?= $uruncek['kategori_ad'] ?></span>
                </div>
                <div class="item-sale-info">
                    <div class="price"><small><?= fiyat($uruncek['urun_fiyat']) ?></small></div>
                    <div class="sale-qty">Satış (
                        <?php
                        $urunsay = $db->prepare("SELECT COUNT(urun_id) as say FROM siparis_detay where urun_id=:id");
                        $urunsay->execute(array(
                            'id' => $uruncek['urun_id']
                        ));
                        $urunsaycek = $urunsay->fetch(PDO::FETCH_ASSOC);
                        echo $urunsaycek['say'];
                        ?> )</div>
                </div>
            </div>
            <div class="item-profile">
                <div class="profile-title">
                    <div class="img-wrapper"><img src="<?= $uruncek['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>
                    <span><?= $uruncek['kullanici_ad'] . " " . kisalt($uruncek['kullanici_soyad'], 0, 1) ?>.</span>
                </div>
                <div class="profile-rating-info">
                    <ul>
                        <?php require_once 'yildiz.php'; ?>
                        <li><i class="fa fa-comment-o" aria-hidden="true"></i>(
                            <?php
                            $yorumsay = $db->prepare("SELECT COUNT(urun_id) as say FROM yorumlar WHERE urun_id=:id");
                            $yorumsay->execute(array(
                                'id' => $uruncek['urun_id']
                            ));
                            $yorumsaycek = $yorumsay->fetch(PDO::FETCH_ASSOC);
                            echo $yorumsaycek['say'];
                            ?>
                            )</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } ?>