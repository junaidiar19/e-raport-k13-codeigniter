<?php
$siswa       = $this->db->query("SELECT * FROM tb_siswa, tb_kelas WHERE id_siswa=" . $id . " AND tb_siswa.kelas = tb_kelas.id_kelas ")->result();
$ortu        = $this->db->query("SELECT * FROM tb_ortu WHERE siswa=" . $id . " ")->result();
$skl         = $this->db->query("SELECT * FROM tb_sekolah")->result();
$guru        = $this->m_admin->data_guru()->result();
$tahunajaran = $this->db->query("SELECT * FROM tb_tahunajaran WHERE id_tahunajaran=" . $ta . " ")->result();

$sikap1 = $this->db->query("SELECT * FROM tb_sikap_ki1 WHERE ta=" . $ta . " AND siswa=" . $id . " ")->result();

$sikap2 = $this->db->query("SELECT * FROM tb_sikap_ki2 WHERE ta=" . $ta . " AND siswa=" . $id . " ")->result();

$ekskul = $this->db->query("SELECT * FROM tb_ekskul, tb_ekskul_siswa WHERE tb_ekskul.eks = tb_ekskul_siswa.id_ekskul_siswa AND ta=" . $ta . " AND siswa=" . $id . " ")->result();

$fisik     = $this->db->query("SELECT * FROM tb_fisik, tb_tahunajaran WHERE tb_fisik.ta = tb_tahunajaran.id_tahunajaran AND ta=" . $ta . " AND siswa=" . $id . " ");
$kesehatan = $this->db->query("SELECT * FROM tb_kesehatan WHERE ta=" . $ta . " AND siswa=" . $id . " ")->result();

$guru   = $this->db->query("SELECT * FROM tb_guru, tb_kelas WHERE tb_guru.wali_kelas = tb_kelas.id_kelas")->result();
$kepsek = $this->db->query("SELECT * FROM tb_guru WHERE jabatan='1' ")->result();

$mapel = $this->db->query("SELECT * FROM tb_mapel ")->result();

$nilai_ki3 = $this->db->query("SELECT * FROM tb_nilai_ki3 WHERE ta=" . $ta . " AND siswa=" . $id . " ")->result();
$nilai_ki4 = $this->db->query("SELECT * FROM tb_nilai_ki4 WHERE ta=" . $ta . " AND siswa=" . $id . " ")->result();

$prestasi = $this->db->query("SELECT * FROM tb_prestasi, tb_tahunajaran WHERE tb_prestasi.ta = tb_tahunajaran.id_tahunajaran AND siswa=" . $id . " AND ta=" . $ta . " ")->result();
// $prestasi2 = $this->db->query("SELECT * FROM tb_prestasi, tb_tahunajaran WHERE tb_prestasi.ta = tb_tahunajaran.id_tahunajaran AND siswa=" . $id . " AND smt='2' ")->result();

$absen = $this->db->query("SELECT SUM(jumlah) AS jml, SUM(sakit) AS s, SUM(izin) AS i, SUM(alpha) AS a FROM tb_absiswa WHERE siswa=" . $id . " AND ta=" . $ta . " ")->result();

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

.right {
  text-align: right;
}

.left {
  text-align: left;
}

.table {
  border-collapse: collapse;
}

.table {
  border: 1px solid black;
}

  .row:after {
  content: "";
  display: table;
  clear: both;
}

@media screen and (max-width:600px) {
  .column {
    width: 100%;
  }
  .column {
  float: left;
  width: 33.33%;
  padding: 15px;
}

</style>

<br>

<h3 class="center">RAPOR PESERTA DIDIK DAN PROFIL PESERTA DIDIK
</h3>

<table style="width: 100%;">
    <tr>
        <td>
            <table style="width: 100%; margin-top: 30px;">
            <?php foreach ($siswa as $sw) {?>
                <tr>
                    <td style="width: 150px;">Nama Peserta Didik</td>
                    <td style="width: 20px;">:</td>
                    <td><b><?=$sw->nm_siswa?></b></td>
                </tr>

                <tr>
                    <td>Nomor Induk Siswa</td>
                    <td>:</td>
                    <td><?=$sw->nis?></td>
                </tr>
            <?php }

    foreach ($skl as $sh) {
        ?>
                <tr>
                    <td>Nama Sekolah</td>
                    <td>:</td>
                    <td><?=$sh->nama_sklh?></td>
                </tr>

                <tr>
                    <td>Alamat Sekolah</td>
                    <td style="vertical-align: text-top;">:</td>
                    <td>
                        <?=$sh->alamat?> <?=$sh->kelurahan?>, <?=$sh->kecamatan?>, <?=$sh->kabupaten?>
                    </td>
                </tr>

            <?php }?>

            </table>

        </td>
        <td>
            <table style="width: 100%; margin-top: 30px;">
            <?php foreach ($siswa as $sw) {?>
                <tr>
                    <td style="width: 150px;">Kelas</td>
                    <td style="width: 20px;">:</td>
                    <td><?=$sw->nm_kelas?></td>
                </tr>
            <?php }

    foreach ($tahunajaran as $ta) {
        ?>
                <tr>
                    <td>Semester</td>
                    <td>:</td>
                    <td><?=substr($ta->nm_tahunajaran, 12)?></td>
                </tr>

                <tr>
                    <td>Tahun Pelajaran</td>
                    <td style="vertical-align: text-top;">:</td>
                    <td>
                        <?=substr($ta->nm_tahunajaran, 0, 9)?>
                    </td>
                </tr>

            <?php }?>

            </table>
        </td>
    </tr>
</table>
<br>

<h5><b>A. SIKAP</b></h5>
<table style="width: 100%;" border="1" class="table">
    <tr style="background: #ddd;">
        <th colspan="3"><b>DESKRIPSI</b></th>
    </tr>
    <tr>
        <td class="center" width="20">1</td>
        <td width="170" height="100">&emsp;Sikap Spiritual</td>
        <td><p style="margin-left: 5px;">
        <?php
foreach ($sikap1 as $skp1) {
        if ($skp1->kelas == $sw->kelas) {
            echo $skp1->desk;
        }
    }
    ?></p></td>
    </tr>
    <tr>
        <td class="center">2</td>
        <td height="100">&emsp;Sikap Sosial</td>
        <td><p style="margin-left: 5px;">
        <?php
foreach ($sikap2 as $skp2) {
        if ($skp2->kelas == $sw->kelas) {
            echo $skp2->desk;
        }
    }
    ?></p></td>
    </tr>
</table>

<br>

<!-- <table>
    <tr>
        <td><h5><b>B. </b></h5></td>
        <td><h5><b>PENGETAHUAN DAN KETERAMPILAN</b></h5></td>
    </tr>
    <tr>
        <td>&emsp;</td>
        <td><h5><b>KKM Satuan Pendidikan = 60</b></h5></td>
    </tr>
</table> -->

<h5><b>B. PENGETAHUAN DAN KETERAMPILAN</b></h5>
<h5><b>&emsp;&nbsp;KKM Satuan Pendidikan = 60</b></h5>


<table style="width: 100%;" border="1" class="table">
    <tr style="background: #ddd;">
        <th rowspan="3"><b>No</b></th>
        <th rowspan="3"><b>Muatan Pelajaran</b></th>
    </tr>
    <tr style="background: #ddd;">
        <th colspan="3"><b>Pengetahuan</b></th>
        <th colspan="3"><b>Keterampilan</b></th>
    </tr>
    <tr style="background: #ddd;">
        <th>Nilai</th>
        <th>Predikat</th>
        <th>Deskripsi</th>
        <th>Nilai</th>
        <th>Predikat</th>
        <th>Deskripsi</th>
    </tr>
<?php
$no = 1;
    foreach ($mapel as $mp) {
        if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
            ?>
    <tr>
        <td class="center"><?=$no++?></td>
        <td><p style="margin-left: 5px;"><?=$mp->nm_mapel?></p></td>
<?php foreach ($nilai_ki3 as $ki3) {
                if ($ki3->mapel == $mp->id_mapel) {
                    ?>
        <td class="center"><?=$ki3->total_na?></td>
        <td class="center">
            <?php
$v = $ki3->total_na;
                    if ($v >= 89 && $v < 100) {
                        echo 'A';
                    } else if ($v >= 77 && $v < 89) {
                        echo 'B';
                    } else if ($v >= 65 && $v < 77) {
                        echo "C";
                    } else if ($v < 65) {
                        echo "D";
                    }
                    ?>
        </td>
        <td><p style="margin-left: 5px;"><?=$ki3->deskripsi?></p></td>
        <?php }}?>

        <?php foreach ($nilai_ki4 as $ki4) {
                if ($ki4->mapel == $mp->id_mapel) {
                    ?>
        <td class="center"><?=$ki4->total_na?></td>
        <td class="center">
            <?php
$v = $ki4->total_na;
                    if ($v >= 89 && $v < 100) {
                        echo 'A';
                    } else if ($v >= 77 && $v < 89) {
                        echo 'B';
                    } else if ($v >= 65 && $v < 77) {
                        echo "C";
                    } else if ($v < 65) {
                        echo "D";
                    }
                    ?>
        </td>
        <td><p style="margin-left: 5px;"><?=$ki4->deskripsi?></p></td>
        <?php }}?>

    </tr>
<?php }}?>
</table>

<br>
<br>
<h5><b>C. Ekstrakurikuler</b></h5>
<table width="100%" border="1" class="table">
    <tr style="background: #ddd;">
        <th class="center" width="270"><b>Kegiatan Ekstrakurikuler</b></th>
        <th class="center"><b>Keterangan</b></th>
    </tr>
    <?php foreach ($ekskul as $eks) {?>
    <tr>
        <td>&emsp;<?=$eks->nm_ekskul?></td>
        <td>&emsp;<?=$eks->ket?></td>
    </tr>
<?php }?>
</table>

<br>
<h5><b>D. Saran-Saran</b></h5>
<input class="table" style="width: 100%; height: 40px; background: white; padding-left: 10px;">

<br>
<h5><b>E. Perkembangan Fisik</b></h5>
<table width="100%" border="1" class="table">
    <tr style="background: #ddd;">
        <th class="center" width="20"><b>No</b></th>
        <th class="center" width="240"><b>Aspek Yang Dinilai</b></th>
        <th class="center"><b>Keterangan</b></th>
    </tr>
    <tr>
        <td class="center">1. </td>
        <td>&emsp; Tinggi Badan</td>
<?php
foreach ($fisik->result() as $fk) {
        echo '<td class="center">' . $fk->tb_1 . ' cm</td>';
    }
    ?>
    </tr>
    <tr>
        <td class="center">2. </td>
        <td>&emsp; Berat Badan</td>
<?php
foreach ($fisik->result() as $fk) {
        echo '<td class="center">' . $fk->bb_1 . ' cm</td>';
    }
    ?>
</table>


<br>
<h5><b>F. Kondisi Kesehatan</b></h5>

<table border="1" width="100%" class="table">
    <tr style="background: #ddd;">
        <th width="10"><b>No</b></th>
        <th width="240" class="center"><b>Aspek Fisik</b></th>
        <th class="center"><b>Keterangan</b></th>
    </tr>

    <tr>
        <td width="10" class="center">1. </td>
        <td>&emsp; Pendengaran</td>
        <?php
foreach ($kesehatan as $ks) {
        ?>
        <td class="center"><?php
if ($ks->pendengaran == 1) {
            echo "Sangat Baik";
        } elseif ($ks->pendengaran == 2) {
            echo "Baik";
        } elseif ($ks->pendengaran == 3) {
            echo "Kurang Baik";
        }
        ?></td>
<?php }?>
    </tr>

    <tr>
        <td width="10" class="center">2. </td>
        <td>&emsp; Penglihatan</td>
        <?php
foreach ($kesehatan as $ks) {
        ?>
        <td class="center"><?php
if ($ks->penglihatan == 1) {
            echo "Sangat Baik";
        } elseif ($ks->penglihatan == 2) {
            echo "Baik";
        } elseif ($ks->penglihatan == 3) {
            echo "Kurang Baik";
        }
        ?></td>
<?php }?>
    </tr>

    <tr>
        <td width="10" class="center">3. </td>
        <td>&emsp; Gigi</td>
        <?php
foreach ($kesehatan as $ks) {
        ?>
        <td class="center"><?php
if ($ks->gigi == 1) {
            echo "Sangat Baik";
        } elseif ($ks->gigi == 2) {
            echo "Baik";
        } elseif ($ks->gigi == 3) {
            echo "Kurang Baik";
        }
        ?></td>
<?php }?>
    </tr>

</table>

<br>
<br>
<table>
    <tr>
        <td><h5><b>G. </b></h5></td>
        <td><h5><b>Catatan Prestasi</b></h5></td>
    </tr>
</table>

<table width="100%" border="1" class="table">
    <tr style="background: #ddd;">
        <th width="10"><b>No</b></th>
        <th>Jenis Prestasi</th>
        <th>Prestasi</th>
    </tr>
<?php
$no = 1;
    foreach ($prestasi as $pr) {
        ?>
    <tr>
        <td class="center"><?=$no++?></td>
        <td><p style="margin-left: 5px;"><?=$pr->jp?></p></td>
        <td><p style="margin-left: 5px;"><?=$pr->pres?></p></td>
    </tr>
<?php }?>
</table>


<br>
<h5><b>H. Ketidakhadiran</b></h5>

<?php foreach ($absen as $ab) {?>
<table width="60%" border="1" class="table">
    <tr style="background: #ddd;">
        <th class="center" colspan="2"><b>Ketidakhadiran</b></th>
    </tr>
    <tr>
        <td width="200">
            &emsp; Sakit
        </td>
        <td class="right"><?=$ab->s?> Hari&nbsp;</td>
    </tr>
    <tr>
        <td>
            &emsp; Izin
        </td>
        <td class="right"><?=$ab->i?> Hari&nbsp;</td>
    </tr>
    <tr>
        <td>
            &emsp; Tanpa Keterangan
        </td>
        <td class="right"><?=$ab->a?> Hari&nbsp;</td>
    </tr>
</table>
<?php }?>



<br>
<br>
<br>

 <table width="100%">
      <tr>
        <td class="center" width="50%">
            <p>Mengetahui :</p>
              <p>Wali,</p>
            <br>
            <br>
            <br>
            <br>
              <?php foreach ($ortu as $or) {?>
                <p style="text-decoration: underline;"><b><?=$or->nm_ayah?><?=$or->nm_wali?></b></p>
              <?php }?>
        </td>

        <td class="center" width="50%">
            Banjarmasin, <?php echo tgl_indo(date('Y-m-d')) ?>
<?php foreach ($guru as $gr) {
        if ($gr->wali_kelas == $sw->kelas) {?>
              <p>Wali Kelas <?=$gr->nm_kelas?>,</p>
            <br>
            <br>
            <br><br>
                <p style="text-decoration: underline;"><b><?=$gr->nm_guru?></b></p>
                NIP. <?=$gr->nip?>
              <?php }}?>

        </td>
      </tr>
      <tr>
          <td class="center" colspan="2">
            <br><br>
              <p>Kepala Sekolah,</p>
                <br>
                <br>
                <br>
                <br>
                  <?php foreach ($kepsek as $g) {?>
                    <p style="text-decoration: underline;"><b><?=$g->nm_guru?></b></p>
                    NIP. <?=$g->nip?>
                  <?php }?>
            </td>
          </td>
      </tr>
    </table>

    <script>
        window.print();
    </script>

<?php }?>