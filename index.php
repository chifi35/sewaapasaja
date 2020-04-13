<?php
    session_start();
    $root = "http://localhost/sewaapasajafix/";
    if(!isset($_SESSION["nama"])){
        header("location: login.php");
    }else{
        $nama = $_SESSION['nama'];

    }
    include_once "database/koneksi.php";
    $jenis = null;
    $tab = "barang";
    if(isset($_GET["tab"])){
        $tab = $_GET["tab"];
        if(isset($_GET['jenis']))
            $jenis = $_GET["jenis"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.css">
    <script type="text/javascript" src="asset/js/jquery.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.js"></script>
    <script src="asset/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="asset/sweetalert/sweetalert.css">
    <script type="text/javascript">
        function hapus(a,b,c,d) {
            var href = document.getElementById(d).href;
          	swal({
          	  title: "Apakah Anda Yakin Untuk Menghapus?",
          	  text: c+" dengan nama "+b+" ("+a+")",
          	  type: "warning",
          	  showCancelButton: true,
          	  confirmButtonColor: "#DD6B55",
          	  confirmButtonText: "Ya",
          	  cancelButtonText: "Batal",
          	  closeOnConfirm: false,
          	  closeOnCancel: false
          	},
          		function(isConfirm){
          		  if (isConfirm) {
                  swal({
                    title: "Berhasil Hapus!",
                    type: "success",
                    timer: 1200,
                    showConfirmButton: false},
                  function(){
                        window.location = href;
                    }
                  );
          		    return true;
          		  } else {
          			swal("Batal", "Anda Membatalkan Penghapusan", "error");
          		  }
          	});
            return false;
        }
        function lunasi(a,b,c,d){
            var href = document.getElementById(d).href;
            swal({
              title: "Apakah Anda Yakin Untuk Melunasi?",
              text: "Penyewaan "+a+" dengan no plat : "+b+" dengan nilai kurang : Rp. "+c,
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Ya",
              cancelButtonText: "Batal",
              closeOnConfirm: false,
              closeOnCancel: false
            },
              function(isConfirm){
                if (isConfirm) {
                  swal({
                    title: "Berhasil Dilunasi!",
                    type: "success",
                    timer: 1200,
                    showConfirmButton: false},
                  function(){
                        window.location = href;
                    }
                  );
          		    return true;
                } else {
                swal("Batal", "Anda Membatalkan Pelunasan", "error");
                }
            });
            return false;
        }
        function Kembalikan(a,b,c,d){
          var href = document.getElementById(d).href;
          swal({
            title: "Penyewaan Barang Akan Dikembalikan!!",
            text: "Barang "+b+" Dengan No Barang : "+c+" oleh "+a+" Akan Dikembalikan!!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
          },
            function(isConfirm){
              if (isConfirm) {
                swal({
                  title: "Berhasil Dikembalikan!",
                  type: "success",
                  timer: 1200,
                  showConfirmButton: false},
                function(){
                      window.location = href;
                  }
                );
                return true;
              } else {
              swal("Batal", "Anda Membatalkan Pengembalian", "error");
              }
          });
            return false;
        }

    </script>
</head>
<body>
<div id="error"> </div>
<div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation">
                <a class="navbar-brand" href="<?php echo $root ?>"> <b>Sewa Apa Saja</b></a>
            </li>
            <li role="presentation"  <?php if($tab=="barang") echo "class='active'" ?>>
                <a href="#barang" aria-controls="barang" role="tab" data-toggle="tab">Barang</a>
            </li>
            <li role="presentation" <?php if($tab=="pemilik") echo "class='active'" ?>>
                <a href="#pemilik" aria-controls="pemilik" role="tab" data-toggle="tab">Pemilik</a>
            </li>
            <li role="presentation"  <?php if($tab=="penyewa") echo "class='active'" ?>>
                <a href="#penyewa" aria-controls="penyewa" role="tab" data-toggle="tab">Penyewa</a>
            </li>
            <li role="presentation" <?php if($tab=="sewa") echo "class='active'" ?>>
                <a href="#sewaa" aria-controls="a" role="tab" data-toggle="tab">Sewa</a>
            </li>
            <li role="presentation"  <?php if($tab=="bayar") echo "class='active'" ?>>
                <a href="#bayar" aria-controls="bayar" role="tab" data-toggle="tab">Pembayaran</a>
            </li>
            <li role="presentation" <?php if($tab=="kembali") echo "class='active'" ?>>
                <a href="#kembali" aria-controls="kembali" role="tab" data-toggle="tab">Pengembalian</a>
            </li>
            <li role="presentation">
                <a href="laporan.php">Laporan</a>
            </li>
            <li role="presentation">
                 <span align="left" class="navbar-brand">Nama : <i><?php echo $nama?></i></b>  <a href="logout.php" class="btn btn-danger btn-xs">Logout</a></span>
            </li>

        </ul>
        <?php
            if($jenis!=null){
                $pesan = "null";
                if($tab=="barang" AND $jenis=="tbh")
                    $pesan = "Data Mobil Berhasil Ditambahkan";
                elseif($tab=="barang" AND $jenis=="hapus")
                    $pesan = "Data Mobil Berhasil Dihapus";
                elseif($tab=="pemilik" AND $jenis=="tbh")
                    $pesan = "Data Pemilik Berhasil Ditambahkan";
                elseif($tab=="pemilik" AND $jenis=="hapus")
                    $pesan = "Data Pemilik Berhasil Dihapus";
                elseif($tab=="penyewa" AND $jenis=="tbh")
                    $pesan = "Data Penyewa Berhasil Ditambahkan";
                elseif($tab=="sewa" AND $jenis=="tbh")
                    $pesan = "Data Sewa Berhasil Ditambahkan";
                elseif($tab=="bayar" AND $jenis=="lunas")
                    $pesan = "Penyewaan Berhasil Dilunasi";
                elseif($tab=="kembali" AND $jenis!=null)
                    $pesan = "Sewa Berhasil dikembalikan dengan denda Rp. ".$jenis;

        ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p align="center"><?php echo $pesan?></p>
        </div>
        <?php }?>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- MOBIL -->
        <div role="tabpanel" class="tab-pane <?php if($tab=="barang") echo "active" ?>" id="barang">
            <h2 align="center">Daftar Barang</h2>
                 <?php include_once "database/tampilBarang.php";?>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tbhBarang">
                Tambah Barang
            </button>
        </div>

        <!-- SOPIR -->
        <div role="tabpanel" class="tab-pane <?php if($tab=="pemilik") echo "active" ?>" id="pemilik">
            <h2 align="center">Daftar Pemilik</h2>
              <?php include_once "database/tampilPemilik.php";?>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tbhPemilik">
                Tambah Pemilik
            </button>
        </div>

        <!-- Penyewa -->
        <div role="tabpanel" class="tab-pane <?php if($tab=="penyewa") echo "active" ?>" id="penyewa">
            <h2 align="center">Daftar Penyewa</h2>
                 <div id="cetak"><?php include "database/tampilPenyewa.php";?></div>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tbhPenyewa">
                Tambah Penyewa
            </button>
        </div>

        <!-- Sewa -->
        <div role="tabpanel" class="tab-pane <?php if($tab=="sewa") echo "active" ?>" id="sewaa">
            <h2 align="center">Daftar Sewa</h2>
                 <?php include_once "database/tampilSewa.php";?>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tbhSewa">
                Tambah Sewa
            </button>

        </div>
        <div role="tabpanel" class="tab-pane  <?php if($tab=="bayar") echo "active" ?>" id="bayar">
            <h2 align="center">Daftar Bayar</h2>
                 <?php include_once "database/tampilBayar.php";?>

        </div>
        <div role="tabpanel" class="tab-pane <?php if($tab=="kembali") echo "active" ?>" id="kembali">
            <h2 align="center">Pengembalian</h2>
                 <?php include_once "database/tampilKembali.php";?>
        </div>
    </div>
</div>
<!-- Modal Mobil -->
    <div class="modal fade" id="tbhBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalBarang">Tambah Data Barang</h4>
            </div>
            <div class="modal-body">
                <form name="tbhBarang" method="POST" action="database/simpanBarang.php">
                    <table width="100%" style="margin: 10px; padding-bottom: 20px;">
                        <tr>
                            <td>Nomor Barang</td>
                            <td>
                                <input type="text" class="form-control" name="no_barang" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td>
                                <input type="text" class="form-control" name="merk" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis</td>
                            <td>
                                <input type="radio" name="jenis" value="Baru" checked> Baru
                                <input type="radio" name="jenis" value="Bekas"> Bekas
                            </td>
                        </tr>
                        <tr>
                            <td>Warna</td>
                            <td>
                                <input type="text" class="form-control" name="warna" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>
                                <input type="text" class="form-control" name="harga" required>
                            </td>
                        </tr>
                    </table>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" value="Tambah Barang" class="btn btn-primary">
                     </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Pemilik -->
    <div class="modal fade" id="tbhPemilik" tabindex="-1" role="dialog" aria-labelledby="modalSopir" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalSopir">Tambah Data Pemilik</h4>
            </div>
            <div class="modal-body">
                <form name="tbhPemilik" method="POST" action="database/simpanPemilik.php">
                    <table width="100%" style="margin: 10px; padding-bottom: 20px;">
                        <tr>
                            <td>Nama Pemilik</td>
                            <td>
                                <input type="text" class="form-control" name="nama" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat Pemilik</td>
                            <td>
                                <input type="text" class="form-control" name="alamat" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Telpon</td>
                            <td>
                                <input type="text"  class="form-control" name="no_tlp" required>
                            </td>
                        </tr>
                    </table>

            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" value="Tambah Pemilik" class="btn btn-primary">
                     </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Penyewa -->
    <div class="modal fade" id="tbhPenyewa" tabindex="-1" role="dialog" aria-labelledby="modalPenyewa" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalSopir">Tambah Data Penyewa</h4>
            </div>
            <div class="modal-body">
                <form name="tbhPenyewa" method="POST" action="database/simpanPenyewa.php">
                    <table width="100%" style="margin: 10px; padding-bottom: 20px;">
                        <tr>
                            <td>Nama Penyewa</td>
                            <td>
                                <input type="text" class="form-control" name="nama" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat Penyewa</td>
                            <td>
                                <input type="text" class="form-control" name="alamat" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Penyewa</td>
                            <td>
                                <input type="text"  class="form-control" name="no_tlp" required>
                            </td>
                        </tr>
                    </table>

            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" value="Tambah Penyewa" class="btn btn-primary">
                     </form>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal Sewa -->
    <div class="modal fade" id="tbhSewa" tabindex="-1" role="dialog" aria-labelledby="modalSewa" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalSewa">Tambah Sewa</h4>
            </div>
            <div class="modal-body">
                <form name="tbhSewa" method="POST" action="database/simpanSewa.php">
                    <table width="100%" style="margin: 10px; padding-bottom: 20px;">
                        <tr>
                            <td>Id Penyewa</td>
                            <td>
                                <select class="form-control" name="id_penyewa" required>
                                <?php
                                    $resultPenyewa = mysqli_query($kon, "select * from penyewa");
                                    while($rsPenyewa = $resultPenyewa->fetch_array(MYSQLI_ASSOC)) {
                                        echo "<option value='".$rsPenyewa['id_penyewa']."'>(".$rsPenyewa['id_penyewa'].") ".$rsPenyewa['nama_penyewa'];
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Id </td>
                            <td>
                                <select class="form-control" name="id_barang" required>
                                <?php
                                    $resultMobil = mysqli_query($kon, "select * from barang where status_barang='Tidak Disewa'");
                                    while($rs = $resultMobil->fetch_array(MYSQLI_ASSOC)) {
                                        echo "<option value='".$rs['id_barang']."'>(".$rs['no_barang'].") ".$rs['merek']." - ".$rs['jenis'];
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Id Pemilik</td>
                            <td>
                                <select class="form-control" name="id_sopir">
                                <?php
                                    $pemilik = mysqli_query($kon, "select * from pemilik where status_sopir='Tidak Disewa' ORDER BY id_sopir ASC ");
                                    while($rs = $pemilik->fetch_array(MYSQLI_ASSOC)) {
                                        echo "<option value='".$rs['id_sopir']."'>(".$rs['id_sopir'].") ".$rs['nama_sopir'];
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Lama Sewa</td>
                            <td>
                                <input type="number" name="hari" value="1" required min="1"> Hari
                                <input type="number" name="jam" value="0" required min="0" max="24"> Jam
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><h3 align="center">Jaminan</h3></td>
                        </tr>
                        <tr>
                            <td>Jenis Jaminan</td>
                            <td>
                                <input type="radio" name="jenis_jaminan" value="STNK Motor" checked> SIM
                                <input type="radio" name="jenis_jaminan" value="KTP"> KTP
                            </td>
                        </tr>
                        <tr>
                            <td>No Jaminan</td>
                            <td>
                                <input type="text" name="nomor_jaminan" class="form-control"  required>
                            </td>
                        </tr>
                        <tr>
                            <td>Atas Nama</td>
                            <td>
                                <input type="text" name="atas_nama" class="form-control"  required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><h3 align="center">Bayar</h3></td>
                        </tr>
                        <tr>
                            <td>Bayar DP </td>
                            <td>
                                <input type="number" name="bayar" class="form-control" value="100000" min="100000" required>
                            </td>
                        </tr>
                    </table>

            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" value="Tambah Sewa" class="btn btn-primary">
                     </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
