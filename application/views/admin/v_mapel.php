
<div id="page_content">
    <div id="page_content_inner">


   <div class="uk-grid uk-grid-medium hierarchical_show" data-uk-grid-margin>
            <div class="uk-width-1-1">

                <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-7-10">
                            <h3>Data Mata Pelajaran</h3>
                        </div>
                        <div class="uk-width-medium-3-10 uk-text-right">
                            <?php if ($akun['level'] == '1') {?>
                            <a data-uk-tooltip="{pos:'top'}" title="Tambah Mapel" data-uk-modal="{target:'#tambah_mapel'}" class="md-btn md-btn-primary md-btn-wave-light"><i class="fas fa-plus-circle"></i></a>
                        <?php }?>
                        </div>
                    </div><hr>

                    <?php echo $this->session->flashdata('mapel') ?>
                                            <div class="table-responsive">
                                                <form action="<?php echo base_url('admin/hapus_mapel2') ?>" method="post" id="form-delete">
                                                <table class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <?php if ($akun['level'] == '1') {?>
                                                            <th style="width: 10px;">
                                                                <div class="checkbox checkbox-fill d-inline">
                                                                    <input type="checkbox" name="checkbox-fill-1" id="check-all">
                                                                    <label for="check-all" class="cr"></label>
                                                                </div>
                                                            </th>
                                                        <?php }?>
                                                            <th>No</th>
                                                            <th>Mapel</th>
                                                            <th>Kode</th>
                                                            <th>KKM KI-3</th>
                                                            <th>KKM KI-4</th>
                                                            <?php if ($akun['level'] == '1') {?>
                                                            <th>Aksi</th>
                                                        <?php }?>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="show_mapel"></tbody>
                                                </table>
                                                <?php if ($akun['level'] == '1') {?>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="md-btn md-btn-danger md-btn-wave-light" id="btn-delete" title="Hapus"><i class="feather icon-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            <?php }?>
                                            </form>
                                            </div>

  <script>

         $(document).ready(function(){
            $("#check-all").click(function(){
              if($(this).is(":checked"))
                $(".check-item").prop("checked", true);
              else
                $(".check-item").prop("checked", false);
            });

            $("#btn-delete").click(function(){
              var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?");

              if(confirm)
                $("#form-delete").submit();
            });
          });

    </script>


                  </div>
                </div>

            </div>
        </div>

    </div>
</div>


        <div class="uk-modal" id="tambah_mapel">
                <div class="uk-modal-dialog" style="width: 700px;">
                    <div class="uk-modal-header">
                        <div class="uk-grid">
                            <div class="uk-width-7-10">
                                <h3 class="uk-modal-title">Tambah Mata Pelajaran</h3>
                            </div>
                            <div class="uk-width-3-10 uk-text-right">
                                <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                                  <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <form id="tambah-mapel">

<button type="button" class="md-btn md-btn-small md-btn-primary md-btn-wave-light" onclick="tambah()"><i class="fas fa-plus-circle"></i></button>
<button type="button" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="resetForm()"><i class="fas fa-minus-circle"></i></button><br><br>

        <table class='uk-table'>
            <tr>
              <th>No</th>
                <th style="width: 300px;">Mapel</th>
                <th>Kode</th>
                <th>KKM KI-3</th>
                <th>KKM KI-4</th>
            </tr>
            <tr>
              <td>1. </td>
                <td>
                    <input type="text" class="md-input" name="nm_mapel[]" autocomplete="off">
                </td>
                <td>
                    <input type="text" class="md-input" name="kode_mapel[]" autocomplete="off">
                </td>
                <td>
                    <input type="number" class="md-input" name="ki_3[]" autocomplete="off">
                </td>
                <td>
                    <input type="number" class="md-input" name="ki_4[]" autocomplete="off">
                </td>
            </tr>
        </table>
    <div id="insert-form"></div>
    <input type="hidden" id="jumlah-form" value="1">


                    <div class="uk-text-right">
                        <input type="reset" class="md-btn md-btn-danger" value="Reset">
                        <input type="submit" class="md-btn md-btn-primary" value="Simpan">
                    </div>
                        </form>
                </div>
            </div>


<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script>
        tampil_mapel();

        function tampil_mapel(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url('admin/get_mapel') ?>',
                async : false,
                dataType : 'json',
                success : function(mp){
                    var html = '';
                    var i;
                    var no = 1;
                    var a = "'";
                    for(i=0; i<mp.length; i++){
                        if (mp[i].id_mapel != 1 && mp[i].id_mapel != 2) {

                        html += '<tr>'+
                        <?php if ($akun['level'] == '1') {?>
                                '<td>'+
                                    '<div class="checkbox checkbox-fill d-inline">'+
                         '<input type="checkbox" name="id_mapel[]" value="'+mp[i].id_mapel+'" class="check-item" id="check-'+mp[i]+'">'+
                                        '<label for="check--'+mp[i]+'" class="cr"></label>'+
                                    '</div>'+
                                '</td>'+
                            <?php }?>
                                '<td>'+no+++'. </td>'+
                                '<td>'+mp[i].nm_mapel+'</td>'+
                                '<td>'+mp[i].kode_mapel+'</td>'+
                                '<td>'+mp[i].ki_3+'</td>'+
                                '<td>'+mp[i].ki_4+'</td>'+
<?php if ($akun['level'] == '1') {?>
                                '<td>'+
                                    '<a data-uk-tooltip="{pos:top}" title="Hapus" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_mapel('+mp[i].id_mapel+')"><i class="feather icon-trash"></i></a>'+
                                    '<a data-uk-tooltip="{pos:top}" title="Edit" data-uk-modal="{target:'+a+'#edit_mapel_'+mp[i].id_mapel+''+a+'}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>'+
                                '</td>'+
                            <?php }?>
                                '</tr>';
                    }
                }
                    $('#show_mapel').html(html);
                }

            });
        }

        $("#tambah-mapel").submit(function(e) {
            e.preventDefault()

            var nm_mapel = $("input[name='nm_mapel[]']").map(function()
                      {
                        return $(this).val();
                      }).get();
            var kode_mapel = $("input[name='kode_mapel[]']").map(function()
                          {
                            return $(this).val();
                          }).get();
            var ki_3 = $("input[name='ki_3[]']").map(function()
                          {
                            return $(this).val();
                          }).get();
            var ki_4 = $("input[name='ki_4[]']").map(function()
                          {
                            return $(this).val();
                          }).get();
                $.ajax({
                    type : 'POST',
                    url : '<?php echo base_url('admin/tambah_mapel') ?>',
                    data : {
                        nm_mapel:nm_mapel,
                        kode_mapel:kode_mapel,
                        ki_3:ki_3,
                        ki_4:ki_4,
                    }, success: function(data) {
                        nm_mapel.innerHTML = '';
                        kode_mapel.innerHTML = '';
                        ki_3.innerHTML = '';
                        ki_4.innerHTML = '';
                        tampil_mapel();
                        swal("Berhasil Menambahkan Data", {
                            icon: "success",
                        })
                    }
                })
    })

    function hapus_mapel(id) {

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
                        url : '<?php echo base_url('admin/hapus_mapel') ?>',
                        data : {id:id},
                        success: function(data) {
                            tampil_mapel();
                                swal("Berhasil Menghapus Data", {
                                    icon: "success",
                                })
                        }
                    })
                }
             });

    }

</script>


<script type="text/javascript">

            function tambah() {
              var jumlah = parseInt($("#jumlah-form").val());
              var nextform = jumlah + 1;
              $("#jumlah-form").val(nextform);

                  $("#insert-form").append(
                    '<table class="uk-table">'+
                            '<tr>'+
                              '<td>'+nextform+'. </td>'+
                                '<td style="width: 300px;">'+
                                    '<div class="md-input-wrapper"><input type="text" class="md-input" name="nm_mapel[]" autocomplete="off"><span class="md-input-bar"></span></div>'+
                                '</td>'+
                                '<td>'+
                                    '<div class="md-input-wrapper"><input type="text" class="md-input" name="kode_mapel[]" autocomplete="off"><span class="md-input-bar"></span></div>'+
                                '</td>'+
                                '<td>'+
                                    '<div class="md-input-wrapper"><input type="number" class="md-input" name="ki_3[]" autocomplete="off"><span class="md-input-bar"></span></div>'+
                                '</td>'+
                                '<td>'+
                                    '<div class="md-input-wrapper"><input type="number" class="md-input" name="ki_4[]" autocomplete="off"><span class="md-input-bar"></span></div>'+
                                '</td>'+
                            '</tr>'+
                        "</table>"
                  );

              $("#jumlah-form").val(nextform);
            }

             function resetForm() {
        $("#insert-form").html("");
        $("#jumlah-form").val("1");
    }


        </script>


<?php
foreach ($mapel->result_array() as $mp) {
    ?>
<div class="uk-modal" id="edit_mapel_<?php echo $mp['id_mapel']; ?>">
                                <div class="uk-modal-dialog" style="width: 700px;">
                                    <div class="uk-modal-header">
                                        <div class="uk-grid">
                                            <div class="uk-width-7-10">
                                                <h3 class="uk-modal-title">Edit Mata Pelajaran</h3>
                                            </div>
                                            <div class="uk-width-3-10 uk-text-right">
                                                <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                                                  <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <form action="<?php echo base_url('admin/edit_mapel') ?>" method="post">

                        <table class='uk-table'>
                            <tr>
                                <th style="width: 300px;">Mapel</th>
                                <th>Kode</th>
                                <th>KKM KI-3</th>
                                <th>KKM KI-4</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" name="id_mapel" value="<?=$mp['id_mapel']?>" autocomplete="off">
                                    <input type="text" class="md-input" name="nm_mapel" value="<?=$mp['nm_mapel']?>" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="md-input" name="kode_mapel" value="<?=$mp['kode_mapel']?>" autocomplete="off">
                                </td>
                                <td>
                                    <input type="number" class="md-input" name="ki_3" value="<?=$mp['ki_3']?>" autocomplete="off">
                                </td>
                                <td>
                                    <input type="number" class="md-input" name="ki_4" value="<?=$mp['ki_4']?>" autocomplete="off">
                                </td>
                            </tr>
                        </table>


                                    <div class="uk-text-right">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        <input type="submit" class="md-btn md-btn-primary" value="Simpan">
                                    </div>
                                        </form>
                                </div>
                            </div>
<?php }?>
