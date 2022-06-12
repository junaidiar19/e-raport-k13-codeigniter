
<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

ob_start();

/**
 *
 */
class Admin extends CI_Controller {
    function __construct() {

        parent::__construct();
        $this->load->model(['m_admin']);

        if ($this->session->userdata['logged_in']['id_akun'] == '') {
            redirect('login');
        }
    }

    public function index() {
        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        $var['sklh']   = $this->m_admin->data_sekolah();
        $var['guru']   = $this->m_admin->data_guru();
        $var['mapel']  = $this->m_admin->data_mapel();
        $var['tj']     = $this->m_admin->data_tahunajaran();
        $var['active'] = 'dashboard';

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/v_dashboard');
        $this->load->view('admin/v_footer_admin');
    }

    // SEKOLAH

    function edit_sekolah($gr) {

        $data = [
            'nama_sklh'  => $this->input->post('nama_sklh'),
            'ns_sklh'    => $this->input->post('ns_sklh'),
            'alamat'     => $this->input->post('alamat'),
            'telp'       => $this->input->post('telp'),
            'kode_pos'   => $this->input->post('kode_pos'),
            'kelurahan'  => $this->input->post('kelurahan'),
            'kecamatan'  => $this->input->post('kecamatan'),
            'kabupaten'  => $this->input->post('kabupaten'),
            'provinsi'   => $this->input->post('provinsi'),
            'website'    => $this->input->post('website'),
            'email'      => $this->input->post('email'),
            'akreditasi' => $this->input->post('akreditasi'),
            'kepsek'     => $this->input->post('kepsek'),
        ];

        $where = [
            'id_sekolah' => $this->input->post('id_sekolah'),
        ];

        $config['upload_path']   = './images';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload("logo")) {
            if ($gr == $data['kepsek']) {
                $this->m_admin->update($where, $data, 'tb_sekolah');
                $this->session->set_flashdata('skl',
                    "<div class='uk-alert uk-alert-success' data-uk-alert>
              <a href='#' class='uk-alert-close uk-close'></a>
                    <i class='fas fa-check-circle'></i>
                    Berhasil Mengedit Data
            </div>");
                redirect('admin');
            } else {
                $w = [
                    'id_guru' => $data['kepsek'],
                ];
                $d = [
                    'kelas'      => '0',
                    'wali_kelas' => '0',
                    'jabatan'    => '1',
                ];

                $g = [
                    'id_guru' => $gr,
                ];

                $gd = [
                    'jabatan' => '2',
                ];

                $this->m_admin->update($where, $data, 'tb_sekolah');
                $this->m_admin->update($w, $d, 'tb_guru');
                $this->m_admin->update($g, $gd, 'tb_guru');
                $this->session->set_flashdata('skl',
                    "<div class='uk-alert uk-alert-success' data-uk-alert>
              <a href='#' class='uk-alert-close uk-close'></a>
                    <i class='fas fa-check-circle'></i>
                    Berhasil Mengedit Data
            </div>");
                redirect('admin');
            }
        } else {
            $upload                   = $this->upload->data();
            $logo                     = $upload["raw_name"] . $upload["file_ext"];
            $data['logo']             = $logo;
            $config['image_library']  = 'gd2';
            $config['create_thumb']   = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 500;
            $config['height']         = 500;
            $config['source_image']   = "./images/$logo";
            $this->load->library('image_lib');
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            if ($gr == $data['kepsek']) {
                $this->m_admin->update($where, $data, 'tb_sekolah');
                $this->session->set_flashdata('skl',
                    "<div class='uk-alert uk-alert-success' data-uk-alert>
              <a href='#' class='uk-alert-close uk-close'></a>
                    <i class='fas fa-check-circle'></i>
                    Berhasil Mengedit Data
            </div>");
                redirect('admin');
            } else {
                $w = [
                    'id_guru' => $data['kepsek'],
                ];
                $d = [
                    'kelas'      => '0',
                    'wali_kelas' => '0',
                    'jabatan'    => '1',
                ];

                $g = [
                    'id_guru' => $gr,
                ];

                $gd = [
                    'jabatan' => '2',
                ];

                $this->m_admin->update($where, $data, 'tb_sekolah');
                $this->m_admin->update($w, $d, 'tb_guru');
                $this->m_admin->update($g, $gd, 'tb_guru');
                $this->session->set_flashdata('skl',
                    "<div class='uk-alert uk-alert-success' data-uk-alert>
              <a href='#' class='uk-alert-close uk-close'></a>
                    <i class='fas fa-check-circle'></i>
                    Berhasil Mengedit Data
            </div>");
                redirect('admin');
            }
        }
    }

    // MAPEL

    function mapel() {
        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        $var['mapel']  = $this->m_admin->data_mapel();
        $var['active'] = 'mapel';

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/v_mapel');
        $this->load->view('admin/v_footer_admin');
    }

    function get_mapel() {
        $data = $this->m_admin->data_mapel()->result();
        echo json_encode($data);
    }

    function get_mapel_id() {
        $id   = $this->input->get('id');
        $data = $this->m_admin->mapel_id($id);
        echo json_encode($data);
    }

    function tambah_mapel() {
        $nm_mapel   = $this->input->post('nm_mapel');
        $kode_mapel = $this->input->post('kode_mapel');
        $ki_3       = $this->input->post('ki_3');
        $ki_4       = $this->input->post('ki_4');

        $data  = [];
        $index = 0;
        foreach ($nm_mapel as $nm_mapel) {
            array_push($data, [
                'nm_mapel'   => $nm_mapel,
                'kode_mapel' => $kode_mapel[$index],
                'ki_3'       => $ki_3[$index],
                'ki_4'       => $ki_4[$index],
            ]);
            $index++;
        }

        $this->m_admin->insert('tb_mapel', $data);
    }

    public function hapus_mapel() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_mapel', 'id_mapel', $id);
    }

    public function hapus_mapel2() {
        $id_mapel = $_POST['id_mapel'];
        $this->m_admin->delete('tb_mapel', 'id_mapel', $id_mapel);
        $this->session->set_flashdata('mapel',
            "<div class='uk-alert uk-alert-danger' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Menghapus Data
                      </div>");
        redirect("admin");
    }

    function edit_mapel() {
        $id_mapel   = $this->input->post('id_mapel');
        $nm_mapel   = $this->input->post('nm_mapel');
        $kode_mapel = $this->input->post('kode_mapel');
        $ki_3       = $this->input->post("ki_3");
        $ki_4       = $this->input->post("ki_4");

        $data = [
            'nm_mapel'   => $nm_mapel,
            'kode_mapel' => $kode_mapel,
            'ki_3'       => $ki_3,
            'ki_4'       => $ki_4,
        ];

        $where = [
            'id_mapel' => $id_mapel,
        ];

        $this->m_admin->update($where, $data, 'tb_mapel');
        $this->session->set_flashdata('mapel',
            "<div class='uk-alert uk-alert-primary' data-uk-alert>
            <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Mengedit Data
                      </div>");
        redirect('admin/mapel');
    }

    // EKSKUL SISWA

    function ekskul_siswa() {
        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        $var['ekskul_siswa'] = $this->m_admin->data_ekskul_siswa();
        $var['active']       = 'ekskul_siswa';

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/v_ekskul_siswa');
        $this->load->view('admin/v_footer_admin');
    }

    function tambah_ekskul_siswa() {
        $data = [
            'nm_ekskul' => $this->input->post('nm_ekskul'),
        ];

        $this->m_admin->tambah('tb_ekskul_siswa', $data);
        $this->session->set_flashdata('ekskul_siswa',
            "<div class='uk-alert uk-alert-success' data-uk-alert>
            <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Menambahkan Data
                      </div>");
        redirect('admin/ekskul_siswa');
    }

    function edit_ekskul_siswa($id) {

        $data = [
            'nm_ekskul' => $this->input->post('nm_ekskul'),
        ];

        $where = [
            'id_ekskul_siswa' => $id,
        ];

        $this->m_admin->update($where, $data, 'tb_ekskul_siswa');
        $this->session->set_flashdata('ekskul_siswa',
            "<div class='uk-alert uk-alert-primary' data-uk-alert>
            <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Mengedit Data
                      </div>");
        redirect('admin/ekskul_siswa');
    }

    public function hapus_ekskul_siswa() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_ekskul_siswa', 'id_ekskul_siswa', $id);
    }

    // GURU

    function guru() {
        $var['guru']   = $this->m_admin->data_guru();
        $var['mapel']  = $this->m_admin->data_mapel();
        $var['kelas']  = $this->m_admin->data_kelas();
        $var['active'] = 'guru';

        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();
        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/guru/v_guru');
        $this->load->view('admin/v_footer_admin');
    }

    function detailguru($id) {
        $var['kelas']       = $this->m_admin->data_kelas();
        $var['guru']        = $this->m_admin->data_guru();
        $var['mapel']       = $this->m_admin->data_mapel();
        $var['hari']        = $this->m_admin->data_hari();
        $var['jadwal']      = $this->m_admin->data_jadwal();
        $var['tahunajaran'] = $this->m_admin->data_tahunajaran();
        $var['smt']         = $this->m_admin->data_smt();
        $var['ab']          = $this->m_admin->data_ab();
        $var['abguru']      = $this->m_admin->data_abguru();
        $var['active']      = 'guru';
        $var['id']          = $id;

        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/guru/v_detail_guru');
        $this->load->view('admin/v_footer_admin');
    }

    function insert_akun_guru() {
        $id   = $this->input->post('id_guru');
        $user = $this->input->post('user');
        $hash = $this->input->post('pass');

        $data  = [];
        $index = 0;
        foreach ($hash as $hash) {
            array_push($data, [
                'password' => password_hash($hash, PASSWORD_BCRYPT, ['cost' => 11]),
                'username' => $user[$index],
                'id_guru'  => $id[$index],
            ]);
            $index++;
        }

        $this->m_admin->update_akun($data, 'tb_akun');
        $this->session->set_flashdata('guru',
            "<div class='uk-alert uk-alert-success' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Menambahkan Akun
                      </div>");
        redirect("admin/guru");
    }

    function tambah_akun_guru($id) {

        $user = $this->input->post('username');
        $hash = $this->input->post('password');

        $data = [
            'username' => $user,
            'password' => password_hash($hash, PASSWORD_BCRYPT, ['cost' => 11]),
            'level'    => '2',
        ];

        $exec    = $this->m_admin->tambah('tb_akun', $data);
        $id_akun = $this->db->insert_id();

        $data2 = [
            'akun' => $id_akun,
        ];

        $where = [
            'id_guru' => $id,
        ];

        $this->m_admin->update($where, $data2, 'tb_guru');

        $this->session->set_flashdata('guru',
            "<div class='uk-alert uk-alert-success' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'></i>
                            Berhasil Menambahkan Akun
                          </div>");
        redirect("admin/guru");
    }

    function edit_akun_guru() {

        $id        = $this->input->post('id_akun');
        $username  = $this->input->post('username');
        $pass_baru = $this->input->post('pass_baru');
        $pass_lama = $this->input->post('pass_lama');

        if ($pass_baru == '') {
            $data = [
                'username' => $username,
                'password' => $pass_lama,
            ];
            $where = [
                'id_akun' => $id,
            ];
            $this->m_admin->update($where, $data, 'tb_akun');
            $this->session->set_flashdata('guru',
                "<div class='uk-alert uk-alert-primary' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'></i>
                            Berhasil Mengedit Akun
                          </div>");
            redirect("admin/guru");
        } else {
            $data2 = [
                'username' => $username,
                'password' => password_hash($pass_baru, PASSWORD_BCRYPT, ['cost' => 11]),
            ];
            $where2 = [
                'id_akun' => $id,
            ];
            $this->m_admin->update($where2, $data2, 'tb_akun');
            $this->session->set_flashdata('guru',
                "<div class='uk-alert uk-alert-primary' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'></i>
                            Berhasil Mengedit Akun
                          </div>");
            redirect("admin/guru");
        }
    }

    function tambah_guru() {

        $data = [
            'nm_guru'     => $this->input->post('nm_guru'),
            'nip'         => $this->input->post('nip'),
            'nuptk'       => $this->input->post('nuptk'),
            'npsp'        => $this->input->post('npsp'),
            'gol'         => $this->input->post('gol'),
            'sk_pertama'  => $this->input->post('sk_pertama'),
            'sk_uk'       => $this->input->post('sk_uk'),
            'kelas'       => $this->input->post('kelas'),
            'jabatan'     => $this->input->post('jabatan'),
            'th_jbkepsek' => $this->input->post('th_jbkepsek'),
            'stfk_guru'   => $this->input->post('stfk_guru'),
            'stt_guru'    => $this->input->post('stt_guru'),
            'no_telp'     => $this->input->post('no_telp'),
        ];

        $this->m_admin->tambah('tb_guru', $data);
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
            'kelas'       => $this->input->post('kelas'),
            'wali_kelas'  => $this->input->post('wali_kelas'),
            'jabatan'     => $this->input->post('jabatan'),
            'th_jbkepsek' => $this->input->post('th_jbkepsek'),
            'stfk_guru'   => $this->input->post('stfk_guru'),
            'stt_guru'    => $this->input->post('stt_guru'),
            'no_telp'     => $this->input->post('no_telp'),
        ];

        $where = [
            'id_guru' => $this->input->post('id_guru'),
        ];

        $this->m_admin->update($where, $data, 'tb_guru');
        $this->session->set_flashdata('guru',
            "<div class='uk-alert uk-alert-primary' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Mengedit Data
                      </div>");
        redirect("admin/guru");
    }

    function edit_guru2($id) {

        $data = [
            'nm_guru'     => $this->input->post('nm_guru'),
            'nip'         => $this->input->post('nip'),
            'nuptk'       => $this->input->post('nuptk'),
            'npsp'        => $this->input->post('npsp'),
            'gol'         => $this->input->post('gol'),
            'sk_pertama'  => $this->input->post('sk_pertama'),
            'sk_uk'       => $this->input->post('sk_uk'),
            'kelas'       => $this->input->post('kelas'),
            'wali_kelas'  => $this->input->post('wali_kelas'),
            'jabatan'     => $this->input->post('jabatan'),
            'th_jbkepsek' => $this->input->post('th_jbkepsek'),
            'stfk_guru'   => $this->input->post('stfk_guru'),
            'stt_guru'    => $this->input->post('stt_guru'),
            'no_telp'     => $this->input->post('no_telp'),
        ];

        $where = [
            'id_guru' => $this->input->post('id_guru'),
        ];

        $this->m_admin->update($where, $data, 'tb_guru');
        $this->session->set_flashdata('guru',
            "<div class='uk-alert uk-alert-primary' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Mengedit Data
                      </div>");
        redirect("admin/detailguru/$id");
    }

    function edit_guru3($id) {

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
            redirect("admin/detailguru/$id");
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
            redirect("admin/detailguru/$id");
        }
    }

    public function hapus_guru() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_guru', 'id_guru', $id);
    }

    public function hapus_guru2() {
        $id_guru = $_POST['id_guru'];
        $this->m_admin->delete('tb_guru', 'id_guru', $id_guru);
        $this->session->set_flashdata('guru',
            "<div class='uk-alert uk-alert-danger' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Menghapus Data
                      </div>");
        redirect("admin/guru");
    }

    function ganti_pass($id) {

        $pass_lama  = $this->input->post('pass_lama');
        $pass_baru  = $this->input->post('pass_baru');
        $pass_baru2 = $this->input->post('pass_baru2');

        $cek = $this->db->query("SELECT * FROM tb_akun WHERE id_akun='" . $id . "'");

        foreach ($cek->result_array() as $row) {
            if (password_verify($pass_lama, $row['password'])) {
                if ($pass_baru == $pass_baru2) {
                    $data = [
                        'password' => password_hash($pass_baru2, PASSWORD_BCRYPT, ['cost' => 11]),
                    ];
                    $where = [
                        'id_akun' => $id,
                    ];

                    $this->m_admin->update($where, $data, 'tb_akun');
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

// JADWAL

    function get_jadwal() {
        $data = $this->m_admin->data_jadwal()->result();
        echo json_encode($data);
    }

    function get_hari() {
        $data = $this->m_admin->data_hari()->result();
        echo json_encode($data);
    }

    function tambah_jadwal() {

        $tj  = $this->m_admin->data_tahunajaran()->result_array();
        $smt = $this->m_admin->data_smt()->result_array();

        foreach ($tj as $tj) {
            if ($tj['stt_tahunajaran'] == 'Y') {
                $id_tj = $tj['id_tahunajaran'];
            }
        }

        foreach ($smt as $smt) {
            if ($smt['stt_smt'] == 'Y') {
                $id_smt = $smt['id_smt'];
            }
        }

        $data = [
            'jam_mulai'   => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai'),
            'hari'        => $this->input->post('hari'),
            'kelas'       => $this->input->post('kelas'),
            'mapel'       => $this->input->post('mapel'),
            'guru'        => $this->input->post('guru'),
            'ta'          => $id_tj,
        ];

        $this->m_admin->tambah('tb_jadwal', $data);
    }

    function edit_jadwal() {

        $data = [
            'jam_mulai'   => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai'),
            'kelas'       => $this->input->post('kelas'),
            'mapel'       => $this->input->post('mapel'),
        ];

        $where = [
            'id_jadwal' => $this->input->post('jadwal'),
        ];

        $this->m_admin->update($where, $data, 'tb_jadwal');
    }

    public function hapus_jadwal() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_jadwal', 'id_jadwal', $id);
    }

    function modal_edit() {

        $jd    = $this->m_admin->data_jadwal()->result();
        $kelas = $this->m_admin->data_kelas();
        $mapel = $this->m_admin->data_mapel();
        $id    = $this->input->post('id');
        echo '<link rel="stylesheet" href="' . base_url() . '/assets/assets/css/main.min.css" media="all">';
        foreach ($jd as $jd) {
            if ($jd->id_jadwal == $id) {
                echo "<div style='display: none;' id='alert-edit-jadwal-" . $jd->id_jadwal . "'>
                    <div class='uk-alert uk-alert-primary' data-uk-alert>
                                <a href='#' class='uk-alert-close uk-close'></a>
                                        <i class='fas fa-check-circle'>&nbsp;</i>
                                        Berhasil Mengedit Jadwal
                            </div>
                </div>";
                echo '<input type="hidden" id="jadwal-' . $jd->id_jadwal . '" value="' . $jd->id_jadwal . '">

                                <div class="uk-grid">
                                    <div class="uk-width-5-10">

                                        <div class="uk-form-row">
                                            <label>Jam Mulai</label>
                                            <input type="time" class="md-input" id="jam_mulai-' . $jd->id_jadwal . '" value="' . $jd->jam_mulai . '" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>Jam Selesai</label>
                                            <input type="time" class="md-input" id="jam_selesai-' . $jd->id_jadwal . '" value="' . $jd->jam_selesai . '" autocomplete="off">
                                        </div>
                                    </div>';

                echo '<div class="uk-width-5-10">
                <div class="uk-margin-medium-bottom">
                                            <select id="kelas-' . $jd->id_jadwal . '" class="uk-form-width" data-md-selectize-inline>
                                                <option value="">-Select-</option>';
                foreach ($kelas->result_array() as $kl) {
                    echo '<option value="' . $kl['id_kelas'] . '"';
                    if ($kl['id_kelas'] == $jd->kelas) {
                        echo "selected";
                    }
                    echo '>' . $kl['nm_kelas'] . '</option>';
                }
                echo '</select>
                                        </div>
                                        <div class="uk-margin-medium-bottom">
                                            <select id="mapel-' . $jd->id_jadwal . '" class="uk-form-width" data-md-selectize-inline>
                                                <option value="">-Select-</option>';
                foreach ($mapel->result_array() as $mp) {
                    if ($mp['id_mapel'] != 1 && $mp['id_mapel'] != 2) {
                        echo '<option value="' . $mp['id_mapel'] . '"';
                        if ($mp['id_mapel'] == $jd->mapel) {
                            echo "selected";
                        }
                        echo '>' . $mp['nm_mapel'] . '</option>';
                    }}
                echo '</select></div></div>';

                echo "</div>";

                echo '<div class="uk-text-right">
                                <input type="reset" class="md-btn md-btn-danger" value="Reset">
                                <input type="submit" onclick="edit_jadwal(' . $jd->id_jadwal . ')" class="md-btn md-btn-primary" value="Simpan">
                            </div>';
            }
        }
        echo '<stylesheet';
        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    // ABSEN

    function get_abguru($id) {
        $ab     = $this->m_admin->data_ab();
        $abguru = $this->m_admin->data_abguru();
        $tj     = $this->m_admin->data_tahunajaran()->result_array();
        $smt    = $this->m_admin->data_smt()->result_array();

        foreach ($tj as $tj) {
            if ($tj['stt_tahunajaran'] == 'Y') {
                $id_tj = $tj['id_tahunajaran'];
            }
        }

        foreach ($smt as $smt) {
            if ($smt['stt_smt'] == 'Y') {
                $id_smt = $smt['id_smt'];
            }
        }

        $no = 1;
        $pt = "'";
        foreach ($ab->result() as $ab) {
            if ($ab->smt == $id_smt) {
                echo "<tr>
                                            <td>" . $no++ . " </td>
                                            <td>" . $ab->nm_bulan . "</td>";
                $cekdata = $this->db->query("SELECT * FROM tb_abguru WHERE guru=" . $id . " AND  ta=" . $id_tj . " AND smt=" . $id_smt . " AND ab=" . $ab->id_ab . " ")->num_rows();
                if ($cekdata > 0) {
                    foreach ($abguru->result() as $ag) {
                        if ($ag->guru == $id && $ag->ta == $id_tj && $ag->smt == $id_smt && $ag->ab == $ab->id_ab) {
                            echo "
                                            <td>" . $ag->sakit . "</td>
                                            <td>" . $ag->izin . "</td>
                                            <td>" . $ag->alpha . "</td>
                                            <td>" . $ag->jumlah . "</td>
                                            <td>";

                            echo '<a data-uk-tooltip="{pos:top}" title="Hapus" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_abguru(' . $ag->id_abguru . ')"><i class="feather icon-trash"></i></a>
                                <a data-uk-tooltip="{pos:top}" title="Edit" onclick="edit_abguru(' . $ag->id_abguru . ')"
                                data-uk-modal="{target:' . $pt . '#edit_abguru' . $pt . '}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>
                                            </td>
                            ';
                        }
                    }
                } else {
                    echo '
                        <td colspan="4" style="text-align: center;">Data Tidak Ada</td>
                        <td>
                            <a data-uk-tooltip="{pos:top}" title="Tambah" href="#" class="md-btn md-btn-small md-btn-primary md-btn-wave-light" data-uk-modal="{target:' . $pt . '#tambah_abguru' . $pt . '}" onclick="tambah_abguru(' . $ab->id_ab . ')" ><i class="feather icon-plus-circle"></i></a>
                        </td>
                    ';
                }
                echo "</tr>";
            }
        }
        $jlh = $this->db->query("SELECT SUM(jumlah) AS jml, SUM(sakit) AS s, SUM(izin) AS i, SUM(alpha) AS a FROM tb_abguru WHERE guru=" . $id . " AND ta=" . $id_tj . " AND smt=" . $id_smt . " ")->result();
        foreach ($jlh as $jlh) {
            echo "<tr>
                        <td colspan='2' style='text-align: center;'><b>Total</b></td>
                        <td><b>" . $jlh->s . "</b></td>
                        <td><b>" . $jlh->i . "</b></td>
                        <td><b>" . $jlh->a . "</b></td>
                        <td colspan='2'><b>" . $jlh->jml . "</b></td>
                     </tr>
                ";
        }
    }

    function get_tambah_abguru() {
        $id = $this->input->post('id');
        $ab = $this->m_admin->data_ab();
        echo '<link rel="stylesheet" href="' . base_url() . '/assets/assets/css/main.min.css" media="all">';
        echo "<div style='display: none;' id='alert-tambah-abguru-" . $id . "'>
                    <div class='uk-alert uk-alert-success' data-uk-alert>
                                <a href='#' class='uk-alert-close uk-close'></a>
                                        <i class='fas fa-check-circle'>&nbsp;</i>
                                        Berhasil Menambahkan Absen
                            </div>
                </div>";
        foreach ($ab->result() as $ab) {
            if ($ab->id_ab == $id) {
                echo "<h4>Bulan : " . $ab->nm_bulan . "</h4>";
            }}
        echo '
        <table class="uk-table">
            <tr>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alpha</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td><input type="number" onkeyup="key_sakit(' . $id . ')" value="0" class="md-input" id="sakit-' . $id . '"></td>
                <td><input type="number" onkeyup="key_izin(' . $id . ')" value="0" class="md-input" id="izin-' . $id . '"></td>
                <td><input type="number" onkeyup="key_alpha(' . $id . ')" value="0" class="md-input" id="alpha-' . $id . '"></td>
                <td><input class="md-input" id="jumlah-' . $id . '" readonly/></td>
            </tr>
            <input type="hidden" id="ab-' . $id . '" value="' . $id . '">
        </table>
        ';

        echo '<div class="uk-text-right">
                <input type="submit" onclick="submit_abguru(' . $id . ')" class="md-btn md-btn-primary" value="Simpan">
            </div>';

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    function get_edit_abguru() {
        $id     = $this->input->post('id');
        $abguru = $this->m_admin->data_abguru();
        echo '<link rel="stylesheet" href="' . base_url() . '/assets/assets/css/main.min.css" media="all">';
        echo "<div style='display: none;' id='alert-edit-abguru-" . $id . "'>
                    <div class='uk-alert uk-alert-primary' data-uk-alert>
                                <a href='#' class='uk-alert-close uk-close'></a>
                                        <i class='fas fa-check-circle'>&nbsp;</i>
                                        Berhasil Mengedit Absen
                            </div>
                </div>";

        echo '
        <table class="uk-table">
            <tr>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alpha</th>
                <th>Jumlah</th>
            </tr>';
        foreach ($abguru->result() as $ag) {
            if ($ag->id_abguru == $id) {
                echo '<tr>
                <td><input type="number" onkeyup="key_sakit(' . $id . ')" class="md-input" id="sakit-' . $id . '" value="' . $ag->sakit . '"></td>
                <td><input type="number" onkeyup="key_izin(' . $id . ')" class="md-input" id="izin-' . $id . '" value="' . $ag->izin . '"></td>
                <td><input type="number" onkeyup="key_alpha(' . $id . ')" class="md-input" id="alpha-' . $id . '" value="' . $ag->alpha . '"></td>
                <td><input class="md-input" id="jumlah-' . $id . '" value="' . $ag->jumlah . '" readonly/></td>
            </tr>
                <input type="hidden" id="abguru-' . $id . '" value="' . $ag->id_abguru . '">
        </table>';
            }
        }

        echo '<div class="uk-text-right">
                <input type="submit" onclick="ubah_abguru(' . $id . ')" class="md-btn md-btn-primary" value="Simpan">
            </div>';

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    function get_abguru_filter() {
        $id_tj  = $this->input->post('ta_abguru');
        $id_smt = $this->input->post('smt_abguru');
        $ab     = $this->m_admin->data_ab();
        $abguru = $this->m_admin->data_abguru();

        $no = 1;
        $pt = "'";
        foreach ($ab->result() as $ab) {
            if ($ab->smt == $id_smt) {
                echo "<tr>
                                            <td>" . $no++ . " </td>
                                            <td>" . $ab->nm_bulan . "</td>";
                $cekdata = $this->db->query("SELECT * FROM tb_abguru WHERE ta=" . $id_tj . " AND smt=" . $id_smt . " AND ab=" . $ab->id_ab . " ")->num_rows();
                if ($cekdata > 0) {
                    foreach ($abguru->result() as $ag) {
                        if ($ag->ta == $id_tj && $ag->smt == $id_smt && $ag->ab == $ab->id_ab) {
                            echo "
                                            <td>" . $ag->sakit . "</td>
                                            <td>" . $ag->izin . "</td>
                                            <td>" . $ag->alpha . "</td>
                                            <td>" . $ag->jumlah . "</td>
                                            <td>";

                            echo '<a data-uk-tooltip="{pos:top}" title="Hapus" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_abguru_filter(' . $ag->id_abguru . ')"><i class="feather icon-trash"></i></a>
                                <a data-uk-tooltip="{pos:top}" title="Edit" onclick="edit_abguru_filter(' . $ag->id_abguru . ')"
                                data-uk-modal="{target:' . $pt . '#edit_abguru' . $pt . '}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>
                                            </td>
                            ';
                        }
                    }
                } else {
                    echo '
                        <td colspan="5" style="text-align: center;">Data Tidak Ada</td>
                    ';
                }
                echo "</tr>";
            }
        }
        $jlh = $this->db->query("SELECT SUM(jumlah) AS jml, SUM(sakit) AS s, SUM(izin) AS i, SUM(alpha) AS a FROM tb_abguru WHERE ta=" . $id_tj . " AND smt=" . $id_smt . " ")->result();
        foreach ($jlh as $jlh) {
            echo "<tr>
                        <td colspan='2' style='text-align: center;'><b>Total</b></td>
                        <td><b>" . $jlh->s . "</b></td>
                        <td><b>" . $jlh->i . "</b></td>
                        <td><b>" . $jlh->a . "</b></td>
                        <td colspan='2'><b>" . $jlh->jml . "</b></td>
                     </tr>
                ";
        }
    }

    function get_edit_abguru_filter() {
        $id     = $this->input->post('id');
        $abguru = $this->m_admin->data_abguru();
        echo '<link rel="stylesheet" href="' . base_url() . '/assets/assets/css/main.min.css" media="all">';
        echo "<div style='display: none;' id='alert-edit-abguru-" . $id . "'>
                    <div class='uk-alert uk-alert-primary' data-uk-alert>
                                <a href='#' class='uk-alert-close uk-close'></a>
                                        <i class='fas fa-check-circle'>&nbsp;</i>
                                        Berhasil Mengedit Absen
                            </div>
                </div>";

        echo '
        <table class="uk-table">
            <tr>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alpha</th>
                <th>Jumlah</th>
            </tr>';
        foreach ($abguru->result() as $ag) {
            if ($ag->id_abguru == $id) {
                echo '<tr>
                <td><input type="number" onkeyup="key_sakit(' . $id . ')" class="md-input" id="sakit-' . $id . '" value="' . $ag->sakit . '"></td>
                <td><input type="number" onkeyup="key_izin(' . $id . ')" class="md-input" id="izin-' . $id . '" value="' . $ag->izin . '"></td>
                <td><input type="number" onkeyup="key_alpha(' . $id . ')" class="md-input" id="alpha-' . $id . '" value="' . $ag->alpha . '"></td>
                <td><input class="md-input" id="jumlah-' . $id . '" value="' . $ag->jumlah . '" readonly/></td>
            </tr>
                <input type="hidden" id="abguru-' . $id . '" value="' . $ag->id_abguru . '">
        </table>';
            }
        }

        echo '<div class="uk-text-right">
                <input type="submit" onclick="ubah_abguru_filter(' . $id . ')" class="md-btn md-btn-primary" value="Simpan">
            </div>';

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    function tambah_abguru() {

        $tj  = $this->m_admin->data_tahunajaran()->result_array();
        $smt = $this->m_admin->data_smt()->result_array();

        foreach ($tj as $tj) {
            if ($tj['stt_tahunajaran'] == 'Y') {
                $id_tj = $tj['id_tahunajaran'];
            }
        }

        foreach ($smt as $smt) {
            if ($smt['stt_smt'] == 'Y') {
                $id_smt = $smt['id_smt'];
            }
        }

        $data = [
            'sakit'  => $this->input->post('sakit'),
            'izin'   => $this->input->post('izin'),
            'alpha'  => $this->input->post('alpha'),
            'jumlah' => $this->input->post('jumlah'),
            'ab'     => $this->input->post('ab'),
            'guru'   => $this->input->post('guru'),
            'ta'     => $id_tj,
            'smt'    => $id_smt,
        ];

        $this->m_admin->tambah('tb_abguru', $data);
    }

    function edit_abguru() {

        $data = [
            'sakit'  => $this->input->post('sakit'),
            'izin'   => $this->input->post('izin'),
            'alpha'  => $this->input->post('alpha'),
            'jumlah' => $this->input->post('jumlah'),
        ];

        $where = [
            'id_abguru' => $this->input->post('abguru'),
        ];

        $this->m_admin->update($where, $data, 'tb_abguru');
    }

    public function hapus_abguru() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_abguru', 'id_abguru', $id);
    }

// DESKRIPSI KOMPETENSI

    function menu_desk_ki3() {
        $var['kelas']  = $this->m_admin->data_kelas();
        $var['active'] = 'desk_ki3';

        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/desk_komp/v_menu_ki3');
        $this->load->view('admin/v_footer_admin');
    }

    function desk_ki3($id) {
        $var['desk_ki3'] = $this->m_admin->desk_ki3();
        $var['mapel']    = $this->m_admin->data_mapel();
        $var['smt']      = $this->m_admin->data_smt();
        $var['active']   = 'desk_ki3';
        $var['id']       = $id;

        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/desk_komp/v_ki3');
        $this->load->view('admin/v_footer_admin');
    }

    function tambah_desk_ki3($id) {
        $mapel    = $this->input->post('mapel');
        $desk_ki3 = $this->input->post('desk_ki3');
        $smt      = $this->input->post('smt');
        $kelas    = $this->input->post('kelas');

        $data  = [];
        $index = 0;
        foreach ($mapel as $mapel) {
            array_push($data, [
                'mapel'    => $mapel,
                'desk_ki3' => $desk_ki3[$index],
                'smt'      => $smt[$index],
                'kelas'    => $kelas[$index],
            ]);
            $index++;
        }

        $this->m_admin->insert('tb_desk_ki3', $data);
        $this->session->set_flashdata('desk',
            "<div class='uk-alert uk-alert-success' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Menambahkan Data
                      </div>");
        redirect("admin/desk_ki3/" . $id . " ");
    }

    function edit_desk_ki3($id) {
        $data = [
            'desk_ki3' => $this->input->post('desk_ki3'),
        ];

        $where = [
            'id_desk_ki3' => $this->input->post('id'),
        ];

        $this->m_admin->update($where, $data, 'tb_desk_ki3');
        $this->session->set_flashdata('desk',
            "<div class='uk-alert uk-alert-primary' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Mengedit Data
                      </div>");
        redirect("admin/desk_ki3/" . $id . " ");
    }

    public function hapus_desk_ki3() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_desk_ki3', 'id_desk_ki3', $id);
    }

    function menu_desk_ki4() {
        $var['kelas']  = $this->m_admin->data_kelas();
        $var['active'] = 'desk_ki4';

        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/desk_komp/v_menu_ki4');
        $this->load->view('admin/v_footer_admin');
    }

    function desk_ki4($id) {
        $var['desk_ki4'] = $this->m_admin->desk_ki4();
        $var['mapel']    = $this->m_admin->data_mapel();
        $var['smt']      = $this->m_admin->data_smt();
        $var['id']       = $id;
        $var['active']   = 'desk_ki4';

        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/desk_komp/v_ki4');
        $this->load->view('admin/v_footer_admin');
    }

    function tambah_desk_ki4($id) {
        $mapel    = $this->input->post('mapel');
        $desk_ki4 = $this->input->post('desk_ki4');
        $smt      = $this->input->post('smt');
        $kelas    = $this->input->post('kelas');

        $data  = [];
        $index = 0;
        foreach ($mapel as $mapel) {
            array_push($data, [
                'mapel'    => $mapel,
                'desk_ki4' => $desk_ki4[$index],
                'smt'      => $smt[$index],
                'kelas'    => $kelas[$index],
            ]);
            $index++;
        }

        $this->m_admin->insert('tb_desk_ki4', $data);
        $this->session->set_flashdata('desk',
            "<div class='uk-alert uk-alert-success' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Menambahkan Data
                      </div>");
        redirect("admin/desk_ki4/" . $id . " ");
    }

    function edit_desk_ki4($id) {
        $data = [
            'desk_ki4' => $this->input->post('desk_ki4'),
        ];

        $where = [
            'id_desk_ki4' => $this->input->post('id'),
        ];

        $this->m_admin->update($where, $data, 'tb_desk_ki4');
        $this->session->set_flashdata('desk',
            "<div class='uk-alert uk-alert-primary' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Mengedit Data
                      </div>");
        redirect("admin/desk_ki4/" . $id . " ");
    }

    public function hapus_desk_ki4() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_desk_ki4', 'id_desk_ki4', $id);
    }

    // SISWA

    function siswa() {
        $var['siswa']  = $this->m_admin->data_siswa();
        $var['kelas']  = $this->m_admin->data_kelas();
        $var['active'] = 'siswa';
        $id_akun       = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun']   = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/siswa/v_siswa');
        $this->load->view('admin/v_footer_admin');
    }

    function detailsiswa($id) {
        $var['kelas']       = $this->m_admin->data_kelas();
        $var['siswa']       = $this->m_admin->data_siswa();
        $var['mapel']       = $this->m_admin->data_mapel();
        $var['pendidikan']  = $this->m_admin->data_pendidikan();
        $var['hari']        = $this->m_admin->data_hari();
        $var['jadwal']      = $this->m_admin->data_jadwal();
        $var['tahunajaran'] = $this->m_admin->data_tahunajaran();
        $var['smt']         = $this->m_admin->data_smt();
        $var['ab']          = $this->m_admin->data_ab();
        $var['absiswa']     = $this->m_admin->data_absiswa();
        $var['fisik']       = $this->m_admin->data_fisik();
        $var['kesehatan']   = $this->m_admin->data_kesehatan();
        $var['active']      = 'siswa';
        $var['id']          = $id;
        $var['sikap_ki1']   = $this->m_admin->data_sikap_ki1();
        $var['sikap_ki2']   = $this->m_admin->data_sikap_ki2();
        $var['kr_ki3']      = $this->m_admin->data_kr_ki3();
        $var['kr_ki4']      = $this->m_admin->data_kr_ki4();
        $var['ki1']         = $this->m_admin->data_sikap_ki1();
        $var['ki2']         = $this->m_admin->data_sikap_ki2();

        $tj  = $this->m_admin->data_tahunajaran()->result_array();
        $smt = $this->m_admin->data_smt()->result_array();

        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        foreach ($tj as $tj) {
            if ($tj['stt_tahunajaran'] == 'Y') {
                $id_tjj = $tj['id_tahunajaran'];
            }
        }

        foreach ($smt as $smt) {
            if ($smt['stt_smt'] == 'Y') {
                $id_smtt = $smt['id_smt'];
            }
        }

        $var['id_tj']  = $id_tjj;
        $var['id_smt'] = $id_smtt;

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/siswa/v_detail_siswa');
        $this->load->view('admin/v_footer_admin');
    }

    // NILAI SIKAP

    function nilai_sikap($kl) {

        $var['active'] = 'siswa';
        $var['id']     = $kl;
        $id_akun       = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun']   = $this->m_admin->cekdata($id_akun)->row_array();

        $var['taj'] = $this->db->query("SELECT * FROM tb_tahunajaran ORDER BY stt_tahunajaran DESC ")->result();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/sikap/v_daftar_ta');
        $this->load->view('admin/v_footer_admin');
    }

    function detail_nilai_sikap($kl, $ta) {

        $var['kelas']     = $this->m_admin->data_kelas();
        $var['sikap_ki1'] = $this->m_admin->data_sikap_ki1();
        $var['sikap_ki2'] = $this->m_admin->data_sikap_ki2();
        $var['kr_ki3']    = $this->m_admin->data_kr_ki3();
        $var['kr_ki4']    = $this->m_admin->data_kr_ki4();
        $var['active']    = 'siswa';
        $var['id']        = $kl;
        $var['ta']        = $ta;
        $id_akun          = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun']      = $this->m_admin->cekdata($id_akun)->row_array();

        $var['kelas'] = $this->db->query("SELECT * FROM tb_kelas WHERE id_kelas=" . $kl . " ")->result();
        $var['taj']   = $this->db->query("SELECT * FROM tb_tahunajaran WHERE id_tahunajaran=" . $ta . " ")->result();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/sikap/v_nilai_sikap');
        $this->load->view('admin/v_footer_admin');
    }

    // REKAP NILAI

    function rekap_nilai($id, $jb) {

        $var['mapel']       = $this->m_admin->data_mapel();
        $var['tahunajaran'] = $this->m_admin->data_tahunajaran();
        $var['active']      = 'siswa';
        $var['kl']          = $id;
        $var['jb']          = $jb;
        $id_akun            = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun']        = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/rekap/v_rekap_nilai');
        $this->load->view('admin/v_footer_admin');
    }

    function rekap_nilai_ki3($kl, $id, $ta) {

        $var['siswa']  = $this->m_admin->data_siswa();
        $var['mapel']  = $this->db->query("SELECT * FROM tb_mapel WHERE id_mapel=" . $id . " ")->result();
        $var['kelas']  = $this->db->query("SELECT * FROM tb_kelas WHERE id_kelas=" . $kl . " ")->result();
        $var['taj']    = $this->db->query("SELECT * FROM tb_tahunajaran WHERE stt_tahunajaran='Y' ")->result();
        $var['ki3']    = $this->db->query("SELECT * FROM tb_desk_ki3 WHERE mapel=" . $id . " ")->result();
        $var['active'] = 'siswa';
        $var['kl']     = $kl;
        $var['id']     = $id;
        $var['ta']     = $ta;
        $id_akun       = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun']   = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/rekap/v_rekap_nilai_ki3');
        $this->load->view('admin/v_footer_admin');
    }

    function rekap_nilai_ki4($kl, $id, $ta) {

        $var['siswa']  = $this->m_admin->data_siswa();
        $var['mapel']  = $this->db->query("SELECT * FROM tb_mapel WHERE id_mapel=" . $id . " ")->result();
        $var['kelas']  = $this->db->query("SELECT * FROM tb_kelas WHERE id_kelas=" . $kl . " ")->result();
        $var['taj']    = $this->db->query("SELECT * FROM tb_tahunajaran WHERE stt_tahunajaran='Y' ")->result();
        $var['ki4']    = $this->db->query("SELECT * FROM tb_desk_ki4 WHERE mapel=" . $id . " ")->result();
        $var['active'] = 'siswa';
        $var['kl']     = $kl;
        $var['id']     = $id;
        $var['ta']     = $ta;

        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/rekap/v_rekap_nilai_ki4');
        $this->load->view('admin/v_footer_admin');
    }

    // LEGER

    function leger($id) {

        $var['taj']    = $this->db->query("SELECT * FROM tb_tahunajaran ORDER BY stt_tahunajaran DESC ")->result();
        $var['active'] = 'siswa';
        $var['id']     = $id;
        $id_akun       = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun']   = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/leger/v_daftar_ta');
        $this->load->view('admin/v_footer_admin');
    }

    function detail_leger($kl, $ta) {

        $var['mapel'] = $this->m_admin->data_mapel();
        $var['ki1']   = $this->db->query("SELECT * FROM tb_sikap_ki1 WHERE kelas=" . $kl . " AND ta=" . $ta . " ");
        $var['ki2']   = $this->db->query("SELECT * FROM tb_sikap_ki2 WHERE kelas=" . $kl . " AND ta=" . $ta . " ");
        $var['siswa'] = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $kl . " ");
        $var['kelas'] = $this->db->query("SELECT * FROM tb_kelas WHERE id_kelas=" . $kl . " ")->result();
        $var['taj']   = $this->db->query("SELECT * FROM tb_tahunajaran WHERE id_tahunajaran=" . $ta . " ")->result();

        $var['active'] = 'siswa';
        $var['kla']    = $kl;
        $var['id_tj']  = $ta;

        $id_akun     = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun'] = $this->m_admin->cekdata($id_akun)->row_array();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/leger/v_leger');
        $this->load->view('admin/v_footer_admin');
    }

    public function naikkelas() {

        $id_akun       = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun']   = $this->m_admin->cekdata($id_akun)->row_array();
        $var['active'] = 'naikkelas';
        $var['siswa']  = $this->m_admin->data_siswa();

        $this->load->view('admin/v_header_admin', $var);
        $this->load->view('admin/v_naik_kelas');
        $this->load->view('admin/v_footer_admin');
    }
}
