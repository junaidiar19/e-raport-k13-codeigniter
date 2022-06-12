
<div id="page_content">
    <div id="page_content_inner">


<div class="uk-grid uk-grid-medium hierarchical_show" data-uk-grid-margin>
    <?php foreach ($sklh->result_array() as $sh) {
    ?>
    <div class="uk-width-3-10">

                    <div class="md-card md-card-hover-img">
                        <div class="md-card-head uk-text-center uk-position-relative" style="border-bottom: none;">
                            <img class="md-card-head-img" style="margin-top: 5px;" src="<?php echo base_url() ?>images/<?=$sh['logo']?>" alt=""/>
                        </div>
                        <div class="md-card-content">
                            <h4 class="uk-text-center"><?=$sh['nama_sklh']?></h4><hr>
                            <p><b>Kepala Sekolah :</b></p>
                            <?php foreach ($guru->result_array() as $gr) {
        if ($gr['id_guru'] == $sh['kepsek']) {?>
                            <table class="uk-table">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><b><?php echo $gr['nm_guru']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td>:</td>
                                    <td><b><?php echo $gr['nip']; ?></b></td>
                                </tr>
                            </table>
                        <?php }}?>
                        <div class="uk-grid">
                            <div class="uk-width-7-10"><p><b>Tahun Ajaran :</b></p></div>
                            <div class="uk-width-3-10 uk-text-right">

                            <?php if ($akun['level'] == '1') {?>
                                <a data-uk-tooltip="{pos:top}" title="Kelola Tahun Ajaran" data-uk-modal="{target:'#kelola_tahunajaran'}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="fas fa-edit"></i></a>
                            <?php }?>

                            </div>
                        </div>
                            <table class="uk-table">
                                <tr>
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td><b id="tahun-ta"></b></td>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>

    <div class="uk-width-7-10">
        <div class="md-card">
                        <div class="md-card-content">
                            <?php echo $this->session->flashdata('skl'); ?>
                            <ul id="user_edit_tabs" class="uk-tab" data-uk-tab="{connect:'#user_edit_tabs_content'}">
                                    <li class="uk-active"><a href="#">Profil</a></li>
                                    <?php if ($akun['level'] == '1') {?>
                                    <li><a href="#">Edit</a></li>
                                <?php }?>
                            </ul>
                            <ul id="user_edit_tabs_content" class="uk-switcher uk-margin">
                                    <li>
                                        <table class="uk-table">
                                <tr>
                                    <td>
                                        <ul class="md-list md-list-addon">
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">star_rate</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['ns_sklh']?></span>
                                                    <span class="uk-text-small uk-text-muted">No Statistik Sekolah</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">location_on</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['alamat']?></span>
                                                    <span class="uk-text-small uk-text-muted">Alamat</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['telp']?></span>
                                                    <span class="uk-text-small uk-text-muted">Telepon</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">mail_outline</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['kode_pos']?></span>
                                                    <span class="uk-text-small uk-text-muted">Kode Pos</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">location_on</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['kelurahan']?></span>
                                                    <span class="uk-text-small uk-text-muted">Kelurahan</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">location_on</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['kelurahan']?></span>
                                                    <span class="uk-text-small uk-text-muted">Kelurahan</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">star_rate</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['akreditasi']?></span>
                                                    <span class="uk-text-small uk-text-muted">Akreditasi</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="md-list md-list-addon">
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">location_on</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['kecamatan']?></span>
                                                    <span class="uk-text-small uk-text-muted">Kecamatan</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">location_on</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['kabupaten']?></span>
                                                    <span class="uk-text-small uk-text-muted">Kabupaten</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">location_on</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['provinsi']?></span>
                                                    <span class="uk-text-small uk-text-muted">Provinsi</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">web</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['website']?></span>
                                                    <span class="uk-text-small uk-text-muted">Website</span>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><?=$sh['email']?></span>
                                                    <span class="uk-text-small uk-text-muted">Email</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                                </li>

                                <li>
                            <form action="<?php echo base_url('admin/edit_sekolah/' . $sh['kepsek']) ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_sekolah" value="<?=$sh['id_sekolah']?>">
                                    <table class="uk-table">
                                <tr>
                                    <td>
                                        <div class="uk-form-row">
                                            <label>Nama Sekolah</label>
                                          <input class="md-input" name="nama_sklh" value="<?=$sh['nama_sklh']?>" autocomplete="off">
                                        </div>

                                        <div class="uk-form-row">
                                            <label>No Statistik Sekolah</label>
                                          <input class="md-input" name="ns_sklh" value="<?=$sh['ns_sklh']?>" autocomplete="off">
                                        </div>

                                        <div class="uk-form-row">
                                            <label>Alamat</label>
                                            <input name="alamat" class="md-input" value="<?=$sh['alamat']?>" autocomplete="off">
                                        </div>

                                        <div class="uk-form-row">
                                            <label>Telpon</label>
                                          <input class="md-input" name="telp" value="<?=$sh['telp']?>" autocomplete="off">
                                        </div>

                                        <div class="uk-form-row">
                                            <label>Kode Pos</label>
                                          <input class="md-input" name="kode_pos" value="<?=$sh['kode_pos']?>" autocomplete="off">
                                        </div>

                                        <div class="uk-form-row">
                                            <label>Kelurahan</label>
                                          <input class="md-input" name="kelurahan" value="<?=$sh['kelurahan']?>" autocomplete="off">
                                        </div>
                                        <br>
                                            <label>Logo Sekolah</label>
                                        <div class="uk-form-row">
                                          <input type="file" class="md-input" name="logo" value="<?=$sh['logo']?>">
                                          <?=$sh['logo']?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="uk-form-row">
                                            <label>Kecamatan</label>
                                          <input class="md-input" name="kecamatan" value="<?=$sh['kecamatan']?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>Kabupaten</label>
                                          <input class="md-input" name="kabupaten" value="<?=$sh['kabupaten']?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>Provinsi</label>
                                          <input class="md-input" name="provinsi" value="<?=$sh['provinsi']?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>Website</label>
                                          <input class="md-input" name="website" value="<?=$sh['website']?>" autocomplete="off">
                                        </div>

                                        <div class="uk-form-row">
                                            <label>Email</label>
                                          <input class="md-input" name="email" value="<?=$sh['email']?>" autocomplete="off">
                                        </div>

                                        <div class="uk-form-row">
                                            <label>Akreditasi</label>
                                          <input class="md-input" name="akreditasi" value="<?=$sh['akreditasi']?>"
                                        onkeyup="this.value = this.value.toUpperCase()" autocomplete="off">
                                        </div>

                                <div class="uk-form-row">
                                        <label>Kepala Sekolah</label>
                                    <select id="select_demo_1" name="kepsek" data-md-selectize required="">
                                        <option value="">-Select-</option>
                                        <?php foreach ($guru->result_array() as $gr) {
        if ($gr['akun'] != 1) {
            ?>
                                        <option value="<?php echo $gr['id_guru'] ?>" <?php if ($gr['id_guru'] == $sh['kepsek']) {
                echo "selected";
            }?>><?php echo $gr['nm_guru'] ?></option>
                                        <?php }}?>
                                      </select>
                                </div>


                                    </td>
                                </tr>

                            </table>

                            <div class="uk-text-right">
                                <input type="reset"  value="Reset" class="md-btn md-btn-danger">
                                   <input  name="simpan" value="Simpan" type="submit" class="md-btn md-btn-primary">
                            </div>
                            </form>
                                </li>
                            </ul>


                        </div>

                    </div>

            </div>
 <?php }?>
            </div>





    </div>
</div>

<div class="uk-modal" id="kelola_tahunajaran">
            <div class="uk-modal-dialog">
                <div class="uk-modal-header">
                    <div class="uk-grid">
                        <div class="uk-width-7-10">
                            <h3 class="uk-modal-title">Kelola Tahun Ajaran</h3>
                        </div>
                        <div class="uk-width-3-10 uk-text-right">
                            <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                    <hr>
                </div>

                <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
                    <li class="uk-active"><a href="#">Status</a></li>
                    <li><a href="#">Kelola</a></li>
                </ul>

                <ul id="tabs_1" class="uk-switcher uk-margin">
                    <!-- <li id="show-data-ta-stt"> -->
                        <li>

                        <table class="uk-table">
                            <tr>
                                <th>#</th>
                                <th>Tahun Ajaran</th>
                                <th>Status</th>
                            </tr>
                            <!-- <tbody id=""> -->
                                <?php
$no = 1;
foreach ($tj->result() as $ta) {
    ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$ta->nm_tahunajaran?>
                                    <p id="alert-update-ta-<?=$ta->id_tahunajaran?>" style="color: red; display: none;">Matikan dulu status yang ada !</p>
                                </td>
                                <td>
                                    <input type="checkbox" value="<?=$ta->id_tahunajaran?>" data-switchery data-switchery-size="large" <?php if ($ta->stt_tahunajaran == 'Y') {
        echo "checked";
    }?> id="update-stt-ta-<?=$ta->id_tahunajaran?>" />
                                </td>
                            </tr>

                        <?php
if ($ta->stt_tahunajaran == 'Y') {
        echo '<input type="hidden" id="id_stt_y" value="' . $ta->id_tahunajaran . '">';
        echo '<input type="hidden" id="stt_y" value="' . $ta->stt_tahunajaran . '">';
    }
}?>
                            <!-- </tbody> -->

                        </table>
                    </li>
                    <li>
                        <div class="uk-text-right">
            <button onclick="tambah_ta()" class="md-btn md-btn-primary md-btn-small md-btn-wave-light"><i class="fas fa-plus-circle"></i></button>
            </div>

            <div id="form-tambah-ta" style="display: none;">
                <table class='uk-table'>
                    <tr>
                        <td>
                            <input type="text" class="md-input" placeholder="Tahun Ajaran" id="nm_tahunajaran_s" autocomplete="off">
                        </td>
                        <td>
                            <input type="number" class="md-input" placeholder="Tahun" id="tahun_s" autocomplete="off">
                        </td>
                        <td>
                            <input type="number" class="md-input" placeholder="Semester" id="smt_s" autocomplete="off">
                        </td>
                    </tr>
                </table>
                <div class="uk-text-right">
                    <button onclick="simpan_ta()" class="md-btn md-btn-primary md-btn-small md-btn-wave-light"><i class="fas fa-save">&nbsp;</i>Simpan</button>
                </div>
            </div>

            <div id="form-edit-ta"></div>
                        <table class="uk-table">
                            <tr>
                                <th>#</th>
                                <th>Tahun Ajaran</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Aksi</th>
                            </tr>
                            <tbody id="show-data-ta"></tbody>
                        </table>
                    </li>
                </ul>

                </div>
            </div>


<script>

    function tambah_ta() {
        $("#form-tambah-ta").slideDown('slow');
        $("#form-edit-ta").slideUp('slow');
    }

        tampil_data_ta();
        function tampil_data_ta() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_ta')?>',
                    success: function(data) {
                        $("#show-data-ta").html(data);
                    }
                })
            }

        tampil_data_ta_stt();
        function tampil_data_ta_stt() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_ta_stt')?>',
                    success: function(data) {
                        $("#show-data-ta-stt").html(data);
                        // console.log(data);
                    }
                })
            }

        function simpan_ta() {
            var ta = $("#nm_tahunajaran_s").val();
            var th = $("#tahun_s").val();
            var smt = $("#smt_s").val();



            $.ajax({
                type : 'post',
                url : '<?=base_url('proses/simpan_ta')?>',
                data : {ta:ta,th:th,smt:smt},
                success : function(data) {
                    tampil_data_ta();
                    $("#nm_tahunajaran_s").val("");
                    $("#tahun_s").val("");
                    $("#smt_s").val("");
                }
            })
        }

        function ubah_ta(id) {
            $("#form-edit-ta").slideDown('slow');
                $.ajax({
                    type : 'post',
                    url : '<?=base_url('proses/form_edit_ta')?>',
                    data : {id:id},
                    success: function(data) {
                        $("#form-edit-ta").html(data);
                        $("#form-tambah-ta").slideUp('slow');
                    }
                })
            }

            function edit_ta(id) {
            var ta = $("#nm_tahunajaran_s-"+id).val();
            var th = $("#tahun_s-"+id).val();
            var smt = $("#smt_s-"+id).val();
            var id = $("#id_tahunajaran_s-"+id).val();

                $.ajax({
                    type : 'post',
                    url : '<?=base_url('proses/edit_ta')?>',
                    data : {ta:ta,th:th,smt:smt,id:id},
                    success: function(data) {
                        tampil_data_ta();
                    }
                })
            }

    function hapus_ta(id) {

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
                        url : '<?php echo base_url('proses/hapus_ta') ?>',
                        data : {id:id},
                        success: function(data) {
                            tampil_data_ta();
                            $("#form-tambah-ta").slideUp('slow');
                            $("#form-edit-ta").slideUp('slow');
                                swal("Berhasil Menghapus Data", {
                                    icon: "success",
                                })
                        }
                    })
                }
             });

    }

        tampil_ta();
        function tampil_ta() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_stt_ta')?>',
                    success: function(data) {
                        $("#tahun-ta").html(data);
                    }
                })
            }


   <?php
foreach ($tj->result() as $ta) {?>

            $("#update-stt-ta-<?=$ta->id_tahunajaran?>").on("change", function () {
                    // var id_ = $("#id_stt_y").val();
                    // var stt_ = 'N';
                    var val = $(this).val();
                    // $("#alert-update-ta-<?=$ta->id_tahunajaran?>").slideDown("slow");
                    var apply = $(this).is(':checked') ? 'Y' : 'N';

                    // var id = [id_, val];
                    // var stt = [stt_, apply];
                    // console.log(id);
                    // console.log(stt);


                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('proses/update_stt_ta')?>",
                        data: {val: val, apply: apply},
                        success: function(data) {
                            console.log(data);
                            tampil_ta();
                        }
                    });
            });

<?php }?>

</script>

