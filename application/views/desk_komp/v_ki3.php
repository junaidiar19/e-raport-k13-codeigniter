<div id="page_content">
    <div id="page_content_inner">

	<div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-1-1">

                <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-7-10">
                            <h3>Deskripsi Kompetensi Dasar KI-3 ( Pengetahuan )</h3>
                        </div>
                        <div class="uk-width-medium-3-10 uk-text-right"></div>
                    </div><hr>
 <?php
foreach ($mapel->result() as $mp) {
    ?>
                    <div class="uk-accordion" data-uk-accordion>
    <h3 class="uk-accordion-title"><?=$mp->nm_mapel?></h3>
                                <div class="uk-accordion-content">
                                    <table class="uk-table">
<?php
$no = 1;
    foreach ($desk_ki3->result() as $ds) {
        if ($ds->mapel == $mp->id_mapel) {?>
                                        <tr>
                                            <td>3.<?=$no++?></td>
                                            <td><?=$ds->desk_ki3?></td>
                                        </tr>
                                    <?php }}?>

                                    </table>
                                </div>

                        </div>
<?php }?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

