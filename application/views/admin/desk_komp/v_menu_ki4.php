<div id="page_content">
    <div id="page_content_inner">


   <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-1-1">

                <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-7-10">
                            <h3>Daftar Kelas KI4 - Keterampilan</h3>
                        </div>
                        <div class="uk-width-medium-3-10 uk-text-right">

                        </div>
                    </div><hr>

                    <table id="dt_default" class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
$no = 1;
foreach ($kelas->result() as $kl) {
    if ($kl->id_kelas != 7) {?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$kl->nm_kelas . '&nbsp;' . $kl->huruf_kl?></td>
                            <td>
                                <a data-uk-tooltip="{pos:'top'}" title="" href="<?php echo base_url('admin/desk_ki4/') . $kl->id_kelas ?>" class="md-btn md-btn-primary md-btn-small md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Detail</a>
                                <a target="_blank" data-uk-tooltip="{pos:'top'}" title="Report Deskripsi KI4"
                                href="<?=base_url('cetak/cetak_desk_ki4/' . $kl->id_kelas)?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report Deskripsi KI4</a>
                            </td>
                        </tr>
                    <?php }}?>
                    </tbody>

                </table>


                </div>
            </div>
        </div>

    </div>

</div>

</div>

