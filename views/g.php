<?php

include_once "../controllers/c_album.php";
include_once "../controllers/c_foto.php";
include_once "../controllers/c_login.php";
include_once "template/header.php";
include_once "homefoto.php";


$baru = new c_album();
$foto = new c_foto();
?>
<body>
    <?php foreach ($baru->edit($_GET['albumid']) as $read) : ?>
                    <div class="card">
                      <div class="container">
                        <h4>Album : <?= $read->namaalbum?></h4>
                       <p><?= $read->deskripsi ?></p>
                        <a class="cta-btn" href="tambahfoto.php?albumid=<?php echo $_GET['albumid'];?>">Tambah Foto</a>
                    </div>
    <?php endforeach; ?>
    <?php if (empty($foto->read($_GET['albumid']))) { 
      echo'<h1 class="text-secondary"> You Dont Have Any Photos In This Album';
    }else{  ?>
    <?php foreach ($foto->read($_GET['albumid']) as $read) : ?>
        <div class="card">
          <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel" id="owl-carousel-basic">
              <div class="item">
              </div>           
          </div>
        </div>
      <div class="d-flex py-10">
          <div class="preview-list w-200">
                <div class="preview-item p-02">
                   <img src="../assets/images/<?= $read->lokasifile ?>" height="360px" width="260px">
                     <a href="../assets/images/<?= $read->lokasifile ?>" title= "<?php $read->judulfoto ?>" class="img-fluid" alt=""></a>
                     <?php
                      if ($_SESSION['userid'] ==  $read->userid) {
                      ?>
                        <a href="editfoto.php?fotoid=<?= $read->fotoid ?>" title= "" class="details-link"><i class="bi bi-pencil-square"></i></a>
                        <a href="../routers/r_foto.php?fotoid=<?= $read->fotoid ?>&aksi=delete&albumid=<?= $read->albumid ?>" onclick="return confirm('Yakin ingin menghapus data ini?')"  title= "hapus" class="details-link"><i class="bi bi-trash"></i></a>
                      <?php }?>  
                      <a href="gallery.php?fotoid=<?= $read->fotoid ?>">
                      <h2><?= $read->deskripsifoto ?></h2>
                      </a>
                      <?php endforeach; ?>
                     <?php } ?>
                </div>
          </div>
      </div>
</body>






<?php

$title = "Dashboard";
$side = "dashboard";
include_once "template/header.php";
include_once "../controllers/c_foto.php";
include_once "../controllers/c_komentar.php";
include_once "../controllers/c_like.php";
$foto = new c_foto();
$komentar = new c_komentar();
$tampilike = new c_like();

date_default_timezone_set('Asia/Jakarta');
$waktu = date("Y-m-d H:i:s");


?>

<main id="main" class="main">

    <?php foreach ($foto->home() as $tampil) : ?>
        <div class="card">
            <div class="container">

            </div>
            <div class="card-body mt-2">
                <h4 style="margin-left: 2%; margin-bottom: 1%;"><?= $tampil->username ?></h4>
                <h6 style="margin-left: 2%; margin-bottom: 1%;"><?= $tampil->tanggalunggah ?></h6>
                <img src="../assets/images/<?= $tampil->lokasifile ?>" width="50%" height="50%" alt="">
                <h5 class="card-title"><?= $tampil->judulfoto ?></h5>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <p class="p mb-0 text-gray-800 m-0 font-weight-bold text-secondary"><?= $tampil->deskripsifoto ?></p>
                </div>
                <div class="row">
                    <div class="col-10">
                        <?php if ($tampilike->user($tampil->fotoid, $_SESSION['userid']) == 0) { ?>
                            <a class="p mb-0 text-gray-800 m-0 font-weight-bold text-secondary" href="../routers/r_like.php?aksi=tambah&userid=<?= $_SESSION['userid'] ?>&fotoid=<?= $tampil->fotoid ?>">Like</a>
                        <?php } else { ?>
                            <a class="p mb-0 text-gray-800 m-0 font-weight-bold text-secondary" href="../routers/r_like.php?aksi=delete&userid=<?= $_SESSION['userid'] ?>">Unlike</a>
                        <?php } ?>
                    </div>
                    <div class="col-2">
                        <?= $tampilike->jumlah($tampil->fotoid) ?> Like | <?= $komentar->jumlah($tampil->fotoid) ?> Comments
                    </div>
                </div>

                <?php
                if (empty($komentar->read_komentar($tampil->fotoid))) {
                    echo "";
                } else { ?>
                    <?php foreach ($komentar->read_komentar($tampil->fotoid) as $komen) : ?>
                        <div class="alert alert-dark alert-dismissible fade show " col-lg-12 role="alert">
                            <a class="nav-link nav-profile align-items-center pe-0" data-bs-toggle="dropdown">
                                <span class="username text-dark" style="margin-left: 2%;"><?= $komen->username ?></span>
                                <?php if ($_SESSION['userid'] == $komen->userid) { ?>
                                    <a href="../routers/r_komentar.php?komentarid=<?= $komen->komentarid ?>&aksi=delete" style="margin-left: 90%;" class="text-dark" onclick="return confirm('Yakin ingin menghapus komentar anda?')">Hapus</a>
                                <?php } ?>
                                <br>
                                <span class="p text-dark" style="margin-left: 2%;"><?= $komen->isikomentar ?></span>
                                <span style="margin-left: 68%;" class="text-dark">
                                    <?= $komen->tanggalkomentar ?>
                                </span>
                                <!-- <span style="margin-left: 5%;"></span> -->
                                <!-- <br> -->


                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>

                <form class="row g-3 mt-3" action="../routers/r_komentar.php?aksi=tambah" method="post">
                    <input type="text" name="isikomentar" class="form-control" placeholder="Comments">
                    <input type="text" name="komentarid" id="id" hidden>
                    <input type="text" name="userid" id="" value="<?= $_SESSION['userid'] ?>" hidden>
                    <input type="text" name="fotoid" id="" value="<?= $tampil->fotoid ?>" hidden>
                    <input type="text" name="tanggal" id="" value="<?= $waktu ?>" hidden>
                    <button type="submit" hidden></button>
                </form>
            </div>
        </div>
    <?php endforeach ?>
</main><!-- End #main -->


<?php

include_once "template/footer.php";

?>