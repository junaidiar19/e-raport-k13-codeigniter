<?php
$siswa = $this->db->query("SELECT * FROM tb_siswa WHERE id_siswa=" . $id . " ")->result();
$ortu  = $this->db->query("SELECT * FROM tb_ortu WHERE siswa=" . $id . " ")->result();
$skl   = $this->db->query("SELECT * FROM tb_sekolah")->result();
$guru  = $this->m_admin->data_guru()->result();

function tgl_indo($date) {
    $BulanIndo = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    $tahun  = substr($date, 0, 4);
    $bulan  = substr($date, 5, 2);
    $tgl    = substr($date, 8, 2);
    $result = $tgl . "-" . $BulanIndo[(int) $bulan - 1] . "-" . $tahun;
    return ($result);
}

foreach ($siswa as $sw) {
    ?>

<style>
  .uk-table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    margin-bottom: 15px;
}
table {
    display: table;
    border-collapse: separate;
    border-spacing: 2px;
    border-color: grey;
}
.center {
  text-align: center;
}

.table {
  border-collapse: collapse;
}

.table {
  border: 1px solid black;
}
</style>


<br>

				<!-- HALAMAN COVER -->

    <table class="center" style="width: 100%;">
    	<tr>
    		<td>
    			<img style="width: 120px; height: 120px; margin-bottom: 50px;" src="<?=base_url('images/logo-sd.png')?>">
    		</td>
    	</tr>
    	<tr>
    		<td class="center"><h3>RAPORT PESERTA DIDIK <br>SEKOLAH DASAR <br> ( SD ) </h3></td>
    	</tr>
    </table>

    <p class="center" style="margin-top: 90px;">Nama Peserta Didik :</p>
   <table border="1" style="width: 100%;" class="table">
   	<tr>
   		<td class="center">
   			<h3><?=$sw->nm_siswa?></h3>
   		</td>
   	</tr>
   </table>

   <p class="center" style="margin-top: 20px;">Nama Induk Siswa :</p>
   <table border="1" style="width: 100%;" class="table">
   	<tr>
   		<td class="center">
   			<h3><?=$sw->nis?></h3>
   		</td>
   	</tr>
   </table>
   <table class="center" style="margin-top: 250px; width: 100%;">
   	<tr>
   		<td class="center">
   			<h2><b>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN
</b></h2>
   		</td>
   	</tr>
   	<tr>
   		<td class="center">
   			<h2><b>REPUBLIK INDONESIA
</b></h2>
   		</td>
   	</tr>
   </table>

   <!-- HALAMAN DATA SEKOLAH -->

	<table style="width: 100%; margin-top: 200px; margin-bottom: 50px;">
   		<tr>
    		<td class="center"><h3>RAPORT PESERTA DIDIK <br>SEKOLAH DASAR <br> ( MI ) </h3></td>
    	</tr>
    </table>
<?php foreach ($skl as $sh) {?>

    <table style="width: 100%;">
    	<tr>
    		<td>Nama Sekolah</td>
    		<td>:</td>
    		<td><?=$sh->nama_sklh?></td>
    	</tr>
    	<tr>
    		<td>NPSN</td>
    		<td>:</td>
    		<td><?=$sh->ns_sklh?></td>
    	</tr>
    	<tr>
    		<td>Alamat Sekolah</td>
    		<td>:</td>
    		<td><?=$sh->alamat?></td>
    	</tr>
    	<tr>
    		<td>No Telpon</td>
    		<td>:</td>
    		<td><?=$sh->telp?></td>
    	</tr>
    	<tr>
    		<td>Kode Pos</td>
    		<td>:</td>
    		<td><?=$sh->kode_pos?></td>
    	</tr>
    	<tr>
    		<td>Kelurahan/Desa</td>
    		<td>:</td>
    		<td><?=$sh->kelurahan?></td>
    	</tr>
    	<tr>
    		<td>Kecamatan</td>
    		<td>:</td>
    		<td><?=$sh->kecamatan?></td>
    	</tr>
    	<tr>
    		<td>Kota/Kabupaten</td>
    		<td>:</td>
    		<td><?=$sh->kabupaten?></td>
    	</tr>
    	<tr>
    		<td>Provinsi</td>
    		<td>:</td>
    		<td><?=$sh->provinsi?></td>
    	</tr>
    	<tr>
    		<td>Website</td>
    		<td>:</td>
    		<td><?=$sh->website?></td>
    	</tr>
    	<tr>
    		<td>E-mail</td>
    		<td>:</td>
    		<td><?=$sh->email?></td>
    	</tr>
    </table>
<?php }?>

<table style="width: 100%; margin-top: 1000px; margin-bottom: 50px;">
   		<tr>
    		<td class="center"><h2>PETUNJUK PENGGUNAAN</h2></td>
    	</tr>
    </table>

    <table style="width: 100%;">
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">1. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">
    			Rapor Peserta Didik dipergunakan selama peserta didik yang bersangkutan mengikuti seluruh program pembelajaran di Sekolah Dasar tersebut;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">2. &nbsp;</p>
    		</td>
    		<td>
    			Identitas Sekolah diisi dengan data yang sesuai dengan keberadaan Sekolah Dasar;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">3. &nbsp;</p>
    		</td>
    		<td>
    			Daftar Peserta didik diisi oleh data peserta didik yang ada dalam Rapor Peserta Didik ini;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">4. &nbsp;</p>
    		</td>
    		<td>
    			Identitas  Peserta  didik  diisi  oleh  data  yang  sesuai  dengan  keberadaan  peserta didik;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">5. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">Rapor  Peserta  Didik  harus  dilengkapi  dengan  pas  foto  berwarna  (3 x 4) dan pengisiannya dilakukan oleh Guru Kelas;</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">6. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">Kompetensi inti 1 (KI-1) untuk sikap spiritual diambil dari KI-1 pada muatan pelajaran pendidikan agama dan budi pekerti dan PPKn;</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">7. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">Kompetensi inti 2 (KI-2) untuk sikap sosial diambil dari KI-2 pada muatan pelajaran Pendidikan Agama dan Budi Pekerti dan PPKn;</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">8. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">Kompetensi inti 3 dan 4 (KI-3 dan KI-4) diambil dari KI-3 dan KI-4 pada semua muatan pelajaran;</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">9. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">
    			Hasil penilaian pengetahuan dan keterampilan dilaporkan dalam bentuk nilai, predikat dan deskripsi pencapaian kompetensi mata pelajaran;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">10. &nbsp;</p>
    		</td>
    		<td>
    			Hasil penilaian sikap dilaporkan dalam bentuk predikat dan/atau deskripsi;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">11. &nbsp;</p>
    		</td>
    		<td>
    			Predikat yang ditulis dalam Rapor Peserta Didik:<br>
    			A : Sangat Baik <br>
    			B : Baik <br>
    			C : Cukup <br>
    			D : Kurang
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">12. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">
    			Deskripsi pengetahuan dan keterampilan ditulis dengan kalimat positif sesuai dengan capaian KD tertinggi atau terendah dari masing-masing muatan pelajaran yang diperoleh peserta didik. Deskripsi berisi pengetahuan dan keterampilan yang sangat baik/dan atau baik yang dikuasai dan penguasaannya belum optimal. Apabila nilai capaian KD muatan pelajaran yang diperoleh dari suatu muatan pelajaran sama, kolom deskripsi ditulis sesuai dengan capaian untuk semua KD;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;"><p style="font-size: 15px;">13. &nbsp;</p>
    		</td>
    		<td>
    			Laporan  Ekstrakurikuler  diisi  oleh  kegiatan  ekstrakurikuler  yang  diikuti  oleh peserta didik;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">14. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">
    			Saran–saran diisi tentang hal-hal yang perlu mendapatkan perhatian peserta didik, pendidik, dan orangtua/wali terutama untuk hal-hal yang tidak didapatkan dari sekolah;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">15. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">
    			Laporan tinggi dan berat badan peserta didik ditulis berdasarkan hasil pengukuran yang dilakukan pendidik;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">16. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">
    			Laporan kondisi kesehatan fisik diisi dengan deskripsi hasil pemeriksaan yang dilakukan pendidik, bekerjasama dengan tenaga kesehatan atau puskesmas terdekat;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">17. &nbsp;</p>
    		</td>
    		<td>
    			Prestasi diisi dengan prestasi peserta didik yang menonjol;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">18. &nbsp;</p>
    		</td>
    		<td style="text-align: justify;">
    			Kolom ketidakhadiran ditulis dengan data akumulasi ketidakhadiran peserta didik karena sakit, izin, atau tanpa keterangan selama satu semester;
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">19. &nbsp;</p>
    		</td>
    		<td>
    			Apabila peserta didik pindah, maka dicatat di dalam kolom keterangan pindah.
    		</td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top;">
    			<p style="font-size: 15px;">20. &nbsp;</p>
    		</td>
    		<td>
    			Kolom pernyataan kenaikan kelas diisi keterangan naik atau tinggal kelas.
    		</td>
    	</tr>
    </table>




    <table style="width: 100%; margin-top: 300px; margin-bottom: 50px;">
   		<tr>
    		<td class="center"><h3>IDENTITAS PESERTA DIDIK
</h3></td>
    	</tr>
    </table>

    <table style="width: 100%;">
    	<tr>
    		<td style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">1.</p>
    		</td>
    		<td style="width: 200px;"><p style="font-size: 15px;">Nama Peserta Didik</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$sw->nm_siswa?></td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">2.</p>
    		</td>
    		<td style="width: 200px;"><p style="font-size: 15px;">Nomor Induk Siswa</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$sw->nis?></td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">3.</p>
    		</td>
    		<td style="width: 200px;"><p style="font-size: 15px;">N I S N</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$sw->nisn?></td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">4.</p>
    		</td>
    		<td style="width: 200px;"><p style="font-size: 15px;">Tempat Tangal Lahir</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$sw->tempat . ', ' . tgl_indo($sw->tanggal_lahir)?></td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">5.</p>
    		</td>
    		<td style="width: 200px;"><p style="font-size: 15px;">Jenis Kelamin</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$sw->jk?></td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">6.</p>
    		</td>
    		<td style="width: 200px;"><p style="font-size: 15px;">Agama</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$sw->agama?></td>
    	</tr>
    	<tr>
    		<td style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">7.</p>
    		</td>
    		<td style="width: 200px; vertical-align: text-top;"><p style="font-size: 15px;">Alamat</p></td>
    		<td style="width: 30px; vertical-align: text-top;">:</td>
    		<td><?=$sw->jalan . ' ' . $sw->kel . '' . $sw->kec . '' . $sw->kab?></td>
    	</tr>
    	<?php foreach ($ortu as $or) {
        ?>

    	<tr>
    		<td rowspan="3" style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">8.</p>
    		</td>
    		<td colspan="3"><p style="font-size: 15px;">Nama Orang Tua</p></td>
		</tr>
		<tr>
			<td><p style="font-size: 15px;">1) Ayah</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$or->nm_ayah?></td>
    	</tr>
    	<tr>
			<td><p style="font-size: 15px;">2) Ibu</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$or->nm_ibu?></td>
    	</tr>

    	<tr>
    		<td rowspan="3" style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">9.</p>
    		</td>
    		<td colspan="3"><p style="font-size: 15px;">Pendidikan Orang Tua</p></td>
		</tr>
		<tr>
			<td><p style="font-size: 15px;">1) Ayah</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?php

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

        ?></td>
    	</tr>
    	<tr>
			<td><p style="font-size: 15px;">2) Ibu</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?php
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
        ?></td>
    	</tr>

    	<tr>
    		<td rowspan="3" style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">10.</p>
    		</td>
    		<td colspan="3"><p style="font-size: 15px;">Pekerjaan Orang Tua</p></td>
		</tr>
		<tr>
			<td><p style="font-size: 15px;">1) Ayah</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$or->pj_ayah?></td>
    	</tr>
    	<tr>
			<td><p style="font-size: 15px;">2) Ibu</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$or->pj_ibu?></td>
    	</tr>


    	<tr>
    		<td rowspan="6" style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">11.</p>
    		</td>
    		<td colspan="3"><p style="font-size: 15px;">Alamat Orang Tua</p></td>
		</tr>
		<tr>
			<td><p style="font-size: 15px;">1) Jalan</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=($or->nm_ayah != '') ? $sw->jalan : ''?></td>
    	</tr>
    	<tr>
			<td><p style="font-size: 15px;">2) Kelurahan/Desa</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=($or->nm_ayah != '') ? $sw->kel : ''?></td>
    	</tr>
    	<tr>
			<td><p style="font-size: 15px;">3) Kecamatan</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=($or->nm_ayah != '') ? $sw->kec : ''?></td>
    	</tr>
    	<tr>
			<td><p style="font-size: 15px;">4) Kabupaten/Kota</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=($or->nm_ayah != '') ? $sw->kab : ''?></td>
    	</tr>
    	<tr>
			<td><p style="font-size: 15px;">5) Porvinsi</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=($or->nm_ayah != '') ? $sw->prov : ''?></td>
    	</tr>

    	<tr>
    		<td rowspan="4" style="vertical-align: text-top; width: 30px;">
    			<p style="font-size: 15px;">12.</p>
    		</td>
    		<td colspan="4"><p style="font-size: 15px;">Wali Peserta Didik</p></td>
		</tr>
		<tr>
			<td><p style="font-size: 15px;">1) Nama</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$or->nm_wali?></td>
    	</tr>
    	<tr>
			<td><p style="font-size: 15px;">2) Pekerjaan</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=$or->pj_wali?></td>
    	</tr>
    	<tr>
			<td><p style="font-size: 15px;">3) Alamat</p></td>
    		<td style="width: 30px;">:</td>
    		<td><?=($or->nm_wali != '') ? $sw->jalan . ', ' . $sw->kel . ', ' . $sw->kec . ', ' . $sw->kab . ', ' . $sw->prov : ''?></td>
    	</tr>

<?php }?>


    </table>
    <br>
    <br>
    <br>

	<table>
      <tr>
        <td style="width: 460px;"></td>
        <td></td>
        <td style="width: 100%;">

              <p>Banjarmasin, </p>
              <p><b>Kepala Sekolah</b></p>
            <br>
            <br>
            <br>
            <br>
              <?php foreach ($guru as $gr) {
        if ($gr->jabatan == 1) {?>
                <p><b><?=$gr->nm_guru?></b></p>
                NIP. <?=$gr->nip?>
              <?php }}?>

        </td>
      </tr>
    </table>


<?php }?>
