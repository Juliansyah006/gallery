<?php

SESSION_START();
include_once "../controllers/c_album.php";
$album = new c_album();

date_default_timezone_set('Asia/jakarta');
$tanggal = date("Y-m-d H:i:s");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GALLERY</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                  <h3 class="text-center">Edit Album</h3>
                  <?php foreach($album->edit($_GET['albumid']) as $edit) : ?>
                 <form action="../routers/r_album.php?aksi=edit" method="post" enctype="multipart/form-data">

                 <div class="mb-1">
                    <input type="id" class="form-control" name="albumid" value="<?= $edit->albumid ?>" id="albumid" hidden>
                  </div>

                  <div class="form-group">
                  <label>Nama Album</label>
                  <input type="text" class="form-control p_input" id="namaalbum" value="<?= $edit->namaalbum ?>" name="namaalbum">

                  </div>

                 <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control p_input" id="deskripsi" rows="4" name="deskripsi" required><?= $edit->deskripsi ?></textarea>
                  </div>

                 <div class="form-group">
                    <input type="datetime-local" class="form-control p_input" id="tanggaldibuat" name="tanggaldibuat" value="<?= $tanggal ?>" hidden>
                  </div>

                  <!-- <div class="form-group">
                    <input type="file" class="form-control" value="" name="photo" id="photo" placeholder="Photo" required>
                  </div> -->

                  <div class="form-group">
                    <input type="text" class="form-control form-control-user"  id="userid" value="<?= $_SESSION['userid'] ?>" name="userid" hidden>
                  </div>

                  <button type="submit" class="btn btn-outline-secondary btn-lg btn-block">Edit</button>
                  <!-- page-body-wrapper ends -->

                  <?php endforeach;?>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>