
  <?php
$skl    = $this->db->query("SELECT * FROM tb_sekolah")->result();
$guru   = $this->db->query("SELECT * FROM tb_guru, tb_kelas WHERE tb_guru.wali_kelas = tb_kelas.id_kelas")->result();
$siswa  = $this->db->query("SELECT * FROM tb_siswa, tb_kelas WHERE tb_siswa.kelas = tb_kelas.id_kelas AND kelas=" . $kl . " ")->result();
$taj    = $this->db->query("SELECT * FROM tb_tahunajaran WHERE id_tahunajaran=" . $ta . " ")->result();
$kelas  = $this->db->query("SELECT * FROM tb_kelas WHERE id_kelas=" . $kl . " ")->result();
$kr_ki3 = $this->db->query("SELECT * FROM tb_kr_ki3");
$ski1   = $this->db->query("SELECT * FROM tb_sikap_ki1, tb_siswa WHERE tb_sikap_ki1.siswa = tb_siswa.id_siswa");
$nki3   = $this->db->query("SELECT * FROM tb_nki1");

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
</style>

<?php
function tgl_indo($date) {
    $BulanIndo = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    $tahun  = substr($date, 0, 4);
    $bulan  = substr($date, 5, 2);
    $tgl    = substr($date, 8, 2);
    $result = $tgl . "-" . $BulanIndo[(int) $bulan - 1] . "-" . $tahun;
    return ($result);
}

?>

   <table>
          <?php foreach ($skl as $sh) {?>
      <tr>
        <td>
           <img style="height: 130px; width: 110px;" src="<?php echo base_url() ?>images/<?=$sh->logo?>">
        </td>
        <td style="text-align: center; width: 800px;">

          <p style="font-size: 30px;">PEMERINTAH KOTA BANJARMASIN</p>
          <p style="font-size: 25px;"><b><?=$sh->nama_sklh?></b></p>
          <p style="font-size: 15px;"><?=$sh->alamat?> <?=$sh->kelurahan?>, <?=$sh->kecamatan?></p>
          <p style="font-size: 15px;">Kab. <?=$sh->kabupaten?>, <?=$sh->provinsi?></p>
          <p><b>Telp : <?=$sh->telp?> &nbsp; Email : <?=$sh->email?></b></p>

        </td>
      </tr>
         <?php }?>

    </table>

    <hr style="color: black; height: 4px;">

    <table>
      <?php foreach ($kelas as $k) {?>
      <tr>
        <td colspan="3"><p><b>Nilai Sikap Kelas <?=$k->nm_kelas?></b></p></td>
      </tr>
    <?php }?>
      <?php foreach ($taj as $tj) {?>
      <tr>
        <td>Tahun Ajaran</td>
        <td>:</td>
        <td><?php echo $tj->nm_tahunajaran; ?></td>
      </tr>
    <?php }?>
    </table>

    <table class="uk-table" border="1">
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

          <tr>

          <?php
$n = 1;
foreach ($kr_ki3->result() as $kr3) {?>
              <th style="text-align: center;"><?=$kr3->nm_kriteria?></th>
              <?php $n++;}?>
          </tr>

      </thead>
      <?php
$no = 1;
foreach ($ski1->result() as $sw) {
    if ($sw->kelas == $kl && $sw->ta == $ta) {
        echo
        '<tr>
          <td style="vertical-align: middle;">' . $no++ . '</td>
          <td style="vertical-align: middle;">&nbsp;' . $sw->nm_siswa . '</td>';
        foreach ($nki3->result() as $kr3) {
            if ($kr3->siswa == $sw->siswa) {
                echo '<td class="center">' . $kr3->nilai . '</td>';
            }
        }
        echo
        '<td class="center">' . $sw->predikat . '</td>
        <td>&nbsp;' . $sw->desk . '</td></tr>';
    }
}
?>
    </table>
    <br>

   <table>
      <tr>
        <td style="width: 750px;"></td>
        <td></td>
        <td style="width: 100%;">
<?php foreach ($guru as $gr) {
    if ($gr->wali_kelas == $kl) {?>
              <p>Wali Kelas <?=$gr->nm_kelas?>,</p>
            <br>
            <br>
            <br>
            <br>
                <p style="text-decoration: underline;"><?=$gr->nm_guru?></p>
                NIP. <?=$gr->nip?>
              <?php }}?>

        </td>
      </tr>
    </table>
