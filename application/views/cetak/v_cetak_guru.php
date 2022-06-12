
  <?php

$skl  = $this->db->query("SELECT * FROM tb_sekolah")->result();
$guru = $this->m_admin->data_guru()->result();
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

    <p><b>DATA KEPEGAWAIAN GURU DAN TENAGA KEPENDIDIKAN :  </b></p>

    <table class="uk-table" border="1">
      <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>NUPTK</th>
        <th>Golongan</th>
        <th>Jabatan</th>
        <th>Sertifikasi</th>
        <th>Telpon</th>
        <th>Status</th>
      </tr>

      <?php
$no = 1;
foreach ($guru as $sw) {
    if ($sw->jabatan != 1 && $sw->akun != 1) {
        echo '
      <tr>
        <td class="center">' . $no++ . '</td>
        <td>&nbsp;' . $sw->nip . '</td>
        <td>&nbsp;' . $sw->nm_guru . '</td>
        <td>&nbsp;' . $sw->nuptk . '</td>
        <td>&nbsp;' . $sw->gol . '</td>';?>

  <td><?php

        if ($sw->jabatan == 1) {
            echo "KEPALA SEKOLAH";
        } else {
            echo "Guru " . $sw->nm_mapel;
        }
        ?></td>

<?php echo '
        <td class="center">' . $sw->stfk_guru . '</td>
        <td>&nbsp;' . $sw->no_telp . '</td>
        <td class="center">' . $sw->stt_guru . '</td>
      </tr>';
    }} ?>
    </table>
    <br>

    <table>
      <tr>
        <td style="width: 750px;"></td>
        <td></td>
        <td style="width: 100%;">
          <?php foreach ($skl as $sh) {?>
              <p><?=$sh->kabupaten?>, <?php echo tgl_indo(date('Y-m-d')); ?></p>
              <p>Kepala Sekolah,</p>
            <?php }?>
            <br>
            <br>
            <br>
            <br>
              <?php foreach ($guru as $gr) {
    if ($gr->jabatan == 1) {?>
                <p><?=$gr->nm_guru?></p>
                NIP. <?=$gr->nip?>
              <?php }}?>

        </td>
      </tr>
    </table>
