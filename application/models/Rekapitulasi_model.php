<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rekapitulasi_model extends CI_Model
{
    public $table_profil = 'profil';
    public $id = 'id';
    public $order = 'DESC';

    public $fillable = [
        'id_user', 'jenis_kelamin', 'jr',
        'tempat_lahir', 'tanggal_lahir', 'nisn',
        'alamat', 'no_telp', 'nama_ayah',
        'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu',
        'tahun_masuk', 'tahun_lulus', 'no_ijazah',
        'no_skhun', 'status', 'deskripsi'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    // get all
    public function get_all()
    {
        $this->db->select('profil.*, users.*, profil.id as profil_id');
        $this->db->order_by('profil.id', $this->order);
        $this->db->join('users', 'profil.id_user = users.id');

        return $this->db->get($this->table_profil)->result();
    }

    // get data by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);

        return $this->db->get($this->table_profil)->row();
    }

    public function get_alumni_by_user_id($id_user = null)
    {
        $this->db->join('users AS t2', 't2.id = t1.id_user');

        return $this->db->get_where('profil AS t1', array('t1.id_user' => $id_user))->row();
    }

    public function insert_profil($data)
    {
        $data_arr = [];
        foreach ($this->fillable as $key => $value) {
            $data_arr[$value] = $data[$value] ?? NULL;
        }
        $this->db->insert($this->table_profil, $data_arr);
    }

    public function update_picture($id, $picture)
    {
        $data = [
            'picture' => $picture
        ];
        return $this->db->where('id', $id)->update($this->table_profil, $data);
    }
}

/* End of file Rekapitulasi_model.php */
/* Location: ./application/models/Rekapitulasi_model.php */