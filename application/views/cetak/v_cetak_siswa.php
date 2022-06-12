
  <?php

$skl   = $this->db->query("SELECT * FROM tb_sekolah")->result();
$guru  = $this->db->query("SELECT * FROM tb_guru")->result();
$siswa = $this->db->query("SELECT * FROM tb_siswa, tb_kelas WHERE tb_siswa.kelas = tb_kelas.id_kelas AND kelas=" . $id . " ")->result();
$tj    = $this->db->query("SELECT * FROM tb_tahunajaran WHERE stt_tahunajaran='Y' ")->result();

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

   <table>
          <?php foreach ($skl as $sh) {?>
      <tr>
        <td>
           <img style="height: 150px; width: 130px;" src="<?php echo base_url() ?>images/<?=$sh->logo?>">
        </td>
        <td style="text-align: center; width: 800px;">

          <p style="font-size: 40px;">PEMERINTAH KOTA BANJARMASIN</p>
          <p style="font-size: 35px;"><b><?=$sh->nama_sklh?></b></p>
          <p style="font-size: 20px;"><?=$sh->alamat?> <?=$sh->kelurahan?>, <?=$sh->kecamatan?></p>
          <p style="font-size: 20px;">Kab. <?=$sh->kabupaten?>, <?=$sh->provinsi?></p>
          <p><b>Telp : <?=$sh->telp?> &nbsp; Email : <?=$sh->email?></b></p>

        </td>
      </tr>
         <?php }?>

    </table>

    <hr style="color: black; height: 4px;">

    <table>
      <tr>
        <td colspan="3"><p><b>Data Siswa Kelas <?=$nm?>  </b></p></td>
      </tr>
      <?php foreach ($tj as $ta) {?>
      <tr>
        <td>Tahun Ajaran</td>
        <td>:</td>
        <td><?php echo $ta->nm_tahunajaran; ?></td>
      </tr>
    <?php }?>
    </table>
    <br>

    <table class="uk-table" border="1">
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>NISN</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
      </tr>
      <?php
$no = 1;
foreach ($siswa as $sw) {
    echo '
      <tr>
        <td class="center">' . $no++ . '</td>
        <td>&nbsp;' . $sw->nis . '</td>
        <td>&nbsp;' . $sw->nisn . '</td>
        <td>&nbsp;' . $sw->nm_siswa . '</td>
        <td class="center">' . $sw->jk . '</td>
      </tr>';
}?>
    </table>
    <br>

    <table>
      <tr>
        <td style="width: 460px;"></td>
        <td></td>
        <td style="width: 100%;">

              <p>Wali Kelas <?=$nm?>,</p>
            <br>
            <br>
            <br>
            <br>
              <?php foreach ($guru as $gr) {
    if ($gr->wali_kelas == $id) {?>
                <p style="text-decoration: underline;"><?=$gr->nm_guru?></p>
                NIP. <?=$gr->nip?>
              <?php }}?>

        </td>
      </tr>
    </table>
