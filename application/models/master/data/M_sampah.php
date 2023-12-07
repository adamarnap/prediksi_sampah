<?php


class M_sampah extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function get_data_sampah()
    {
        // Set nama bulan ke indonesia
        $this->db->query("SET lc_time_names = 'id_ID';");

        $this->db->select('*');
        $this->db->select("DATE_FORMAT(tgl_volume, '%M') AS bulan");
        $this->db->select("YEAR(tgl_volume) AS tahun");
        $this->db->from('tb_sampah a');
        $this->db->join('tb_sungai b', 'b.id_sungai = a.id_sungai');
        $this->db->order_by('tgl_volume', 'DESC');
        $query = $this->db->get();
        $results = $query->result_array();

        // Mengganti "Pebruari" menjadi "Februari" dalam hasil query
        foreach ($results as &$row) {
            $row['bulan'] = str_replace('Pebruari', 'Februari', $row['bulan']);
        }

        return $results;
    }

    // Get data sungai
    public function get_data_sungai()
    {
        $this->db->select('*');;
        $this->db->from('tb_sungai a');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get data prediksi
    public function get_data_prediksi()
    {
        $this->db->select('*');
        $this->db->from('tb_prediksi a');
        $this->db->join('tb_sungai b', 'b.id_sungai = a.id_sungai');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get data sampah by sungai
    public function get_data_sampah_by_sungai($id_sungai)
    {
        $this->db->select('*');
        $this->db->from('tb_sampah a');
        $this->db->join('tb_sungai b', 'b.id_sungai = a.id_sungai');
        $this->db->where('a.id_sungai', $id_sungai);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get data minimal from sampah
    public function get_min_volume($id_sungai)
    {
        $this->db->select('min(volume) as min_volume');
        $this->db->from('tb_sampah a');
        $this->db->join('tb_sungai b', 'b.id_sungai = a.id_sungai');
        $this->db->where('a.id_sungai', $id_sungai);
        $query = $this->db->get();
        return $query->row_array()['min_volume'];
    }
    // Insert data menu
    public function insert($table, $params)
    {
        return $this->db->insert($table, $params);
    }

    // update data menu
    function update($table, $params, $where)
    {
        return $this->db->update($table, $params, $where);
    }

    // delete data menu
    function delete($table, $params)
    {
        return $this->db->delete($table, $params);
    }
}
