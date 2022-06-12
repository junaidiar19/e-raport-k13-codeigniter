
  <?php

$skl  = $this->db->query("SELECT * FROM tb_sekolah")->result();
$ortu = $this->db->query("SELECT * FROM tb_ortu, tb_siswa WHERE tb_ortu.siswa = tb_siswa.id_siswa AND  kelas=" . $id . " ")->result();

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

    <p><b>Data Orang Tua Siswa Kelas <?=$nm?> :  </b></p>

    <table class="uk-table" border="1">
      <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Ayah</th>
        <th>Pendidikan</th>
        <th>Pekerjaan</th>
        <th>Ibu</th>
        <th>Pendidikan</th>
        <th>Pekerjaan</th>
      </tr>
      <?php
$no = 1;
foreach ($ortu as $or) {
    echo '
      <tr>
        <td class="center">' . $no++ . '</td>
        <td>&nbsp;' . $or->nm_siswa . '</td>';
    echo '
        <td>&nbsp;' . $or->nm_ayah . '</td>
        <td>&nbsp;';
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
        <td>&nbsp;' . $or->pj_ayah . '</td>
        <td>&nbsp;' . $or->nm_ibu . '</td>
        <td>&nbsp;';
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
        <td>&nbsp;' . $or->pj_ibu . '</td>';
    echo '</tr>';
}?>
    </table>
    <br>

  <!--   <table>
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
    </table> -->
