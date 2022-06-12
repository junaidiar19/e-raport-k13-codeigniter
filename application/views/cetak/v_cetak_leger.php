
  <?php
$skl    = $this->db->query("SELECT * FROM tb_sekolah")->result();
$guru   = $this->db->query("SELECT * FROM tb_guru, tb_kelas WHERE tb_guru.wali_kelas = tb_kelas.id_kelas")->result();
$kepsek = $this->db->query("SELECT * FROM tb_guru WHERE jabatan='1' ")->result();
$siswa  = $this->db->query("SELECT * FROM tb_siswa, tb_kelas WHERE tb_siswa.kelas = tb_kelas.id_kelas AND kelas=" . $kl . " ");

$mapel = $this->db->query("SELECT * FROM tb_mapel");
$ki1   = $this->db->query("SELECT * FROM tb_sikap_ki1, tb_siswa WHERE tb_sikap_ki1.siswa = tb_siswa.id_siswa");
$ki2   = $this->db->query("SELECT * FROM tb_sikap_ki2, tb_siswa WHERE tb_sikap_ki2.siswa = tb_siswa.id_siswa");
$kelas = $this->db->query("SELECT * FROM tb_kelas WHERE id_kelas=" . $kl . " ");
$taj   = $this->db->query("SELECT * FROM tb_tahunajaran WHERE id_tahunajaran=" . $ta . " ");

?>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/jquery/jquery-1.11.2.min.js"></script>

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

    <table width="80%">
          <?php foreach ($skl as $sh) {?>
      <tr>
        <td rowspan="5">
           <img style="height: 130px; width: 110px;" src="<?php echo base_url() ?>images/<?=$sh->logo?>">

        </td>
        <td style="font-size: 30px;" class="center">PEMERINTAH KOTA BANJARMASIN</td>
      </tr>
      <tr>
        <td class="center" style="font-size: 25px;"><b><?=$sh->nama_sklh?></b></td>
      </tr>
      <tr>
        <td class="center" style="font-size: 15px;"><?=$sh->alamat?> <?=$sh->kelurahan?>, <?=$sh->kecamatan?></td>
      </tr>
      <tr>
        <td class="center" style="font-size: 15px;">Kab. <?=$sh->kabupaten?>, <?=$sh->provinsi?></td>
      </tr>
      <tr>
        <td class="center"><b>Telp : <?=$sh->telp?> &nbsp; Email : <?=$sh->email?></b></td>
      </tr>
    <?php }?>
    </table>

    <!-- <hr style="background: black; height: 4px;"> -->
    <hr>
    <table>
      <?php foreach ($kelas->result() as $k) {?>
      <tr>
        <td colspan="3"><p><b>Data Leger Kelas <?=$k->nm_kelas?></b></p></td>
      </tr>
    <?php }?>
      <?php foreach ($taj->result() as $tj) {?>
      <tr>
        <td>Tahun Ajaran</td>
        <td>:</td>
        <td><?php echo $tj->nm_tahunajaran; ?></td>
      </tr>
    <?php }?>
    </table>

      <table class="uk-table" border="1" style="font-size: 12px;">
        <tr>
            <th rowspan="3"><b>No</b></th>
            <th rowspan="3" style="width: 150px;"><b>Nama Siswa</b></th>
        </tr>

        <tr>
            <th><b>ASPEK</b></th>
        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        ?>
            <th><b><?=$mp->kode_mapel?></b></th>
        <?php }}?>
          <th colspan="2" style="text-align: center;"><b>SIKAP</b></th>
          <th colspan="3"><b>NILAI AKHIR</b></th>
          <th colspan="3"><b>ABSENSI</b></th>
          <th rowspan="2">RANK</th>
        </tr>

        <tr>
            <th><b>KKM</b></th>
        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        ?>
            <th><b><?=$mp->ki_3?></b></th>
        <?php }}?>
          <th><b>Spritual</b></th>
          <th><b>Sosial</b></th>
          <th><b>JML</b></th>
          <th><b>NR</b></th>
          <th style="width: 40px;"><b>NR P&K</b></th>
          <th><b>S</b></th>
          <th><b>I</b></th>
          <th><b>A</b></th>
        </tr>

        <?php
$no = 1;
foreach ($siswa->result() as $sw) {
    ?>
                                    <tr>
                                        <td class="center" rowspan="2"><?=$no++?></td>
                                        <td rowspan="2">&nbsp;<?=$sw->nm_siswa?></td>
                                        <td>&nbsp;Pengetahuan</td>
                                        <?php foreach ($mapel->result() as $mp) {
        if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
            $avg3 = $this->db->query("SELECT AVG(total_na) as avg3 FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
            foreach ($avg3 as $av3) {
                ?>

                                        <td class="center"><?=number_format($av3->avg3, 0)?></td>

                                    <?php }}}?>
<?php foreach ($ki1->result() as $k1) {
        if ($k1->siswa == $sw->id_siswa) {?>
                                    <td class="center" rowspan="2"><?=$k1->predikat?></td>
                                  <?php }}?>

                                  <?php foreach ($ki2->result() as $k2) {
        if ($k2->siswa == $sw->id_siswa) {?>
                                    <td class="center" rowspan="2"><?=$k2->predikat?></td>
                                <?php }}?>

                                <td class="center">
                                    <?php
$sum3 = $this->db->query("SELECT SUM(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($sum3 as $v) {
        echo $v->jml;
    }
    ?>
                                </td>
                                <td class="center">

                                    <?php
$avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($avg3 as $v) {
        echo number_format($v->jml, 2);
    }
    ?>

                                </td>

                                <td class="center" rowspan="2">
                                    <?php
$nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . ") as result ")->result();

    foreach ($nrpk as $v) {
        echo number_format($v->result, 2) / 2;
        echo '<input type="hidden" name="nilai_akhir[]" value="' . (number_format($v->result, 2) / 2) . '">';
    }
    ?>
                                </td>

                                <?php
$absen = $this->db->query("SELECT *,SUM(sakit) as t_sakit, SUM(izin) as t_izin, SUM(alpha) as t_alpha FROM tb_absiswa WHERE siswa=" . $sw->id_siswa . " AND ta=" . $ta . " ")->result();
    foreach ($absen as $ab) {
        ?>
                                <td class="center" rowspan="2"><?=$ab->t_sakit?></td>
                                <td class="center" rowspan="2"><?=$ab->t_izin?></td>
                                <td class="center" rowspan="2"><?=$ab->t_alpha?></td>
                            <?php }?>
                                <td rowspan="2" class="center">
                                  <b id="rank_hasil_<?=($no - 2)?>"></b>

                              </td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;Keterampilan</td>
                                        <?php foreach ($mapel->result() as $mp) {
        if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
            $avg4 = $this->db->query("SELECT AVG(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND mapel=" . $mp->id_mapel . " AND ta=" . $ta . "")->result();
            foreach ($avg4 as $av4) {
                ?>

                                        <td class="center"><?=number_format($av4->avg4, 0)?></td>

                                    <?php }}}?>
                                    <td class="center">
                                           <?php
$sum4 = $this->db->query("SELECT SUM(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($sum4 as $v) {
        echo $v->jml;
    }
    ?>
                                    </td>
                                    <td class="center">
                                         <?php
$avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($avg4 as $v) {
        echo number_format($v->jml, 2);
    }
    ?>
                                    </td>

                                    </tr>
                                <?php }?>

                                    <tr>
                                        <td class="center" colspan="2" rowspan="3"><b>Jumlah Nilai</b></td>
                                    </tr>

                                    <tr>
                                        <td><b>Pengetahuan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg3 = $this->db->query("SELECT SUM(total_na) as avg3 FROM tb_nilai_ki3 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
        foreach ($avg3 as $av3) {
            ?>
                                        <td class="center"><b><?=$av3->avg3?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>
                                        <?php
$avg3 = $this->db->query("SELECT SUM(total_na) as avg3 FROM tb_nilai_ki3 WHERE kelas=" . $kl . " AND ta=" . $ta . "")->result();
foreach ($avg3 as $av3) {
    ?>
                                        <td class="center"><b><?=$av3->avg3?></b></td>

                                    <?php }?>

                                    <td class="center"><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($avg3 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
echo array_sum($arr);
?>
</b>
                                </td>

                                <td rowspan="2" class="center"><b>
                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . ") as result ")->result();

    foreach ($nrpk as $v) {
        $arr[] = number_format($v->result, 2) / 2;
    }}

echo array_sum($arr);
?>
                                </b></td>

                                <?php
$arr_s = [];
$arr_i = [];
$arr_a = [];

foreach ($siswa->result() as $sw) {
    $absen = $this->db->query("SELECT *,SUM(sakit) as t_sakit, SUM(izin) as t_izin, SUM(alpha) as t_alpha FROM tb_absiswa WHERE siswa=" . $sw->id_siswa . " AND ta=" . $ta . " ")->result();
    foreach ($absen as $ab) {
        $arr_s[] = $ab->t_sakit;
        $arr_i[] = $ab->t_izin;
        $arr_a[] = $ab->t_alpha;
    }}
$arr_sk = array_sum($arr_s);
$arr_iz = array_sum($arr_i);
$arr_al = array_sum($arr_a);
?>

    <td rowspan="11" class="center"><b><?=$arr_sk?></b></td>
    <td rowspan="11" class="center"><b><?=$arr_iz?></b></td>
    <td rowspan="11" class="center"><b><?=$arr_al?></b></td>
    <td rowspan="11"></td>
                                    </tr>

                                    <tr>
                                        <td><b>Keterampilan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg4 = $this->db->query("SELECT SUM(total_na) as avg4 FROM tb_nilai_ki4 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
        foreach ($avg4 as $av4) {
            ?>
                                        <td class="center"><b><?=$av4->avg4?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>

                                        <?php
$avg4 = $this->db->query("SELECT SUM(total_na) as avg4 FROM tb_nilai_ki4 WHERE kelas=" . $kl . " AND ta=" . $ta . "")->result();
foreach ($avg4 as $av4) {
    ?>
                                        <td class="center"><b><?=$av4->avg4?></b></td>

                                    <?php }?>

<td class="center"><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($avg4 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
echo array_sum($arr);
?>
</b>
                                </td>
                                    </tr>

                                    <tr>
                                        <td class="center" style="vertical-align: inherit;" colspan="2" rowspan="3"><b>Nilai Rata-Rata</b></td>
                                    </tr>

                                    <tr>
                                        <td><b>Pengetahuan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg3 = $this->db->query("SELECT AVG(na_kd) as avg3 FROM tb_nki3 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
        foreach ($avg3 as $av3) {
            ?>

                                        <td class="center"><b><?=number_format($av3->avg3, 1)?></b></td>

                                    <?php }}}?>
                                    <td colspan="2"></td>

                                        <?php
$arr = [];
foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg3 = $this->db->query("SELECT SUM(total_na) as avg3 FROM tb_nilai_ki3 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
        foreach ($avg3 as $av3) {
            if ($av3->avg3 != null) {
                $arr[] = $av3->avg3;
            }}}}
$c   = count($arr);
$avg = array_sum($arr);
if ($c != 0 && $avg != 0) {
    $total = $avg / $c;
    ?>

    <td class="center"><b><?=$total?></b></td>
<?php }?>

                                    <td class="center"><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($avg3 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
$c     = count($arr);
$avg   = array_sum($arr);
$total = $avg / $c;
echo number_format($total, 2);
?>
</b>
                                </td>

                                <td rowspan="2" class="center"><b>
                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . ") as result ")->result();

    foreach ($nrpk as $v) {
        $arr[] = number_format($v->result, 2) / 2;
    }}

$c     = count($arr);
$avg   = array_sum($arr);
$total = $avg / $c;
echo number_format($total, 2);
?>
                                </b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Keterampilan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg4 = $this->db->query("SELECT AVG(na_kd) as avg4 FROM tb_nki4 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
        foreach ($avg4 as $av4) {
            ?>

                                        <td class="center"><b><?=number_format($av4->avg4, 1)?></b></td>

                                    <?php }}}?>
                                    <td colspan="2"></td>
                                    <?php
$arr = [];
foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg4 = $this->db->query("SELECT SUM(total_na) as avg4 FROM tb_nilai_ki4 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
        foreach ($avg4 as $av4) {
            if ($av4->avg4 != null) {
                $arr[] = $av4->avg4;
            }}}}
$c   = count($arr);
$avg = array_sum($arr);
if ($c != 0 && $avg != 0) {
    $total = $avg / $c;
    ?>

    <td class="center"><b><?=$total?></b></td>
<?php }?>

    <td class="center"><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($avg4 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
$c     = count($arr);
$avg   = array_sum($arr);
$total = $avg / $c;
echo number_format($total, 2);
?>
</b>
                                </td>

                                    </tr>

                                    <tr>
                                        <td class="center" colspan="2" rowspan="3"><b>Nilai Terendah</b></td>
                                    </tr>

                                    <tr>
                                        <td><b>Pengetahuan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg3 = $this->db->query("SELECT MIN(total_na) as avg3 FROM tb_nilai_ki3 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
        foreach ($avg3 as $av3) {
            ?>

                                        <td class="center"><b><?=number_format($av3->avg3, 0)?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>
                                            <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT SUM(total_na) as avg3 FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
    foreach ($avg3 as $av3) {
        if ($av3->avg3 != null) {
            $arr[] = $av3->avg3;
        }}}
?>

        <td class="center"><b><?=(empty($arr)) ? '' : min($arr)?></b></td>

        <td class="center"><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($avg3 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
echo min($arr);
?>
</b>
                                </td>

                                <td rowspan="2" class="center"><b>
                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . ") as result ")->result();

    foreach ($nrpk as $v) {
        $arr[] = number_format($v->result, 2) / 2;
    }}
echo min($arr);
?>
                                </b></td>

                                    </tr>
                                    <tr>
                                        <td><b>Keterampilan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg4 = $this->db->query("SELECT MIN(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
        foreach ($avg4 as $av4) {
            ?>

                                        <td class="center"><b><?=number_format($av4->avg4, 0)?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>
                                        <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT SUM(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
    foreach ($avg4 as $av4) {
        if ($av4->avg4 != null) {
            $arr[] = $av4->avg4;
        }}}
?>

    <td class="center"><b><?=(empty($arr)) ? '' : min($arr)?></b></td>

    <td class="center"><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($avg4 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
echo min($arr);
?>
</b>
                                </td>
                                    </tr>

                                    <tr>
                                        <td class="center" colspan="2" rowspan="3"><b>Nilai Tertinggi</b></td>
                                    </tr>

                                    <tr>
                                        <td><b>Pengetahuan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg3 = $this->db->query("SELECT MAX(total_na) as avg3 FROM tb_nilai_ki3 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
        foreach ($avg3 as $av3) {
            ?>

                                        <td class="center"><b><?=number_format($av3->avg3, 0)?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>
                                        <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT SUM(total_na) as avg3 FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
    foreach ($avg3 as $av3) {
        if ($av3->avg3 != null) {
            $arr[] = $av3->avg3;
        }}}
?>

    <td class="center"><b><?=(empty($arr)) ? '' : max($arr)?></b></td>

    <td class="center"><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($avg3 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
echo max($arr);
?>
</b>
                                </td>

                                 <td rowspan="2" class="center"><b>
                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . ") as result ")->result();

    foreach ($nrpk as $v) {
        $arr[] = number_format($v->result, 2) / 2;
    }}
echo max($arr);
?>
                                </b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Keterampilan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg4 = $this->db->query("SELECT MAX(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
        foreach ($avg4 as $av4) {
            ?>

                                        <td class="center"><b><?=number_format($av4->avg4, 0)?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>
                                        <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT SUM(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . "")->result();
    foreach ($avg4 as $av4) {
        if ($av4->avg4 != null) {
            $arr[] = $av4->avg4;
        }}}
?>

    <td class="center"><b><?=(empty($arr)) ? '' : max($arr)?></b></td>

    <td class="center"><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kl . " AND ta=" . $ta . " ")->result();

    foreach ($avg4 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
echo max($arr);
?>
</b>
                                </td>
                                    </tr>
      </table>


      <table>
      <tr>
        <td style="width: 50px;"></td>
        <td>
              <p>Kepala Sekolah,</p>
            <br>
            <br>
            <br>
            <br>
              <?php foreach ($kepsek as $g) {?>
                <p style="text-decoration: underline;"><?=$g->nm_guru?></p>
                NIP. <?=$g->nip?>
              <?php }?>
        </td>

        <td style="width: 500px;"></td>

        <td>
<?php foreach ($guru as $gr) {
    if ($gr->wali_kelas == $kl) {?>
              <p>Wali Kelas <?=$gr->nm_kelas?>,</p>
            <br>
            <br>
            <br>
                <p style="text-decoration: underline;"><?=$gr->nm_guru?></p>
                NIP. <?=$gr->nip?>
              <?php }}?>

        </td>
      </tr>
    </table>


     <script>
var arr_rank = $("input[name='nilai_akhir[]']").map(function() {
    return $(this).val();
}).get();

var sorted = arr_rank.slice().sort(function(a,b){return b-a})
var ranks = arr_rank.slice().map(function(v){ return sorted.indexOf(v)+1 });

var c = arr_rank.length;

for (var i = 0; i < c; i++) {
document.getElementById("rank_hasil_"+[i]).innerHTML = ranks[i];
}
window.print();

                                </script>
