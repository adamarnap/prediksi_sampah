 <!-- Content Wrapper -->
 <div id="content-wrapper" class="d-flex flex-column">
     <!-- Main Content -->
     <div id="content">
         <!-- Begin Page Content -->
         <div class="container-fluid">

             <!-- Page Heading -->
             <h1 class="h3 mb-2 text-gray-800">Data <?= $sub_title ?></h1>

             <!-- DataTales Example -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                         <h2 class="h3 mb-0 text-gray-800">Daftar Data <?= $sub_title ?></h2>
                         <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah_data_sampah">
                             <i class="fas fa-plus fa-sm text-white-50"></i> Tambah <?= $sub_title ?> Baru
                         </a>
                     </div>
                     <!-- Notifikasi form validasi -->
                     <?= $this->session->flashdata('message') ?>
                     <!-- Notifikasi form validasi -->
                 </div>
                 <div class="card-body">

                     <div class="table-responsive">
                         <table class="table table-bouered" id="dataTable" width="100%" cellspacing="0">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Nama Sungai</th>
                                     <th>Bulan</th>
                                     <th>Tahun</th>
                                     <th>Volume (TON)</th>
                                     <th>Aksi</th>
                                 </tr>
                             </thead>
                             <tfoot>
                                 <tr>
                                     <th>#</th>
                                     <th>Nama Sungai</th>
                                     <th>Bulan</th>
                                     <th>Tahun</th>
                                     <th>Volume (TON)</th>
                                     <th>Aksi</th>
                                 </tr>
                             </tfoot>
                             <tbody>
                                 <?php $no = 1;
                                    foreach ($sampah as $s) : ?>
                                     <tr>
                                         <td class="text-center"><?= $no++ ?></td>
                                         <td class="text-left"><?= $s['nama_sungai'] ? $s['nama_sungai'] : '-' ?></td>
                                         <td class="text-left"><?= $s['bulan'] ? $s['bulan'] : '-' ?></td>
                                         <td class="text-left"><?= $s['tahun'] ? $s['tahun'] : '-' ?></td>
                                         <td class="text-left"><?= $s['volume'] ? number_format($s['volume'], 0, ',', '.') : '-' ?></td>

                                         <td class="text-center d-flex align-items-center">
                                             <a href="" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm mr-1" data-toggle="modal" data-target="#edit_sampah_<?= $s['id_sampah'] ?>">
                                                 <i class="fas fa-edit fa-xs text-white-50"></i>
                                             </a>
                                             <a href="<?= base_url('master/data/sampah/hapus_sampah/') . $s['id_sampah'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="konfirmasiHapus(event)">
                                                 <i class="fas fa-trash fa-xs text-white-50"></i>
                                             </a>
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
         <!-- /.container-fluid -->
     </div>

     <!-- Modals Add Role-->
     <div class="modal fade bd-example-modal-lg" id="tambah_data_sampah" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <!-- Modal Header -->
                 <div class="modal-header">
                     <h5 class="modal-title">Tambah Data Sampah Baru</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <!-- Modal Body -->
                 <div class="modal-body">
                     <!-- Form Tambah Data Role -->
                     <form action="<?= base_url('master/data/sampah/tambah_proses') ?>" method="post" enctype="multipart/form-data">
                         <div class="row">
                             <div class="col">
                                 <label class="col-form-label"><b>Nama Sungai</b></label>
                                 <select name="id_sungai" id="" class="form-control select2" required>
                                     <option value="">- Pilih Sungai -</option>
                                     <?php foreach ($sungai as $sg) : ?>
                                         <option value="<?= $sg['id_sungai'] ?>">> <?= $sg['nama_sungai'] ?></option>
                                     <?php endforeach; ?>
                                 </select>
                                 <small class="text-danger pl-2">Wajib diisi</small>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col">
                                 <label class="col-form-label"><b>Periode</b></label>
                                 <input type="date" class="form-control" name="tgl_volume" placeholder="Periode" id="" required>
                                 <small class="text-danger pl-2">Wajib diisi</small>
                             </div>
                             <div class="col">
                                 <label class="col-form-label"><b>Volume</b></label>
                                 <input type="number" class="form-control" name="volume" placeholder="Volume Sampah" id="" required>
                                 <small class="text-danger pl-2">Wajib diisi | Dalam TON</small>
                             </div>
                         </div>

                         <div class="modal-footer">
                             <button type="submit" class="btn btn-primary">Simpan Data</button>
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                         </div>
                     </form>
                 </div>
                 <!-- Modal Footer -->
             </div>
         </div>
     </div>

     <!-- Modals Edit Pengguna-->
     <?php foreach ($sampah as $s) : ?>
         <div class="modal fade bd-example-modal-lg" id="edit_sampah_<?= $s['id_sampah'] ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                     <!-- Modal Header -->
                     <div class="modal-header">
                         <h5 class="modal-title">Edit Data Sampah</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <!-- Modal Body -->
                     <div class="modal-body">
                         <!-- Form Edit Data Pengguna -->
                         <form action="<?= base_url('master/data/sampah/edit_proses') ?>" method="post" enctype="multipart/form-data">
                             <input type="hidden" name="id_sampah" value="<?= $s['id_sampah'] ?>">
                             <div class="row">
                                 <div class="col">
                                     <label class="col-form-label"><b>Nama Sungai</b></label>
                                     <select name="id_sungai" id="" class="form-control select2" required>
                                         <option value="">- Pilih Sungai -</option>
                                         <?php foreach ($sungai as $sg) : ?>
                                             <option value="<?= $sg['id_sungai'] ?>" <?php if ($s['id_sungai'] == $sg['id_sungai']) : ?>selected<?php endif; ?>> <?= $sg['nama_sungai'] ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                     <small class="text-danger pl-2">Wajib diisi</small>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col">
                                     <label class="col-form-label"><b>Periode</b></label>
                                     <input type="date" class="form-control" name="tgl_volume" value="<?= $s['tgl_volume'] ?>" placeholder="Periode" id="" required>
                                     <small class="text-danger pl-2">Wajib diisi</small>
                                 </div>
                                 <div class="col">
                                     <label class="col-form-label"><b>Volume</b></label>
                                     <input type="number" class="form-control" name="volume" value="<?= $s['volume'] ?>" placeholder="Volume Sampah" id="" required>
                                     <small class="text-danger pl-2">Wajib diisi | Dalam TON</small>
                                 </div>
                             </div>

                             <div class="modal-footer">
                                 <button type="submit" class="btn btn-primary">Simpan Data</button>
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                             </div>
                         </form>
                     </div>
                     <!-- Modal Footer -->
                 </div>
             </div>
         </div>
     <?php endforeach; ?>

 </div>


 <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
 <script type="text/javascript">
     // Select 2
     $(document).ready(function() {
         $(".select2").select2({
             theme: 'bootstrap4',
         });
     });


     //  Konfirmasi Hapus
     function konfirmasiHapus(e) {
         e.preventDefault();
         var urlToRedirect = e.currentTarget.getAttribute('href');
         Swal.fire({
             icon: 'question',
             text: 'Apakah data ini ingin dihapus secara permanen ?',
             title: 'Konfirmasi Hapus',
             showDenyButton: false,
             showCancelButton: true,
             confirmButtonColor: '#ef4523',
             confirmButtonText: 'Hapus',
             cancelButtonText: 'Batal',
             denyButtonText: `Don't save`,
         }).then((result) => {
             /* Read more about isConfirmed, isDenied below */
             if (result.isConfirmed) {
                 window.location.href = urlToRedirect;
             }
         })
     }
 </script>