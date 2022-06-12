

<div id="page_content">
    <div id="page_content_inner">

	<div class="uk-grid uk-grid-medium hierarchical_show" data-uk-grid-margin>
            <div class="uk-width-1-1">

                <div class="md-card">
                <div class="md-card-content">
                            <table class="uk-table">
                                <tr>
                                    <td colspan="3">
                                        <h4 class="uk-text-center">Daftar Leger Nilai Rapor SDN Pasar Lama 6</h4>
                                    </td>
                                </tr>
                            <?php foreach ($kelas as $kl) {?>
                                <tr>
                                    <td style="width: 100px;">Kelas</td>
                                    <td>:</td>
                                    <td><?=$kl->nm_kelas . '&nbsp;' . $kl->huruf_kl?></td>
                                </tr>
                            <?php }?>
                            <?php foreach ($taj as $tj) {?>
                                <tr>
                                    <td>Semester</td>
                                    <td>:</td>
                                    <td><?=$tj->smt?></td>
                                </tr>
                                <tr>
                                    <td>Tahun Ajaran</td>
                                    <td>:</td>
                                    <td><?=$tj->nm_tahunajaran?></td>
                                </tr>
                            <?php }?>
                            </table>

                    </div>
                </div>


                <div class="md-card">
                    <div class="md-card-content">
                        <a target="blank" data-uk-tooltip="{pos:'top'}" title="Report Data Leger" href="<?=base_url('cetak/cetak_leger/' . $kla . '/' . $id_tj)?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report Leger</a>

                        <!-- <button data-uk-tooltip="{pos:'top'}" title="Generate Rangking" onclick="cek_rank()" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-spinner">&nbsp;</i>Generate Rangking</button> -->

                        <br><br>

                        <div class="table-responsive">

                            <table class="uk-table uk-table-striped" border="1">

                                <thead>
                                    <tr>
                                        <th rowspan="4" style="vertical-align: inherit;"><b>No</b></th>
                                        <th rowspan="4" style="vertical-align: inherit; padding-right: 150px;"><b>Nama Siswa</b></th>
                                    </tr>

                                    <tr>
                                        <th><b>ASPEK</b></th>
                                    <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        ?>
                                        <th><b><?=$mp->kode_mapel?></b></th>
                                    <?php }}?>
                                        <th colspan="2" style="text-align: center;"><b>SIKAP</b></th>
                                        <th rowspan="2" style="vertical-align: inherit;"><b>JML</b></th>
                                        <th rowspan="2" style="vertical-align: inherit;"><b>NR</b></th>
                                        <th rowspan="2" style="vertical-align: inherit;"><b>NR P&K</b></th>
                                        <th colspan="3"><b>ABSENSI</b></th>
                                        <th rowspan="2" style="vertical-align: inherit;"><b>RANK</b></th>

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
                                        <th><b>S</b></th>
                                        <th><b>I</b></th>
                                        <th><b>A</b></th>
                                    </tr>


                                </thead>
                                <tbody>
                                <?php
$no       = 1;
$arr_rank = [];
foreach ($siswa->result() as $sw) {
    ?>
                                    <tr>
                                        <td rowspan="2"><?=$no++?></td>
                                        <td rowspan="2"><?=$sw->nm_siswa?></td>
                                        <td>Pengetahuan</td>
                                        <?php foreach ($mapel->result() as $mp) {
        if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
            $avg3 = $this->db->query("SELECT AVG(total_na) as avg3 FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
            foreach ($avg3 as $av3) {
                $nilai_pth = number_format($av3->avg3, 0);
                ?>

                                        <td><?=number_format($av3->avg3, 0)?></td>

                                    <?php }}}?>

                                    <?php
foreach ($ki1->result() as $k1) {
        if ($k1->siswa == $sw->id_siswa) {?>
                                    <td rowspan="2" style="vertical-align: inherit; text-align: center;"><?=$k1->predikat?></td>
                                <?php }}?>

                                <?php foreach ($ki2->result() as $k2) {
        if ($k2->siswa == $sw->id_siswa) {?>
                                    <td rowspan="2" style="vertical-align: inherit; text-align: center;"><?=$k2->predikat?></td>
                                <?php }}?>

                                <td>
                                    <?php
$sum3 = $this->db->query("SELECT SUM(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

    foreach ($sum3 as $v) {
        echo $v->jml;
    }
    ?>
                                </td>
                                <td>

                                    <?php
$avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();
    $arr  = [];
    foreach ($avg3 as $v) {
        echo number_format($v->jml, 2);
    }
    ?>

                                </td>
                                <td rowspan="2" style="vertical-align: inherit; text-align: center;">
                                    <?php
$nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . ") as result ")->result();

    foreach ($nrpk as $v) {
        echo number_format($v->result, 2) / 2;
        echo '<input type="hidden" name="nilai_akhir[]" value="' . (number_format($v->result, 2) / 2) . '">';
        echo '<input type="hidden" name="siswa[]" value="' . $sw->id_siswa . '">';
        echo '<input type="hidden" name="ta_leger[]" value="' . $id_tj . '">';
        echo '<input type="hidden" name="kelas_leger[]" value="' . $kla . '">';
    }
    ?>
                                </td>
        <?php
$absen = $this->db->query("SELECT *,SUM(sakit) as t_sakit, SUM(izin) as t_izin, SUM(alpha) as t_alpha FROM tb_absiswa WHERE siswa=" . $sw->id_siswa . " AND ta=" . $id_tj . " ")->result();
    foreach ($absen as $ab) {
        ?>
                                <td rowspan="2" style="vertical-align: inherit; text-align: center;"><?=$ab->t_sakit?></td>
                                <td rowspan="2" style="vertical-align: inherit; text-align: center;"><?=$ab->t_izin?></td>
                                <td rowspan="2" style="vertical-align: inherit; text-align: center;"><?=$ab->t_alpha?></td>
                            <?php }?>
                            <td rowspan="2" style="vertical-align: inherit; text-align: center;">
                            <b id="rank_hasil_<?=($no - 2)?>"></b>
                            </td>
                                    </tr>
                                    <tr>
                                        <td>Keterampilan</td>
                                        <?php foreach ($mapel->result() as $mp) {
        if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
            $avg4 = $this->db->query("SELECT AVG(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
            foreach ($avg4 as $av4) {
                ?>

                                        <td><?=number_format($av4->avg4, 0)?></td>

                                    <?php }}}?>
                                    <td>
                                           <?php
$sum4 = $this->db->query("SELECT SUM(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

    foreach ($sum4 as $v) {
        echo $v->jml;
    }
    ?>
                                    </td>
                                    <td>
                                         <?php
$avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

    foreach ($avg4 as $v) {
        echo number_format($v->jml, 2);
    }
    ?>
                                    </td>

                                    </tr>
                                <?php }?>

                                <script>

var arr_rank = $("input[name='nilai_akhir[]']").map(function() {
    return $(this).val();
}).get();

var ta = $("input[name='ta_leger[]']").map(function() {
    return $(this).val();
}).get();

var siswa = $("input[name='siswa[]']").map(function() {
    return $(this).val();
}).get();

var kelas = $("input[name='kelas_leger[]']").map(function() {
    return $(this).val();
}).get();

var sorted = arr_rank.slice().sort(function(a,b){return b-a})
var ranks = arr_rank.slice().map(function(v){ return sorted.indexOf(v)+1 });

var c = arr_rank.length;

for (var i = 0; i < c; i++) {
document.getElementById("rank_hasil_"+[i]).innerHTML = ranks[i];
}


                                </script>


                                    <tr>
                                        <td class="center" style="vertical-align: inherit;" colspan="2" rowspan="3"><b>Jumlah Nilai</b></td>
                                    </tr>

                                    <tr>
                                        <td><b>Pengetahuan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg3 = $this->db->query("SELECT SUM(total_na) as avg3 FROM tb_nilai_ki3 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
        foreach ($avg3 as $av3) {
            ?>
                                        <td><b><?=$av3->avg3?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>
                                        <?php
$avg3 = $this->db->query("SELECT SUM(total_na) as avg3 FROM tb_nilai_ki3 WHERE kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
foreach ($avg3 as $av3) {
    ?>
                                        <td><b><?=$av3->avg3?></b></td>

                                    <?php }?>

                                    <td><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

    foreach ($avg3 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
echo array_sum($arr);
?>
</b>
                                </td>

                                <td rowspan="2" style="vertical-align: inherit; text-align: center;"><b>
                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . ") as result ")->result();

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
    $absen = $this->db->query("SELECT *,SUM(sakit) as t_sakit, SUM(izin) as t_izin, SUM(alpha) as t_alpha FROM tb_absiswa WHERE siswa=" . $sw->id_siswa . " AND ta=" . $id_tj . " ")->result();
    foreach ($absen as $ab) {
        $arr_s[] = $ab->t_sakit;
        $arr_i[] = $ab->t_izin;
        $arr_a[] = $ab->t_alpha;
    }}
$arr_sk = array_sum($arr_s);
$arr_iz = array_sum($arr_i);
$arr_al = array_sum($arr_a);
?>

    <td rowspan="12" style="vertical-align: inherit; text-align: center;"><b><?=$arr_sk?></b></td>
    <td rowspan="12" style="vertical-align: inherit; text-align: center;"><b><?=$arr_iz?></b></td>
    <td rowspan="12" style="vertical-align: inherit; text-align: center;"><b><?=$arr_al?></b></td>
    <td rowspan="12"></td>

                                    </tr>
                                    <tr>
                                        <td><b>Keterampilan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg4 = $this->db->query("SELECT SUM(total_na) as avg4 FROM tb_nilai_ki4 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
        foreach ($avg4 as $av4) {
            ?>
                                        <td><b><?=$av4->avg4?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>

                                        <?php
$avg4 = $this->db->query("SELECT SUM(total_na) as avg4 FROM tb_nilai_ki4 WHERE kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
foreach ($avg4 as $av4) {
    ?>
                                        <td><b><?=$av4->avg4?></b></td>

                                    <?php }?>

                                    <td><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

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
        $avg3 = $this->db->query("SELECT AVG(na_kd) as avg3 FROM tb_nki3 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
        foreach ($avg3 as $av3) {
            ?>

                                        <td><b><?=number_format($av3->avg3, 1)?></b></td>

                                    <?php }}}?>
                                    <td colspan="2"></td>

                                        <?php
$arr = [];
foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg3 = $this->db->query("SELECT SUM(total_na) as avg3 FROM tb_nilai_ki3 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
        foreach ($avg3 as $av3) {
            if ($av3->avg3 != null) {
                $arr[] = $av3->avg3;
            }}}}
$c   = count($arr);
$avg = array_sum($arr);
if ($c != 0 && $avg != 0) {
    $total = $avg / $c;
    ?>

    <td><b><?=$total?></b></td>
<?php }?>

                                    <td><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

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

                                <td rowspan="2" style="vertical-align: inherit; text-align: center;"><b>
                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . ") as result ")->result();

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
        $avg4 = $this->db->query("SELECT AVG(na_kd) as avg4 FROM tb_nki4 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
        foreach ($avg4 as $av4) {
            ?>

                                        <td><b><?=number_format($av4->avg4, 1)?></b></td>

                                    <?php }}}?>
                                    <td colspan="2"></td>
                                    <?php
$arr = [];
foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg4 = $this->db->query("SELECT SUM(total_na) as avg4 FROM tb_nilai_ki4 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
        foreach ($avg4 as $av4) {
            if ($av4->avg4 != null) {
                $arr[] = $av4->avg4;
            }}}}
$c   = count($arr);
$avg = array_sum($arr);
if ($c != 0 && $avg != 0) {
    $total = $avg / $c;
}
?>

    <td><b><?=$total?></b></td>

    <td><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

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
                                        <td class="center" style="vertical-align: inherit;" colspan="2" rowspan="3"><b>Nilai Terendah</b></td>
                                    </tr>

                                    <tr>
                                        <td><b>Pengetahuan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg3 = $this->db->query("SELECT MIN(total_na) as avg3 FROM tb_nilai_ki3 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
        foreach ($avg3 as $av3) {
            ?>

                                        <td><b><?=number_format($av3->avg3, 0)?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>
                                            <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT SUM(total_na) as avg3 FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
    foreach ($avg3 as $av3) {
        if ($av3->avg3 != null) {
            $arr[] = $av3->avg3;
        }}}
?>
        <td><b><?=(empty($arr)) ? '' : min($arr)?></b></td>

        <td><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND  kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

    foreach ($avg3 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
echo min($arr);
?>
</b>
                                </td>

                                <td rowspan="2" style="vertical-align: inherit; text-align: center;"><b>
                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . ") as result ")->result();

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
        $avg4 = $this->db->query("SELECT MIN(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
        foreach ($avg4 as $av4) {
            ?>

                                        <td><b><?=number_format($av4->avg4, 0)?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>
                                        <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT SUM(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
    foreach ($avg4 as $av4) {
        if ($av4->avg4 != null) {
            $arr[] = $av4->avg4;
        }}}
?>

        <td><b><?=(empty($arr)) ? '' : min($arr)?></b></td>


    <td><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND  kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

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
                                        <td class="center" style="vertical-align: inherit;" colspan="2" rowspan="3"><b>Nilai Tertinggi</b></td>
                                    </tr>

                                    <tr>
                                        <td><b>Pengetahuan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg3 = $this->db->query("SELECT MAX(total_na) as avg3 FROM tb_nilai_ki3 WHERE mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
        foreach ($avg3 as $av3) {
            ?>

                                        <td><b><?=number_format($av3->avg3, 0)?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>
                                        <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT SUM(total_na) as avg3 FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
    foreach ($avg3 as $av3) {
        if ($av3->avg3 != null) {
            $arr[] = $av3->avg3;
        }}}
?>

    <td><b><?=(empty($arr)) ? '' : max($arr)?></b></td>

    <td><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND  kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

    foreach ($avg3 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
?>
<?=(empty($arr)) ? '' : max($arr)?>
</b>
                                </td>

                                 <td rowspan="2" style="vertical-align: inherit; text-align: center;"><b>
                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . ") as result ")->result();

    foreach ($nrpk as $v) {
        $arr[] = number_format($v->result, 2) / 2;
    }}
?>
    <?=max($arr)?>

                                </b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Keterampilan</b></td>
                                        <?php foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        $avg4 = $this->db->query("SELECT MAX(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
        foreach ($avg4 as $av4) {
            ?>

                                        <td><b><?=number_format($av4->avg4, 0)?></b></td>

                                    <?php }}}?>
                                        <td colspan="2"></td>
                                        <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT SUM(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND kelas=" . $kla . " AND ta=" . $id_tj . "")->result();
    foreach ($avg4 as $av4) {
        if ($av4->avg4 != null) {
            $arr[] = $av4->avg4;
        }}}
?>

    <td><b><?=(empty($arr)) ? '' : max($arr)?></b></td>

    <td><b>

                                    <?php
$arr = [];
foreach ($siswa->result() as $sw) {
    $avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND  kelas=" . $kla . " AND ta=" . $id_tj . " ")->result();

    foreach ($avg4 as $v) {
        $arr[] = number_format($v->jml, 2);
    }
}
echo max($arr);
?>
</b>
                                </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

