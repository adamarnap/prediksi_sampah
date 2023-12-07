<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sampah extends CI_Controller
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
        $this->sub_title = 'Data Sampah';
        $this->main_title = 'Data Sampah';
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

        // Data untuk di olah
        $data['sampah'] = $this->M_sampah->get_data_sampah();
        $data['sungai'] = $this->M_sampah->get_data_sungai();

        // Cek Data
        // dd($data);

        // Display
        $this->load->view('templates/header_backend', $data);
        $this->load->view('templates/sidebar_backend', $data);
        $this->load->view('templates/topbar_backend', $data);
        $this->load->view('master/data/sampah/index.php', $data);
        $this->load->view('templates/footer_backend', $data);
    }

    /* Tambah data sampah */
    public function tambah_proses()
    {
        // Ambil data dari form input
        $id_sungai = $this->input->post('id_sungai');
        $volume = $this->input->post('volume');
        $tgl_volume = $this->input->post('tgl_volume');

        $params = array(
            'id_sungai' => $id_sungai,
            'volume' => $volume,
            'tgl_volume' => $tgl_volume,
            'created' => date('Y-m-d H:i:s'),
            'created_name' => $this->session->userdata('user_nama'),
        );
        if ($this->M_sampah->insert('tb_sampah', $params)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data sampah berhasil ditambahkan!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data sampah berhasil ditambahkan!</div>');
        }
        redirect('master/data/sampah');
    }

    /* Edit data sampah */
    public function edit_proses()
    {
        // Ambil data dari form input
        $id_sampah = $this->input->post('id_sampah');
        $id_sungai = $this->input->post('id_sungai');
        $volume = $this->input->post('volume');
        $tgl_volume = $this->input->post('tgl_volume');

        $params = array(
            'id_sungai' => $id_sungai,
            'volume' => $volume,
            'tgl_volume' => $tgl_volume,
            'created' => date('Y-m-d H:i:s'),
            'created_name' => $this->session->userdata('user_nama'),
        );
        $where = array(
            'id_sampah' => $id_sampah
        );
        if ($this->M_sampah->update('tb_sampah', $params, $where)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data sampah berhasil diedit!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data sampah gagal diedit!</div>');
        }
        redirect('master/data/sampah');
    }

    /* Hapus sampah */
    public function hapus_sampah($id_sampah)
    {
        $where = array(
            'id_sampah' => $id_sampah
        );
        if ($this->M_sampah->delete('tb_sampah', $where)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data sampah berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data sampah gagal dihapus!</div>');
        }
        redirect('master/data/sampah');
    }

}
