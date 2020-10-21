<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>Guest Book</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
    <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
</head>

<?php
// Create database connection using config file
include_once("condb.php");

// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM guestbook ORDER BY id DESC");
?>

<body class="light sidebar-collapse sidebar-offCanvas-lg">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
<div class="page">
    <header class="indigo lighten-2 relative shadow pb-5">
        <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar">
            <div class="relative" style="height: 50px;">
            </div>
        </div>
        <div class="container text-white pb-5">
            <div class="mb-4">
                <h4>
                    <i class="icon-contact_phone"></i>
                    Guest Book
                </h4>
            </div>
        </div>
    </header>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="guestbookController.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                    </div>
                    <div class="form-group">
                        <label for="msg" class="col-form-label">Message</label>
                        <textarea name="msg" id="msg" cols="30" rows="2" class="form-control" placeholder="Message" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="act" name="act" value="">
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container relative animatedParent animateOnce pull-up-lg">
      <div class="animated fadeInUpShort my-3 mb-5">
          <div class="card my-3 no-b">
              <div class="card-body">
                  <div class="col-sm-12"style="margin-bottom: 15px">
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" id="btnAdd">
                          <i class="icon-add"></i>
                          Tambah data
                      </button>
                  </div>
                  <table class="table table-bordered table-hover data-tables"
                         data-options='{"searching":true}' id="datatable">
                      <thead>
                      <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Alamat</th>
                          <th>Kota</th>
                          <th>Pesan</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php while($user_data = mysqli_fetch_array($result)){?>
                      <tr>
                          <input class="id" type="hidden" value="<?= $user_data['id']; ?>">
                          <td class="name"><span class="badge badge-secondary"><?= $user_data['name']; ?></span></td>
                          <td class="email"><span class="badge badge-primary r-3 blink"><?= $user_data['email']; ?></span></td>
                          <td class="address"><?= $user_data['address']; ?></td>
                          <td class="city"><?= $user_data['city']; ?></td>
                          <td class="msg"><?= $user_data['msg']; ?></td>
                          <td>
                              <button type="button" class="btn btn-warning btn-sm" id="btnEdit" data-toggle="modal" data-target="#exampleModal">
                                  <i class="icon-pencil"></i>
                              </button>
                              <button type="button" class="btn btn-danger btn-sm" id="btnDelete">
                                  <i class="icon-trash"></i>
                              </button>
                          </td>
                      </tr>
                      <?php }
                      mysqli_close($mysqli);
                      ?>
                      </tfoot>
                  </table>
              </div>
          </div>
      </div>
    </div>
</div>
</div>
<script src="assets/js/app.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
<script>
    $(document).ready(function() {

        <?php //if (isset($status)) {?>
//        swal({
//            position: 'center',
//            type: 'success',
//            title: "<?php ////echo $status;?>//",
//            showConfirmButton: false,
//            timer: 1500
//        });
        <?php //}?>

        $('#btnAdd').click(function () {
            $("#name").val('');
            $("#email").val('');
            $("#address").val('');
            $("#city").val('');
            $("#msg").val('');
            $("#id").val('');
            $("#act").val('add');
            $('.modal-title').text('Tambah Data');
        });

        $('#datatable').on('click', '[id^=btnEdit]', function() {
            var $item = $(this).closest("tr");
            $("#name").val($.trim($item.find(".name").text()));
            $("#email").val($.trim($item.find(".email").text()));
            $("#address").val($.trim($item.find(".address").text()));
            $("#city").val($.trim($item.find(".city").text()));
            $("#msg").val($.trim($item.find(".msg").text()));
            $("#id").val($.trim($item.find(".id").val()));
            $("#act").val('edit');
            $('.modal-title').text('Edit Data');
        });

        $('#datatable').on('click', '[id^=btnDelete]', function() {
            var $item = $(this).closest("tr");
            var ID = $.trim($item.find(".id").val());
            var name = $.trim($item.find(".name").text());

            swal({
                    title: "Ingin menghapus data?",
                    text: "Data dengan Nama " + name + " akan dihapus",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#26C6DA",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Tidak, batalkan!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        window.location.href = "guestbookController.php?act=delete&id=" + ID;
                    } else {
                        swal("Dibatalkan", "Data tidak jadi dihapus", "error");
                    }
                });
        });
    });
</script>
</body>
</html>