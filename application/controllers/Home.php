<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * class Home
 * dikembangkan Hangga.
 */
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('Home_model' => 'home'));
        $this->load->model(array('Rekapitulasi_model' => 'rekapitulasi'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $this->data['is_user'] = $this->ion_auth->user()->row();
            $user = $this->ion_auth->user()->row()->id;
            $this->data['count_alumni'] = $this->home->count_alumni();

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
            $this->data['get_all'] = $this->rekapitulasi->get_all();
            $this->data['title'] = humanize(implode(' | ', array($this->template->set_app_name(), 'Rekapitulasi Data Alumni')));
            $this->data['_view'] = 'home/main';
            
            $this->data['group'] = $this->ion_auth->get_users_groups($user)->row()->name;
            $this->template->_render_page('layouts/backend', $this->data);
        }
    }
}
