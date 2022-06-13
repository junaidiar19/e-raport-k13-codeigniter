
<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// ob_clean();
ob_start();

/**
 *
 */
class Cetak extends CI_Controller {
    function __construct() {

        parent::__construct();
        $this->load->model(['m_admin']);

        if ($this->session->userdata['logged_in']['id_akun'] == '') {
            redirect('login');
        }
    }

    public function cetak_siswa($id, $nama) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $mpdf->SetTitle('Report Data Siswa Kelas ' . $nama . '');
        $this->data['description'] = "";
        $this->data['id']          = $id;
        $this->data['nm']          = $nama;

        $data = $this->load->view('cetak/v_cetak_siswa', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report Siswa Kelas "' . $nama . '".PDF', 'I');
    }

    public function cetak_ortu($id, $nama) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);

        $mpdf->SetTitle('Report Data Orang Tua Siswa Kelas ' . $nama . '');
        $this->data['description'] = "";
        $this->data['id']          = $id;
        $this->data['nm']          = $nama;

        $data = $this->load->view('cetak/v_cetak_ortu', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report Orang Tua Siswa Kelas "' . $nama . '".PDF', 'I');
    }

    public function cetak_guru() {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);

        $mpdf->SetTitle('Report Data Guru');
        $this->data['description'] = "";

        $data = $this->load->view('cetak/v_cetak_guru', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report Data Guru.PDF', 'I');
    }

    public function cetak_ki3($id, $mp, $ta) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $mpdf->SetTitle('Report Data Nilai Pengetahuan');
        $this->data['description'] = "";
        $this->data['id']          = $id;
        $this->data['mp']          = $mp;
        $this->data['ta']          = $ta;

        $data = $this->load->view('cetak/v_cetak_ki3', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report Data Nilai Pengetahuan.PDF', 'I');
    }

    public function cetak_ki4($id, $mp, $ta) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $mpdf->SetTitle('Report Data Nilai Keterampilan');
        $this->data['description'] = "";
        $this->data['id']          = $id;
        $this->data['mp']          = $mp;
        $this->data['ta']          = $ta;

        $data = $this->load->view('cetak/v_cetak_ki4', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report Data Nilai Keterampilan.PDF', 'I');
    }

    public function cetak_ki1($kl, $ta) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);

        $mpdf->SetTitle('Report Data Nilai Sikap Spritual');
        $this->data['description'] = "";
        $this->data['kl']          = $kl;
        $this->data['ta']          = $ta;

        $data = $this->load->view('cetak/v_cetak_ki1', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report Data Nilai Sikap Spritual.PDF', 'I');
    }

    public function cetak_ki2($kl, $ta) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);

        $mpdf->SetTitle('Report Data Nilai Sikap Sosial');
        $this->data['description'] = "";
        $this->data['kl']          = $kl;
        $this->data['ta']          = $ta;

        $data = $this->load->view('cetak/v_cetak_ki2', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report Data Nilai Sikap Sosial.PDF', 'I');
    }

    public function cetak_leger($kl, $ta) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);

        $mpdf->SetTitle('Report Data Leger');
        $this->data['description'] = "";
        $this->data['kl']          = $kl;
        $this->data['ta']          = $ta;
        $pt                        = "'";

        $data = $this->load->view('cetak/v_cetak_leger2', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report Data Leger.PDF', 'I');
    }

    function cetak_leger2($kl, $ta) {
        $id_akun          = ($this->session->userdata['logged_in']['id_akun']);
        $var['akun']      = $this->m_admin->cekdata($id_akun)->row_array();
        $this->data['kl'] = $kl;
        $this->data['ta'] = $ta;

        $this->load->view('cetak/v_cetak_leger', $this->data);
    }

    public function cetak_desk_ki3($kl) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $mpdf->SetTitle('Report Data Deskripsi KI3 (Pengetahuan)');
        $this->data['description'] = "";
        $this->data['kl']          = $kl;
        $pt                        = "'";

        $data = $this->load->view('cetak/v_cetak_desk_ki3', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report Data Deskripsi KI3 (Pengetahuan).PDF', 'I');
    }

    public function cetak_desk_ki4($kl) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $mpdf->SetTitle('Report Data Deskripsi KI4 (Keterampilan)');
        $this->data['description'] = "";
        $this->data['kl']          = $kl;
        $pt                        = "'";

        $data = $this->load->view('cetak/v_cetak_desk_ki4', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report Data Deskripsi KI4 (Keterampilan).PDF', 'I');
    }

    public function cetak_r1($id, $nis) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $mpdf->SetTitle('Report R-1 ' . $nis . ' ');
        $this->data['description'] = "";
        $this->data['id']          = $id;

        $data = $this->load->view('cetak/v_cetak_r1', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report R-1 ' . $nis . '.PDF', 'I');
    }

    public function cetak_r2($id, $nis, $ta) {

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $mpdf->SetTitle('Report R-2 ' . $nis . ' ');
        $this->data['description'] = "";
        $this->data['id']          = $id;
        $this->data['ta']          = $ta;

        $data = $this->load->view('cetak/v_cetak_r2', $this->data, TRUE);

        $mpdf->WriteHTML($data);
        $mpdf->Output('Report R-2 ' . $nis . '.PDF', 'I');
    }

    public function cetak_r2_($id, $nis, $ta) {

        // $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        // $mpdf->SetTitle('Report R-2 ' . $nis . ' ');
        // $this->data['description'] = "";
        $this->data['id'] = $id;
        $this->data['ta'] = $ta;

        $data = $this->load->view('cetak/v_cetak_r2', $this->data);

        // $mpdf->WriteHTML($data);
        // $mpdf->Output('Report R-2 ' . $nis . '.PDF', 'I');
    }
}