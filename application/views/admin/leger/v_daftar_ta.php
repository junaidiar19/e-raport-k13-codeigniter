<div id="page_content">
    <div id="page_content_inner">

	<div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-1-1">

                <div class="md-card">
                <div class="md-card-content">
                            <h3>Pilih Tahun Ajaran Yang Tersedia</h3>
                        <hr>

                <table id="dt_default" class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
$no = 1;
foreach ($taj as $tj) {?>
                        <tr style="background: <?php if ($tj->stt_tahunajaran == 'Y') {echo "yellow";}?>">
                            <td><?=$no++?></td>
                            <td><?=$tj->nm_tahunajaran?></td>
                            <td>
                                <a data-uk-tooltip="{pos:'top'}" title="" href="<?php echo base_url('admin/detail_leger/') . $id . '/' . $tj->id_tahunajaran ?>" class="md-btn md-btn-primary md-btn-small md-btn-wave-light"><i class="fas fa-list">&nbsp;</i>Leger</a>

                                <a target="blank" data-uk-tooltip="{pos:'top'}" title="Report Data Leger" target="blank" href="<?=base_url('cetak/cetak_leger/' . $id . '/' . $tj->id_tahunajaran)?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report Leger</a>


                            </td>
                        </tr>
                    <?php }?>
                    </tbody>

                </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

