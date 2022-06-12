<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

ob_start();

/**
 *
 */
class Proses extends CI_Controller {
    function __construct() {

        parent::__construct();
        $this->load->model(['m_admin']);

        if ($this->session->userdata['logged_in']['id_akun'] == '') {
            redirect('login');
        }
    }

    function get_ta() {
        $tj = $this->db->query("SELECT * FROM tb_tahunajaran");

        $no = 1;
        foreach ($tj->result() as $ta) {
            echo '
                            <tr>
                                <td>' . $no++ . '</td>
                                <td>' . $ta->nm_tahunajaran . '</td>
                                <td>' . $ta->tahun . '</td>
                                <td>' . $ta->smt . '</td>
                                <td>
            <button onclick="hapus_ta(' . $ta->id_tahunajaran . ')" class="md-btn md-btn-danger md-btn-small md-btn-wave-light"><i class="fas fa-trash"></i></button>
            <button onclick="ubah_ta(' . $ta->id_tahunajaran . ')" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>';
        }
    }

    public function form_edit_ta() {
        $id = $this->input->post('id');
        $tj = $this->db->query("SELECT * FROM tb_tahunajaran WHERE id_tahunajaran=" . $id . " ")->result();
        foreach ($tj as $ta) {
            echo '<table class="uk-table">';
            echo '
                    <tr>
                        <td>
                        <input type="hidden" id="id_tahunajaran_s-' . $ta->id_tahunajaran . '" value="' . $ta->id_tahunajaran . '">
                        <div class="md-input-wrapper md-input-filled">
                            <input type="text" class="md-input" placeholder="Tahun Ajaran" id="nm_tahunajaran_s-' . $ta->id_tahunajaran . '" autocomplete="off" value="' . $ta->nm_tahunajaran . '">
                            <span class="md-input-bar"></span></div>
                        </td>
                        <td>
                        <div class="md-input-wrapper md-input-filled">
                            <input type="number" class="md-input" placeholder="Tahun" id="tahun_s-' . $ta->id_tahunajaran . '" autocomplete="off" value="' . $ta->tahun . '">
                            <span class="md-input-bar"></span></div>
                        </td>
                        <td>
                        <div class="md-input-wrapper md-input-filled">
                            <input type="number" class="md-input" placeholder="Semester" id="smt_s-' . $ta->id_tahunajaran . '" autocomplete="off" value="' . $ta->smt . '">
                            <span class="md-input-bar"></span></div>
                        </td>
                    </tr>';
            echo '</table>';
            echo '<div class="uk-text-right">
                    <button onclick="edit_ta(' . $ta->id_tahunajaran . ')" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</button>
                </div>';
        }
    }

    function get_ta_stt() {
        echo '<link rel="stylesheet" href="' . base_url() . '/assets/assets/css/main.min.css" media="all">';

        $tj = $this->db->query("SELECT * FROM tb_tahunajaran");
        $no = 1;
        foreach ($tj->result() as $ta) {
            echo '
                            <tr>
                                <td>' . $no++ . '</td>
                                <td>' . $ta->nm_tahunajaran . '</td>
                                <td>';
            echo '
                                    <input type="checkbox" value="' . $ta->id_tahunajaran . '" data-switchery data-switchery-size="large" ';
            if ($ta->stt_tahunajaran == 'Y') {
                echo "checked";
            }
            echo 'id="update-stt-ta-' . $ta->id_tahunajaran . '" />';
            echo '
                                </td>
                            </tr>';
        }
    }

    public function simpan_ta() {
        $data = [
            'nm_tahunajaran'  => $this->input->post('ta'),
            'tahun'           => $this->input->post('th'),
            'smt'             => $this->input->post('smt'),
            'stt_tahunajaran' => 'N',
        ];

        $this->m_admin->tambah('tb_tahunajaran', $data);
    }

    public function edit_ta() {
        $data = [
            'nm_tahunajaran' => $this->input->post('ta'),
            'tahun'          => $this->input->post('th'),
            'smt'            => $this->input->post('smt'),
        ];

        $where = [
            'id_tahunajaran' => $this->input->post('id'),
        ];

        $this->m_admin->update($where, $data, 'tb_tahunajaran');
    }

    public function hapus_ta() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_tahunajaran', 'id_tahunajaran', $id);
    }

    function get_siswa() {
        $siswa = $this->m_admin->data_siswa();
        $kelas = $this->m_admin->data_kelas();
        $fk    = $this->input->post('fk');
        $a     = "'";

        echo '<link rel="stylesheet" href="' . base_url() . '/assets/assets/css/main.min.css" media="all">';

        foreach ($kelas->result() as $kl) {
            if ($kl->id_kelas == $fk) {
                echo '
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-7-10">
                            <h3>Data Siswa Kelas ' . $kl->nm_kelas . '</h3>
                        </div>
                        <div class="uk-width-medium-3-10 uk-text-right">
                            <a data-uk-modal="{target:' . $a . '#tambah_siswa_' . $kl->id_kelas . '' . $a . '}" class="md-btn md-btn-primary md-btn-wave-light"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div><hr>';

                echo '
                    <div class="table-responsive">
                        <form action="' . base_url('proses/hapus_siswa2') . '" method="post" id="form-delete-' . $kl->id_kelas . '">
                        <table class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">
                                        <div class="checkbox checkbox-fill d-inline">
                                            <input type="checkbox" name="checkbox-fill-1" id="check-all-' . $kl->id_kelas . '">
                                            <label for="check-all-' . $kl->id_kelas . '" class="cr"></label>
                                        </div>
                                    </th>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>JK</th>
                                    <th>Agama</th>
                                    <th>Tempat</th>
                                    <th>Tgl Lahir</th>
                                    <th>Jalan</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten</th>
                                    <th>Provinsi</th>
                                    <th>TK</th>
                                </tr>
                            </thead>
                        <tbody>';

                $no  = 1;
                $noa = 1;
                $nob = 1;
                foreach ($siswa->result() as $sw) {
                    if ($sw->kelas == $kl->id_kelas) {
                        echo '
            <tr>
                    <td>
                        <div class="checkbox checkbox-fill d-inline">
                          <input type="checkbox" name="id_siswa[]" value="' . $sw->id_siswa . '" class="check-item-' . $kl->id_kelas . '" id="check-' . $noa++ . '">
                            <label for="check-' . $nob++ . '" class="cr"></label>
                        </div>
                    </td>
                    <td>' . $no++ . '</td>
                                      <td>
                                      <a data-uk-tooltip="{pos:top}" title="Hapus" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_siswa(' . $sw->id_siswa . ')"><i class="feather icon-trash"></i></a>
                                      <a data-uk-tooltip="{pos:top}" title="Edit" data-uk-modal="{target:' . $a . '#edit_siswa_' . $sw->id_siswa . '' . $a . '}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>
                                      <a data-uk-tooltip="{pos:top}" title="Detail" href="' . base_url('admin/detailsiswa/') . $sw->id_siswa . '" class="md-btn md-btn-primary md-btn-small md-btn-wave-light"><i class="fas fa-address-card"></i></a>
                                      </td>
                                      <td>' . $sw->nm_siswa . '</td>
                                      <td>' . $sw->nis . '</td>
                                      <td>' . $sw->nisn . '</td>
                                      <td>' . $sw->jk . '</td>
                                      <td>' . $sw->agama . '</td>
                                      <td>' . $sw->tempat . '</td>
                                      <td>' . $sw->tanggal_lahir . '</td>
                                      <td>' . $sw->jalan . '</td>
                                      <td>' . $sw->kel . '</td>
                                      <td>' . $sw->kec . '</td>
                                      <td>' . $sw->kab . '</td>
                                      <td>' . $sw->prov . '</td>
                                      <td>' . $sw->pdd_sb . '</td>
                                      </tr>
                          ';
                    }
                }

                echo '</tbody>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <a class="md-btn md-btn-danger md-btn-wave-light" id="btn-delete-' . $kl->id_kelas . '" title="Hapus"><i class="feather icon-trash"></i></a>
                            </td>
                        </tr>
                    </table>
                </form>
                </div>';

                echo ' <script>

                 $(document).ready(function(){
                    $("#check-all-' . $kl->id_kelas . '").click(function(){
                      if($(this).is(":checked"))
                        $(".check-item-' . $kl->id_kelas . '").prop("checked", true);
                      else
                        $(".check-item-' . $kl->id_kelas . '").prop("checked", false);
                    });

                    $("#btn-delete-' . $kl->id_kelas . '").click(function(){
                      var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?");
                      if(confirm)
                        $("#form-delete-' . $kl->id_kelas . '").submit();
                    });
                  });

            </script>';

                echo "</div></div>";

                echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
                echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
                echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';

                echo '<script src="http://localhost/k13app/assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>';
                echo '<script src="http://localhost/k13app/assets/bower_components/datatables-colvis/js/dataTables.colVis.js"></script>';
                echo '<script src="http://localhost/k13app/assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>';
                echo '<script src="http://localhost/k13app/assets/assets/js/custom/datatables_uikit.min.js"></script>';
                echo '<script src="http://localhost/k13app/assets/assets/js/pages/plugins_datatables.min.js"></script>';
            }
        }
    }

    function tambah_siswa() {

        $data = [
            'nis'           => $this->input->post('nis'),
            'nisn'          => $this->input->post('nisn'),
            'nm_siswa'      => $this->input->post('nm_siswa'),
            'jk'            => $this->input->post('jk'),
            'agama'         => $this->input->post('agama'),
            'tempat'        => $this->input->post('tempat'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jalan'         => $this->input->post('jalan'),
            'kel'           => $this->input->post('kel'),
            'kec'           => $this->input->post('kec'),
            'kab'           => $this->input->post('kab'),
            'prov'          => $this->input->post('prov'),
            // 'pdd_sb'        => $this->input->post('pdd_sb'),
            'kelas'         => $this->input->post('kelas'),
        ];

        $this->m_admin->tambah('tb_siswa', $data);
    }

    function edit_siswa() {

        $data = [
            'nis'           => $this->input->post('nis'),
            'nisn'          => $this->input->post('nisn'),
            'nm_siswa'      => $this->input->post('nm_siswa'),
            'jk'            => $this->input->post('jk'),
            'agama'         => $this->input->post('agama'),
            'tempat'        => $this->input->post('tempat'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jalan'         => $this->input->post('jalan'),
            'kel'           => $this->input->post('kel'),
            'kec'           => $this->input->post('kec'),
            'kab'           => $this->input->post('kab'),
            'prov'          => $this->input->post('prov'),
            'pdd_sb'        => $this->input->post('pdd_sb'),
        ];

        $where = [
            'id_siswa' => $this->input->post('id_siswa'),
        ];

        $this->m_admin->update($where, $data, 'tb_siswa');
    }

    public function hapus_siswa() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_siswa', 'id_siswa', $id);
    }

    public function hapus_siswa2() {
        $id_siswa = $_POST['id_siswa'];
        $this->m_admin->delete('tb_siswa', 'id_siswa', $id_siswa);
        $this->session->set_flashdata('siswa',
            "<div class='uk-alert uk-alert-danger' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-check-circle'></i>
                        Berhasil Menghapus Data
                      </div>");
        redirect("admin/siswa");
    }

    // ORTU SISWA

    function get_ortu($id) {

        $ortu = $this->m_admin->data_ortu();

        echo "<div style='display: none;' id='alert-tambah-ortu'>
                    <div class='uk-alert uk-alert-success' data-uk-alert>
                        <a href='#' class='uk-alert-close uk-close'></a>
                                <i class='fas fa-check-circle'>&nbsp;</i>
                                Berhasil Menambahkan Data
                    </div>
                </div><br>";
        foreach ($ortu->result() as $or) {
            if ($or->siswa == $id) {
                echo '<div class="uk-grid">';
                echo '<div class="uk-width-medium-5-10">';
                echo '	<table class="uk-table">
				            <tr>
				                <th colspan="3" style="text-align: center;">AYAH<hr></th>
				            </tr>
				            <tr>
								<td style="width:100px;">Nama</td>
								<td style="width:10px;">:</td>
								<td>' . $or->nm_ayah . '</td>
				            </tr>
				            <tr>
								<td>Pendidikan</td>
								<td>:</td>
								<td>';

                if ($or->pdd_ayah == 1) {
                    echo "SD";
                } elseif ($or->pdd_ayah == 2) {
                    echo "SMP";
                } elseif ($or->pdd_ayah == 3) {
                    echo "SMA";
                } elseif ($or->pdd_ayah == 4) {
                    echo "D3";
                } elseif ($or->pdd_ayah == 5) {
                    echo "S1";
                } elseif ($or->pdd_ayah == 6) {
                    echo "S2";
                } elseif ($or->pdd_ayah == 7) {
                    echo "S3";
                }

                echo '</td>
				            </tr>
				            <tr>
								<td>Pekerjaan</td>
								<td>:</td>
								<td>' . $or->pj_ayah . '</td>
				            </tr>
				            <tr>
								<td>NIK</td>
								<td>:</td>
								<td>' . $or->nik_ayah . '</td>
				            </tr>
				          </table>';
                echo '</div>';
                echo '<div class="uk-width-medium-5-10">';
                echo '	<table class="uk-table">
				            <tr>
				                <th colspan="3" style="text-align: center;">IBU<hr></th>
				            </tr>
				            <tr>
								<td style="width:100px;">Nama</td>
								<td style="width:10px;">:</td>
								<td>' . $or->nm_ibu . '</td>
				            </tr>
				            <tr>
								<td>Pendidikan</td>
								<td>:</td>
								<td>';
                if ($or->pdd_ibu == 1) {
                    echo "SD";
                } elseif ($or->pdd_ibu == 2) {
                    echo "SMP";
                } elseif ($or->pdd_ibu == 3) {
                    echo "SMA";
                } elseif ($or->pdd_ibu == 4) {
                    echo "D3";
                } elseif ($or->pdd_ibu == 5) {
                    echo "S1";
                } elseif ($or->pdd_ibu == 6) {
                    echo "S2";
                } elseif ($or->pdd_ibu == 7) {
                    echo "S3";
                }
                echo '</td>
				            </tr>
				            <tr>
								<td>Pekerjaan</td>
								<td>:</td>
								<td>' . $or->pj_ibu . '</td>
				            </tr>
				            <tr>
								<td>NIK</td>
								<td>:</td>
								<td>' . $or->nik_ibu . '</td>
				            </tr>
				          </table>';
                echo '</div>';
                echo '<div class="uk-width-medium-5-10"><br>';
                echo '	<table class="uk-table">
				            <tr>
				                <th colspan="3" style="text-align: center;">WALI<hr></th>
				            </tr>
				            <tr>
								<td style="width:100px;">Nama</td>
								<td style="width:10px;">:</td>
								<td>' . $or->nm_wali . '</td>
				            </tr>
				            <tr>
								<td>Pendidikan</td>
								<td>:</td>
								<td>';
                if ($or->pdd_wali == 1) {
                    echo "SD";
                } elseif ($or->pdd_wali == 2) {
                    echo "SMP";
                } elseif ($or->pdd_wali == 3) {
                    echo "SMA";
                } elseif ($or->pdd_wali == 4) {
                    echo "D3";
                } elseif ($or->pdd_wali == 5) {
                    echo "S1";
                } elseif ($or->pdd_wali == 6) {
                    echo "S2";
                } elseif ($or->pdd_wali == 7) {
                    echo "S3";
                }
                echo '</td>
				            </tr>
				            <tr>
								<td>Pekerjaan</td>
								<td>:</td>
								<td>' . $or->pj_wali . '</td>
				            </tr>
				            <tr>
								<td>NIK</td>
								<td>:</td>
								<td>' . $or->nik_wali . '</td>
				            </tr>
				          </table>';
                echo '</div>';
                echo '</div>';
            }
        }
    }

    function get_btn_ortu($id) {
        $ortu = $this->m_admin->data_ortu();
        $lgt  = $this->db->query("SELECT * FROM tb_ortu WHERE siswa=" . $id . "")->num_rows();
        if ($lgt == 0) {
            echo '
		        	<a onclick="tambah_ortu()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-plus-circle"></i></a>';
        } else {
            foreach ($ortu->result() as $or) {
                if ($or->siswa == $id) {
                    echo '<a data-uk-tooltip="{pos:top}" title="Hapus" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_ortu(' . $or->id_ortu . ')"><i class="feather icon-trash"></i></a>

		        <a onclick="edit_ortu(' . $or->id_ortu . ')" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-edit"></i></a>';
                }
            }
        }
    }

    function get_edit_ortu($id) {
        $ortu       = $this->db->query("SELECT * FROM tb_ortu WHERE siswa=" . $id . "");
        $pendidikan = $this->m_admin->data_pendidikan();

        foreach ($ortu->result() as $or) {
            echo '<div class="uk-grid">';
            echo '<div class="uk-width-medium-5-10">';
            echo '	<table class="uk-table">
				            <tr>
				                <th colspan="3" style="text-align: center;">AYAH<hr></th>
				            </tr>
				            <tr>
								<td style="width:100px;">Nama</td>
								<td style="width:10px;">:</td>
								<td>
									<div class="uk-form-row">
						                <div class="md-input-wrapper md-input-focus">
						                	<label>Nama Ayah</label>
						                		<input class="md-input" id="nm_ayah_' . $or->id_ortu . '" value="' . $or->nm_ayah . '" autocomplete="off">
						                		<span class="md-input-bar"></span>
						                	</div>
						                </div>
								</td>
				            </tr>
				            <tr>
								<td>Pendidikan</td>
								<td>:</td>
								<td>';

            echo '<div class="uk-form-row"><select class="uk-form-width" id="pdd_ayah_' . $or->id_ortu . '" data-md-selectize-inline>';
            echo '<option value="">-Pendidikan-</option>';
            foreach ($pendidikan->result() as $kl) {
                echo '<option value="' . $kl->id_pendidikan . '"';
                if ($kl->id_pendidikan == $or->pdd_ayah) {
                    echo "selected";
                }
                echo '>' . $kl->nm_pendidikan . '</option>';
            }
            echo '</select></div>';

            echo '</td>
				            </tr>
				            <tr>
								<td>Pekerjaan</td>
								<td>:</td>
								<td>
									<div class="uk-form-row">
						                <div class="md-input-wrapper md-input-focus">
						                    <label>Pekerjaan</label>
						                    	<input class="md-input" id="pj_ayah_' . $or->id_ortu . '" value="' . $or->pj_ayah . '" autocomplete="off">
						                    	<span class="md-input-bar"></span>
						                	</div>
						                </div>
								</td>
				            </tr>
				            <tr>
								<td>NIK</td>
								<td>:</td>
								<td>
									<div class="uk-form-row">
						                <div class="md-input-wrapper md-input-focus">
						                    <label>NIK</label>
						                    	<input class="md-input" id="nik_ayah_' . $or->id_ortu . '" value="' . $or->nik_ayah . '" autocomplete="off">
						                    	<span class="md-input-bar"></span>
						                	</div>
						                </div>
								</td>
				            </tr>
				          </table>';
            echo '</div>';
            echo '<div class="uk-width-medium-5-10">';
            echo '	<table class="uk-table">
				            <tr>
				                <th colspan="3" style="text-align: center;">IBU<hr></th>
				            </tr>
				            <tr>
								<td style="width:100px;">Nama</td>
								<td style="width:10px;">:</td>
								<td>
									<div class="uk-form-row">
						                <div class="md-input-wrapper md-input-focus">
						                	<label>Nama Ibu</label>
						                		<input class="md-input" id="nm_ibu_' . $or->id_ortu . '" value="' . $or->nm_ibu . '" autocomplete="off">
						                		<span class="md-input-bar"></span>
						                	</div>
						                </div>
								</td>
				            </tr>
				            <tr>
								<td>Pendidikan</td>
								<td>:</td>
								<td>';

            echo '<div class="uk-form-row"><select class="uk-form-width" id="pdd_ibu_' . $or->id_ortu . '" data-md-selectize-inline>';
            echo '<option value="">-Pendidikan-</option>';
            foreach ($pendidikan->result() as $kl) {
                echo '<option value="' . $kl->id_pendidikan . '"';
                if ($kl->id_pendidikan == $or->pdd_ibu) {
                    echo "selected";
                }
                echo '>' . $kl->nm_pendidikan . '</option>';
            }
            echo '</select></div>';

            echo '</td>
				            </tr>
				            <tr>
								<td>Pekerjaan</td>
								<td>:</td>
								<td>
									<div class="uk-form-row">
						                <div class="md-input-wrapper md-input-focus">
						                    <label>Pekerjaan</label>
						                    	<input class="md-input" id="pj_ibu_' . $or->id_ortu . '" value="' . $or->pj_ibu . '" autocomplete="off">
						                    	<span class="md-input-bar"></span>
						                	</div>
						                </div>
								</td>
				            </tr>
				            <tr>
								<td>NIK</td>
								<td>:</td>
								<td>
									<div class="uk-form-row">
						                <div class="md-input-wrapper md-input-focus">
						                    <label>NIK</label>
						                    	<input class="md-input" id="nik_ibu_' . $or->id_ortu . '" value="' . $or->nik_ibu . '" autocomplete="off">
						                    	<span class="md-input-bar"></span>
						                	</div>
						                </div>
								</td>
				            </tr>
				          </table>';
            echo '</div>';
            echo '<div class="uk-width-medium-5-10"><br>';
            echo '	<table class="uk-table">
				            <tr>
				                <th colspan="3" style="text-align: center;">WALI<hr></th>
				            </tr>
				            <tr>
								<td style="width:100px;">Nama</td>
								<td style="width:10px;">:</td>
								<td>
									<div class="uk-form-row">
						                <div class="md-input-wrapper md-input-focus">
						                	<label>Nama Wali</label>
						                		<input class="md-input" id="nm_wali_' . $or->id_ortu . '" value="' . $or->nm_wali . '" autocomplete="off">
						                		<span class="md-input-bar"></span>
						                	</div>
						                </div>
								</td>
				            </tr>
				            <tr>
								<td>Pendidikan</td>
								<td>:</td>
								<td>';

            echo '<div class="uk-form-row"><select class="uk-form-width" id="pdd_wali_' . $or->id_ortu . '" data-md-selectize-inline>';
            echo '<option value="">-Pendidikan-</option>';
            foreach ($pendidikan->result() as $kl) {
                echo '<option value="' . $kl->id_pendidikan . '"';
                if ($kl->id_pendidikan == $or->pdd_wali) {
                    echo "selected";
                }
                echo '>' . $kl->nm_pendidikan . '</option>';
            }
            echo '</select></div>';

            echo '</td>
				            </tr>
				            <tr>
								<td>Pekerjaan</td>
								<td>:</td>
								<td>
									<div class="uk-form-row">
						                <div class="md-input-wrapper md-input-focus">
						                    <label>Pekerjaan</label>
						                    	<input class="md-input" id="pj_wali_' . $or->id_ortu . '" value="' . $or->pj_wali . '" autocomplete="off">
						                    	<span class="md-input-bar"></span>
						                	</div>
						                </div>
								</td>
				            </tr>
				            <tr>
								<td>NIK</td>
								<td>:</td>
								<td>
									<div class="uk-form-row">
						                <div class="md-input-wrapper md-input-focus">
						                    <label>NIK</label>
						                    	<input class="md-input" id="nik_wali_' . $or->id_ortu . '" value="' . $or->nik_wali . '" autocomplete="off">
						                    	<span class="md-input-bar"></span>
						                	</div>
						                </div>
								</td>
				            </tr>
				          </table>';
            echo '</div>';
            echo '</div>';
        }

        echo '
	    <div class="uk-text-right">
	        <button onclick="update_ortu(' . $or->id_ortu . ')" class="md-btn md-btn-primary md-btn-wave-light">Simpan</button>
	    </div>';

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    function tambah_ortu() {

        $data = [
            'nm_ayah'  => $this->input->post('nm_ayah'),
            'pdd_ayah' => $this->input->post('pdd_ayah'),
            'pj_ayah'  => $this->input->post('pj_ayah'),
            'nik_ayah' => $this->input->post('nik_ayah'),
            'nm_ibu'   => $this->input->post('nm_ibu'),
            'pdd_ibu'  => $this->input->post('pdd_ibu'),
            'pj_ibu'   => $this->input->post('pj_ibu'),
            'nik_ibu'  => $this->input->post('nik_ibu'),
            'nm_wali'  => $this->input->post('nm_wali'),
            'pdd_wali' => $this->input->post('pdd_wali'),
            'pj_wali'  => $this->input->post('pj_wali'),
            'nik_wali' => $this->input->post('nik_wali'),
            'siswa'    => $this->input->post('siswa'),
        ];

        $this->m_admin->tambah('tb_ortu', $data);
    }

    function edit_ortu() {

        $data = [
            'nm_ayah'  => $this->input->post('nm_ayah'),
            'pdd_ayah' => $this->input->post('pdd_ayah'),
            'pj_ayah'  => $this->input->post('pj_ayah'),
            'nik_ayah' => $this->input->post('nik_ayah'),
            'nm_ibu'   => $this->input->post('nm_ibu'),
            'pdd_ibu'  => $this->input->post('pdd_ibu'),
            'pj_ibu'   => $this->input->post('pj_ibu'),
            'nik_ibu'  => $this->input->post('nik_ibu'),
            'nm_wali'  => $this->input->post('nm_wali'),
            'pdd_wali' => $this->input->post('pdd_wali'),
            'pj_wali'  => $this->input->post('pj_wali'),
            'nik_wali' => $this->input->post('nik_wali'),
        ];

        $where = [
            'id_ortu' => $this->input->post('id_ortu'),
        ];

        $this->m_admin->update($where, $data, 'tb_ortu');
    }

    public function hapus_ortu() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_ortu', 'id_ortu', $id);
    }

    // FISIK

    function get_fisik($id) {
        $fk  = $this->m_admin->data_fisik();
        $ta  = $this->m_admin->data_tahunajaran();
        $lgt = $this->db->query("SELECT * FROM tb_fisik WHERE siswa=" . $id . "")->num_rows();
        $pt  = "'";
        // if ($lgt > 0) {
        foreach ($ta->result() as $t) {
            $fsk = $this->db->query("SELECT * FROM tb_fisik WHERE ta=" . $t->id_tahunajaran . " AND siswa=" . $id . " ")->num_rows();

            echo '
				<tr>
					<td>' . $t->nm_tahunajaran . '</td>';
            foreach ($fk->result() as $k) {
                if ($k->ta == $t->id_tahunajaran && $k->siswa == $id) {
                    echo
                    '<td>' . $k->tb_1 . ' cm</td>
						<td>' . $k->bb_1 . ' kg</td>
					<td>
						<a data-uk-tooltip="{pos:top}" title="Hapus" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_fisik(' . $k->id_fisik . ')"><i class="feather icon-trash"></i></a>
						<a data-uk-modal="{target:' . $pt . '#edit_fisik' . $pt . '}" onclick="edit_fisik(' . $k->id_fisik . ')" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-edit"></i></a>
					</td>';
                }
            }

            if ($fsk == 0) {
                echo '<td colspan="2" class="uk-text-center">Data Belum Ada</td>';
                echo '<td><a data-uk-modal="{target:' . $pt . '#tambah_fisik' . $pt . '}" onclick="tambah_fisik(' . $t->id_tahunajaran . ')" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-plus-circle"></i></a></td>';
            }

            echo '</tr>';
        }
    }

    function tambah_fisik() {

        $data = [
            'tb_1'  => $this->input->post('tb_1'),
            'bb_1'  => $this->input->post('bb_1'),
            'ta'    => $this->input->post('ta'),
            'siswa' => $this->input->post('siswa'),
        ];

        $this->m_admin->tambah('tb_fisik', $data);
    }

    function edit_fisik() {

        $data = [
            'tb_1' => $this->input->post('tb_1'),
            'bb_1' => $this->input->post('bb_1'),
        ];

        $where = [
            'id_fisik' => $this->input->post('fisik'),
        ];

        $this->m_admin->update($where, $data, 'tb_fisik');
    }

    public function hapus_fisik() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_fisik', 'id_fisik', $id);
    }

    function get_modal_tambah_fisik() {
        $id = $this->input->post('id');

        echo " <div id='alert-tambah-fisik-" . $id . "' style='display: none;'>
                <div class='uk-alert uk-alert-primary' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'>&nbsp;</i>
                            Berhasil Menambahkan Data
                </div>
              </div>";
        echo '<table class="uk-table" border="1">
            <tr>
                <th>Tinggi Badan<sup>[cm]</sup></th>
                <th>Berat Badan<sup>[kg]</sup></th>
            </tr>
            <tr>
                <td>
                	<div class="md-input-wrapper md-input-filled">
                    <input type="text" class="md-input" id="tb_1-' . $id . '" autocomplete="off">
                    <span class="md-input-bar"></span></div>
                </td>
                <td>
                	<div class="md-input-wrapper md-input-filled">
                    <input type="text" class="md-input" id="bb_1-' . $id . '" autocomplete="off">
                    <input type="hidden" class="md-input" id="ta-' . $id . '" autocomplete="off">
                    <span class="md-input-bar"></span></div>
                </td>
            </tr>
        </table>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="submit_fisik(' . $id . ')">Simpan</button>
        </div>';
    }

    function get_modal_fisik() {
        $id = $this->input->post('id');
        $fk = $this->m_admin->data_fisik();

        echo " <div id='alert-edit-fisik-" . $id . "' style='display: none;'>
                <div class='uk-alert uk-alert-success' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'>&nbsp;</i>
                            Berhasil Mengedit Data
                </div>
              </div>";
        foreach ($fk->result() as $k) {
            if ($k->id_fisik == $id) {
                echo '<table class="uk-table" border="1">
            <tr>
                <th>Tinggi Badan<sup>[cm]</sup></th>
                <th>Berat Badan<sup>[kg]</sup></th>
            </tr>
            <tr>
                <td>
                	<div class="md-input-wrapper md-input-filled">
                    <input type="text" class="md-input" id="tb_1-' . $id . '" value="' . $k->tb_1 . '" autocomplete="off">
                    <span class="md-input-bar"></span></div>
                </td>
                <td>
                	<div class="md-input-wrapper md-input-filled">
                    <input type="text" class="md-input" id="bb_1-' . $id . '" value="' . $k->bb_1 . '" autocomplete="off">
                    <span class="md-input-bar"></span></div>
                </td>
            </tr>
        </table>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="ubah_fisik(' . $id . ')">Simpan</button>
        </div>';
            }
        }
    }

    // KESEHATAN

    function get_kesehatan($id) {
        $fk  = $this->m_admin->data_kesehatan();
        $ta  = $this->m_admin->data_tahunajaran();
        $lgt = $this->db->query("SELECT * FROM tb_kesehatan WHERE siswa=" . $id . "")->num_rows();
        $pt  = "'";
        // if ($lgt > 0) {
        foreach ($ta->result() as $t) {
            $fsk = $this->db->query("SELECT * FROM tb_kesehatan WHERE ta=" . $t->id_tahunajaran . " AND siswa=" . $id . "  ")->num_rows();

            echo '
				<tr>
					<td>' . $t->nm_tahunajaran . '</td>';
            foreach ($fk->result() as $k) {
                if ($k->ta == $t->id_tahunajaran && $k->siswa == $id) {
                    echo '<td>';

                    if ($k->pendengaran == 1) {
                        echo "Sangat Baik";
                    } elseif ($k->pendengaran == 2) {
                        echo "Baik";
                    } else {
                        echo "Kurang Baik";
                    }

                    echo '</td>';
                    echo '<td>';
                    if ($k->penglihatan == 1) {
                        echo "Sangat Baik";
                    } elseif ($k->penglihatan == 2) {
                        echo "Baik";
                    } else {
                        echo "Kurang Baik";
                    }
                    echo '</td>';
                    echo '<td>';
                    if ($k->gigi == 1) {
                        echo "Sangat Baik";
                    } elseif ($k->gigi == 2) {
                        echo "Baik";
                    } else {
                        echo "Kurang Baik";
                    }
                    echo '</td>';
                    echo '
					<td>
						<a data-uk-tooltip="{pos:top}" title="Hapus" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_kesehatan(' . $k->id_kesehatan . ')"><i class="feather icon-trash"></i></a>
						<a data-uk-modal="{target:' . $pt . '#edit_kesehatan' . $pt . '}" onclick="edit_kesehatan(' . $k->id_kesehatan . ')" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-edit"></i></a>
					</td>';
                }
            }

            if ($fsk == 0) {
                echo '<td colspan="3" class="uk-text-center">Data Belum Ada</td>';
                echo '<td><a data-uk-modal="{target:' . $pt . '#tambah_kesehatan' . $pt . '}" onclick="tambah_kesehatan(' . $t->id_tahunajaran . ')" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-plus-circle"></i></a></td>';
            }

            echo '</tr>';
        }
        //      } else {

        //          echo '
        //          <tr>
        //     <td colspan="6" style="text-align: center;"><b>Data belum ada</b></td>
        // </tr>
        //          ';
        //      }
    }

    function tambah_kesehatan() {

        $data = [
            'pendengaran' => $this->input->post('pendengaran'),
            'penglihatan' => $this->input->post('penglihatan'),
            'gigi'        => $this->input->post('gigi'),
            'siswa'       => $this->input->post('siswa'),
            'ta'          => $this->input->post('ta'),
        ];

        $this->m_admin->tambah('tb_kesehatan', $data);
    }

    function edit_kesehatan() {

        $data = [
            'pendengaran' => $this->input->post('pendengaran'),
            'penglihatan' => $this->input->post('penglihatan'),
            'gigi'        => $this->input->post('gigi'),
        ];

        $where = [
            'id_kesehatan' => $this->input->post('kesehatan'),
        ];

        $this->m_admin->update($where, $data, 'tb_kesehatan');
    }

    public function hapus_kesehatan() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_kesehatan', 'id_kesehatan', $id);
    }

    function get_modal_tambah_kes() {
        $id      = $this->input->post('id');
        $kondisi = $this->m_admin->data_kondisi();

        echo " <div id='alert-tambah-kesehatan-" . $id . "' style='display: none;'>
                <div class='uk-alert uk-alert-primary' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'>&nbsp;</i>
                            Berhasil Menambahkan Data
                </div>
              </div>";
        echo '<table class="uk-table">
            <tr>
                <th>Pendengaran</th>
                <th>Penglihatan</th>
                <th>Gigi</th>
            </tr>
            <tr>
                <td>';

        echo '<div class="uk-form-row"><select class="uk-form-width" id="pendengaran-' . $id . '" data-md-selectize-inline>
                                            <option value="">-Kondisi-</option>';
        foreach ($kondisi->result_array() as $kl) {
            echo '<option value="' . $kl['id_kondisi'] . '">' . $kl['nm_kondisi'] . '</option>';
        }
        echo '</select></div>';

        echo '
                <td>';
        echo '<div class="uk-form-row"><select class="uk-form-width" id="penglihatan-' . $id . '" data-md-selectize-inline>
                                            <option value="">-Kondisi-</option>';
        foreach ($kondisi->result_array() as $kl) {
            echo '<option value="' . $kl['id_kondisi'] . '">' . $kl['nm_kondisi'] . '</option>';
        }
        echo '</select></div>';
        echo '
                </td>
                <td>';
        echo '<div class="uk-form-row"><select class="uk-form-width" id="gigi-' . $id . '" data-md-selectize-inline>
                                            <option value="">-Kondisi-</option>';
        foreach ($kondisi->result_array() as $kl) {
            echo '<option value="' . $kl['id_kondisi'] . '">' . $kl['nm_kondisi'] . '</option>';
        }
        echo '</select></div>';
        echo '
                    <input type="hidden" class="md-input" id="ta-' . $id . '" value="' . $id . '" autocomplete="off">
                </td>
            </tr>
        </table>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="submit_kesehatan(' . $id . ')">Simpan</button>
        </div>';

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    function get_modal_kes() {
        $id      = $this->input->post('id');
        $kes     = $this->m_admin->data_kesehatan();
        $kondisi = $this->m_admin->data_kondisi();

        echo " <div id='alert-edit-kesehatan-" . $id . "' style='display: none;'>
                <div class='uk-alert uk-alert-success' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'>&nbsp;</i>
                            Berhasil Mengedit Data
                </div>
              </div>";
        foreach ($kes->result() as $k) {
            if ($k->id_kesehatan == $id) {
                echo '<table class="uk-table">
            <tr>
                <th>Pendengaran</th>
                <th>Penglihatan</th>
                <th>Gigi</th>
            </tr>
            <tr>
                <td>';

                echo '<div class="uk-form-row"><select class="uk-form-width" id="pendengaran-' . $id . '" data-md-selectize-inline>
                                            <option value="">-Kondisi-</option>';
                foreach ($kondisi->result() as $kl) {
                    echo '<option value="' . $kl->id_kondisi . '"';
                    if ($kl->id_kondisi == $k->pendengaran) {
                        echo "selected";
                    }
                    echo '>' . $kl->nm_kondisi . '</option>';
                }
                echo '</select></div>';

                echo '
                </td>
                <td>';
                echo '<div class="uk-form-row"><select class="uk-form-width" id="penglihatan-' . $id . '" data-md-selectize-inline>
                                            <option value="">-Kondisi-</option>';
                foreach ($kondisi->result() as $kl) {
                    echo '<option value="' . $kl->id_kondisi . '"';
                    if ($kl->id_kondisi == $k->penglihatan) {
                        echo "selected";
                    }
                    echo '>' . $kl->nm_kondisi . '</option>';
                }
                echo '</select></div>';
                echo '
                </td>
                <td>';

                echo '<div class="uk-form-row"><select class="uk-form-width" id="gigi-' . $id . '" data-md-selectize-inline>
                                            <option value="">-Kondisi-</option>';
                foreach ($kondisi->result() as $kl) {
                    echo '<option value="' . $kl->id_kondisi . '"';
                    if ($kl->id_kondisi == $k->gigi) {
                        echo "selected";
                    }
                    echo '>' . $kl->nm_kondisi . '</option>';
                }
                echo '</select></div>';

                echo '
                </td>
            </tr>
        </table>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="ubah_kesehatan(' . $id . ')">Simpan</button>
        </div>';
            }
        }

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    // EKSKUL

    function get_ekskul($id) {
        $tahunajaran = $this->m_admin->data_tahunajaran();
        $pt          = "'";
        foreach ($tahunajaran->result() as $kl) {
            echo '
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-grid">
                                <div class="uk-width-7-10">
                                    <h5><b>' . $kl->nm_tahunajaran . '</b></h5>
                                </div>
                                <div class="uk-width-3-10 uk-text-right">
                                    <button data-uk-modal="{target:' . $pt . '#tambah_ekskul' . $pt . '}" onclick="tambah_ekskul(' . $kl->id_tahunajaran . ')" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
            ';

            echo '
                <table class="uk-table" border="1">
                <tr>
                    <th colspan="4" style="text-align: center;">Data Ekstrakurikuler</th>
                </tr>
                <tr>
                    <th style="width: 10px;">No</th>
                    <th>Ekskul</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>';
            $pr = $this->db->query("SELECT * FROM tb_ekskul, tb_ekskul_siswa WHERE tb_ekskul.eks = tb_ekskul_siswa.id_ekskul_siswa AND ta=" . $kl->id_tahunajaran . " AND siswa=" . $id . " ");
            if ($pr->num_rows() > 0) {
                $no = 1;
                foreach ($pr->result() as $k) {
                    echo '
                <tr>
                    <td>' . $no++ . '</td>
                    <td>' . $k->nm_ekskul . '</td>
                    <td>' . $k->ket . '</td>
                    <td>
                        <a data-uk-tooltip="{pos:top}" title="Hapus" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_ekskul(' . $k->id_ekskul . ')"><i class="feather icon-trash"></i></a>
                        <a data-uk-modal="{target:' . $pt . '#edit_ekskul' . $pt . '}" onclick="edit_ekskul(' . $k->id_ekskul . ')" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>';
                }
            } else {
                echo '
        	<tr>
        		<td colspan="4" class="uk-text-center"><b>Tidak Ada Data Ekskul</b></td>
        	</tr>';
            }

            echo "</table>";

            echo "</div></div>";
        }
    }

    function tambah_ekskul() {

        $data = [
            'eks'   => $this->input->post('eks'),
            'ket'   => $this->input->post('ket'),
            'ta'    => $this->input->post('ta'),
            'siswa' => $this->input->post('siswa'),
        ];

        $this->m_admin->tambah('tb_ekskul', $data);
    }

    function edit_ekskul() {

        $data = [
            'eks' => $this->input->post('eks'),
            'ket' => $this->input->post('ket'),
        ];

        $where = [
            'id_ekskul' => $this->input->post('ekskul'),
        ];

        $this->m_admin->update($where, $data, 'tb_ekskul');
    }

    public function hapus_ekskul() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_ekskul', 'id_ekskul', $id);
    }

    function get_modal_tambah_ekskul() {
        $id           = $this->input->post('id');
        $ekskul_siswa = $this->m_admin->data_ekskul_siswa();

        echo "<div id='alert-tambah-ekskul-" . $id . "' style='display: none;'>
                <div class='uk-alert uk-alert-primary' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'>&nbsp;</i>
                            Berhasil Menambahkan Data
                </div>
              </div>";

        echo '<table class="uk-table">
            <tr>
                <th>Eksul</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td>';

        echo '<select class="uk-form-width" id="eks-' . $id . '" data-md-selectize-inline>
                                            <option value="">-Ekstrakurikuler-</option>';
        foreach ($ekskul_siswa->result_array() as $kl) {
            echo '<option value="' . $kl['id_ekskul_siswa'] . '">' . $kl['nm_ekskul'] . '</option>';
        }
        echo '</select>';

        echo '<td>
                <div class="md-input-wrapper md-input-filled">
                    <input type="text" class="md-input" id="ket-' . $id . '" autocomplete="off">
                    <span class="md-input-bar"></span></div>
                </td>
            </tr>
            <input type="hidden" id="ta-' . $id . '" value="' . $id . '">
        </table>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="submit_ekskul(' . $id . ')">Simpan</button>
        </div>';

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    function get_modal_eks() {
        $id           = $this->input->post('id');
        $eks          = $this->m_admin->data_ekskul();
        $ekskul_siswa = $this->m_admin->data_ekskul_siswa();

        echo " <div id='alert-edit-ekskul-" . $id . "' style='display: none;'>
                <div class='uk-alert uk-alert-success' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'>&nbsp;</i>
                            Berhasil Mengedit Data
                </div>
              </div>";
        foreach ($eks->result() as $k) {
            if ($k->id_ekskul == $id) {
                echo '<table class="uk-table">
            <tr>
                <th>Ekskul</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td>';

                echo '<select class="uk-form-width" id="eks-' . $id . '" data-md-selectize-inline>
                                            <option value="">-Ekstrakurikuler-</option>';
                foreach ($ekskul_siswa->result() as $kl) {
                    echo '<option value="' . $kl->id_ekskul_siswa . '"';
                    if ($kl->id_ekskul_siswa == $k->eks) {
                        echo "selected";
                    }
                    echo '>' . $kl->nm_ekskul . '</option>';
                }
                echo '</select>';

                echo '
                <td>
                <div class="md-input-wrapper md-input-filled">
                    <input type="text" class="md-input" id="ket-' . $id . '" value="' . $k->ket . '" autocomplete="off">
                    <span class="md-input-bar"></span></div>
                </td>
            </tr>
        </table>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="ubah_ekskul(' . $id . ')">Simpan</button>
        </div>';
            }
        }

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    // PRESTASI

    function get_prestasi($id) {
        $tahunajaran = $this->db->query("SELECT * FROM tb_tahunajaran ORDER BY id_tahunajaran DESC");
        $pt          = "'";
        foreach ($tahunajaran->result() as $kl) {
            echo '
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-grid">
                                <div class="uk-width-7-10">
                                    <h5>' . $kl->nm_tahunajaran . '</h5>
                                </div>
                                <div class="uk-width-3-10 uk-text-right">
                                    <button data-uk-modal="{target:' . $pt . '#tambah_prestasi' . $pt . '}" onclick="tambah_prestasi(' . $kl->id_tahunajaran . ')" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
            ';

            echo '
                <table class="uk-table" border="1">
                <tr>
                    <th colspan="4" style="text-align: center;">Data Prestasi</th>
                </tr>
                <tr>
                    <th style="width: 10px;">No</th>
                    <th>Jenis Prestasi</th>
                    <th>Prestasi</th>
                    <th>Aksi</th>
                </tr>';
            $pr = $this->db->query("SELECT * FROM tb_prestasi WHERE ta=" . $kl->id_tahunajaran . " AND siswa=" . $id . "");
            if ($pr->num_rows() > 0) {
                $no = 1;
                foreach ($pr->result() as $k) {
                    echo '
                <tr>
                    <td>' . $no++ . '</td>
                    <td>' . $k->jp . '</td>
                    <td>' . $k->pres . '</td>
                    <td>
                        <a data-uk-tooltip="{pos:top}" title="Hapus" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_prestasi(' . $k->id_prestasi . ')"><i class="feather icon-trash"></i></a>
                        <a data-uk-modal="{target:' . $pt . '#edit_prestasi' . $pt . '}" onclick="edit_prestasi(' . $k->id_prestasi . ')" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>';
                }
            } else {
                echo '
        	<tr>
        		<td colspan="4" class="uk-text-center"><b>Tidak Ada Prestasi</b></td>
        	</tr>';
            }

            echo "</table>";

            echo "</div></div>";
        }
    }

    function tambah_prestasi() {

        $data = [
            'jp'    => $this->input->post('jp'),
            'pres'  => $this->input->post('pres'),
            'ta'    => $this->input->post('ta'),
            'siswa' => $this->input->post('siswa'),
        ];

        $this->m_admin->tambah('tb_prestasi', $data);
    }

    function edit_prestasi() {

        $data = [
            'jp'   => $this->input->post('jp'),
            'pres' => $this->input->post('pres'),
        ];

        $where = [
            'id_prestasi' => $this->input->post('prestasi'),
        ];

        $this->m_admin->update($where, $data, 'tb_prestasi');
    }

    public function hapus_prestasi() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_prestasi', 'id_prestasi', $id);
    }

    function get_modal_tambah_prestasi() {
        $id = $this->input->post('id');
        echo "<div id='alert-tambah-prestasi-" . $id . "' style='display:none;'>
                <div class='uk-alert uk-alert-primary' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'>&nbsp;</i>
                            Berhasil Menambahkan Data
                </div>
              </div>";

        echo '<table class="uk-table">
            <tr>
                <th>Jenis</th>
                <th>Prestasi</th>
            </tr>
            <tr>
                <td>
                <div class="md-input-wrapper md-input-filled">
                    <input type="text" class="md-input" id="jp-' . $id . '" autocomplete="off">
                    <span class="md-input-bar"></span></div>
                </td>
                <td>
                <div class="md-input-wrapper md-input-filled">
                    <input type="text" class="md-input" id="pres-' . $id . '" autocomplete="off">
                    <span class="md-input-bar"></span></div>
                </td>
            </tr>
            <input type="hidden" id="ta-' . $id . '" value="' . $id . '">
        </table>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="submit_prestasi(' . $id . ')">Simpan</button>
        </div>';
    }

    function get_modal_prestasi() {
        $id = $this->input->post('id');
        $pr = $this->m_admin->data_prestasi();

        echo " <div id='alert-edit-prestasi-" . $id . "' style='display: none;'>
                <div class='uk-alert uk-alert-success' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'>&nbsp;</i>
                            Berhasil Mengedit Data
                </div>
              </div>";
        foreach ($pr->result() as $k) {
            if ($k->id_prestasi == $id) {
                echo '<table class="uk-table">
            <tr>
                <th>Jenis</th>
                <th>Prestasi</th>
            </tr>
            <tr>
                <td>
                <div class="md-input-wrapper md-input-filled">
                    <input type="text" class="md-input" id="jp-' . $id . '" value="' . $k->jp . '" autocomplete="off">
                    <span class="md-input-bar"></span></div>
                </td>
                <td>
                <div class="md-input-wrapper md-input-filled">
                    <input type="text" class="md-input" id="pres-' . $id . '" value="' . $k->pres . '" autocomplete="off">
                    <span class="md-input-bar"></span></div>
                </td>
            </tr>
        </table>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="ubah_prestasi(' . $id . ')">Simpan</button>
        </div>';
            }
        }
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

    // ABSEN

    function get_absiswa($id) {
        $ab      = $this->m_admin->data_ab();
        $absiswa = $this->m_admin->data_absiswa();
        $tj      = $this->m_admin->data_tahunajaran()->result_array();
        $smt     = $this->m_admin->data_smt()->result_array();

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
                $cekdata = $this->db->query("SELECT * FROM tb_absiswa WHERE siswa=" . $id . " AND  ta=" . $id_tj . " AND smt=" . $id_smt . " AND ab=" . $ab->id_ab . " ")->num_rows();
                if ($cekdata > 0) {
                    foreach ($absiswa->result() as $ag) {
                        if ($ag->siswa == $id && $ag->ta == $id_tj && $ag->smt == $id_smt && $ag->ab == $ab->id_ab) {
                            echo "
                                            <td>" . $ag->sakit . "</td>
                                            <td>" . $ag->izin . "</td>
                                            <td>" . $ag->alpha . "</td>
                                            <td>" . $ag->jumlah . "</td>
                                            <td>";

                            echo '<a data-uk-tooltip="{pos:top}" title="Hapus" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_absiswa(' . $ag->id_absiswa . ')"><i class="feather icon-trash"></i></a>
                                <a data-uk-tooltip="{pos:top}" title="Edit" onclick="edit_absiswa(' . $ag->id_absiswa . ')"
                                data-uk-modal="{target:' . $pt . '#edit_absiswa' . $pt . '}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>
                                            </td>
                            ';
                        }
                    }
                } else {
                    echo '
                        <td colspan="4" style="text-align: center;">Data Tidak Ada</td>
                        <td>
                            <a data-uk-tooltip="{pos:top}" title="Tambah" href="#" class="md-btn md-btn-small md-btn-primary md-btn-wave-light" data-uk-modal="{target:' . $pt . '#tambah_absiswa' . $pt . '}" onclick="tambah_absiswa(' . $ab->id_ab . ')" ><i class="feather icon-plus-circle"></i></a>
                        </td>
                    ';
                }
                echo "</tr>";
            }
        }
        $jlh = $this->db->query("SELECT SUM(jumlah) AS jml, SUM(sakit) AS s, SUM(izin) AS i, SUM(alpha) AS a FROM tb_absiswa WHERE siswa=" . $id . " AND ta=" . $id_tj . " AND smt=" . $id_smt . " ")->result();
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

    function get_tambah_absiswa() {
        $id = $this->input->post('id');
        $ab = $this->m_admin->data_ab();
        echo '<link rel="stylesheet" href="' . base_url() . '/assets/assets/css/main.min.css" media="all">';
        echo "<div style='display: none;' id='alert-tambah-absiswa-" . $id . "'>
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
                <input type="submit" onclick="submit_absiswa(' . $id . ')" class="md-btn md-btn-primary" value="Simpan">
            </div>';

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    function get_edit_absiswa() {
        $id      = $this->input->post('id');
        $absiswa = $this->m_admin->data_absiswa();
        echo '<link rel="stylesheet" href="' . base_url() . '/assets/assets/css/main.min.css" media="all">';
        echo "<div style='display: none;' id='alert-edit-absiswa-" . $id . "'>
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
        foreach ($absiswa->result() as $ag) {
            if ($ag->id_absiswa == $id) {
                echo '<tr>
                <td><input type="number" onkeyup="key_sakit(' . $id . ')" class="md-input" id="sakit-' . $id . '" value="' . $ag->sakit . '"></td>
                <td><input type="number" onkeyup="key_izin(' . $id . ')" class="md-input" id="izin-' . $id . '" value="' . $ag->izin . '"></td>
                <td><input type="number" onkeyup="key_alpha(' . $id . ')" class="md-input" id="alpha-' . $id . '" value="' . $ag->alpha . '"></td>
                <td><input class="md-input" id="jumlah-' . $id . '" value="' . $ag->jumlah . '" readonly/></td>
            </tr>
                <input type="hidden" id="absiswa-' . $id . '" value="' . $ag->id_absiswa . '">
        </table>';
            }
        }

        echo '<div class="uk-text-right">
                <input type="submit" onclick="ubah_absiswa(' . $id . ')" class="md-btn md-btn-primary" value="Simpan">
            </div>';

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    function get_absiswa_filter() {
        $id_tj = $this->input->post('ta_absiswa');
        // $id_smt = $this->input->post('smt_absiswa');
        $ab = $this->m_admin->data_ab();
        $ta = $this->db->query("SELECT * FROM tb_tahunajaran")->result();

        foreach ($ta as $ta) {
            $id_smt = $ta->smt;
        }

        $no = 1;
        $pt = "'";

        foreach ($ab->result() as $ab) {
            if ($ab->smt == $id_smt) {
                echo "<tr>
                                            <td>" . $no++ . " </td>
                                            <td>" . $ab->nm_bulan . "</td>";
                $absiswa = $this->db->query("SELECT * FROM tb_absiswa WHERE ta=" . $id_tj . " AND smt=" . $id_smt . " AND ab=" . $ab->id_ab . " ");
                if ($absiswa->num_rows() > 0) {
                    foreach ($absiswa->result() as $ag) {
                        echo "
                                            <td>" . $ag->sakit . "</td>
                                            <td>" . $ag->izin . "</td>
                                            <td>" . $ag->alpha . "</td>
                                            <td>" . $ag->jumlah . "</td>
                                            <td>";

                        echo '<a data-uk-tooltip="{pos:top}" title="Hapus" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_absiswa_filter(' . $ag->id_absiswa . ')"><i class="feather icon-trash"></i></a>
                                <a data-uk-tooltip="{pos:top}" title="Edit" onclick="edit_absiswa_filter(' . $ag->id_absiswa . ')"
                                data-uk-modal="{target:' . $pt . '#edit_absiswa' . $pt . '}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>
                                            </td>
                            ';
                    }
                } else {
                    echo '
                        <td colspan="5" style="text-align: center;">Data Tidak Ada</td>
                    ';
                }
                echo "</tr>";
            }
        }
        $jlh = $this->db->query("SELECT SUM(jumlah) AS jml, SUM(sakit) AS s, SUM(izin) AS i, SUM(alpha) AS a FROM tb_absiswa WHERE ta=" . $id_tj . " AND smt=" . $id_smt . " ")->result();
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

    function get_edit_absiswa_filter() {
        $id      = $this->input->post('id');
        $absiswa = $this->m_admin->data_absiswa();
        echo '<link rel="stylesheet" href="' . base_url() . '/assets/assets/css/main.min.css" media="all">';
        echo "<div style='display: none;' id='alert-edit-absiswa-" . $id . "'>
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
        foreach ($absiswa->result() as $ag) {
            if ($ag->id_absiswa == $id) {
                echo '<tr>
                <td><input type="number" onkeyup="key_sakit(' . $id . ')" class="md-input" id="sakit-' . $id . '" value="' . $ag->sakit . '"></td>
                <td><input type="number" onkeyup="key_izin(' . $id . ')" class="md-input" id="izin-' . $id . '" value="' . $ag->izin . '"></td>
                <td><input type="number" onkeyup="key_alpha(' . $id . ')" class="md-input" id="alpha-' . $id . '" value="' . $ag->alpha . '"></td>
                <td><input class="md-input" id="jumlah-' . $id . '" value="' . $ag->jumlah . '" readonly/></td>
            </tr>
                <input type="hidden" id="absiswa-' . $id . '" value="' . $ag->id_absiswa . '">
        </table>';
            }
        }

        echo '<div class="uk-text-right">
                <input type="submit" onclick="ubah_absiswa_filter(' . $id . ')" class="md-btn md-btn-primary" value="Simpan">
            </div>';

        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . 'assets/assets/js/altair_admin_common.min.js"></script>';
    }

    function tambah_absiswa() {

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
            'siswa'  => $this->input->post('siswa'),
            'ta'     => $id_tj,
            'smt'    => $id_smt,
        ];

        $this->m_admin->tambah('tb_absiswa', $data);
    }

    function edit_absiswa() {

        $data = [
            'sakit'  => $this->input->post('sakit'),
            'izin'   => $this->input->post('izin'),
            'alpha'  => $this->input->post('alpha'),
            'jumlah' => $this->input->post('jumlah'),
        ];

        $where = [
            'id_absiswa' => $this->input->post('absiswa'),
        ];

        $this->m_admin->update($where, $data, 'tb_absiswa');
    }

    public function hapus_absiswa() {
        $id = $this->input->post("id");
        $this->m_admin->hapus('tb_absiswa', 'id_absiswa', $id);
    }

    // PENILAIAN SIKAP SPIRITUAL

    function get_nilai_ki1($id, $id_tj) {

        $siswa  = $this->m_admin->data_siswa();
        $kr_ki3 = $this->m_admin->data_kr_ki3();
        $nki3   = $this->db->query("SELECT * FROM tb_nki1");
        $ski1   = $this->m_admin->data_sikap_ki1();

        $lgt = $this->db->query("SELECT * FROM tb_sikap_ki1 WHERE kelas=" . $id . " AND ta=" . $id_tj . "")->num_rows();
        if ($lgt == 0) {
            $no = 1;

            foreach ($siswa->result() as $sw) {
                if ($sw->kelas == $id) {
                    echo
                    '<tr>
	                            <td style="vertical-align: middle;">' . $no++ . '</td>
	                            <td style="vertical-align: middle;">' . $sw->nm_siswa . '</td>';
                    $np = 1;
                    $nk = 1;
                    foreach ($kr_ki3->result() as $kr3) {
                        echo '<td><input type="text"
           onkeyup="cek_predikat_' . $sw->id_siswa . '_' . $id . '_' . $id_tj . '(' . $sw->id_siswa . ', ' . $np++ . ', ' . $id . ', ' . $id_tj . ')"
             id="nilai_ki1_' . $sw->id_siswa . '_' . $nk++ . $id . $id_tj . '" name="kolom_nilai_ki1[]" class="md-input" autocomplete="off"></td>';
                        echo '<input type="hidden" name="kriteria_ki1[]" value="' . $kr3->id_kr_ki3 . '">
								<input type="hidden" name="siswa_kr3[]" value="' . $sw->id_siswa . '">
	                            <input type="hidden" name="ta_kr3[]" value="' . $id_tj . '">
	                            <input type="hidden" name="kelas_kr3[]" value="' . $id . '">
	                            <input type="hidden" name="smt_kr3[]" value="' . $id_smt . '">
                        ';
                    }
                    echo
                    '<td><input name="predikat_ki1[]" id="predikat_ki1_' . $sw->id_siswa . $id . $id_tj . '" class="md-input" autocomplete="off" readonly/></td>
			         <td><textarea type="text" class="md-input" name="deskripsi_ki1[]" style="width: 200px"; autocomplete="off"></textarea></td>

			                        <input type="hidden" name="siswa_ki1[]" value="' . $sw->id_siswa . '">
		                            <input type="hidden" name="ta_ki1[]" value="' . $id_tj . '">
		                            <input type="hidden" name="kelas_ki1[]" value="' . $id . '">
		                            <input type="hidden" name="smt_ki1[]" value="' . $id_smt . '">
		                            </tr>
		                            ';
                }
            }
        } else {
            $no = 1;
            foreach ($ski1->result() as $sw) {
                if ($sw->kelas == $id && $sw->ta == $id_tj) {
                    echo
                    '<tr>
                                <td style="vertical-align: middle;">' . $no++ . '</td>
                                <td style="vertical-align: middle;">' . $sw->nm_siswa . '
                                <input type="hidden" name="id_sikap_ki1_b[]" value="' . $sw->id_sikap_ki1 . '"></td>';
                    $np = 1;
                    $nk = 1;
                    foreach ($nki3->result() as $kr3) {
                        if ($kr3->siswa == $sw->id_siswa && $kr3->kelas == $id && $kr3->ta == $id_tj) {
                            echo '<td><div class="md-input-wrapper md-input-filled"><input type="text"
      onkeyup="cek_predikat_' . $sw->id_sikap_ki1 . '_' . $id . '_' . $id_tj . '(' . $sw->id_sikap_ki1 . ', ' . $np++ . ', ' . $id . ', ' . $id_tj . ')"
                             id="nilai_ki1_' . $sw->id_sikap_ki1 . '_' . $nk++ . $id . $id_tj . '" name="kolom_nilai_ki1_b[]" class="md-input"  value="' . $kr3->nilai . '" autocomplete="off"><span class="md-input-bar"></span></div></td>';
                            echo '<input type="hidden" name="id_nki_b[]" value="' . $kr3->id_nki1 . '">';
                        }
                    }
                    echo
                    '<td><div class="md-input-wrapper md-input-filled"><input name="predikat_ki1_b[]" id="predikat_ki1_' . $sw->id_sikap_ki1 . $id . $id_tj . '" class="md-input" value="' . $sw->predikat . '" autocomplete="off" readonly/><span class="md-input-bar"></span></div></td>
	             	<td><div class="md-input-wrapper md-input-filled"><textarea class="md-input" name="deskripsi_ki1_b[]" style="width: 200px"; autocomplete="off">' . $sw->desk . '</textarea><span class="md-input-bar"></span></div><input type="hidden" name="id_ski1_b[]" value="' . $sw->id_sikap_ki1 . '"></td></tr>';
                }
            }
        }
    }

    function get_btn_ki1($id, $ta) {
        $lgt = $this->db->query("SELECT * FROM tb_sikap_ki1 WHERE kelas=" . $id . " AND ta=" . $ta . " ")->num_rows();
        if ($lgt == 0) {
            echo '<a onclick="submit_nilai_ki1()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a>';
        } else {
            echo '<a onclick="hapus_nilai_ki1()" class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-trash">&nbsp;</i>Hapus</a>';
            echo '<a onclick="ubah_nilai_ki1()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a>';
        }
    }

    // B

    function get_nilai_ki1_b($id, $id_tj) {

        $kr_ki3 = $this->m_admin->data_kr_ki3();
        $nki3   = $this->db->query("SELECT * FROM tb_nki1");
        $ski1   = $this->m_admin->data_sikap_ki1();

        $c1 = $this->db->query("SELECT * FROM tb_sikap_ki1 WHERE kelas=" . $id . " AND ta=" . $id_tj . " ")->num_rows();
        $c2 = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $id . " ")->num_rows();

        if ($c2 > $c1 && $c1 > 0) {
            echo '
    <h5 style="color: red;">Nilai Siswa yang belum diinput :</h5>

    <div class="uk-text-right" id="show_btn_ki1_b"></div>
    <br>
        <div style="display: none; margin-top: 5px;" id="alert-tambah-ki1-b">
            <div class="uk-alert uk-alert-success" data-uk-alert>
                        <a href="#" class="uk-alert-close uk-close"></a>
                                <i class="fas fa-check-circle">&nbsp;</i>
                                Successfully !
                    </div>
        </div>
        <div class="table-responsive">
                <table class="uk-table uk-table-striped" cellspacing="0" width="100%" border="1">
                    <thead>
                        <tr>
                            <th rowspan="3" style="vertical-align: middle;">No. </th>
                            <th rowspan="3" style="vertical-align: middle;">Nama Siswa</th>
                        </tr>

                        <tr>
                            <th colspan="4" style="text-align: center">Kriteria</th>
                            <th rowspan="2" style="vertical-align: middle;">Predikat</th>
                            <th rowspan="2" style="vertical-align: middle;">Deskripsi</th>
                        </tr>

                        <tr>';
            $n = 1;
            foreach ($kr_ki3->result() as $kr3) {
                echo ' <th style="text-align: center;">' . $kr3->nm_kriteria . '</th>';
                $n++;
            }
            echo '
                        </tr>

                    </thead>
                         <tbody>';

            $lgt    = $this->db->query("SELECT * FROM tb_sikap_ki1 WHERE kelas=" . $id . " AND ta=" . $id_tj . "");
            $siswab = $this->db->query("SELECT * FROM tb_siswa WHERE kelas = " . $id . " ")->result();

            $id_b = [];
            $arr  = [];

            foreach ($lgt->result() as $lg) {
                $id_b[] = $lg->siswa;
            }

            foreach ($siswab as $sw) {
                $arr[] = $sw->id_siswa;
            }

            $res = array_diff($arr, $id_b);
            $cek = array_values($res);
            $no  = 1;

            for ($i = 0; $i < count($cek); $i++) {
                $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas = " . $id . " AND id_siswa=" . $cek[$i] . " ");
                foreach ($siswa->result() as $sw) {
                    echo
                    '<tr>
	                            <td style="vertical-align: middle;">' . $no++ . '</td>
	                            <td style="vertical-align: middle;">' . $sw->nm_siswa . '</td>';
                    $np = 1;
                    $nk = 1;
                    foreach ($kr_ki3->result() as $kr3) {
                        echo '<td><input type="text"
           onkeyup="cek_predikat_' . $sw->id_siswa . '_' . $id . '_' . $id_tj . '(' . $sw->id_siswa . ', ' . $np++ . ', ' . $id . ', ' . $id_tj . ')"
             id="nilai_ki1_' . $sw->id_siswa . '_' . $nk++ . $id . $id_tj . '" name="kolom_nilai_ki1[]" class="md-input" autocomplete="off"></td>';
                        echo '<input type="hidden" name="kriteria_ki1[]" value="' . $kr3->id_kr_ki3 . '">
								<input type="hidden" name="siswa_kr3[]" value="' . $sw->id_siswa . '">
	                            <input type="hidden" name="ta_kr3[]" value="' . $id_tj . '">
	                            <input type="hidden" name="kelas_kr3[]" value="' . $id . '">
                        ';
                    }
                    echo
                    '<td><input name="predikat_ki1[]" id="predikat_ki1_' . $sw->id_siswa . $id . $id_tj . '" class="md-input" autocomplete="off" readonly/></td>
			         <td><textarea type="text" class="md-input" name="deskripsi_ki1[]" style="width: 200px"; autocomplete="off"></textarea></td>

			                        <input type="hidden" name="siswa_ki1[]" value="' . $sw->id_siswa . '">
		                            <input type="hidden" name="ta_ki1[]" value="' . $id_tj . '">
		                            <input type="hidden" name="kelas_ki1[]" value="' . $id . '">
		                            </tr>
		                            ';

                    echo '</tbody>
                </table>

            </div>';
                }
            }
        }
    }

    function get_btn_ki1_b($id, $ta) {
        echo '<a onclick="submit_nilai_ki1()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a>';
    }

    function tambah_nilai_ki1() {

        $predikat_ki1  = $this->input->post('predikat_ki1');
        $siswa_ki1     = $this->input->post('siswa_ki1');
        $ta_ki1        = $this->input->post('ta_ki1');
        $deskripsi_ki1 = $this->input->post('deskripsi_ki1');
        $kelas_ki1     = $this->input->post('kelas_ki1');

        $kriteria_ki1    = $this->input->post('kriteria_ki1');
        $kolom_nilai_ki1 = $this->input->post('kolom_nilai_ki1');
        $ta_kr3          = $this->input->post('ta_kr3');
        $siswa_kr3       = $this->input->post('siswa_kr3');
        $kelas_kr3       = $this->input->post('kelas_kr3');

        $data  = [];
        $index = 0;
        foreach ($siswa_ki1 as $siswa_ki1) {
            array_push($data, [
                'siswa'    => $siswa_ki1,
                'predikat' => $predikat_ki1[$index],
                'desk'     => $deskripsi_ki1[$index],
                'ta'       => $ta_ki1[$index],
                'kelas'    => $kelas_ki1[$index],
            ]);
            $index++;
        }

        $data2  = [];
        $index2 = 0;
        foreach ($kriteria_ki1 as $kriteria_ki1) {
            array_push($data2, [

                'kriteria' => $kriteria_ki1,
                'nilai'    => $kolom_nilai_ki1[$index2],
                'siswa'    => $siswa_kr3[$index2],
                'kelas'    => $kelas_kr3[$index2],
                'ta'       => $ta_kr3[$index2],

            ]);
            $index2++;
        }

        $this->m_admin->insert('tb_sikap_ki1', $data);
        $this->m_admin->insert('tb_nki1', $data2);
    }

    function update_nilai_ki1() {

        $predikat_ki1_b  = $this->input->post('predikat_ki1_b');
        $id_ski1_b       = $this->input->post('id_ski1_b');
        $deskripsi_ki1_b = $this->input->post('deskripsi_ki1_b');

        $id_nki_b          = $this->input->post('id_nki_b');
        $kolom_nilai_ki1_b = $this->input->post('kolom_nilai_ki1_b');

        $data  = [];
        $index = 0;
        foreach ($id_ski1_b as $id_ski1_b) {
            array_push($data, [
                'id_sikap_ki1' => $id_ski1_b,
                'predikat'     => $predikat_ki1_b[$index],
                'desk'         => $deskripsi_ki1_b[$index],
            ]);
            $index++;
        }

        $data2  = [];
        $index2 = 0;
        foreach ($id_nki_b as $id_nki_b) {
            array_push($data2, [
                'id_nki1' => $id_nki_b,
                'nilai'   => $kolom_nilai_ki1_b[$index2],
            ]);
            $index2++;
        }

        // var_dump($data);
        // var_dump($data2);

        $this->db->update_batch('tb_sikap_ki1', $data, 'id_sikap_ki1');
        $this->db->update_batch('tb_nki1', $data2, 'id_nki1');
    }

    function hapus_nilai_ki1() {
        $id_a = $this->input->post("id_a");
        $id_b = $this->input->post("id_b");

        $this->m_admin->delete('tb_nki1', 'id_nki1', $id_a);
        $this->m_admin->delete('tb_sikap_ki1', 'id_sikap_ki1', $id_b);
    }

    // PENILAIAN SIKAP SOSIAL

    function get_nilai_ki2($id, $id_tj) {

        $siswa  = $this->m_admin->data_siswa();
        $kr_ki4 = $this->m_admin->data_kr_ki4();
        $nki4   = $this->db->query("SELECT * FROM tb_nki2");
        $ski2   = $this->m_admin->data_sikap_ki2();

        $lgt = $this->db->query("SELECT * FROM tb_sikap_ki2 WHERE kelas=" . $id . " AND ta=" . $id_tj . " ")->num_rows();
        if ($lgt == 0) {
            $no = 1;
            foreach ($siswa->result() as $sw) {
                if ($sw->kelas == $id) {
                    echo
                    '<tr>
		                                <td style="vertical-align: middle;">' . $no++ . '</td>
		                                <td style="vertical-align: middle;">' . $sw->nm_siswa . '</td>';
                    $np = 0;
                    $nk = 0;
                    foreach ($kr_ki4->result() as $kr4) {
                        echo '<td><div class="md-input-wrapper md-input-filled"><input type="text"
                     onkeyup="cek_predikat2_' . $sw->id_siswa . '_' . $id . '_' . $id_tj . '(' . $sw->id_siswa . ', ' . $np++ . ', ' . $id . ', ' . $id_tj . ')"
             id="nilai_ki2_' . $sw->id_siswa . '_' . $nk++ . $id . $id_tj . '"
                      name="kolom_nilai_ki2[]" class="md-input" autocomplete="off"><span class="md-input-bar"></span></div></td>';
                        echo '<input type="hidden" name="kriteria_ki2[]" value="' . $kr4->id_kr_ki4 . '">
								<input type="hidden" name="siswa_kr4[]" value="' . $sw->id_siswa . '">
	                            <input type="hidden" name="ta_kr4[]" value="' . $id_tj . '">
	                            <input type="hidden" name="kelas_kr4[]" value="' . $id . '">
	                            <input type="hidden" name="smt_kr4[]" value="' . $id_smt . '">
                        ';
                    }
                    echo
                    '<td><div class="md-input-wrapper md-input-filled"><input id="predikat_ki2_' . $sw->id_siswa . $id . $id_tj . '"  name="predikat_ki2[]" class="md-input" autocomplete="off" readonly/><span class="md-input-bar"></span></div></td>
			         <td><div class="md-input-wrapper md-input-filled"><textarea type="text" class="md-input" name="deskripsi_ki2[]" style="width: 200px"; autocomplete="off"></textarea><span class="md-input-bar"></span></div></td>

			                        <input type="hidden" name="siswa_ki2[]" value="' . $sw->id_siswa . '">
		                            <input type="hidden" name="ta_ki2[]" value="' . $id_tj . '">
		                            <input type="hidden" name="kelas_ki2[]" value="' . $id . '">
		                            <input type="hidden" name="smt_ki2[]" value="' . $id_smt . '">
		                            </tr>
		                            ';
                }}
        } else {
            $no = 1;
            foreach ($ski2->result() as $sw) {
                if ($sw->kelas == $id AND $sw->ta == $id_tj) {
                    echo
                    '<tr>
                                <td style="vertical-align: middle;">' . $no++ . '</td>
                                <td style="vertical-align: middle;">' . $sw->nm_siswa . '
                                <input type="hidden" name="id_sikap_ki2_b[]" value="' . $sw->id_sikap_ki2 . '"></td>';
                    $np = 1;
                    $nk = 0;
                    foreach ($nki4->result() as $kr4) {
                        if ($kr4->siswa == $sw->id_siswa && $kr4->kelas == $id && $kr4->ta == $id_tj) {
                            echo '<td><div class="md-input-wrapper md-input-filled"><input type="text"
                            onkeyup="cek_predikat2_' . $sw->id_sikap_ki2 . '_' . $id . '_' . $id_tj . '(' . $sw->id_sikap_ki2 . ', ' . $np++ . ', ' . $id . ', ' . $id_tj . ')"
                             id="nilai_ki2_' . $sw->id_sikap_ki2 . '_' . $nk++ . $id . $id_tj . '"
                            name="kolom_nilai_ki2_b[]" class="md-input"  value="' . $kr4->nilai . '" autocomplete="off"><span class="md-input-bar"></span></div></td>';
                            echo '<input type="hidden" name="id_nki2_b[]" value="' . $kr4->id_nki2 . '">';
                        }
                    }
                    echo
                    '<td><div class="md-input-wrapper md-input-filled"><input name="predikat_ki2_b[]" id="predikat_ki2_' . $sw->id_sikap_ki2 . $id . $id_tj . '" class="md-input" value="' . $sw->predikat . '" autocomplete="off" readonly/><span class="md-input-bar"></span></div></td>
	             <td><div class="md-input-wrapper md-input-filled"><textarea class="md-input" name="deskripsi_ki2_b[]" style="width: 200px"; autocomplete="off">' . $sw->desk . '</textarea><span class="md-input-bar"></span></div><input type="hidden" name="id_ski2_b[]" value="' . $sw->id_sikap_ki2 . '"></td></tr>';
                }
            }
        }
    }

    function get_btn_ki2($id, $id_tj) {
        $lgt = $this->db->query("SELECT * FROM tb_sikap_ki2 WHERE kelas=" . $id . " AND ta=" . $id_tj . "")->num_rows();
        if ($lgt == 0) {
            echo '<a onclick="submit_nilai_ki2()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a>';
        } else {
            echo '<a onclick="hapus_nilai_ki2()" class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-trash">&nbsp;</i>Hapus</a>';
            echo '<a onclick="ubah_nilai_ki2()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a>';
        }
    }

    function get_nilai_ki2_b($id, $id_tj) {

        $siswa  = $this->m_admin->data_siswa();
        $kr_ki4 = $this->m_admin->data_kr_ki4();
        $nki4   = $this->db->query("SELECT * FROM tb_nki2");
        $ski2   = $this->m_admin->data_sikap_ki2();
        $c1     = $this->db->query("SELECT * FROM tb_sikap_ki2 WHERE kelas=" . $id . " AND ta=" . $id_tj . " ")->num_rows();
        $c2     = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $id . " ")->num_rows();

        if ($c2 > $c1 && $c1 > 0) {
            echo '
        <h5 style="color: red;">Nilai Siswa yang belum diinput :</h5>

	    <div class="uk-text-right" id="show_btn_ki2_b"></div>
	    <br>
	        <div style="display: none; margin-top: 5px;" id="alert-tambah-ki2-b">
	            <div class="uk-alert uk-alert-success" data-uk-alert>
	                        <a href="#" class="uk-alert-close uk-close"></a>
	                                <i class="fas fa-check-circle">&nbsp;</i>
	                                Successfully !
	                    </div>
	        </div>
	        <div class="table-responsive">
	                <table class="uk-table uk-table-striped" cellspacing="0" width="100%" border="1">
	                    <thead>
	                        <tr>
	                            <th rowspan="3" style="vertical-align: middle;">No. </th>
	                            <th rowspan="3" style="vertical-align: middle;">Nama Siswa</th>
	                        </tr>

	                        <tr>
	                            <th colspan="6" style="text-align: center">Kriteria</th>
	                            <th rowspan="2" style="vertical-align: middle;">Predikat</th>
	                            <th rowspan="2" style="vertical-align: middle;">Deskripsi</th>
	                        </tr>

	                        <tr>';
            $n = 1;
            foreach ($kr_ki4->result() as $kr4) {
                echo '<th style="text-align: center;">' . $kr4->nm_kriteria . '</th>';
                $n++;}
            echo '
	                        </tr>

	                    </thead>
	                         <tbody>';

            $lgt    = $this->db->query("SELECT * FROM tb_sikap_ki2 WHERE kelas=" . $id . " AND ta=" . $id_tj . "");
            $siswab = $this->db->query("SELECT * FROM tb_siswa WHERE kelas = " . $id . " ")->result();

            $id_b = [];
            $arr  = [];

            foreach ($lgt->result() as $lg) {
                $id_b[] = $lg->siswa;
            }

            foreach ($siswab as $sw) {
                $arr[] = $sw->id_siswa;
            }

            $res = array_diff($arr, $id_b);
            $cek = array_values($res);
            $no  = 1;

            for ($i = 0; $i < count($cek); $i++) {
                $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas = " . $id . " AND id_siswa=" . $cek[$i] . " ");

                foreach ($siswa->result() as $sw) {
                    if ($sw->kelas == $id) {
                        echo
                        '<tr>
		                                <td style="vertical-align: middle;">' . $no++ . '</td>
		                                <td style="vertical-align: middle;">' . $sw->nm_siswa . '</td>';
                        $np = 0;
                        $nk = 0;
                        foreach ($kr_ki4->result() as $kr4) {
                            echo '<td><div class="md-input-wrapper md-input-filled"><input type="text"
                     onkeyup="cek_predikat2_' . $sw->id_siswa . '_' . $id . '_' . $id_tj . '(' . $sw->id_siswa . ', ' . $np++ . ', ' . $id . ', ' . $id_tj . ')"
             id="nilai_ki2_' . $sw->id_siswa . '_' . $nk++ . $id . $id_tj . '"
                      name="kolom_nilai_ki2[]" class="md-input" autocomplete="off"><span class="md-input-bar"></span></div></td>';
                            echo '<input type="hidden" name="kriteria_ki2[]" value="' . $kr4->id_kr_ki4 . '">
								<input type="hidden" name="siswa_kr4[]" value="' . $sw->id_siswa . '">
	                            <input type="hidden" name="ta_kr4[]" value="' . $id_tj . '">
	                            <input type="hidden" name="kelas_kr4[]" value="' . $id . '">
                        ';
                        }
                        echo
                        '<td><div class="md-input-wrapper md-input-filled"><input id="predikat_ki2_' . $sw->id_siswa . $id . $id_tj . '"  name="predikat_ki2[]" class="md-input" autocomplete="off" readonly/><span class="md-input-bar"></span></div></td>
			         <td><div class="md-input-wrapper md-input-filled"><textarea type="text" class="md-input" name="deskripsi_ki2[]" style="width: 200px"; autocomplete="off"></textarea><span class="md-input-bar"></span></div></td>

			                        <input type="hidden" name="siswa_ki2[]" value="' . $sw->id_siswa . '">
		                            <input type="hidden" name="ta_ki2[]" value="' . $id_tj . '">
		                            <input type="hidden" name="kelas_ki2[]" value="' . $id . '">
		                            </tr>
		                            ';
                    }
                }
                echo '
	                         </tbody>
	                </table>

	            </div>';
            }
        }
    }

    function get_btn_ki2_b($id, $ta) {
        echo '<a onclick="submit_nilai_ki2()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a>';
    }

    function tambah_nilai_ki2() {

        $predikat_ki2  = $this->input->post('predikat_ki2');
        $siswa_ki2     = $this->input->post('siswa_ki2');
        $ta_ki2        = $this->input->post('ta_ki2');
        $deskripsi_ki2 = $this->input->post('deskripsi_ki2');
        $kelas_ki2     = $this->input->post('kelas_ki2');

        $kriteria_ki2    = $this->input->post('kriteria_ki2');
        $kolom_nilai_ki2 = $this->input->post('kolom_nilai_ki2');
        $ta_kr4          = $this->input->post('ta_kr4');
        $siswa_kr4       = $this->input->post('siswa_kr4');
        $kelas_kr4       = $this->input->post('kelas_kr4');

        $data  = [];
        $index = 0;
        foreach ($siswa_ki2 as $siswa_ki2) {
            array_push($data, [
                'siswa'    => $siswa_ki2,
                'predikat' => $predikat_ki2[$index],
                'desk'     => $deskripsi_ki2[$index],
                'ta'       => $ta_ki2[$index],
                'kelas'    => $kelas_ki2[$index],
            ]);
            $index++;
        }

        $data2  = [];
        $index2 = 0;
        foreach ($kriteria_ki2 as $kriteria_ki2) {
            array_push($data2, [

                'kriteria' => $kriteria_ki2,
                'nilai'    => $kolom_nilai_ki2[$index2],
                'siswa'    => $siswa_kr4[$index2],
                'kelas'    => $kelas_kr4[$index2],
                'ta'       => $ta_kr4[$index2],

            ]);
            $index2++;
        }

        $this->m_admin->insert('tb_sikap_ki2', $data);
        $this->m_admin->insert('tb_nki2', $data2);
    }

    function update_nilai_ki2() {

        $predikat_ki2_b  = $this->input->post('predikat_ki2_b');
        $id_ski2_b       = $this->input->post('id_ski2_b');
        $deskripsi_ki2_b = $this->input->post('deskripsi_ki2_b');

        $id_nki2_b         = $this->input->post('id_nki2_b');
        $kolom_nilai_ki2_b = $this->input->post('kolom_nilai_ki2_b');

        $data  = [];
        $index = 0;
        foreach ($id_ski2_b as $id_ski2_b) {
            array_push($data, [
                'id_sikap_ki2' => $id_ski2_b,
                'predikat'     => $predikat_ki2_b[$index],
                'desk'         => $deskripsi_ki2_b[$index],
            ]);
            $index++;
        }

        $data2  = [];
        $index2 = 0;
        foreach ($id_nki2_b as $id_nki2_b) {
            array_push($data2, [
                'id_nki2' => $id_nki2_b,
                'nilai'   => $kolom_nilai_ki2_b[$index2],
            ]);
            $index2++;
        }

        // var_dump($data);
        // var_dump($data2);

        $this->db->update_batch('tb_sikap_ki2', $data, 'id_sikap_ki2');
        $this->db->update_batch('tb_nki2', $data2, 'id_nki2');
    }

    function hapus_nilai_ki2() {
        $id_a = $this->input->post("id_a");
        $id_b = $this->input->post("id_b");

        $this->m_admin->delete('tb_nki2', 'id_nki2', $id_a);
        $this->m_admin->delete('tb_sikap_ki2', 'id_sikap_ki2', $id_b);
    }

    // REKAP NILAI KI3

    function get_btn_nilai_ki3($kl, $id, $ta) {
        $lgt = $this->db->query("SELECT * FROM tb_nki3 WHERE kelas=" . $kl . " AND mapel=" . $id . "  AND ta=" . $ta . " ")->num_rows();
        if ($lgt == 0) {
            echo '<a onclick="submit_nilai_ki3()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a>';
        } else {
            echo '<a onclick="hapus_nilai_ki3()" class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-trash">&nbsp;</i>Hapus</a>';
            echo '<a onclick="ubah_nilai_ki3()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a>';
        }
    }

    function get_nilai_ki3($kl, $id, $ta) {
        $tj    = $this->m_admin->data_tahunajaran()->result();
        $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $kl . " ");
        $n     = $this->db->query("SELECT a.*, b.* FROM tb_nilai_ki3 a, tb_siswa b WHERE a.siswa = b.id_siswa AND mapel=" . $id . " ");
        $smt   = 0;
        foreach ($tj as $t) {
            if ($t->id_tahunajaran == $ta) {
                $smt = $t->smt;
            }
        }

        $ki3  = $this->db->query("SELECT * FROM tb_desk_ki3 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " ")->result();
        $nki3 = $this->db->query("SELECT * FROM tb_nki3")->result();

        $lgt = $this->db->query("SELECT * FROM tb_nki3 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " ")->num_rows();
        if ($lgt == 0) {
            $no = 1;
            foreach ($siswa->result() as $sw) {
                echo '
                <div class="md-card">
                    <div class="md-card-content">
                    <h4>[' . $no++ . ']. ' . $sw->nm_siswa . '</h4>
                        <hr>';

                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th>KD</th>
                                <th>PH</th>
                                <th>NPTS</th>
                                <th>NPAS</th>
                                <th>NA KD</th>
                            </tr>';
                $x = 1;
                foreach ($ki3 as $k3) {
                    echo '
        <input type="hidden" name="siswa_nki3[]" value="' . $sw->id_siswa . '">
        <input type="hidden" name="mapel_nki3[]" value="' . $id . '">
        <input type="hidden" name="kelas_nki3[]" value="' . $kl . '">
        <input type="hidden" name="ta_nki3[]" value="' . $ta . '">
        <input type="hidden" name="id_nki3[]" value="' . $k3->id_desk_ki3 . '">';
                    echo '
                                <tr>
<td>3.' . $x++ . '</td>

            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_ph(' . $k3->id_desk_ki3 . ', ' . $sw->id_siswa . ')" name="ph[]" id="ph-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npts(' . $k3->id_desk_ki3 . ', ' . $sw->id_siswa . ')" name="npts[]" id="npts-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npas(' . $k3->id_desk_ki3 . ', ' . $sw->id_siswa . ')" name="npas[]" id="npas-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td><input class="md-input na_kd-' . ($x - 1) . '-' . $sw->id_siswa . '" name="na_kd[]" id="na_kd-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off" value="0" readonly=""></td>
                                </tr>';
                }
                echo '<input type="hidden" id="total_k3-' . $sw->id_siswa . '" value="' . ($x - 1) . '">';
                echo '<input type="hidden" name="total_na[]" id="total_na-' . $sw->id_siswa . '">';

                echo '</table>';
                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th style="width: 50px; text-align: center;">NA</th>
                                <th style="width: 50px; text-align: center;">Predikat</th>
                                <th style="width: 130px; text-align: center;">Kriteria</th>
                                <th style="text-align: center;">Deskripsi</th>
                            </tr>
                            <input type="hidden" name="siswa_ni3[]" value="' . $sw->id_siswa . '">
                            <input type="hidden" name="kelas_ni3[]" value="' . $kl . '">
                            <input type="hidden" name="mapel_ni3[]" value="' . $id . '">
                            <input type="hidden" name="ta_ni3[]" value="' . $ta . '">
                            <tr>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="na[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="predikat[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="kriteria[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <textarea name="deskripsi[]" class="md-input" autocomplete="off"></textarea>
                                    <span class="md-input-bar"></span></div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>';
            }
        } else {

            $no = 1;
            foreach ($n->result() as $sw) {
                $avg   = $this->db->query("SELECT AVG(na_kd) as avg FROM tb_nki3 WHERE siswa=" . $sw->siswa . " AND ta=" . $ta . " AND mapel=" . $id . " AND kelas=" . $kl . " ")->result();
                $mapel = $this->db->query("SELECT * FROM tb_mapel WHERE id_mapel=" . $id . " ")->result();
                echo '
                <input type="hidden" name="id_ni3[]" value="' . $sw->id_nilai_ki3 . '">
                <div class="md-card">
                    <div class="md-card-content">
                    <h4>[' . $no++ . ']. ' . $sw->nm_siswa . '</h4>
                        <hr>';

                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th>KD</th>
                                <th>PH</th>
                                <th>NPTS</th>
                                <th>NPAS</th>
                                <th>NA KD</th>
                            </tr>';
                $x = 1;
                foreach ($nki3 as $k3) {
                    if ($k3->siswa == $sw->siswa && $k3->mapel == $id && $k3->kelas == $kl) {
                        echo '
                        <input type="hidden" name="id_nki3[]" value="' . $k3->id_nki3 . '">
                                <tr>
<td>3.' . $x++ . '</td>

            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_ph(' . $k3->id_nki3 . ', ' . $sw->id_nilai_ki3 . ')" name="ph[]" id="ph-' . $k3->id_nki3 . '-' . $sw->id_nilai_ki3 . '" value="' . $k3->ph . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npts(' . $k3->id_nki3 . ', ' . $sw->id_nilai_ki3 . ')" name="npts[]" id="npts-' . $k3->id_nki3 . '-' . $sw->id_nilai_ki3 . '" value="' . $k3->npts . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npas(' . $k3->id_nki3 . ', ' . $sw->id_nilai_ki3 . ')" name="npas[]" id="npas-' . $k3->id_nki3 . '-' . $sw->id_nilai_ki3 . '" value="' . $k3->npas . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td><input class="md-input na_kd-' . ($x - 1) . '-' . $sw->id_nilai_ki3 . '" name="na_kd[]" value="' . $k3->na_kd . '" id="na_kd-' . $k3->id_nki3 . '-' . $sw->id_nilai_ki3 . '" autocomplete="off" readonly=""></td>
                                </tr>';
                    }
                }

                echo '<input type="hidden" id="total_k3-' . $sw->id_nilai_ki3 . '" value="' . ($x - 1) . '">';
                echo '<input type="hidden" name="total_na[]" id="total_na-' . $sw->id_nilai_ki3 . '" value="' . $sw->total_na . '">';

                echo '</table>';
                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th style="width: 50px; text-align: center;">NA</th>
                                <th style="width: 50px; text-align: center;">Predikat</th>
                                <th style="width: 130px; text-align: center;">Kriteria</th>
                                <th style="text-align: center;">Deskripsi</th>
                            </tr>';
                foreach ($avg as $av) {
                    echo
                    '<tr>
                                <td style="text-align: center;">
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="na[]" value="' . number_format($av->avg, 1) . '" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td style="text-align: center;">
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="predikat[]" value="';
                    $v = $av->avg;
                    if ($v >= 89 && $v < 100) {
                        echo 'A';
                    } else if ($v >= 77 && $v < 89) {
                        echo 'B';
                    } else if ($v >= 65 && $v < 77) {
                        echo "C";
                    } else if ($v < 65) {
                        echo "D";
                    }
                    echo '" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td style="text-align: center;">
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="kriteria[]" value="';
                    foreach ($mapel as $mp) {
                        if ($v >= $mp->ki_3 && $v < 100) {
                            echo "TUNTAS";
                        } else {
                            echo "TIDAK TUNTAS";
                        }
                    }

                    echo '" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <textarea name="deskripsi[]" class="md-input" autocomplete="off">' . $sw->deskripsi . '</textarea>
                                    <span class="md-input-bar"></span></div>
                                </td>
                            </tr>';
                }
                echo ' </table>

                    </div>
                </div>';
            }
        }
    }

    // B

    function get_nilai_ki3_b($kl, $id, $ta) {
        $tj    = $this->m_admin->data_tahunajaran()->result();
        $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $kl . " ");
        $n     = $this->db->query("SELECT a.*, b.* FROM tb_nilai_ki3 a, tb_siswa b WHERE a.siswa = b.id_siswa AND mapel=" . $id . " ");
        $smt   = 0;
        foreach ($tj as $t) {
            if ($t->id_tahunajaran == $ta) {
                $smt = $t->smt;
            }
        }

        $ki3  = $this->db->query("SELECT * FROM tb_desk_ki3 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " ")->result();
        $nki3 = $this->db->query("SELECT * FROM tb_nki3")->result();

        $c1 = $this->db->query("SELECT * FROM tb_nilai_ki3 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " ")->num_rows();
        $c2 = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $kl . " ")->num_rows();

        if ($c2 > $c1 && $c1 > 0) {
            echo '
            <div class="md-card"><div class="md-card-content">
        	<h5 style="color: red;">Nilai Siswa yang belum diinput :</h5>

    <div><a onclick="submit_nilai_ki3()" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a></div></div></div>';
            $lgt    = $this->db->query("SELECT * FROM tb_nilai_ki3 WHERE kelas=" . $kl . " AND ta=" . $ta . "");
            $siswab = $this->db->query("SELECT * FROM tb_siswa WHERE kelas = " . $kl . " ")->result();

            $id_b = [];
            $arr  = [];

            foreach ($lgt->result() as $lg) {
                $id_b[] = $lg->siswa;
            }

            foreach ($siswab as $sw) {
                $arr[] = $sw->id_siswa;
            }

            $res = array_diff($arr, $id_b);
            $cek = array_values($res);
            $no  = 1;

            for ($i = 0; $i < count($cek); $i++) {
                $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas = " . $kl . " AND id_siswa=" . $cek[$i] . " ");
                foreach ($siswa->result() as $sw) {
                    echo '
                <div class="md-card">
                    <div class="md-card-content">
                    <h4>[' . $no++ . ']. ' . $sw->nm_siswa . '</h4>
                        <hr>';

                    echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th>KD</th>
                                <th>PH</th>
                                <th>NPTS</th>
                                <th>NPAS</th>
                                <th>NA KD</th>
                            </tr>';
                    $x = 1;
                    foreach ($ki3 as $k3) {
                        echo '
        <input type="hidden" name="siswa_nki3[]" value="' . $sw->id_siswa . '">
        <input type="hidden" name="mapel_nki3[]" value="' . $id . '">
        <input type="hidden" name="kelas_nki3[]" value="' . $kl . '">
        <input type="hidden" name="ta_nki3[]" value="' . $ta . '">
        <input type="hidden" name="id_nki3[]" value="' . $k3->id_desk_ki3 . '">';
                        echo '
                                <tr>
<td>3.' . $x++ . '</td>

            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_ph(' . $k3->id_desk_ki3 . ', ' . $sw->id_siswa . ')" name="ph[]" id="ph-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npts(' . $k3->id_desk_ki3 . ', ' . $sw->id_siswa . ')" name="npts[]" id="npts-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npas(' . $k3->id_desk_ki3 . ', ' . $sw->id_siswa . ')" name="npas[]" id="npas-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td><input class="md-input na_kd-' . ($x - 1) . '-' . $sw->id_siswa . '" name="na_kd[]" id="na_kd-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off" value="0" readonly=""></td>
                                </tr>';
                    }
                    echo '<input type="hidden" id="total_k3-' . $sw->id_siswa . '" value="' . ($x - 1) . '">';
                    echo '<input type="hidden" name="total_na[]" id="total_na-' . $sw->id_siswa . '">';

                    echo '</table>';
                    echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th style="width: 50px; text-align: center;">NA</th>
                                <th style="width: 50px; text-align: center;">Predikat</th>
                                <th style="width: 130px; text-align: center;">Kriteria</th>
                                <th style="text-align: center;">Deskripsi</th>
                            </tr>
                            <input type="hidden" name="siswa_ni3[]" value="' . $sw->id_siswa . '">
                            <input type="hidden" name="kelas_ni3[]" value="' . $kl . '">
                            <input type="hidden" name="mapel_ni3[]" value="' . $id . '">
                            <input type="hidden" name="ta_ni3[]" value="' . $ta . '">
                            <tr>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="na[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="predikat[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="kriteria[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <textarea name="deskripsi[]" class="md-input" autocomplete="off"></textarea>
                                    <span class="md-input-bar"></span></div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div><br><br>';
                }
            }
        }
    }

    function get_nilai_ki3_c($kl, $id, $ta) {
        $tj    = $this->m_admin->data_tahunajaran()->result();
        $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $kl . " ");
        $smt   = 0;
        foreach ($tj as $t) {
            if ($t->id_tahunajaran == $ta) {
                $smt = $t->smt;
            }
        }
        $nki3 = $this->db->query("SELECT * FROM tb_nki3 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " ")->result();
        // $dki3 = $this->db->query("SELECT * FROM tb_desk_ki3 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " ");

        $c1 = 0;
        foreach ($nki3 as $sw) {
            $c1 = $this->db->query("SELECT * FROM tb_nki3 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " AND siswa=" . $sw->siswa . " ")->num_rows();
        }

        $c2 = $this->db->query("SELECT * FROM tb_desk_ki3 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " ")->num_rows();

        if ($c2 > $c1 && $c1 > 0) {
            echo '
            <div class="md-card"><div class="md-card-content">
        	<h5 style="color: red;">Nilai Siswa yang belum diinput :</h5>

    <div><a onclick="submit_nilai_ki3()" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a></div></div></div>';
            $id_ = [];
            foreach ($nki3 as $d) {
                $cc = $this->db->query("SELECT * FROM tb_nki3 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " AND siswa=" . $d->siswa . " ")->result();
                foreach ($cc as $c) {
                    $id_[] = $c->kode;
                }
            }
            $id_b = [];
            for ($j = 0; $j < $c1; $j++) {
                $id_b[] = $id_[$j];
            }

            $siswab = $this->db->query("SELECT * FROM tb_desk_ki3 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " ")->result();

            $arr = [];
            foreach ($siswab as $sw) {
                $arr[] = $sw->id_desk_ki3;
            }

            $res = array_diff($arr, $id_b);
            $cek = array_values($res);
            $no  = 1;

            $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas = " . $kl . " ");
            foreach ($siswa->result() as $sw) {
                echo '
                <div class="md-card">
                    <div class="md-card-content">
                    <h4>[' . $no++ . ']. ' . $sw->nm_siswa . '</h4>
                        <hr>';

                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th>KD</th>
                                <th>PH</th>
                                <th>NPTS</th>
                                <th>NPAS</th>
                                <th>NA KD</th>
                            </tr>';
                $x = 1;
                for ($i = 0; $i < count($cek); $i++) {
                    $dki3 = $this->db->query("SELECT * FROM tb_desk_ki3 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " AND id_desk_ki3 = " . $id_b[$i] . " ");
                    foreach ($dki3->result() as $k3) {
                        echo '
        <input type="hidden" name="siswa_nki3[]" value="' . $sw->id_siswa . '">
        <input type="hidden" name="mapel_nki3[]" value="' . $id . '">
        <input type="hidden" name="kelas_nki3[]" value="' . $kl . '">
        <input type="hidden" name="ta_nki3[]" value="' . $ta . '">
        <input type="hidden" name="id_nki3[]" value="' . $k3->id_desk_ki3 . '">';
                        echo '
                                <tr>
<td>3.' . $x++ . '</td>

            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_ph(' . $k3->id_desk_ki3 . ', ' . $sw->id_siswa . ')" name="ph[]" id="ph-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npts(' . $k3->id_desk_ki3 . ', ' . $sw->id_siswa . ')" name="npts[]" id="npts-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npas(' . $k3->id_desk_ki3 . ', ' . $sw->id_siswa . ')" name="npas[]" id="npas-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td><input class="md-input na_kd-' . ($x - 1) . '-' . $sw->id_siswa . '" name="na_kd[]" id="na_kd-' . $k3->id_desk_ki3 . '-' . $sw->id_siswa . '" autocomplete="off" value="0" readonly=""></td>
                                </tr>';
                    }
                }
                echo '<input type="hidden" id="total_k3-' . $sw->id_siswa . '" value="' . ($x - 1) . '">';
                echo '<input type="hidden" name="total_na[]" id="total_na-' . $sw->id_siswa . '">';

                echo '</table>';
                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th style="width: 50px; text-align: center;">NA</th>
                                <th style="width: 50px; text-align: center;">Predikat</th>
                                <th style="width: 130px; text-align: center;">Kriteria</th>
                                <th style="text-align: center;">Deskripsi</th>
                            </tr>
                            <input type="hidden" name="siswa_ni3[]" value="' . $sw->id_siswa . '">
                            <input type="hidden" name="kelas_ni3[]" value="' . $kl . '">
                            <input type="hidden" name="mapel_ni3[]" value="' . $id . '">
                            <input type="hidden" name="ta_ni3[]" value="' . $ta . '">
                            <tr>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="na[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="predikat[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="kriteria[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <textarea name="deskripsi[]" class="md-input" autocomplete="off"></textarea>
                                    <span class="md-input-bar"></span></div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div><br><br>';
            }
        }
    }

    function tambah_nilai_ki3() {
        // NILAI_KI3

        $deskripsi = $this->input->post('deskripsi');
        $siswa_ni3 = $this->input->post('siswa_ni3');
        $kelas_ni3 = $this->input->post('kelas_ni3');
        $ta_ni3    = $this->input->post('ta_ni3');
        $mapel_ni3 = $this->input->post('mapel_ni3');
        $total_na  = $this->input->post('total_na');

        // NKI3
        $siswa_nki3 = $this->input->post('siswa_nki3');
        $kelas_nki3 = $this->input->post('kelas_nki3');
        $mapel_nki3 = $this->input->post('mapel_nki3');
        $ta_nki3    = $this->input->post('ta_nki3');
        $kode       = $this->input->post('kode');
        $ph         = $this->input->post('ph');
        $npts       = $this->input->post('npts');
        $npas       = $this->input->post('npas');
        $na_kd      = $this->input->post('na_kd');

        $data  = [];
        $index = 0;
        foreach ($siswa_ni3 as $siswa_ni3) {
            array_push($data, [
                'siswa'     => $siswa_ni3,
                'deskripsi' => $deskripsi[$index],
                'ta'        => $ta_ni3[$index],
                'kelas'     => $kelas_ni3[$index],
                'mapel'     => $mapel_ni3[$index],
                'total_na'  => $total_na[$index],
            ]);
            $index++;
        }

        $data2  = [];
        $index2 = 0;
        foreach ($siswa_nki3 as $siswa_nki3) {
            array_push($data2, [

                'siswa' => $siswa_nki3,
                'mapel' => $mapel_nki3[$index2],
                'kode'  => $kode[$index2],
                'ph'    => $ph[$index2],
                'npts'  => $npts[$index2],
                'npas'  => $npas[$index2],
                'na_kd' => $na_kd[$index2],
                'kelas' => $kelas_nki3[$index2],
                'ta'    => $ta_nki3[$index2],

            ]);
            $index2++;
        }

        $this->m_admin->insert('tb_nilai_ki3', $data);
        $this->m_admin->insert('tb_nki3', $data2);
    }

    function update_nilai_ki3() {
        // NILAI_KI3

        $deskripsi = $this->input->post('deskripsi');
        $id_ni3    = $this->input->post('id_ni3');
        $total_na  = $this->input->post('total_na');

        // NKI3
        $ph      = $this->input->post('ph');
        $npts    = $this->input->post('npts');
        $npas    = $this->input->post('npas');
        $na_kd   = $this->input->post('na_kd');
        $id_nki3 = $this->input->post('id_nki3');

        $data  = [];
        $index = 0;

        foreach ($id_ni3 as $id_ni3) {
            array_push($data, [
                'id_nilai_ki3' => $id_ni3,
                'deskripsi'    => $deskripsi[$index],
                'total_na'     => $total_na[$index],
            ]);
            $index++;
        }

        $data2  = [];
        $index2 = 0;
        foreach ($id_nki3 as $id_nki3a) {
            array_push($data2, [
                'id_nki3' => $id_nki3a,
                'ph'      => $ph[$index2],
                'npts'    => $npts[$index2],
                'npas'    => $npas[$index2],
                'na_kd'   => $na_kd[$index2],

            ]);
            $index2++;
        }

        // var_dump($data);
        // exit;

        $this->db->update_batch('tb_nilai_ki3', $data, 'id_nilai_ki3');
        $this->db->update_batch('tb_nki3', $data2, 'id_nki3');
    }

    function hapus_nilai_ki3() {
        $id_a = $this->input->post("id_a");
        $id_b = $this->input->post("id_b");

        $this->m_admin->delete('tb_nki3', 'id_nki3', $id_b);
        $this->m_admin->delete('tb_nilai_ki3', 'id_nilai_ki3', $id_a);
    }

    // REKAP NILAI KI-4

    function get_btn_nilai_ki4($kl, $id, $ta) {
        $lgt = $this->db->query("SELECT * FROM tb_nki4 WHERE kelas=" . $kl . " AND mapel=" . $id . "  AND ta=" . $ta . " ")->num_rows();
        if ($lgt == 0) {
            echo '<a onclick="submit_nilai_ki4()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a>';
        } else {
            echo '<a onclick="hapus_nilai_ki4()" class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-trash">&nbsp;</i>Hapus</a>';
            echo '<a onclick="ubah_nilai_ki4()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a>';
        }
    }

    function get_nilai_ki4($kl, $id, $ta) {
        $tj    = $this->m_admin->data_tahunajaran()->result();
        $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $kl . " ");
        $n     = $this->db->query("SELECT a.*, b.* FROM tb_nilai_ki4 a, tb_siswa b WHERE a.siswa = b.id_siswa AND mapel=" . $id . " ");
        $smt   = 0;
        foreach ($tj as $t) {
            if ($t->id_tahunajaran == $ta) {
                $smt = $t->smt;
            }
        }

        $ki4  = $this->db->query("SELECT * FROM tb_desk_ki4 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " ")->result();
        $nki4 = $this->db->query("SELECT * FROM tb_nki4")->result();

        $lgt = $this->db->query("SELECT * FROM tb_nki4 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " ")->num_rows();
        if ($lgt == 0) {
            $no = 1;
            foreach ($siswa->result() as $sw) {
                echo '
                <div class="md-card">
                    <div class="md-card-content">
                    <h4>[' . $no++ . ']. ' . $sw->nm_siswa . '</h4>
                        <hr>';

                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th>KD</th>
                                <th>PH</th>
                                <th>NPTS</th>
                                <th>NPAS</th>
                                <th>NA KD</th>
                            </tr>';
                $x = 1;
                foreach ($ki4 as $k3) {
                    echo '
        <input type="hidden" name="siswa_nki4[]" value="' . $sw->id_siswa . '">
        <input type="hidden" name="mapel_nki4[]" value="' . $id . '">
        <input type="hidden" name="kelas_nki4[]" value="' . $kl . '">
        <input type="hidden" name="ta_nki4[]" value="' . $ta . '">
        <input type="hidden" name="id_nki4[]" value="' . $k3->id_desk_ki4 . '">';
                    echo '
                                <tr>
<td>3.' . $x++ . '</td>

            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_ph(' . $k3->id_desk_ki4 . ', ' . $sw->id_siswa . ')" name="ph[]" id="ph-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npts(' . $k3->id_desk_ki4 . ', ' . $sw->id_siswa . ')" name="npts[]" id="npts-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npas(' . $k3->id_desk_ki4 . ', ' . $sw->id_siswa . ')" name="npas[]" id="npas-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td><input class="md-input na_kd-' . ($x - 1) . '-' . $sw->id_siswa . '" name="na_kd[]" id="na_kd-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off" value="0" readonly=""></td>
                                </tr>';
                }
                echo '<input type="hidden" id="total_k3-' . $sw->id_siswa . '" value="' . ($x - 1) . '">';
                echo '<input type="hidden" name="total_na[]" id="total_na-' . $sw->id_siswa . '">';

                echo '</table>';
                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th style="width: 50px; text-align: center;">NA</th>
                                <th style="width: 50px; text-align: center;">Predikat</th>
                                <th style="width: 130px; text-align: center;">Kriteria</th>
                                <th style="text-align: center;">Deskripsi</th>
                            </tr>
                            <input type="hidden" name="siswa_ni4[]" value="' . $sw->id_siswa . '">
                            <input type="hidden" name="kelas_ni4[]" value="' . $kl . '">
                            <input type="hidden" name="mapel_ni4[]" value="' . $id . '">
                            <input type="hidden" name="ta_ni4[]" value="' . $ta . '">
                            <tr>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="na[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="predikat[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="kriteria[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <textarea name="deskripsi[]" class="md-input" autocomplete="off"></textarea>
                                    <span class="md-input-bar"></span></div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>';
            }
        } else {
            $no = 1;
            foreach ($n->result() as $sw) {
                $avg   = $this->db->query("SELECT AVG(na_kd) as avg FROM tb_nki4 WHERE siswa=" . $sw->siswa . " AND ta=" . $ta . " AND mapel=" . $id . " AND kelas=" . $kl . " ")->result();
                $mapel = $this->db->query("SELECT * FROM tb_mapel WHERE id_mapel=" . $id . " ")->result();
                echo '
                <input type="hidden" name="id_ni4[]" value="' . $sw->id_nilai_ki4 . '">
                <div class="md-card">
                    <div class="md-card-content">
                    <h4>[' . $no++ . ']. ' . $sw->nm_siswa . '</h4>
                        <hr>';

                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th>KD</th>
                                <th>PH</th>
                                <th>NPTS</th>
                                <th>NPAS</th>
                                <th>NA KD</th>
                            </tr>';
                $x = 1;
                foreach ($nki4 as $k3) {
                    if ($k3->siswa == $sw->siswa && $k3->mapel == $id && $k3->kelas == $kl) {
                        echo '
                        <input type="hidden" name="id_nki4[]" value="' . $k3->id_nki4 . '">
                                <tr>
<td>3.' . $x++ . '</td>

            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_ph(' . $k3->id_nki4 . ', ' . $sw->id_nilai_ki4 . ')" name="ph[]" id="ph-' . $k3->id_nki4 . '-' . $sw->id_nilai_ki4 . '" value="' . $k3->ph . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npts(' . $k3->id_nki4 . ', ' . $sw->id_nilai_ki4 . ')" name="npts[]" id="npts-' . $k3->id_nki4 . '-' . $sw->id_nilai_ki4 . '" value="' . $k3->npts . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npas(' . $k3->id_nki4 . ', ' . $sw->id_nilai_ki4 . ')" name="npas[]" id="npas-' . $k3->id_nki4 . '-' . $sw->id_nilai_ki4 . '" value="' . $k3->npas . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td><input class="md-input na_kd-' . ($x - 1) . '-' . $sw->id_nilai_ki4 . '" name="na_kd[]" value="' . $k3->na_kd . '" id="na_kd-' . $k3->id_nki4 . '-' . $sw->id_nilai_ki4 . '" autocomplete="off" readonly=""></td>
                                </tr>';
                    }
                }

                echo '<input type="hidden" id="total_k3-' . $sw->id_nilai_ki4 . '" value="' . ($x - 1) . '">';
                echo '<input type="hidden" name="total_na[]" id="total_na-' . $sw->id_nilai_ki4 . '" value="' . $sw->total_na . '">';

                echo '</table>';
                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th style="width: 50px; text-align: center;">NA</th>
                                <th style="width: 50px; text-align: center;">Predikat</th>
                                <th style="width: 130px; text-align: center;">Kriteria</th>
                                <th style="text-align: center;">Deskripsi</th>
                            </tr>';
                foreach ($avg as $av) {
                    echo
                    '<tr>
                                <td style="text-align: center;">
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="na[]" value="' . number_format($av->avg, 1) . '" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td style="text-align: center;">
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="predikat[]" value="';
                    $v = $av->avg;
                    if ($v >= 89 && $v < 100) {
                        echo 'A';
                    } else if ($v >= 77 && $v < 89) {
                        echo 'B';
                    } else if ($v >= 65 && $v < 77) {
                        echo "C";
                    } else if ($v < 65) {
                        echo "D";
                    }
                    echo '" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td style="text-align: center;">
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="kriteria[]" value="';
                    foreach ($mapel as $mp) {
                        if ($v >= $mp->ki_3 && $v < 100) {
                            echo "TUNTAS";
                        } else {
                            echo "TIDAK TUNTAS";
                        }
                    }

                    echo '" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <textarea name="deskripsi[]" class="md-input" autocomplete="off">' . $sw->deskripsi . '</textarea>
                                    <span class="md-input-bar"></span></div>
                                </td>
                            </tr>';
                }
                echo ' </table>

                    </div>
                </div>';
            }
        }
    }

    // B

    function get_nilai_ki4_b($kl, $id, $ta) {

        $tj    = $this->m_admin->data_tahunajaran()->result();
        $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $kl . " ");
        $smt   = 0;
        foreach ($tj as $t) {
            if ($t->id_tahunajaran == $ta) {
                $smt = $t->smt;
            }
        }
        $dki4 = $this->db->query("SELECT * FROM tb_desk_ki4 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " ");
        $nki4 = $this->db->query("SELECT * FROM tb_nki4 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " ")->num_rows();

        $c1 = $this->db->query("SELECT * FROM tb_nilai_ki4 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " ")->num_rows();
        $c2 = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $kl . " ")->num_rows();

        if ($c2 > $c1 && $c1 > 0) {
            echo '
            <div class="md-card"><div class="md-card-content">
        	<h5 style="color: red;">Nilai Siswa yang belum diinput :</h5>

    <div><a onclick="submit_nilai_ki4()" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a></div></div></div>';
            $lgt    = $this->db->query("SELECT * FROM tb_nilai_ki4 WHERE kelas=" . $kl . " AND ta=" . $ta . "");
            $siswab = $this->db->query("SELECT * FROM tb_siswa WHERE kelas = " . $kl . " ")->result();

            $id_b = [];
            $arr  = [];

            foreach ($lgt->result() as $lg) {
                $id_b[] = $lg->siswa;
            }

            foreach ($siswab as $sw) {
                $arr[] = $sw->id_siswa;
            }

            $res = array_diff($arr, $id_b);
            $cek = array_values($res);
            $no  = 1;

            for ($i = 0; $i < count($cek); $i++) {
                $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas = " . $kl . " AND id_siswa=" . $cek[$i] . " ");
                foreach ($siswa->result() as $sw) {
                    echo '
                <div class="md-card">
                    <div class="md-card-content">
                    <h4>[' . $no++ . ']. ' . $sw->nm_siswa . '</h4>
                        <hr>';

                    echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th>KD</th>
                                <th>PH</th>
                                <th>NPTS</th>
                                <th>NPAS</th>
                                <th>NA KD</th>
                            </tr>';
                    $x = 1;
                    foreach ($dki4->result() as $k3) {
                        echo '
        <input type="hidden" name="siswa_nki4[]" value="' . $sw->id_siswa . '">
        <input type="hidden" name="mapel_nki4[]" value="' . $id . '">
        <input type="hidden" name="kelas_nki4[]" value="' . $kl . '">
        <input type="hidden" name="ta_nki4[]" value="' . $ta . '">
        <input type="hidden" name="id_nki4[]" value="' . $k3->id_desk_ki4 . '">';
                        echo '
                                <tr>
<td>3.' . $x++ . '</td>

            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_ph(' . $k3->id_desk_ki4 . ', ' . $sw->id_siswa . ')" name="ph[]" id="ph-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npts(' . $k3->id_desk_ki4 . ', ' . $sw->id_siswa . ')" name="npts[]" id="npts-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npas(' . $k3->id_desk_ki4 . ', ' . $sw->id_siswa . ')" name="npas[]" id="npas-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td><input class="md-input na_kd-' . ($x - 1) . '-' . $sw->id_siswa . '" name="na_kd[]" id="na_kd-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off" value="0" readonly=""></td>
                                </tr>';
                    }
                    echo '<input type="hidden" id="total_k3-' . $sw->id_siswa . '" value="' . ($x - 1) . '">';
                    echo '<input type="hidden" name="total_na[]" id="total_na-' . $sw->id_siswa . '">';

                    echo '</table>';
                    echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th style="width: 50px; text-align: center;">NA</th>
                                <th style="width: 50px; text-align: center;">Predikat</th>
                                <th style="width: 130px; text-align: center;">Kriteria</th>
                                <th style="text-align: center;">Deskripsi</th>
                            </tr>
                            <input type="hidden" name="siswa_ni4[]" value="' . $sw->id_siswa . '">
                            <input type="hidden" name="kelas_ni4[]" value="' . $kl . '">
                            <input type="hidden" name="mapel_ni4[]" value="' . $id . '">
                            <input type="hidden" name="ta_ni4[]" value="' . $ta . '">
                            <tr>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="na[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="predikat[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="kriteria[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <textarea name="deskripsi[]" class="md-input" autocomplete="off"></textarea>
                                    <span class="md-input-bar"></span></div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div><br><br>';
                }
            }
        }
    }

    function get_nilai_ki4_c($kl, $id, $ta) {
        $tj    = $this->m_admin->data_tahunajaran()->result();
        $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $kl . " ");
        $smt   = 0;
        foreach ($tj as $t) {
            if ($t->id_tahunajaran == $ta) {
                $smt = $t->smt;
            }
        }
        $nki3 = $this->db->query("SELECT * FROM tb_nki4 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " ")->result();
        // $dki4 = $this->db->query("SELECT * FROM tb_desk_ki4 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " ");

        $c1 = 0;
        foreach ($nki3 as $sw) {
            $c1 = $this->db->query("SELECT * FROM tb_nki4 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " AND siswa=" . $sw->siswa . " ")->num_rows();
        }

        $c2 = $this->db->query("SELECT * FROM tb_desk_ki4 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " ")->num_rows();

        if ($c2 > $c1 && $c1 > 0) {
            echo '
            <div class="md-card"><div class="md-card-content">
        	<h5 style="color: red;">Nilai Siswa yang belum diinput :</h5>

    <div><a onclick="submit_nilai_ki4()" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</a></div></div></div>';
            $id_ = [];
            foreach ($nki3 as $d) {
                $cc = $this->db->query("SELECT * FROM tb_nki4 WHERE kelas=" . $kl . " AND ta=" . $ta . " AND mapel=" . $id . " AND siswa=" . $d->siswa . " ")->result();
                foreach ($cc as $c) {
                    $id_[] = $c->kode;
                }
            }
            $id_b = [];
            for ($j = 0; $j < $c1; $j++) {
                $id_b[] = $id_[$j];
            }

            $siswab = $this->db->query("SELECT * FROM tb_desk_ki4 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " ")->result();

            $arr = [];
            foreach ($siswab as $sw) {
                $arr[] = $sw->id_desk_ki4;
            }

            $res = array_diff($arr, $id_b);
            $cek = array_values($res);
            $no  = 1;

            $siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas = " . $kl . " ");
            foreach ($siswa->result() as $sw) {
                echo '
                <div class="md-card">
                    <div class="md-card-content">
                    <h4>[' . $no++ . ']. ' . $sw->nm_siswa . '</h4>
                        <hr>';

                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th>KD</th>
                                <th>PH</th>
                                <th>NPTS</th>
                                <th>NPAS</th>
                                <th>NA KD</th>
                            </tr>';
                $x = 1;
                for ($i = 0; $i < count($cek); $i++) {
                    $dki4 = $this->db->query("SELECT * FROM tb_desk_ki4 WHERE mapel=" . $id . " AND kelas=" . $kl . " AND smt=" . $smt . " AND id_desk_ki4 = " . $id_b[$i] . " ");
                    foreach ($dki4->result() as $k3) {
                        echo '
        <input type="hidden" name="siswa_nki4[]" value="' . $sw->id_siswa . '">
        <input type="hidden" name="mapel_nki4[]" value="' . $id . '">
        <input type="hidden" name="kelas_nki4[]" value="' . $kl . '">
        <input type="hidden" name="ta_nki4[]" value="' . $ta . '">
        <input type="hidden" name="id_nki4[]" value="' . $k3->id_desk_ki4 . '">';
                        echo '
                                <tr>
<td>3.' . $x++ . '</td>

            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_ph(' . $k3->id_desk_ki4 . ', ' . $sw->id_siswa . ')" name="ph[]" id="ph-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npts(' . $k3->id_desk_ki4 . ', ' . $sw->id_siswa . ')" name="npts[]" id="npts-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td>
                <div class="md-input-wrapper md-input-filled">
                <input class="md-input" onkeyup="key_npas(' . $k3->id_desk_ki4 . ', ' . $sw->id_siswa . ')" name="npas[]" id="npas-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off">
                <span class="md-input-bar"></span></div>
            </td>
            <td><input class="md-input na_kd-' . ($x - 1) . '-' . $sw->id_siswa . '" name="na_kd[]" id="na_kd-' . $k3->id_desk_ki4 . '-' . $sw->id_siswa . '" autocomplete="off" value="0" readonly=""></td>
                                </tr>';
                    }
                }
                echo '<input type="hidden" id="total_k3-' . $sw->id_siswa . '" value="' . ($x - 1) . '">';
                echo '<input type="hidden" name="total_na[]" id="total_na-' . $sw->id_siswa . '">';

                echo '</table>';
                echo '
                        <table class="uk-table" border="1">
                            <tr>
                                <th style="width: 50px; text-align: center;">NA</th>
                                <th style="width: 50px; text-align: center;">Predikat</th>
                                <th style="width: 130px; text-align: center;">Kriteria</th>
                                <th style="text-align: center;">Deskripsi</th>
                            </tr>
                            <input type="hidden" name="siswa_ni4[]" value="' . $sw->id_siswa . '">
                            <input type="hidden" name="kelas_ni4[]" value="' . $kl . '">
                            <input type="hidden" name="mapel_ni4[]" value="' . $id . '">
                            <input type="hidden" name="ta_ni4[]" value="' . $ta . '">
                            <tr>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="na[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="predikat[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="kriteria[]" autocomplete="off" readonly="">
                                    <span class="md-input-bar"></span></div>
                                </td>
                                <td>
                                    <div class="md-input-wrapper md-input-filled">
                                    <textarea name="deskripsi[]" class="md-input" autocomplete="off"></textarea>
                                    <span class="md-input-bar"></span></div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div><br><br>';
            }
        }
    }

    function tambah_nilai_ki4() {
        // NILAI_KI4

        $deskripsi = $this->input->post('deskripsi');
        $siswa_ni4 = $this->input->post('siswa_ni4');
        $kelas_ni4 = $this->input->post('kelas_ni4');
        $ta_ni4    = $this->input->post('ta_ni4');
        $mapel_ni4 = $this->input->post('mapel_ni4');
        $total_na  = $this->input->post('total_na');

        // NKI4
        $siswa_nki4 = $this->input->post('siswa_nki4');
        $kelas_nki4 = $this->input->post('kelas_nki4');
        $mapel_nki4 = $this->input->post('mapel_nki4');
        $ta_nki4    = $this->input->post('ta_nki4');
        $kode       = $this->input->post('kode');
        $ph         = $this->input->post('ph');
        $npts       = $this->input->post('npts');
        $npas       = $this->input->post('npas');
        $na_kd      = $this->input->post('na_kd');

        $data  = [];
        $index = 0;
        foreach ($siswa_ni4 as $siswa_ni4) {
            array_push($data, [
                'siswa'     => $siswa_ni4,
                'deskripsi' => $deskripsi[$index],
                'ta'        => $ta_ni4[$index],
                'kelas'     => $kelas_ni4[$index],
                'mapel'     => $mapel_ni4[$index],
                'total_na'  => $total_na[$index],
            ]);
            $index++;
        }

        $data2  = [];
        $index2 = 0;
        foreach ($siswa_nki4 as $siswa_nki4) {
            array_push($data2, [

                'siswa' => $siswa_nki4,
                'mapel' => $mapel_nki4[$index2],
                'kode'  => $kode[$index2],
                'ph'    => $ph[$index2],
                'npts'  => $npts[$index2],
                'npas'  => $npas[$index2],
                'na_kd' => $na_kd[$index2],
                'kelas' => $kelas_nki4[$index2],
                'ta'    => $ta_nki4[$index2],

            ]);
            $index2++;
        }

        $this->m_admin->insert('tb_nilai_ki4', $data);
        $this->m_admin->insert('tb_nki4', $data2);
    }

    function update_nilai_ki4() {
        // NILAI_KI4

        $deskripsi = $this->input->post('deskripsi');
        $id_ni4    = $this->input->post('id_ni4');
        $total_na  = $this->input->post('total_na');

        // NKI4
        $ph      = $this->input->post('ph');
        $npts    = $this->input->post('npts');
        $npas    = $this->input->post('npas');
        $na_kd   = $this->input->post('na_kd');
        $id_nki4 = $this->input->post('id_nki4');

        $data  = [];
        $index = 0;

        foreach ($id_ni4 as $id_ni4) {
            array_push($data, [
                'id_nilai_ki4' => $id_ni4,
                'deskripsi'    => $deskripsi[$index],
                'total_na'     => $total_na[$index],
            ]);
            $index++;
        }

        $data2  = [];
        $index2 = 0;
        foreach ($id_nki4 as $id_nki4a) {
            array_push($data2, [
                'id_nki4' => $id_nki4a,
                'ph'      => $ph[$index2],
                'npts'    => $npts[$index2],
                'npas'    => $npas[$index2],
                'na_kd'   => $na_kd[$index2],

            ]);
            $index2++;
        }

        // var_dump($data);
        // exit;

        $this->db->update_batch('tb_nilai_ki4', $data, 'id_nilai_ki4');
        $this->db->update_batch('tb_nki4', $data2, 'id_nki4');
    }

    function hapus_nilai_ki4() {
        $id_a = $this->input->post("id_a");
        $id_b = $this->input->post("id_b");

        $this->m_admin->delete('tb_nki4', 'id_nki4', $id_b);
        $this->m_admin->delete('tb_nilai_ki4', 'id_nilai_ki4', $id_a);
    }

    function update_stt_ta() {

        // $id  = $this->input->post('id');
        // $stt = $this->input->post('stt');

        // $data  = [];
        // $index = 0;
        // foreach ($id as $id) {
        //     array_push($data, [
        //         'id_tahunajaran'  => $id,
        //         'stt_tahunajaran' => $stt[$index],
        //     ]);
        //     $index++;
        // }

        // var_dump($data);
        // exit;

        $data = [
            'stt_tahunajaran' => $this->input->post('apply'),
        ];

        $where = [
            'id_tahunajaran' => $this->input->post('val'),
        ];

        // $this->db->update_batch('tb_tahunajaran', $data, 'id_tahunajaran');
        $this->m_admin->update($where, $data, 'tb_tahunajaran');
    }

    function get_stt_ta() {
        $ta = $this->db->query("SELECT * FROM tb_tahunajaran WHERE stt_tahunajaran='Y' ")->result();
        foreach ($ta as $tj) {
            echo $tj->nm_tahunajaran;
        }
    }

    function get_data_ta_stt() {
        $tj = $this->m_admin->data_tahunajaran();
        $no = 1;
        echo '<link rel="stylesheet" href="' . base_url() . '/assets/assets/css/main.min.css" media="all">';
        echo '
			<table class="uk-table">
                <tr>
                    <th>#</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>
                </tr>

        ';

        foreach ($tj->result() as $ta) {
            echo '
		                            <tr>
		                                <td>' . $no++ . '</td>
		                                <td>' . $ta->nm_tahunajaran . '
		                                    <p id="alert-update-ta-' . $ta->id_tahunajaran . '" style="color: red; display: none;">Matikan dulu status yang ada !</p>
		                                </td>';
            echo '
			                                <td>
			                                    <input type="checkbox" value="' . $ta->id_tahunajaran . '" data-switchery data-switchery-size="large"';
            if ($ta->stt_tahunajaran == 'Y') {
                echo "checked";
            }
            echo
            ' id="update-stt-ta-' . $ta->id_tahunajaran . '" />';

            echo '</td>
			       </tr></table>';

            if ($ta->stt_tahunajaran == 'Y') {
                echo '<input type="hidden" id="id_stt_y" value="' . $ta->id_tahunajaran . '">';
                echo '<input type="hidden" id="stt_y" value="' . $ta->stt_tahunajaran . '">';
            }
        }
        echo '<script src="' . base_url() . '/assets/assets/js/common.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/uikit_custom.min.js"></script>';
        echo '<script src="' . base_url() . '/assets/assets/js/altair_admin_common.min.js"></script>';
    }

    function naik_kelas() {
        $id = $this->input->post('id');

        $data  = [];
        $index = 0;
        foreach ($id as $id) {
            array_push($data, [
                'id_siswa' => $id,
            ]);
            $index++;
        }
        $this->m_admin->naik_kelas($data, 'tb_siswa');
    }

    function turun_kelas() {
        $id = $this->input->post('id');

        $data  = [];
        $index = 0;
        foreach ($id as $id) {
            array_push($data, [
                'id_siswa' => $id,
            ]);
            $index++;
        }
        $this->m_admin->turun_kelas($data, 'tb_siswa');
    }

    function generate_rank() {
        $nilai_akhir = $this->input->post('nilai_akhir');
        $siswa       = $this->input->post('siswa');
        $rank        = $this->input->post('rank');
        $kelas       = $this->input->post('kelas');
        $ta          = $this->input->post('ta');

        $data  = [];
        $index = 0;
        foreach ($nilai_akhir as $nilai_akhir) {
            array_push($data, [
                'nilai_akhir' => $nilai_akhir,
                'siswa'       => $siswa[$index],
                'rank'        => $rank[$index],
                'kelas'       => $kelas[$index],
                'ta'          => $ta[$index],
            ]);
            $index++;
        }

        $this->m_admin->insert('tb_rank', $data);
    }

    // Grafik Tinggi Badan Berat Badan

    function get_konfisik($id) {
        $fisik = $this->db->query("SELECT * FROM tb_fisik, tb_tahunajaran WHERE tb_fisik.ta = tb_tahunajaran.id_tahunajaran AND siswa=" . $id . " ")->result();
        echo json_encode($fisik);
    }

    function ganti_foto_guru($id) {
        $id_guru = [
            'id_guru' => $id,
        ];

        $config['upload_path']   = './images/guru';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload("foto_guru")) {
            $exec = $this->m_admin->update($id_guru, $array, 'tb_guru');
        } else {
            $upload                    = $this->upload->data();
            $foto_guru                 = $upload["raw_name"] . $upload["file_ext"];
            $array['foto_guru']        = $foto_guru;
            $config2['image_library']  = 'gd2';
            $config2['create_thumb']   = FALSE;
            $config2['maintain_ratio'] = TRUE;
            $config2['width']          = 500;
            $config2['height']         = 500;
            $config2['source_image']   = "./images/guru/$foto_guru";
            $this->load->library('image_lib');
            $this->image_lib->clear();
            $this->image_lib->initialize($config2);
            $this->image_lib->resize();
            $this->m_admin->update($id_guru, $array, 'tb_guru');
        }
    }

    function ganti_foto_siswa($id) {
        $id_siswa = [
            'id_siswa' => $id,
        ];

        $config['upload_path']   = './images/siswa';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload("foto_siswa")) {
            $exec = $this->m_admin->update($id_siswa, $array, 'tb_siswa');
        } else {
            $upload                    = $this->upload->data();
            $foto_siswa                = $upload["raw_name"] . $upload["file_ext"];
            $array['foto_siswa']       = $foto_siswa;
            $config2['image_library']  = 'gd2';
            $config2['create_thumb']   = FALSE;
            $config2['maintain_ratio'] = TRUE;
            $config2['width']          = 500;
            $config2['height']         = 500;
            $config2['source_image']   = "./images/siswa/$foto_siswa";
            $this->load->library('image_lib');
            $this->image_lib->clear();
            $this->image_lib->initialize($config2);
            $this->image_lib->resize();
            $this->m_admin->update($id_siswa, $array, 'tb_siswa');
        }
    }
};

?>


