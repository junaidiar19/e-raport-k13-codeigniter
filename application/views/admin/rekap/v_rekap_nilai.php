<div id="page_content">
    <div id="page_content_inner">

	<div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-1-1">

                <?php
$taj = $this->db->query("SELECT * FROM tb_tahunajaran ORDER BY stt_tahunajaran desc");
foreach ($taj->result() as $ta) {
    ?>
                <div class="md-card">
                    <div class="md-card-content">
                                <h5 style="background: <?php if ($ta->stt_tahunajaran == 'Y') {echo "yellow";}?>;"><b><?=$ta->nm_tahunajaran?></b></h5>
                        <hr>

                        <div class="uk-grid">
                        <div class="uk-width-medium-7-10">
                            <h3>Rekap Nilai KI-3 ( Pengetahuan ) dan KI-4 ( Keterampilan )</h3>
                        </div>
                        <div class="uk-width-medium-3-10 uk-text-right">
                        </div>
                    </div><hr>

                    <table id="dt_default" class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Aksi KI3</th>
                            <th>Aksi KI4</th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php
$no = 1;
    foreach ($mapel->result() as $mp) {
        if ($jb == 1 || $jb == 2) {
            if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
                ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$mp->nm_mapel?></td>
                            <td>
                                <a href="<?=base_url('admin/rekap_nilai_ki3/' . $kl . '/' . $mp->id_mapel . '/' . $ta->id_tahunajaran . ' ')?>" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Rekap Nilai KI-3</a>

                                <a target="blank" data-uk-tooltip="{pos:'top'}" title="Report Nilai Pengetahuan" href="<?=base_url('cetak/cetak_ki3/' . $kl . '/' . $mp->id_mapel . '/' . $ta->id_tahunajaran . ' ')?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report KI3</a>
                            </td>
                            <td>
                                <a href="<?=base_url('admin/rekap_nilai_ki4/' . $kl . '/' . $mp->id_mapel . '/' . $ta->id_tahunajaran . ' ')?>" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Rekap Nilai KI-4</a>

                                <a target="blank" data-uk-tooltip="{pos:'top'}" title="Report Nilai Keterampilan" href="<?=base_url('cetak/cetak_ki4/' . $kl . '/' . $mp->id_mapel . '/' . $ta->id_tahunajaran . ' ')?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report KI4</a>
                            </td>
                        </tr>
                    <?php
}
        } else {
            if ($jb == $mp->id_mapel) {?>

            <tr>
                <td><?=$no++;?></td>
                <td><?=$mp->nm_mapel?></td>
                <td>
                    <a href="<?=base_url('admin/rekap_nilai_ki3/' . $kl . '/' . $mp->id_mapel . '/' . $ta->id_tahunajaran . ' ')?>" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Rekap Nilai KI-3</a>

                    <a target="blank" data-uk-tooltip="{pos:'top'}" title="Report Nilai Pengetahuan" href="<?=base_url('cetak/cetak_ki3/' . $kl . '/' . $mp->id_mapel . '/' . $ta->id_tahunajaran . ' ')?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report KI3</a>
                </td>
                <td>
                    <a href="<?=base_url('admin/rekap_nilai_ki4/' . $kl . '/' . $mp->id_mapel . '/' . $ta->id_tahunajaran . ' ')?>" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Rekap Nilai KI-4</a>

                    <a target="blank" data-uk-tooltip="{pos:'top'}" title="Report Nilai Keterampilan" href="<?=base_url('cetak/cetak_ki4/' . $kl . '/' . $mp->id_mapel . '/' . $ta->id_tahunajaran . ' ')?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report KI4</a>
                </td>
            </tr>

    <?php }}
    }
    ?>
                    </tbody>
                    </table>

                    </div>
                </div>
            <?php }?>




            </div>
        </div>
    </div>
</div>

