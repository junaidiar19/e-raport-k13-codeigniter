<div id="page_content">
    <div id="page_content_inner">


   <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-1-1">

                <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-7-10">
                            <h3>Data Ekskul</h3>
                        </div>
                        <div class="uk-width-medium-3-10 uk-text-right">

                        </div>
                    </div><hr>

                    <div class="uk-grid">
                        <div class="uk-width-medium-6-10">

                            <?php echo $this->session->flashdata('ekskul_siswa') ?>
                                            <div class="table-responsive">
                                                <table class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>

                                                            <th>No</th>
                                                            <th>Ekskul</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
$no = 1;
foreach ($ekskul_siswa->result() as $data) {?>
                                                        <tr>
                                                            <td><?=$no++?></td>
                                                            <td><?=$data->nm_ekskul?></td>
                                                            <td>

                                                                <a data-uk-tooltip="{pos:'top'}" title="Hapus Ekskul" onclick="hapus_ekskul_siswa(<?=$data->id_ekskul_siswa?>)" class="md-btn md-btn-danger md-btn-wave-light md-btn-small"><i class="fas fa-trash"></i></a>

                                                                <a data-uk-tooltip="{pos:'top'}" title="Edit Ekskul" data-uk-modal="{target:'#edit_ekskul_siswa_<?=$data->id_ekskul_siswa?>'}" class="md-btn md-btn-success md-btn-wave-light md-btn-small"><i class="fas fa-edit"></i></a>

                                                            </td>
                                                        </tr>
                                                    <?php }?>

                                                    </tbody>
                                                </table>
                                            </div>

                        </div>
                        <div class="uk-width-medium-4-10">
                            <h5>Form Tambah Ekskul</h5>
                            <form action="<?=base_url('admin/tambah_ekskul_siswa')?>" method="post">

                                <div class="uk-form-row">
                                    <label>Nama Ekskul</label>
                                    <input class="md-input" name="nm_ekskul" autocomplete="off">
                                </div>
                                <br>

                                <div class="uk-text-right">
                                    <button class="md-btn md-btn-primary md-btn-wave-light uk-text-right">Simpan</button>
                                    </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

</div>

</div>



<?php
foreach ($ekskul_siswa->result() as $mp) {
    ?>
<div class="uk-modal" id="edit_ekskul_siswa_<?php echo $mp->id_ekskul_siswa; ?>">
                                <div class="uk-modal-dialog" style="width: 700px;">
                                    <div class="uk-modal-header">
                                        <div class="uk-grid">
                                            <div class="uk-width-7-10">
                                                <h3 class="uk-modal-title">Edit Ekskul</h3>
                                            </div>
                                            <div class="uk-width-3-10 uk-text-right">
                                                <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                                                  <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <form action="<?php echo base_url('admin/edit_ekskul_siswa/' . $mp->id_ekskul_siswa) ?>" method="post">

                                        <div class="uk-form-row">
                                            <label>Nama Ekskul</label>
                                            <input class="md-input" name="nm_ekskul" value="<?=$mp->nm_ekskul?>" autocomplete="off">
                                        </div>

                                        <br>

                                    <div class="uk-text-right">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        <input type="submit" class="md-btn md-btn-primary" value="Simpan">
                                    </div>
                                        </form>
                                </div>
                            </div>
<?php }?>

<script>
     function hapus_ekskul_siswa(id) {

        swal({
                title: "Yakin Menghapus Data?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('admin/hapus_ekskul_siswa') ?>',
                        data : {id:id},
                        success: function(data) {
                                swal("Berhasil Menghapus Data", {
                                    icon: "success",
                                }).then(function() {
                                    location.reload();
                                })
                        }
                    })
                }
             });

    }
</script>
