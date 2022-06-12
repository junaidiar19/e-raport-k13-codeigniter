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
                        <div class="uk-width-medium-3-10 uk-text-right">
                        <a data-uk-modal="{target:'#tambah_desk'}" class="md-btn md-btn-primary md-btn-wave-light"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div><hr>
                    <?php echo $this->session->flashdata('desk') ?>
                    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#pills-tab a[href="' + activeTab + '"]').tab('show');
        }
    });
    </script> -->
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <ul class="uk-tab" id="pills-tab" data-uk-tab="{connect:'#tabs_1'}">
                                <li class="uk-active"><a data-toggle="pill" href="#pills-satu">Semester I</a></li>
                                <li><a data-toggle="pill" href="#pills-dua">Semester II</a></li>
                            </ul>
                            <ul id="tabs_1" class="uk-switcher uk-margin">
                                <li id="pills-satu">
                                 <?php
foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        ?>
                    <div class="uk-accordion" data-uk-accordion>
    <h3 class="uk-accordion-title"><?=$mp->nm_mapel?></h3>
                                <div class="uk-accordion-content">
                                    <table class="uk-table">
<?php
$no = 1;
        foreach ($desk_ki3->result() as $ds) {
            if ($ds->mapel == $mp->id_mapel && $ds->smt == 1 && $ds->kelas == $id) {?>
                                        <tr>
                                            <td>3.<?=$no++?></td>
                                            <td><?=$ds->desk_ki3?></td>
                                            <td>
                                                <a data-uk-tooltip="{pos:'top'}" title="Hapus" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_desk_ki3(<?=$ds->id_desk_ki3?>)"><i class="feather icon-trash"></i></a>
                                                <a data-uk-tooltip="{pos:'top'}" title="Edit" href="#" data-uk-modal="{target:'#edit_desk_ki3_<?=$ds->id_desk_ki3?>'}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php }}?>

                                    </table>
                                </div>

                        </div>
<?php }}?>
                                </li>
                                <li id="pills-dua">
                                     <?php
foreach ($mapel->result() as $mp) {
    if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
        ?>
                    <div class="uk-accordion" data-uk-accordion>
    <h3 class="uk-accordion-title"><?=$mp->nm_mapel?></h3>
                                <div class="uk-accordion-content">
                                    <div class="table-responsive">
                                    <table class="uk-table">
<?php
$no = 1;
        foreach ($desk_ki3->result() as $ds) {
            if ($ds->mapel == $mp->id_mapel && $ds->smt == 2 && $ds->kelas == $id) {?>
                                        <tr>
                                            <td>3.<?=$no++?></td>
                                            <td><?=$ds->desk_ki3?></td>
                                            <td>
                                                <a data-uk-tooltip="{pos:'top'}" title="Hapus" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_desk_ki3(<?=$ds->id_desk_ki3?>)"><i class="feather icon-trash"></i></a>
                                                <a data-uk-tooltip="{pos:'top'}" title="Edit" href="#" data-uk-modal="{target:'#edit_desk_ki3_<?=$ds->id_desk_ki3?>'}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php }}?>

                                    </table>
                                </div>
                            </div>
                        </div>
<?php }}?>
                                </li>
                            </ul>
                        </div>
                    </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




   <div class="uk-modal" id="tambah_desk">
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-header">
                                        <div class="uk-grid">
                                            <div class="uk-width-7-10">
                                                <h3 class="uk-modal-title">Tambah Deskrisi Kompetensi</h3>
                                            </div>
                                            <div class="uk-width-3-10 uk-text-right">
                                                <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                                                  <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <form action="<?php echo base_url('admin/tambah_desk_ki3/' . $id) ?>" method="post">

                    <div class="uk-margin-medium-bottom">
                        <select onchange="cek_mapel(this.value)" class="uk-form-width" data-md-selectize-inline>
                            <option value="">-Mapel-</option>
                            <?php foreach ($mapel->result_array() as $mp) {
    if ($mp['id_mapel'] != 1 && $mp['id_mapel'] != 2) {?>
                            <option value="<?php echo $mp['id_mapel'] ?>"><?php echo $mp['nm_mapel'] ?></option>
                            <?php }}?>
                        </select>
                    </div>

                    <div class="uk-margin-medium-bottom">
                        <select onchange="cek_smt(this.value)" class="uk-form-width" data-md-selectize-inline>
                            <option value="">-Semester-</option>
                            <?php foreach ($smt->result_array() as $sm) {?>
                            <option value="<?php echo $sm['id_smt'] ?>"><?php echo $sm['nm_smt'] ?></option>
                            <?php }?>
                        </select>
                    </div><br>

                <div id="alert">
<div class='uk-alert uk-alert-danger' data-uk-alert>
                <a href='#' class='uk-alert-close uk-close'></a>
                        <i class='fas fa-info'></i>
                        Pilih mata pelajaran dan semester dulu
                      </div>
</div>

                <input type="hidden" name="mapel[]" class="mapel">
                <input type="hidden" name="smt[]" class="smt">
                <input type="hidden" name="kelas[]" value="<?=$id?>">

                <button type="button" class="md-btn md-btn-small md-btn-primary md-btn-wave-light" onclick="tambah()"><i class="fas fa-plus-circle"></i></button>
                <button type="button" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="resetForm()"><i class="fas fa-minus-circle"></i></button><br><br>

                <div class="uk-form-row">
                    <label>1. Deskripsi</label>
                    <input class="md-input" name="desk_ki3[]" required="" autocomplete="off">
                </div><br>

                    <div id="insert-form"></div>
                    <input type="hidden" id="jumlah-form" value="1"><br>


                                    <div class="uk-text-right">
                                        <input type="reset" class="md-btn md-btn-danger" value="Reset">
                                        <input type="submit" class="md-btn md-btn-primary" value="Simpan">
                                    </div>
                                        </form>
                                </div>
                            </div>


<?php
foreach ($desk_ki3->result() as $ds) {
    ?>
<div class="uk-modal" id="edit_desk_ki3_<?=$ds->id_desk_ki3?>">
                                <div class="uk-modal-dialog" style="width: 700px;">
                                    <div class="uk-modal-header">
                                        <div class="uk-grid">
                                            <div class="uk-width-7-10">
                                                <h3 class="uk-modal-title">Edit Deskrisi Kompetensi</h3>
                                            </div>
                                            <div class="uk-width-3-10 uk-text-right">
                                                <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                                                  <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <form action="<?php echo base_url('admin/edit_desk_ki3/' . $id) ?>" method="post">

                                        <input type="hidden" name="id" value="<?=$ds->id_desk_ki3?>">
                                        <div class="uk-form-row">
                                            <label>Deskripsi</label>
                                            <input class="md-input" name="desk_ki3" value="<?=$ds->desk_ki3?>" autocomplete="off">
                                        </div>

                                    <div class="uk-text-right">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        <input type="submit" class="md-btn md-btn-primary" value="Simpan">
                                    </div>
                                        </form>
                                </div>
                            </div>
<?php }?>

<script type="text/javascript">
    $("#alert").hide();

            function tambah() {

              var jumlah = parseInt($("#jumlah-form").val());
              var nextform = jumlah + 1;
              var pl = $('.mapel').val();
              var sm = $(".smt").val();
              if (pl == '' && sm == '') {
              $("#alert").show(200);
  } else {
              $("#jumlah-form").val(nextform);

                  $("#insert-form").append(
                    '<input type="hidden" name="mapel[]" value="'+pl+'" />'+
                '<div class="uk-form-row">'+
            '<div class="md-input-wrapper"><label>'+nextform+'. Deskripsi</label><input class="md-input" name="desk_ki3[]" required="" autocomplete="off"><span class="md-input-bar"></span></div>'+
                '</div><br>'+
                '<input type="hidden" name="smt[]" value="'+sm+'">'+
                '<input type="hidden" name="kelas[]" value="<?=$id?>">'
                    );

              $("#jumlah-form").val(nextform);

    function resetForm() {
        $("#insert-form").html("");
        $("#jumlah-form").val("1");
    }
 }

}

   function cek_mapel(id){
              $("#alert").hide();
              $('.mapel').val(id);
    }

    function cek_smt(id){
              $('.smt').val(id);
    }

    function hapus_desk_ki3(id) {

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
                        url : '<?php echo base_url('admin/hapus_desk_ki3') ?>',
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