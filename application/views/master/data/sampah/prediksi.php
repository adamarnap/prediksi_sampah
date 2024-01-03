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
                         <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah_data_prediksi_baru">
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
                                     <th>Tahun Diprediksi</th>
                                     <th>Prediksi Volume</th>
                                     <th>Tgl. Prediksi DiBuat</th>
                                     <th>Aksi</th>
                                 </tr>
                             </thead>
                             <tfoot>
                                 <tr>
                                     <th>#</th>
                                     <th>Nama Sungai</th>
                                     <th>Tahun Diprediksi</th>
                                     <th>Prediksi Volume</th>
                                     <th>Tgl. Prediksi Dibuat</th>
                                     <th>Aksi</th>
                                 </tr>
                             </tfoot>
                             <tbody>
                                 <?php $no = 1;
                                    foreach ($prediksi as $p) : ?>
                                     <tr>
                                         <td class="text-center"><?= $no++ ?></td>
                                         <td class="text-left"><?= $p['nama_sungai'] ? $p['nama_sungai'] : '-' ?></td>
                                         <td class="text-center"><?= $p['tahun_prediksi'] ? $p['tahun_prediksi'] : '-' ?></td>
                                         <td class="text-left">
                                             <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-1" data-toggle="modal" data-target="#view_data_prediksi_<?= $p['id_prediksi'] ?>">
                                                 <i class="fas fa-eye fa-xs text-white-50"></i>
                                             </a>
                                         </td>
                                         <td class="text-left"><?= $p['created'] ? date('d F Y H:i:s T', strtotime($p['created'])) : '-' ?></td>
                                         <td class="text-left">
                                             <a href="<?= base_url('master/data/prediksi/hapus_prediksi/') . $p['id_prediksi'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm mr-1" onclick="konfirmasiHapus(event)">
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
     </div>

     <!-- Modals Add Prediksi-->
     <div class="modal fade bd-example-modal-lg" id="tambah_data_prediksi_baru" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <!-- Modal Header -->
                 <div class="modal-header">
                     <h5 class="modal-title">Tambah Data Prediksi Baru</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <!-- Modal Body -->
                 <div class="modal-body">
                     <!-- Form Tambah Data Role -->
                     <form action="<?= base_url('master/data/prediksi/tambah_proses') ?>" method="post" enctype="multipart/form-data">
                         <div class="row">
                             <div class="col">
                                 <label class="col-form-label"><b>Sungai</b></label>
                                 <select name="id_sungai" id="" class="form-control select2" required>
                                     <option value="">- Pilih Sungai -</option>
                                     <?php foreach ($sungai as $s) : ?>
                                         <option value="<?= $s['id_sungai'] ?>">> <?= $s['nama_sungai'] ?></option>
                                     <?php endforeach; ?>
                                 </select>
                                 <small class="text-danger pl-2">Wajib diisi</small>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col">
                                 <label class="col-form-label"><b>Periode Tahun</b></label>
                                 <select name="tahun" id="" class="form-control select2" required>
                                     <option value="">- Pilih Periode Tahun -</option>
                                     <?php foreach ($tahun as $t) : ?>
                                         <option value="<?= $t['tahun'] . '~' . $t['periode'] ?>">> <?= $t['tahun'] ?></option>
                                     <?php endforeach; ?>
                                 </select>
                                 <small class="text-danger pl-2">Wajib diisi</small>
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

     <!-- Modals View Role-->
     <?php foreach ($prediksi as $p) : ?>
         <div class="modal fade bd-example-modal-xl" id="view_data_prediksi_<?= $p['id_prediksi'] ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-xl">
                 <div class="modal-content">
                     <!-- Modal Header -->
                     <div class="modal-header">
                         <h5 class="modal-title"> <b>Detail Data Prediksi Sungai <?= $p['nama_sungai'] ?></b></h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <!-- Modal Body -->
                     <div class="modal-body">
                         <table class="table table-bordered">
                             <thead>
                                 <tr>
                                     <th class="text-center" scope="col" rowspan="2">#</th>
                                     <th class="text-center" scope="col" colspan="2">Periode Prediksi</th>
                                     <th class="text-center" scope="col" rowspan="2">Volume Prediksi (TON)</th>
                                     <th class="text-center" scope="col" rowspan="2">Tgl. Prediksi DiBuat</th>
                                 </tr>
                                 <tr>
                                     <th class="text-center" scope="col">Bulan</th>
                                     <th class="text-center" scope="col">Tahun</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $no = 1;

                                    $data_prediksi = json_decode($p['data_prediksi'], true);
                                    foreach ($data_prediksi as $dp) : ?>
                                     <tr>
                                         <td class="text-center"><?= $no++ ?></td>
                                         <td class="text-center"><?= $dp['bulan_predicted'] ? $dp['bulan_predicted'] : '-' ?></td>
                                         <td class="text-center"><?= $p['tahun_prediksi'] ? $p['tahun_prediksi'] : '-' ?></td>
                                         <td class="text-left"><?= $dp['vol_predicted'] ? $dp['vol_predicted'] : '-' ?></td>
                                         <td class="text-left"><?= $p['created'] ? date('d F Y H:i:s T', strtotime($p['created'])) : '-' ?></td>
                                     </tr>
                                 <?php endforeach; ?>
                             </tbody>
                         </table>
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