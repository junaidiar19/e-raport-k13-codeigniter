
<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

ob_start();

/**
 *
 */
class Guru extends CI_Controller {
    function __construct() {

        parent::__construct();
        $this->load->model(['m_guru']);
        $this->load->model(['m_admin']);

        if ($this->session->userdata['logged_in']['id_guru'] == '') {
            redirect('login');
        }
    }

    public function index() {
        $id_guru       = ($this->session->userdata['logged_in']['id_guru']);
        $var['akun']   = $this->m_guru->cekdata($id_guru)->row_array();
        $var['sklh']   = $this->m_admin->data_sekolah();
        $var['guru']   = $this->m_admin->data_guru();
        $var['mapel']  = $this->m_admin->data_mapel();
        $var['active'] = 'dashboard';

        $this->load->view('v_header', $var);
        $this->load->view('v_dashboard');
        $this->load->view('v_footer');
    }

    function get_mapel() {
        $data = $this->m_admin->data_mapel()->result();
        echo json_encode($data);
    }

    // PROFIL

    function profil() {
        $id_guru            = ($this->session->userdata['logged_in']['id_guru']);
        $var['akun']        = $this->m_guru->cekdata($id_guru)->row_array();
        $var['kelas']       = $this->m_admin->data_kelas();
        $var['guru']        = $this->m_admin->data_guru();
        $var['mapel']       = $this->m_admin->data_mapel();
        $var['hari']        = $this->m_admin->data_hari();
        $var['jadwal']      = $this->m_admin->data_jadwal();
        $var['tahunajaran'] = $this->m_admin->data_tahunajaran();
        $var['smt']         = $this->m_admin->data_smt();
        $var['active']      = 'guru';

        $this->load->view('v_header', $var);
        $this->load->view('guru/v_profil');
        $this->load->view('v_footer');
    }

    function edit_guru() {

        $data = [
            'nm_guru'     => $this->input->post('nm_guru'),
            'nip'         => $this->input->post('nip'),
            'nuptk'       => $this->input->post('nuptk'),
            'npsp'        => $this->input->post('npsp'),
            'gol'         => $this->input->post('gol'),
            'sk_pertama'  => $this->input->post('sk_pertama'),
            'sk_uk'       => $this->input->post('sk_uk'),
            'jabatan'     => $this->input->post('jabatan'),
            'th_jbkepsek' => $this->input->post('th_jbkepsek'),
            'stfk_guru'   => $this->input->post('stfk_guru'),
            'no_telp'     => $this->input->post('no_telp'),
        ];

        $where = [
            'id_guru' => $this->input->post('id_guru'),
        ];

        $config['upload_path']   = './images/guru';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload("foto_guru")) {
            $this->m_admin->update($where, $data, 'tb_guru');
            $this->session->set_flashdata('guru',
                "<div class='uk-alert uk-alert-success' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Mengedit Data
                      </div>");
            redirect("guru/profil");
        } else {
            $upload                   = $this->upload->data();
            $foto_guru                = $upload["raw_name"] . $upload["file_ext"];
            $data['foto_guru']        = $foto_guru;
            $config['image_library']  = 'gd2';
            $config['create_thumb']   = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 500;
            $config['height']         = 500;
            $config['source_image']   = "./images/guru/$foto_guru";
            $this->load->library('image_lib');
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->m_admin->update($where, $data, 'tb_guru');
            $this->session->set_flashdata('guru',
                "<div class='uk-alert uk-alert-success' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Mengedit Data
                      </div>");
            redirect("guru/profil");
        }
    }

    function get_jadwal() {
        $data = $this->m_admin->data_jadwal()->result();
        echo json_encode($data);
    }

    function get_hari() {
        $data = $this->m_admin->data_hari()->result();
        echo json_encode($data);
    }

    function ganti_pass() {

        $id         = $this->input->post('id');
        $pass_lama  = $this->input->post('pass_lama');
        $pass_baru  = $this->input->post('pass_baru');
        $pass_baru2 = $this->input->post('pass_baru2');

        $cek = $this->db->query("SELECT * FROM tb_guru WHERE id_guru='" . $id . "'");

        foreach ($cek->result_array() as $row) {
            if (password_verify($pass_lama, $row['password'])) {
                if ($pass_baru == $pass_baru2) {
                    $data = [
                        'password' => password_hash($pass_baru2, PASSWORD_BCRYPT, ['cost' => 11]),
                    ];
                    $where = [
                        'id_guru' => $id,
                    ];

                    $this->m_admin->update($where, $data, 'tb_guru');
                    // echo 'sukses';
                    echo "<div class='uk-alert uk-alert-success' data-uk-alert>
                                <a href='#' class='uk-alert-close uk-close'></a>
                                <i class='fas fa-check-circle'>&nbsp;</i>
                                Berhasil mengganti password
                        </div>";
                } else {
                    // echo 'gagal';
                    echo "<div class='uk-alert uk-alert-warning' data-uk-alert>
                                <a href='#' class='uk-alert-close uk-close'></a>
                                <i class='fas fa-info'>&nbsp;</i>
                                Password baru tidak sesuai
                        </div>";
                }
            } else {
                // echo 'error';
                echo "<div class='uk-alert uk-alert-danger' data-uk-alert>
                                <a href='#' class='uk-alert-close uk-close'></a>
                                <i class='feather icon-x-circle'>&nbsp;</i>
                                Password lama yang anda masukkan salah
                        </div>";
            }
        }
    }

    // DESKRIPSI KOMPETENSI

    function desk_ki3() {
        $var['desk_ki3'] = $this->m_admin->desk_ki3();
        $var['mapel']    = $this->m_admin->data_mapel();
        $var['active']   = 'desk_ki3';

        $this->load->view('v_header', $var);
        $this->load->view('desk_komp/v_ki3');
        $this->load->view('v_footer');
    }

    function desk_ki4() {
        $var['desk_ki4'] = $this->m_admin->desk_ki4();
        $var['mapel']    = $this->m_admin->data_mapel();
        $var['active']   = 'desk_ki4';

        $this->load->view('v_header', $var);
        $this->load->view('desk_komp/v_ki4');
        $this->load->view('v_footer');
    }

    // TAHUN AJARAN

    function get_ta() {
        $data = $this->m_admin->data_tahunajaran()->result();
        echo json_encode($data);
    }

    function get_smt() {
        $data = $this->m_admin->data_smt()->result();
        echo json_encode($data);
    }
}