<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rekapitulasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('import_excel');
        $this->load->model(array('Rekapitulasi_model' => 'rekapitulasi'));
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->data['csrf'] = $csrf;
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['is_user'] = $this->ion_auth->user()->row();
            //partial datatable
            $this->data['_partial_css'] = '<!-- JQuery DataTable Css -->
             <link href="' . base_url('assets/backend') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">';
            $this->data['_partial_js'] = '<!-- Jquery DataTable Plugin Js -->
             <script src="' . base_url('assets/backend') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
             <script src="' . base_url('assets/backend') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
             <script src="' . base_url('assets/backend') . '/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
             <script src="' . base_url('assets/backend') . '/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
             <script src="' . base_url('assets/backend') . '/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
             <script src="' . base_url('assets/backend') . '/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
             <script src="' . base_url('assets/backend') . '/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
             <script src="' . base_url('assets/backend') . '/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
             <script src="' . base_url('assets/backend') . '/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
             <!-- Custom Js -->
             <script src="' . base_url('assets/backend') . '/js/pages/tables/jquery-datatable.js"></script>
             <script src="' . base_url('assets/backend') . '/js/rekapitulasi.js"></script>
             ';
            //end partial
            $this->data['get_all'] = $this->rekapitulasi->get_all();
            $this->data['title'] = humanize(implode(' | ', array($this->template->set_app_name(), 'Rekapitulasi Data Alumni')));

            $this->data['_view'] = 'rekapitulasi/rekapitulasi_list';
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }

    public function detail($id_user)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return show_error('Anda tidak punya akses di halaman ini');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();

            $row = $this->rekapitulasi->get_alumni_by_user_id($id_user);
            if ($row) {
                $this->data['nisn'] = $this->form_validation->set_value('nisn', $row->nisn);
                $this->data['first_name'] = $this->form_validation->set_value('first_name', $row->first_name);
                $this->data['last_name'] = $this->form_validation->set_value('last_name', $row->last_name);
                $this->data['jenis_kelamin'] = $this->form_validation->set_value('jenis_kelamin', $row->jenis_kelamin);
                $this->data['jr'] = $this->form_validation->set_value('jr', $row->jr);
                $this->data['tempat_lahir'] = $this->form_validation->set_value('tempat_lahir', $row->tempat_lahir);
                $this->data['tanggal_lahir'] = $this->form_validation->set_value('tanggal_lahir', $row->tanggal_lahir);
                $this->data['alamat'] = $this->form_validation->set_value('alamat', $row->alamat);
                $this->data['no_telp'] = $this->form_validation->set_value('no_telp', $row->no_telp);
                $this->data['nama_ayah'] = $this->form_validation->set_value('nama_ayah', $row->nama_ayah);
                $this->data['pekerjaan_ayah'] = $this->form_validation->set_value('pekerjaan_ayah', $row->pekerjaan_ayah);
                $this->data['nama_ibu'] = $this->form_validation->set_value('nama_ibu', $row->nama_ibu);
                $this->data['pekerjaan_ibu'] = $this->form_validation->set_value('pekerjaan_ibu', $row->pekerjaan_ibu);
                $this->data['tahun_masuk'] = $this->form_validation->set_value('tahun_masuk', $row->tahun_masuk);
                $this->data['tahun_lulus'] = $this->form_validation->set_value('tahun_lulus', $row->tahun_lulus);
                $this->data['no_ijazah'] = $this->form_validation->set_value('no_ijazah', $row->no_ijazah);
                $this->data['no_skhun'] = $this->form_validation->set_value('no_skhun', $row->no_skhun);
                $this->data['status'] = $this->form_validation->set_value('status', $row->status);
                $this->data['deskripsi'] = $this->form_validation->set_value('deskripsi', $row->deskripsi);

                $this->data['_view'] = 'rekapitulasi/rekapitulasi_read';
                $this->template->_render_page('layouts/backend', $this->data);
            } else {
                $this->session->set_flashdata('message', 'Data tidak ditemukan');
                redirect(site_url('rekapitulasi'));
            }
        }
    }

    public function proses()
    {
        $this->load->library('ion_auth');
        if (empty($_FILES['files']['tmp_name'])) {
            $this->session->set_flashdata('message', 'silahkan upload file excel');
            redirect(site_url('rekapitulasi'));
            exit;
        }
        $allowed = array('xls', 'xlsx');
        $file = $_FILES['files']['tmp_name'];
        $ext = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            $this->session->set_flashdata('message', 'hanya menerima file xls atau xlsx');
            redirect(site_url('rekapitulasi'));
        }
        $header = $this->rekapitulasi->fillable;
        array_shift($header);
        $rules = [];
        $errors = [];
        $success = 0;
        $header = array_merge(['first_name', 'last_name', 'email'], $header);
        $custom_validation = [
            'email' => 'trim|required|valid_email'
        ];
        foreach ($header as $k_hdr => $hdr) {
            $rules[] = [
                'field' => $hdr,
                'label' => $hdr,
                'rules' => $custom_validation[$hdr] ?? 'required',
            ];
        }
        $result = ImportExcel::import($file, $header);
        foreach ($result->toArray() as $key => $value) {
            if ($key == 1) continue;
            $this->form_validation->set_data($value);
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() === FALSE) {
                $errors[$key] = $this->form_validation->error_string();
                continue;
            }
            $email = $value['email'];
            $password = $value['nisn'];
            $addtional_data = [
                'first_name' => $value['first_name'],
                'last_name' => $value['last_name'],
            ];
            $create_user = $this->ion_auth->register($email, $password, $email, $addtional_data, [2]);
            if ($create_user !== FALSE) {
                $value['id_user'] = $create_user;
                $value['tanggal_lahir'] = ImportExcel::formatDate($value['tanggal_lahir']);
                $this->rekapitulasi->insert_profil($value);
                $success++;
            }
        }
        if (!empty($errors)) {
            // var_dump($errors); die;
            $this->session->set_flashdata('message', 'data row ' . implode(',', array_keys($errors)) . ' tidak berhasil di import');
        } else {
            $this->session->set_flashdata('message', 'success import ' . $success . ' data');
        }
        redirect(site_url('rekapitulasi'));
    }

    public function download_template()
    {
        $this->load->helper('download');
        $file = __DIR__ . '/../../temp/template_import.xlsx';
        force_download($file, NULL);
    }

    public function upload_picture()
    {
        if ($this->input->method() === 'post') {
            // the user id contain dot, so we must remove it
            $id = $this->input->post('id');
            $file_name = md5($id);
            $config['upload_path']          = FCPATH . '/assets/backend/avatar/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['file_name']            = $file_name;
            $config['overwrite']            = true;
            $config['max_size']             = 2048; // 2MB

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('picture')) {
                $data['error'] = $this->upload->display_errors();
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect(site_url('rekapitulasi'));
            } else {
                $uploaded_data = $this->upload->data();
                if ($this->rekapitulasi->update_picture($id, $uploaded_data['file_name'])) {
                    $this->session->set_flashdata('message', 'Avatar updated!');
                    redirect(site_url('rekapitulasi'));
                }
            }
        }
    }
}

/* End of file Rekapitulasi.php */
/* Location: ./application/controllers/Rekapitulasi.php */