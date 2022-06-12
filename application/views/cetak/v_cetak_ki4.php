
  <?php

$skl   = $this->db->query("SELECT * FROM tb_sekolah")->result();
$guru  = $this->db->query("SELECT * FROM tb_guru, tb_kelas WHERE tb_guru.wali_kelas = tb_kelas.id_kelas")->result();
$siswa = $this->db->query("SELECT * FROM tb_siswa, tb_kelas WHERE tb_siswa.kelas = tb_kelas.id_kelas AND kelas=" . $id . " ")->result();
$taj   = $this->db->query("SELECT * FROM tb_tahunajaran WHERE id_tahunajaran=" . $ta . " ")->result();
$mapel = $this->db->query("SELECT * FROM tb_mapel WHERE id_mapel=" . $mp . " ")->result();
$kelas = $this->db->query("SELECT * FROM tb_kelas WHERE id_kelas=" . $id . " ")->result();

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
      <?php foreach ($kelas as $k) {?>
      <tr>
        <td colspan="3"><p><b>Nilai (KI4) Keterampilan Kelas <?=$k->nm_kelas?></b></p></td>
      </tr>
    <?php }?>
       <?php foreach ($mapel as $m) {?>
      <tr>
        <td>Mata Pelajaran</td>
        <td>:</td>
        <td><?php echo $m->nm_mapel; ?></td>
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
    <br>

    <table class="uk-table" border="1">
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Harian</th>
        <th>UTS</th>
        <th>UAS</th>
        <th>Jumlah</th>
        <th>Rata-Rata</th>
      </tr>
      <?php
$no = 1;
foreach ($siswa as $sw) {
    echo '
      <tr>
        <td class="center">' . $no++ . '</td>
        <td>&nbsp;' . $sw->nis . '</td>
        <td>&nbsp;' . $sw->nm_siswa . '</td>';

    $nph = $this->db->query("SELECT AVG(ph) as total_ph FROM tb_nki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $id . " AND ta=" . $ta . " AND mapel=" . $mp . " ")->result();

    $nuts = $this->db->query("SELECT AVG(npts) as total_uts FROM tb_nki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $id . " AND ta=" . $ta . " AND mapel=" . $mp . " ")->result();

    $nuas = $this->db->query("SELECT AVG(npas) as total_uas FROM tb_nki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $id . " AND ta=" . $ta . " AND mapel=" . $mp . " ")->result();

    $jum = $this->db->query("SELECT (SELECT AVG(ph) FROM tb_nki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $id . " AND ta=" . $ta . " AND mapel=" . $mp . ") + (SELECT AVG(npts) FROM tb_nki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $id . " AND ta=" . $ta . " AND mapel=" . $mp . ") + (SELECT AVG(npas) FROM tb_nki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $id . " AND ta=" . $ta . " AND mapel=" . $mp . ") as jumlah")->result();

    foreach ($nph as $ph) {
        echo '<td class="center">' . number_format($ph->total_ph, 0) . '</td>';
    }

    foreach ($nuts as $uts) {
        echo '<td class="center">' . number_format($uts->total_uts, 0) . '</td>';
    }

    foreach ($nuas as $uas) {
        echo '<td class="center">' . number_format($uas->total_uas, 0) . '</td>';
    }

    foreach ($jum as $j) {
        echo '<td class="center">' . number_format($j->jumlah, 0) . '</td>';
        echo '<td class="center">' . number_format($j->jumlah / 3, 1) . '</td>';
    }

    echo '</tr>';
}?>
    </table>
    <br>

    <table>
      <tr>
        <td style="width: 460px;"></td>
        <td></td>
        <td style="width: 100%;">
<?php foreach ($guru as $gr) {
    if ($gr->wali_kelas == $id) {?>
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
