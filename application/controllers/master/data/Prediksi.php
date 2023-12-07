<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prediksi extends CI_Controller
{

    //Untuk mendefinisikan judul dalam sebuah halaman
    private $sub_title;
    private $main_title;

    public function __construct()
    {
        parent::__construct();
        cek_akses_halaman();

        // Load library
        $this->load->library('form_validation');

        // Load model

        // Model untuk data judul dan portal
        $this->load->model('M_user');
        $this->load->model('M_portal');

        // Model untuk data yang diolah
        $this->load->model('master/data/M_sampah');

        // Judul
        $this->sub_title = 'Data Prediksi';
        $this->main_title = 'Data Prediksi';
    }



    public function index()
    {
        // Mengambil data untuk judul
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_user->get_data_user($user_id);
        $data['portal_data'] = $this->M_portal->get_data_portal();
        $data['portal'] = $data['portal_data'][0]['portal_nm'];
        // Data Judul
        $data['main_title'] = $this->main_title;
        $data['sub_title'] = $this->sub_title;

        $tahun = array(
            ['periode' => '25','id' => '2023', 'tahun' => '2022'],
            ['periode' => '37','id' => '2023', 'tahun' => '2023'],
            ['periode' => '49','id' => '2024', 'tahun' => '2024'],
            ['periode' => '61','id' => '2025', 'tahun' => '2025'],
            ['periode' => '73','id' => '2026', 'tahun' => '2026'],
            ['periode' => '85','id' => '2027', 'tahun' => '2027'],
            ['periode' => '97','id' => '2028', 'tahun' => '2028'],
            ['periode' => '109','id' => '2029', 'tahun' => '2029'],
            ['periode' => '121','id' => '2030', 'tahun' => '2030'],
        );
        
        $data['sampah'] = $this->M_sampah->get_data_sampah();
        $data['sungai'] = $this->M_sampah->get_data_sungai();
        $data['prediksi'] = $this->M_sampah->get_data_prediksi(); 
        $data['tahun'] = $tahun;  

        // Cek Data
        // dd($bulan);
        // dd($data);

        // Display
        $this->load->view('templates/header_backend', $data);
        $this->load->view('templates/sidebar_backend', $data);
        $this->load->view('templates/topbar_backend', $data);
        $this->load->view('master/data/sampah/prediksi.php', $data);
        $this->load->view('templates/footer_backend', $data);
    }

    /* Tambah prediksi */
    public function tambah_proses()
    {
        // Ambil data dari form
        $periodeBulan = explode('~', $this->input->post('tahun'));
        $tahunPrediksi = $periodeBulan[0];
        $x_pred_start = $periodeBulan[1];

        $sungai = $this->input->post('id_sungai');
        
        // Get data sampah berdasarkan sungai
        $sampah = $this->M_sampah->get_data_sampah_by_sungai($sungai);

        // Perhitungan
        $n = 0;  // jumlah data
        $sum_x = 0; // total x
        $sum_y = 0; // total y
        $sum_xy = 0; // total x*y
        $sum_x2 = 0; // total x^2
        // Total
        foreach ($sampah as $periode => $s) {
            if(!empty($s['volume'])){
                $n++;
                $sum_x += $periode + 1;
                $sum_y += $s['volume'];
                $sum_xy += ($periode + 1) * $s['volume'];
                $sum_x2 += ($periode + 1) * ($periode + 1);
            }
        }
        // Rata Rata
        $avg_x = $sum_x / $n;
        $avg_y = $sum_y / $n;
        $avg_xy = $sum_xy / $n;
        $avg_x2 = $sum_x2 / $n;
        // Rumus
        $a = (($sum_x2 * $sum_y) - ($sum_x * $sum_xy)) / (($n * $sum_x2) - ($sum_x * $sum_x));
        $b = (($n * $sum_xy) - ($sum_x * $sum_y)) / (($n * $sum_x2) - ($sum_x * $sum_x));
        $min_volume = $this->M_sampah->get_min_volume($sungai);
        $index_musim = $min_volume / $avg_y;
        // Prediksi
        $array_prediksi = array();
        for ($i = 1; $i <= 12; $i++) {
            $x_pred = $x_pred_start + $i - 1;
            $Y = $a + ($b * $x_pred);
            $predicted = round(($Y * $index_musim), 2);
            
            /* Start set nama bulan */
            if ($i == 1) {
                $bulan = 'Januari';
            } elseif ($i == 2) {
                $bulan = 'Februari';
            } elseif ($i == 3) {
                $bulan = 'Maret';
            } elseif ($i == 4) {
                $bulan = 'April';
            } elseif ($i == 5) {
                $bulan = 'Mei';
            } elseif ($i == 6) {
                $bulan = 'Juni';
            } elseif ($i == 7) {
                $bulan = 'Juli';
            } elseif ($i == 8) {
                $bulan = 'Agustus';
            } elseif ($i == 9) {
                $bulan = 'September';
            } elseif ($i == 10) {
                $bulan = 'Oktober';
            } elseif ($i == 11) {
                $bulan = 'November';
            } elseif ($i == 12) {
                $bulan = 'Desember';
            }
            /* End set nama bulan */

            // Data Prediksi
            $array_prediksi[] = array(
                'vol_predicted' =>  $predicted,
                'bulan_predicted' => $bulan,
            );
        }
        // JSON Encode
        $json_prediksi = json_encode($array_prediksi); 

        // Parameter Input
        $data = array(
            'id_sungai' => $sungai,
            'tahun_prediksi' => $tahunPrediksi,
            'data_prediksi' => $json_prediksi,
            'created' => date('Y-m-d H:i:s'),
            'created_name' => $this->session->userdata('user_nama'),
        );

        // Insert data
        $this->M_sampah->insert('tb_prediksi', $data);

        // Set session
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data prediksi berhasil ditambahkan!</div>');

        // Redirect
        redirect('master/data/prediksi');
    }

    public function hapus_prediksi($id_prediksi = "")
    {
        $where = array('id_prediksi' => $id_prediksi);

        if ($this->M_sampah->delete('tb_prediksi', $where)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data prediksi berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data prediksi gagal dihapus!</div>');
        }
        redirect('master/data/prediksi');
    }
}
