
  <?php

$skl   = $this->db->query("SELECT * FROM tb_sekolah")->result();
$guru  = $this->db->query("SELECT * FROM tb_guru")->result();
$siswa = $this->db->query("SELECT * FROM tb_siswa, tb_kelas WHERE tb_siswa.kelas = tb_kelas.id_kelas AND kelas=" . $kl . " ")->result();

$mapel    = $this->db->query("SELECT * FROM tb_mapel WHERE id_mapel != 1 AND id_mapel != 2")->result();
$desk_ki3 = $this->db->query("SELECT * FROM tb_desk_ki3 WHERE kelas=" . $kl . " ")->result();
$kelas    = $this->db->query("SELECT * FROM tb_kelas WHERE id_kelas=" . $kl . " ")->result();
?>

<style>
  .uk-table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    margin-bottom: 15px;
}
.table {
  border-collapse: collapse;
}

.left {
  text-align: left;
}

.table {
  border: 1px solid black;
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
<?php foreach ($kelas as $ks) {?>
    <h4><b>Data Deskripsi KI3 (Pengetahuan) kelas <?=$ks->nm_kelas?></b></h4>
  <?php }?>
<?php
$no = 1;
foreach ($mapel as $mp) {
    ?>

  <h5><b> (<?=$no++?>) <?=$mp->nm_mapel?> :</b></h5>

  <table width="100%" class="table" border="1">
        <tr>
          <th colspan="2" class="left">Semester 1</th>
        </tr>
        <tr>
          <th class="center" width="10">Kode</th>
          <th style="padding-right: 20px;">Keterangan</th>
        </tr>
        <?php
$nx = 1;
    foreach ($desk_ki3 as $ki3) {
        if ($ki3->mapel == $mp->id_mapel) {?>
        <tr>
          <?php if ($ki3->smt == 1) {?>
            <td class="center">3.<?=$nx++?></td>
            <td><p style="margin-left: 10px;"><?=$ki3->desk_ki3?></p></td>
          <?php }?>
        </tr>
      <?php }}?>
  </table>

  <table width="100%" class="table" border="1">
        <tr>
          <th colspan="2" class="left">Semester 2</th>
        </tr>
        <tr>
          <th class="center" width="10">Kode</th>
          <th class="center">Keterangan</th>
        </tr>
        <?php
$nx = 1;
    foreach ($desk_ki3 as $ki3) {
        if ($ki3->mapel == $mp->id_mapel) {?>
        <tr>
          <?php if ($ki3->smt == 2) {?>
            <td class="center">3.<?=$nx++?></td>
            <td><p style="margin-left: 10px;"><?=$ki3->desk_ki3?></p></td>
          <?php }?>
        </tr>
      <?php }}?>
  </table>

<?php }?>
