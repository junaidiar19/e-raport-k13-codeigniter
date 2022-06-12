 <?php foreach ($guru->result_array() as $gr) {
    if ($gr['id_guru'] == $id) {
        ?>
 <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-7-10">
                    <div class="md-card">



                        <!-- <div class="user_heading">
                            <div class="user_heading_avatar">
                                <div class="thumbnail">
                                    <img src="<?php echo base_url() ?>images/guru/<?php echo $gr['foto_guru'] ?>" alt="user avatar"/>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $gr['nm_guru']; ?></span><span class="sub-heading"><?php if ($gr['jabatan'] == 1) {echo "KEPALA SEKOLAH";} else {echo "Guru " . $gr['nm_mapel'];}?></span></h2>
                            </div>
                        <?php if ($akun['level'] == '1') {?>
                            <a data-uk-tooltip="{pos:'top'}" title="Edit" href="#" data-uk-modal="{target:'#edit_guru_<?php echo $gr['id_guru']; ?>'}" class="md-fab md-fab-small md-fab-accent">
                                <i class="material-icons">&#xE150;</i>
                            </a>
                        <?php }?>
<?php if ($akun['level'] == '2') {?>
                            <a data-uk-tooltip="{pos:'top'}" title="Edit" href="#" data-uk-modal="{target:'#edit_guru3_<?php echo $gr['id_guru']; ?>'}" class="md-fab md-fab-small md-fab-accent">
                                <i class="material-icons">&#xE150;</i>
                            </a>
                            <a style="margin-right: 60px;" data-uk-tooltip="{pos:'top'}" title="Ganti Password" href="#" class="md-fab md-fab-small md-fab-accent md-fab-danger" data-uk-modal="{target:'#ganti_pass_<?php echo $gr['id_guru']; ?>'}"><i class="material-icons md-color-white">vpn_key</i></a>
                        <?php }?>
                        </div> -->

                        <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                        <form id="edit-foto-guru">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="<?php echo base_url() ?>images/guru/<?=$gr['foto_guru']?>" alt=""/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="user_avatar_controls">
                                        <span class="btn-file">
                                            <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                            <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                            <input type="file" name="foto_guru" id="user_edit_avatar_control">
                                        </span>
                                        <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                                    </div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname"><?php echo $gr['nm_guru']; ?></span><span class="sub-heading" id="user_edit_position"><?php if ($gr['jabatan'] == 1) {echo "KEPALA SEKOLAH";} else {echo "Guru " . $gr['nm_mapel'];}?></span></h2>
                                </div>

                                <button type="submit" data-uk-tooltip="{pos:'top'}" title="Simpan Foto" style="margin-right:
                                    <?php
if ($akun['level'] == '1') {
            echo "60px;";
        } else {
            echo "120px;";
        }?>
                                 " class="md-fab md-fab-small md-fab-danger" title="Simpan Foto"><i class="material-icons md-color-white">&#xE161;</i></button>

                                 <?php if ($akun['level'] == '1') {?>
                                    <a data-uk-tooltip="{pos:'top'}" title="Edit" href="#" data-uk-modal="{target:'#edit_guru_<?php echo $gr['id_guru']; ?>'}" class="md-fab md-fab-small md-fab-accent">
                                        <i class="material-icons">&#xE150;</i>
                                    </a>
                                <?php }?>
        <?php if ($akun['level'] == '2') {?>
                                    <a data-uk-tooltip="{pos:'top'}" title="Edit" href="#" data-uk-modal="{target:'#edit_guru3_<?php echo $gr['id_guru']; ?>'}" class="md-fab md-fab-small md-fab-accent">
                                        <i class="material-icons">&#xE150;</i>
                                    </a>
                                    <a style="margin-right: 60px;" data-uk-tooltip="{pos:'top'}" title="Ganti Password" href="#" class="md-fab md-fab-small md-fab-accent md-fab-warning" data-uk-modal="{target:'#ganti_pass_<?php echo $gr['id_guru']; ?>'}"><i class="material-icons md-color-white">vpn_key</i></a>
                                <?php }?>
                                </form>
                            </div>

                            <script>
                                $('#edit-foto-guru').submit(function(e) {
                                    e.preventDefault();

                                    $.ajax({
                                        type : "POST",
                                        url : "<?php echo base_url('proses/ganti_foto_guru/') . $gr['id_guru'] ?>",
                                        data : new FormData(this),
                                        processData:false,
                                         contentType:false,
                                         cache:false,
                                         async:false,
                                        success: function(data) {
                                            swal("Berhasil Mengganti Foto", {
                                                icon: "success",
                                            }).then(function() {
                                                location.reload();
                                            })
                                        }
                                    });
                                 });
                            </script>

                        <div class="user_content">
                                    <?php echo $this->session->flashdata('guru'); ?>
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content'}">
                                <li class="uk-active"><a href="#">Profil</a></li>
                                <li><a href="#">Jadwal Mengajar</a></li>
                                <!-- <li><a href="#">Absen</a></li> -->
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher">
                                <li>
                                <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-large-1-2">
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $gr['nip']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">NIP</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $gr['nuptk']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">NUPTK</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $gr['npsp']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">NOMOR PESERTA SERTIFIKAT PENDIDIK</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $gr['gol']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">GOLONGAN</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">
                                                            <?php if ($gr['sk_pertama'] == '') {echo "";} else {
            echo tgl_indo($gr['sk_pertama']);}?>
                                                            </span>
                                                        <span class="uk-text-small uk-text-muted">TMT SK PERTAMA KALI DI ANGKAT</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">
                                                            <?php if ($gr['sk_uk'] == '') {echo "";} else {
            echo tgl_indo($gr['sk_uk']);}?>
                                                        </span>
                                                        <span class="uk-text-small uk-text-muted">TMT SK UNIT KERJA SEKARANG</span>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-2">
                                            <ul class="md-list">

                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php if ($gr['jabatan'] == 1) {echo "KEPALA SEKOLAH";} else {echo "Guru " . $gr['nm_mapel'];}?></span>
                                                        <span class="uk-text-small uk-text-muted">JABATAN</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">
                                                            <?php if ($gr['th_jbkepsek'] == '') {echo "";} else {
            echo tgl_indo($gr['th_jbkepsek']);}?>
                                                        </span>
                                                        <span class="uk-text-small uk-text-muted">TMT JABATAN KEPSEK</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $gr['stfk_guru']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">SERTIFIKASI</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $gr['no_telp']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">TELEPON</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $gr['stt_guru']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">STATUS</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                    <?php foreach ($kelas->result() as $kl) {
            if ($kl->id_kelas == $gr['kelas']) {?>
                                                        <span class="md-list-heading"><?php echo $kl->nm_kelas; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Mengajar di Kelas</span>
                                                    <?php }}?>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </li>

                                <li>
                                    <table>
                                        <tr>
                                            <td style="width: 300px;">
                                    <div class="uk-margin-medium-bottom">
                                        <select class="uk-form-width" id="ta-filter" data-md-selectize-inline>
                                            <option value="">-Tahun Ajaran-</option>
                                            <?php foreach ($tahunajaran->result_array() as $kl) {
            ?>
                                            <option value="<?php echo $kl['id_tahunajaran'] ?>" <?php if ($kl['stt_tahunajaran'] == 'Y') {
                echo "selected";
            }?>><?php echo $kl['nm_tahunajaran'] ?></option>
                                            <?php }?>
                                                    </select>
                                                </div>
                                            </td>

                                            <td style="padding-left: 30px;">
                                                <button onclick="filter_jadwal()" class="md-btn md-btn-warning md-btn-wave-light"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                            <div id="show_jadwal"></div>
                                </li>

                                <li>

                                    <table>
                                        <tr>
                                            <td style="width: 300px;">
                                    <div class="uk-margin-medium-bottom">
                                        <select class="uk-form-width" id="ta-abguru" data-md-selectize-inline>
                                            <option value="">-Tahun Ajaran-</option>
                                            <?php foreach ($tahunajaran->result_array() as $kl) {
            ?>
                                            <option value="<?php echo $kl['id_tahunajaran'] ?>" <?php if ($kl['stt_tahunajaran'] == 'Y') {
                echo "selected";
            }?>><?php echo $kl['nm_tahunajaran'] ?></option>
                                            <?php }?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="width: 200px;">
                                                <div class="uk-margin-medium-bottom">
                                                    <select class="uk-form-width" id="smt-abguru" data-md-selectize-inline>
                                        <option value="">-Semester-</option>
                                        <?php foreach ($smt->result_array() as $kl) {
            ?>
                                        <option value="<?php echo $kl['id_smt'] ?>" <?php if ($kl['stt_smt'] == 'Y') {
                echo "selected";
            }?>><?php echo $kl['nm_smt'] ?></option>
                                        <?php }?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="padding-left: 30px;">
                                                <button onclick="filter_abguru()" class="md-btn md-btn-warning md-btn-wave-light"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="uk-table">
                                        <tr>
                                            <th style="width: 10px;">No. </th>
                                            <th>Bulan</th>
                                            <th>Sakit</th>
                                            <th>Izin</th>
                                            <th>Alpha</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <tbody id="show_abguru"></tbody>
                                    </table>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

<div class="uk-modal" id="tambah_abguru">
      <div class="uk-modal-dialog" style="width: 1000px;">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Tambah Absen</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>

    <div class="tambah-abguru"></div>
    </div>
</div>

<div class="uk-modal" id="edit_abguru">
      <div class="uk-modal-dialog" style="width: 1000px;">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Edit Absen</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>

    <div class="edit-abguru"></div>
    </div>
</div>

                <div class="uk-width-large-3-10">
                    <div class="md-card md-card-primary">
                        <div class="md-card-content">
                                <div class="uk-grid">
                                    <div class="uk-width-medium-10-10">
                                        <h5>Informasi Jadwal Sedang Mengajar Hari ini :</h5>
                                    </div>
                                </div>
                            <hr>

                            <div id="show-mengajar"></div>
                            <!-- <div class="uk-text-center" id="stt_jd">--Sedang Kosong--</div> -->
                            <span style="color: white;" id="clock"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <?php foreach ($guru->result_array() as $gr) {
            ?>
        <div class="uk-modal" id="edit_guru_<?php echo $gr['id_guru']; ?>">
                          <div class="uk-modal-dialog" style="width: 1000px;">
                            <div class="uk-modal-header">
                                <div class="uk-grid">
                                    <div class="uk-width-7-10">
                                        <h3 class="uk-modal-title">Edit Data Guru</h3>
                                    </div>
                                    <div class="uk-width-3-10 uk-text-right">
                                        <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <form action="<?php echo base_url('admin/edit_guru2/') . $gr['id_guru'] ?>" method="post">
                                <input type="hidden" name="id_guru" value="<?php echo $gr['id_guru']; ?>">
                                <div class="uk-grid">
                                    <div class="uk-width-5-10">
                                        <div class="uk-form-row">
                                            <label>Nama</label>
                                            <input class="md-input" name="nm_guru" value="<?php echo $gr['nm_guru']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>NIP</label>
                                            <input class="md-input" name="nip" value="<?php echo $gr['nip']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>NUPTK</label>
                                            <input class="md-input" value="<?php echo $gr['nuptk']; ?>" name="nuptk" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>NOMOR PESERTA SERTIFIKAT PENDIDIK</label>
                                            <input class="md-input" value="<?php echo $gr['npsp']; ?>" name="npsp" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>GOLONGAN</label>
                                            <input class="md-input" name="gol" value="<?php echo $gr['gol']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>TMT SK PERTAMA KALI DI ANGKAT</label>
                                            <input type="date" class="md-input" name="sk_pertama" value="<?php echo $gr['sk_pertama']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>TMT SK UNIT KERJA SEKARANG</label>
                                            <input type="date" class="md-input" name="sk_uk" value="<?php echo $gr['sk_uk']; ?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="uk-width-5-10">
                                        <div class="uk-margin-medium-bottom">
                                            <select name="jabatan" class="uk-form-width" data-md-selectize-inline>
                                                <option value="">- Jabatan -</option>
                                                <?php foreach ($mapel->result_array() as $mp) {
                ?>
                                                <option value="<?php echo $mp['id_mapel'] ?>" <?php if ($mp['id_mapel'] == $gr['jabatan']) {
                    echo "selected";
                }?>><?php echo $mp['nm_mapel'] ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="uk-form-row">
                                            <label>TMT JABATAN KEPSEK</label>
                                            <input type="date" class="md-input" name="th_jbkepsek" value="<?php echo $gr['th_jbkepsek']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>SERTIFIKASI</label><br><br>
                                                <span class="icheck-inline">
                                                    <input type="radio" name="stfk_guru" id="ya" value="YA" <?php if ($gr['stfk_guru'] == 'YA') {
                echo "checked";
            }?> data-md-icheck required="" />
                                                    <label for="ya" class="inline-label">YA</label>
                                                </span>
                                                <span class="icheck-inline">
                                                    <input type="radio" name="stfk_guru" id="tidak" value="TIDAK" <?php if ($gr['stfk_guru'] == 'TIDAK') {
                echo "checked";
            }?> data-md-icheck required="" />
                                                    <label for="tidak" class="inline-label">TIDAK</label>
                                                </span>
                                        </div>
                                        <div class="uk-form-row">
                                            <label>TELEPON</label>
                                            <input class="md-input" name="no_telp" value="<?php echo $gr['no_telp']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>STATUS</label><br><br>
                                                <span class="icheck-inline">
                                                    <input type="radio" name="stt_guru" id="PNS" value="PNS" <?php if ($gr['stt_guru'] == 'PNS') {
                echo "checked";
            }?> data-md-icheck required="" />
                                                    <label for="PNS" class="inline-label">PNS</label>
                                                </span>
                                                <span class="icheck-inline">
                                                    <input type="radio" name="stt_guru" id="HONOR" value="HONOR" <?php if ($gr['stt_guru'] == 'HONOR') {
                echo "checked";
            }?> data-md-icheck required="" />
                                                    <label for="HONOR" class="inline-label">HONOR</label>
                                                </span>
                                        </div>

                                        <br>

                                        <label>Mengajar di kelas</label>
                                        <div class="uk-margin-medium-bottom">
                                            <select name="kelas" class="uk-form-width" data-md-selectize-inline>
                                                <option value="">-Silahkan Pilih-</option>
                                                 <?php foreach ($kelas->result_array() as $mp) {
                ?>
            <option value="<?php echo $mp['id_kelas'] ?>" <?php if ($mp['id_kelas'] == $gr['kelas']) {
                    echo "selected";
                }?>><?php echo $mp['nm_kelas']; ?></option>

                                                <?php }?>
                                            </select>
                                        </div>

                                        <label>Wali kelas</label>
                                        <div class="uk-margin-medium-bottom">
                                            <select name="wali_kelas" class="uk-form-width" data-md-selectize-inline>
                                                <option value="">-Silahkan Pilih-</option>
                                                 <?php
$kelas2 = $this->db->query("SELECT * FROM tb_kelas LIMIT 6");
            foreach ($kelas2->result_array() as $mp) {
                ?>
            <option value="<?php echo $mp['id_kelas'] ?>" <?php if ($mp['id_kelas'] == $gr['wali_kelas']) {
                    echo "selected";
                }?>><?php echo $mp['nm_kelas']; ?></option>

                                                <?php }?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                            <div class="uk-text-right">
                                <input type="reset" class="md-btn md-btn-danger" value="Reset">
                                <input type="submit" class="md-btn md-btn-primary" value="Simpan">
                            </div>
                    </form>
            </div>
        </div>
        <?php }?>

<?php foreach ($hari->result() as $hr) {
            ?>
<div class="uk-modal" id="tambah_jadwal_<?=$hr->id_hari?>">
                          <div class="uk-modal-dialog" style="width: 1000px;">
                            <div class="uk-modal-header">
                                <div class="uk-grid">
                                    <div class="uk-width-7-10">
                                        <h3 class="uk-modal-title">Tambah Jadwal Mengajar</h3>
                                    </div>
                                    <div class="uk-width-3-10 uk-text-right">
                                        <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
            <div id='alert-jadwal-<?=$hr->id_hari?>'>
                <div class='uk-alert uk-alert-success' data-uk-alert>
                    <a href='#' class='uk-alert-close uk-close'></a>
                            <i class='fas fa-check-circle'>&nbsp;</i>
                            Berhasil Menambahkan Jadwal
                </div>
              </div>
                                <input type="hidden" id="guru-<?=$hr->id_hari?>" value="<?=$id?>">
                                        <input type="hidden" id="hari-<?=$hr->id_hari?>" value="<?=$hr->id_hari?>">

                                        <div class="uk-grid">
                                            <div class="uk-width-5-10">
                                                <div class="uk-form-row">
                                                    <label>Jam Mulai</label>
                                                    <input type="time" class="md-input" id="jam_mulai-<?=$hr->id_hari?>" value="00:00" required="" autocomplete="off">
                                                </div>
                                                <div class="uk-form-row">
                                                    <label>Jam Selesai</label>
                                                    <input type="time" class="md-input" id="jam_selesai-<?=$hr->id_hari?>" value="00:00" required="" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="uk-width-5-10">
                                                <div class="uk-margin-medium-bottom">
                                                <select id="kelas-<?=$hr->id_hari?>" class="uk-form-width" required="" data-md-selectize-inline>
                                                        <option value="">-Kelas-</option>
                                                        <?php foreach ($kelas->result_array() as $kl) {?>
                                                        <option value="<?php echo $kl['id_kelas'] ?>"><?php echo $kl['nm_kelas'] ?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>

                                                <div class="uk-margin-medium-bottom">
                                                    <select id="mapel-<?=$hr->id_hari?>" class="uk-form-width" required="" data-md-selectize-inline>
                                                        <option value="">-Mata Pelajaran-</option>
                                                        <?php foreach ($mapel->result_array() as $kl) {
                if ($kl['id_mapel'] != 1 && $kl['id_mapel'] != 2) {?>
                                                        <option value="<?php echo $kl['id_mapel'] ?>"><?php echo $kl['nm_mapel'] ?></option>
                                                        <?php }}?>
                                                    </select>
                                                </div>

                                            </div>
                                        </div><br>

                                    <div class="uk-text-right">
                                        <input type="reset" class="md-btn md-btn-small md-btn-danger" value="Reset">
                                        <input onclick="tambah_jadwal(<?=$hr->id_hari?>)" type="submit" class="md-btn md-btn-small md-btn-primary" value="Simpan">
                                    </div>
            </div>
        </div>
<?php }?>

 <?php foreach ($guru->result_array() as $gr) {
            ?>
        <div class="uk-modal" id="edit_guru3_<?php echo $gr['id_guru']; ?>">
                          <div class="uk-modal-dialog" style="width: 1000px;">
                            <div class="uk-modal-header">
                                <div class="uk-grid">
                                    <div class="uk-width-7-10">
                                        <h3 class="uk-modal-title">Edit Data Guru</h3>
                                    </div>
                                    <div class="uk-width-3-10 uk-text-right">
                                        <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <form action="<?php echo base_url('admin/edit_guru3/') . $gr['id_guru'] ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_guru" value="<?php echo $gr['id_guru']; ?>">
                                <div class="uk-grid">
                                    <div class="uk-width-5-10">
                                        <div class="uk-form-row">
                                            <label>Nama</label>
                                            <input class="md-input" name="nm_guru" value="<?php echo $gr['nm_guru']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>NIP</label>
                                            <input class="md-input" name="nip" value="<?php echo $gr['nip']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>NUPTK</label>
                                            <input class="md-input" value="<?php echo $gr['nuptk']; ?>" name="nuptk" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>NOMOR PESERTA SERTIFIKAT PENDIDIK</label>
                                            <input class="md-input" value="<?php echo $gr['npsp']; ?>" name="npsp" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>GOLONGAN</label>
                                            <input class="md-input" name="gol" value="<?php echo $gr['gol']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>TMT SK PERTAMA KALI DI ANGKAT</label>
                                            <input class="md-input mask-date" name="sk_pertama" value="<?php echo $gr['sk_pertama']; ?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="uk-width-5-10">

                                        <div class="uk-form-row">
                                            <label>TMT SK UNIT KERJA SEKARANG</label>
                                            <input class="md-input mask-date" name="sk_uk" value="<?php echo $gr['sk_uk']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-margin-medium-bottom">
                                            <select name="jabatan" class="uk-form-width" data-md-selectize-inline>
                                                <option value="">- Jabatan -</option>
                                                <?php foreach ($mapel->result_array() as $mp) {
                if ($mp['id_mapel'] != 1) {
                    ?>
                                                <option value="<?php echo $mp['id_mapel'] ?>" <?php if ($mp['id_mapel'] == $gr['jabatan']) {
                        echo "selected";
                    }?>><?php echo $mp['nm_mapel'] ?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                        <div class="uk-form-row">
                                            <label>TMT JABATAN KEPSEK</label>
                                            <input class="md-input mask-date" name="th_jbkepsek" value="<?php echo $gr['th_jbkepsek']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>SERTIFIKASI</label><br><br>
                                                <span class="icheck-inline">
                                                    <input type="radio" name="stfk_guru" id="ya" value="YA" <?php if ($gr['stfk_guru'] == 'YA') {
                echo "checked";
            }?> data-md-icheck required="" />
                                                    <label for="ya" class="inline-label">YA</label>
                                                </span>
                                                <span class="icheck-inline">
                                                    <input type="radio" name="stfk_guru" id="tidak" value="TIDAK" <?php if ($gr['stfk_guru'] == 'TIDAK') {
                echo "checked";
            }?> data-md-icheck required="" />
                                                    <label for="tidak" class="inline-label">TIDAK</label>
                                                </span>
                                        </div>
                                        <div class="uk-form-row">
                                            <label>TELEPON</label>
                                            <input class="md-input" name="no_telp" value="<?php echo $gr['no_telp']; ?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>Foto</label><br>
                                            <input type="file" name="foto_guru" value="<?php echo $gr['foto_guru']; ?>">
                                            <?php echo $gr['foto_guru']; ?>
                                        </div><br>

                                    </div>
                                </div>

                            <div class="uk-text-right">
                                <input type="reset" class="md-btn md-btn-danger" value="Reset">
                                <input type="submit" class="md-btn md-btn-primary" value="Simpan">
                            </div>
                    </form>
            </div>
        </div>
        <?php }?>


<div class="uk-modal" id="edit_jadwal">
      <div class="uk-modal-dialog" style="width: 1000px;">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Edit Jadwal Mengajar</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>

    <div class="modal-body"></div>
    </div>
</div>


            <?php foreach ($jadwal->result() as $jd) {
            ?>
<div class="uk-modal" id="edit_jadwal_filter_<?=$jd->id_jadwal?>">
                          <div class="uk-modal-dialog" style="width: 1000px;">
                            <div class="uk-modal-header">
                                <div class="uk-grid">
                                    <div class="uk-width-7-10">
                                        <h3 class="uk-modal-title">Edit Jadwal Mengajar</h3>
                                    </div>
                                    <div class="uk-width-3-10 uk-text-right">
                                        <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                <div id='alert-edit-jadwal-filter-<?=$jd->id_jadwal?>'>
                    <div class='uk-alert uk-alert-primary' data-uk-alert>
                                <a href='#' class='uk-alert-close uk-close'></a>
                                        <i class='fas fa-check-circle'>&nbsp;</i>
                                        Berhasil Mengedit Jadwal
                            </div>
                </div>
                        <input type="hidden" id="jadwal2-<?=$jd->id_jadwal?>" value="<?=$jd->id_jadwal?>">

                                <div class="uk-grid">
                                    <div class="uk-width-5-10">

                                        <div class="uk-form-row">
                                            <label>Jam Mulai</label>
                                            <input type="time" class="md-input" id="jam_mulai2-<?=$jd->id_jadwal?>" value="<?=$jd->jam_mulai?>" autocomplete="off">
                                        </div>
                                        <div class="uk-form-row">
                                            <label>Jam Selesai</label>
                                            <input type="time" class="md-input" id="jam_selesai2-<?=$jd->id_jadwal?>" value="<?=$jd->jam_selesai?>" autocomplete="off">
                                        </div>

                                    </div>
                                    <div class="uk-width-5-10">

                                        <div class="uk-margin-medium-bottom">
                                            <select id="kelas2-<?=$jd->id_jadwal?>" class="uk-form-width" data-md-selectize-inline>
                                                <option value="">-Select-</option>
                                                <?php foreach ($kelas->result_array() as $kl) {
                ?>
                                                <option value="<?php echo $kl['id_kelas'] ?>" <?php if ($kl['id_kelas'] == $jd->kelas) {
                    echo "selected";
                }?>><?php echo $kl['nm_kelas'] ?></option>
                                                <?php }?>
                                              </select>
                                        </div>
                                        <div class="uk-margin-medium-bottom">
                                            <select id="mapel2-<?=$jd->id_jadwal?>" class="uk-form-width" data-md-selectize-inline>
                                                <option value="">-Select-</option>
                                                <?php foreach ($mapel->result_array() as $mp) {
                if ($mp['id_mapel'] != 1 && $mp['id_mapel'] != 2) {
                    ?>
                                                <option value="<?php echo $mp['id_mapel'] ?>" <?php if ($mp['id_mapel'] == $jd->mapel) {
                        echo "selected";
                    }?>><?php echo $mp['nm_mapel'] ?></option>
                                                <?php }}?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <div class="uk-text-right">
                                <input type="reset" class="md-btn md-btn-danger" value="Reset">
                                <input type="submit" onclick="edit_jadwal_filter(<?=$jd->id_jadwal?>)" class="md-btn md-btn-primary" value="Simpan">
                            </div>
                        </div>
                    </div>
            <?php }?>

            <?php foreach ($tahunajaran->result_array() as $tj) {
            if ($tj['stt_tahunajaran'] == 'Y') {?>
                <input type="hidden" id="id_tj" value="<?=$tj['id_tahunajaran']?>">
            <?php }}?>

            <?php foreach ($smt->result_array() as $tj) {
            if ($tj['stt_smt'] == 'Y') {?>
                <input type="hidden" id="id_smt" value="<?=$tj['id_smt']?>">
            <?php }}?>


 <?php foreach ($guru->result_array() as $gr) {
            ?>

     <div class="uk-modal" id="ganti_pass_<?php echo $gr['id_guru']; ?>">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <div class="uk-grid">
                    <div class="uk-width-7-10">
                        <h3 class="uk-modal-title">Ganti Password</h3>
                    </div>
                    <div class="uk-width-3-10 uk-text-right">
                        <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <hr>
            </div>
            <div id="alert_<?php echo $gr['id_guru']; ?>"></div>
                <div class="uk-form-row">
                    <label>Password Lama</label>
                    <input type="password" class="md-input" id="pass_lama_<?php echo $gr['id_guru']; ?>" autocomplete="off">
                </div>

                <div class="uk-form-row">
                    <label>Password Baru</label>
                    <input type="password" class="md-input" id="pass_baru_<?php echo $gr['id_guru']; ?>" autocomplete="off">
                </div>

                <div class="uk-form-row">
                    <label>Ulangi Password Baru</label>
                    <input type="password" class="md-input" id="pass_baru2_<?php echo $gr['id_guru']; ?>" autocomplete="off">
                </div>

                <br>

            <div class="uk-text-right">
                <button type="button" id="close_<?php echo $gr['id_guru']; ?>" class="md-btn md-btn-flat uk-modal-close">Close</button>
                <button type="submit" class="md-btn md-btn-primary" onclick="ganti_pass(<?php echo $gr['id_guru']; ?>)">Simpan</button>
            </div>
        </div>
    </div>

<?php }?>


      <script>

        function ganti_pass(id) {

        var pass_lama = $("#pass_lama_"+id).val();
        var pass_baru = $("#pass_baru_"+id).val();
        var pass_baru2 = $("#pass_baru2_"+id).val();
        var alert = document.getElementById("alert_"+id);

        $.ajax({
            type : 'post',
            url : '<?=base_url('admin/ganti_pass/' . $akun['id_akun'])?>',
            data : {
                pass_lama:pass_lama,
                pass_baru:pass_baru,
                pass_baru2:pass_baru2,
            },
            success : function(data) {
                alert.innerHTML = data;
//                 if (data == '\n'+'error') {
// alert.innerHTML = "<div class='uk-alert uk-alert-danger' data-uk-alert><a href='#' class='uk-alert-close uk-close'></a><i class='fas fa-close'>&nbsp;</i>Password lama yang anda masukkan salah</div>";
//                 } else if (data == '\n'+'gagal') {
// alert.innerHTML = "<div class='uk-alert uk-alert-warning' data-uk-alert><a href='#' class='uk-alert-close uk-close'></a><i class='fas fa-info'>&nbsp;</i>Password baru tidak sesuai</div>";
//                 } else if (data == '\n'+'sukses') {
// alert.innerHTML = "<div class='uk-alert uk-alert-success' data-uk-alert><a href='#' class='uk-alert-close uk-close'></a><i class='fas fa-check-circle'>&nbsp;</i>Berhasil mengganti password</div>";
//     document.querySelector('#close_'+id).click();
//                 }

            }
        })
    }

var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
var date = new Date();
var thisDay = date.getDay(),
    thisDay = myDays[thisDay];

    tampilkanwaktu();
    function tampilkanwaktu() {

        var time = new Date();
        var sh = time.getHours() + "";
        var sm = time.getMinutes() + "";
        var ss = time.getSeconds() + "";
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }

    var id_tj = document.getElementById('id_tj').value;
    var id_smt = document.getElementById('id_smt').value;

            tampil_jadwal();
            function tampil_jadwal() {

                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('admin/get_hari')?>',
                    async : false,
                    dataType : 'json',
                    success : function(hr) {
                        var h;
                        var a = "'";
                        var html = '';
                        for(h=0; h<hr.length; h++) {
                            $("#alert-jadwal-"+hr[h].id_hari).hide();

                            html += '<div class="md-card">'+
                                        '<div class="md-card-content">'+
                                        '<div class="uk-grid" style="margin-bottom: 5px;">'+
                                            '<div class="uk-width-7-10">'+
                                                '<h4>'+hr[h].nm_hari+' :</h4>'+
                                            '</div>'+
                                            '<div class="uk-width-3-10 uk-text-right">'+
                                            <?php if ($akun['id_akun'] == 1) {?>
                        '<a data-uk-modal="{target:'+a+'#tambah_jadwal_'+hr[h].id_hari+''+a+'}" class="md-btn md-btn-primary md-btn-small md-btn-wave-light"><i class="fas fa-plus-circle"></i></a>'+
                    <?php }?>
                                            '</div>'+
                                        '</div>'+
                                            '<table class="uk-table" border="1">'+
                                                '<tr>'+
                                                    '<th>Jam Mulai - Selesai</th>'+
                                                    '<th>Kelas</th>'+
                                                    '<th>Mapel</th>'+
                                                    <?php if ($akun['id_akun'] == 1) {?>
                                                    '<th>Aksi</th>'+
                                                <?php }?>
                                                '</tr>'+
                                                '<tbody>';
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('admin/get_jadwal')?>',
                    async : false,
                    dataType : 'json',
                    success : function(jd) {
                        var i;
                        for(i=0; i<jd.length; i++) {
                            $("#alert-edit-jadwal-"+jd[i].id_jadwal).hide();

                            if (jd[i].hari == hr[h].id_hari && jd[i].guru == <?=$id?> && jd[i].ta == id_tj) {
                                var ja = jd[i].jam_mulai;
                                var jb = jd[i].jam_selesai;
                                            html += '<tr>'+
                                                    '<td>'+ja.substr(0, 5)+' - '+jb.substr(0, 5)+'</td>'+
                                                    '<td>'+jd[i].nm_kelas+'</td>'+
                                                    '<td>'+jd[i].nm_mapel+'</td>'+
                                                    <?php if ($akun['id_akun'] == 1) {?>
                                                    '<td>'+
                        '<a data-uk-tooltip="{pos:top}" title="Hapus" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_jadwal('+jd[i].id_jadwal+')"><i class="feather icon-trash"></i></a>'+
                        '<a data-uk-tooltip="{pos:top}" onclick="modal_edit('+jd[i].id_jadwal+')" title="Edit" data-uk-modal="{target:'+a+'#edit_jadwal'+a+'}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>'+
                                                    '</td>'+
                                                <?php }?>
                                                '</tr>';
                        }
                        }
                    }
                });
                html +=
                        '</tbody>'+
                    '</table>'+
                '</div>'+
            '</div>';

            }
            $('#show_jadwal').html(html);

        }
      })
    }

    function modal_edit(id) {
        $.ajax({
            type : 'post',
            url : '<?=base_url('admin/modal_edit')?>',
            data : {id:id},
            success: function(data) {
                $(".modal-body").html(data);
            }
        })
    }

            sedang_mengajar()
            function sedang_mengajar() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('admin/get_jadwal')?>',
                    async : false,
                    dataType : 'json',
                    success : function(jd) {
                        var waktu = document.getElementById("clock").innerHTML;
                        var i;
                        var a = "'";
                        var html = '';
                        for(i=0; i<jd.length; i++) {
                             if (jd[i].guru == <?=$id?> && jd[i].nm_hari == thisDay) {
                                var jam1 = jd[i].jam_mulai.substring(0,5);
                                var jam2 = jd[i].jam_selesai.substring(0,5);
                        if (waktu>=jam1 && waktu<=jam2) {
                                html +=
                                '<table class="uk-table">'+
                                    '<tr>'+
                                        '<td>Jam</td>'+
                                        '<td>:</td>'+
                                        '<td>'+jam1+' - '+jam2+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Kelas</td>'+
                                        '<td>:</td>'+
                                        '<td>'+jd[i].nm_kelas+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Mapel</td>'+
                                        '<td>:</td>'+
                                        '<td>'+jd[i].nm_mapel+'</td>'+
                                    '</tr>'+
                                '</table>';
                            }
                        }
                        }
                        $('#show-mengajar').html(html);
                    }
                });
                setTimeout(function() {
                  sedang_mengajar();
                }, 500);

            }

                 function tambah_jadwal(id) {

                    var guru = $("#guru-"+id).val();
                    var hari = $("#hari-"+id).val();
                    var jam_mulai = $("#jam_mulai-"+id).val();
                    var jam_selesai = $("#jam_selesai-"+id).val();
                    var mapel = $("#mapel-"+id).val();
                    var kelas = $("#kelas-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('admin/tambah_jadwal') ?>',
                        data : {
                            jam_mulai:jam_mulai,
                            jam_selesai:jam_selesai,
                            mapel:mapel,
                            kelas:kelas,
                            guru:guru,
                            hari:hari,
                        },
                        success: function(data) {
                            tampil_jadwal();
                            $("#alert-jadwal-"+id).slideDown('slow');
                            $("#alert-jadwal-"+id).slideUp('slow');
                        }
                    })
                }

    function edit_jadwal(id) {

                    var jadwal = $("#jadwal-"+id).val();
                    var jam_mulai = $("#jam_mulai-"+id).val();
                    var jam_selesai = $("#jam_selesai-"+id).val();
                    var mapel = $("#mapel-"+id).val();
                    var kelas = $("#kelas-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('admin/edit_jadwal') ?>',
                        data : {
                            jam_mulai:jam_mulai,
                            jam_selesai:jam_selesai,
                            mapel:mapel,
                            kelas:kelas,
                            jadwal:jadwal,
                        },
                        success: function(data) {
                            tampil_jadwal();
                            $("#alert-edit-jadwal-"+id).slideDown('slow');
                            $("#alert-edit-jadwal-"+id).slideUp('slow');
                        }
                    })
                }

      function hapus_jadwal(id) {

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
                        url : '<?php echo base_url('admin/hapus_jadwal') ?>',
                        data : {id:id},
                        success: function(data) {
                            tampil_jadwal();
                                swal("Berhasil Menghapus Data", {
                                    icon: "success",
                                })
                        }
                    })
                }
             });
    }

    function filter_jadwal() {

                    var ta_filter = document.getElementById('ta-filter').value;

                    if (ta_filter == id_tj) {
                        tampil_jadwal();
                    } else {

                    tampil_filter();
            function tampil_filter() {

                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('admin/get_hari')?>',
                    async : false,
                    dataType : 'json',
                    success : function(hr) {
                        var h;
                        var a = "'";
                        var html = '';
                        for(h=0; h<hr.length; h++) {
                            $("#alert-jadwal-"+hr[h].id_hari).hide();

                            html += '<div class="md-card">'+
                                        '<div class="md-card-content">'+
                                        '<div class="uk-grid" style="margin-bottom: 5px;">'+
                                            '<div class="uk-width-7-10">'+
                                                '<h4>'+hr[h].nm_hari+' :</h4>'+
                                            '</div>'+
                                            '<div class="uk-width-3-10 uk-text-right">'+
                                            '</div>'+
                                        '</div>'+
                                            '<table class="uk-table" border="1">'+
                                                '<tr>'+
                                                    '<th>Jam Mulai - Selesai</th>'+
                                                    '<th>Kelas</th>'+
                                                    '<th>Mapel</th>'+
                                                    '<th>Aksi</th>'+
                                                '</tr>'+
                                                '<tbody>';
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('admin/get_jadwal')?>',
                    async : false,
                    dataType : 'json',
                    success : function(jd) {
                        var i;
                        for(i=0; i<jd.length; i++) {
                            $("#alert-edit-jadwal-filter-"+jd[i].id_jadwal).hide();

                            if (jd[i].hari == hr[h].id_hari && jd[i].guru == <?=$id?> && jd[i].ta == ta_filter) {
                                var ja = jd[i].jam_mulai;
                                var jb = jd[i].jam_selesai;
                                            html += '<tr>'+
                                                    '<td>'+ja.substr(0, 5)+' - '+jb.substr(0, 5)+'</td>'+
                                                    '<td>'+jd[i].nm_kelas+'</td>'+
                                                    '<td>'+jd[i].nm_mapel+'</td>'+
                                                    '<td>'+
                        '<a data-uk-tooltip="{pos:top}" title="Hapus" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_jadwal_filter('+jd[i].id_jadwal+')"><i class="feather icon-trash"></i></a>'+
                        '<a data-uk-tooltip="{pos:top}" title="Edit" data-uk-modal="{target:'+a+'#edit_jadwal_filter_'+jd[i].id_jadwal+''+a+'}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>'+
                                                    '</td>'+
                                                '</tr>';
                            }
                        }
                    }
                });
                html +=
                        '</tbody>'+
                    '</table>'+
                '</div>'+
            '</div>';
            }
            $('#show_jadwal').html(html);

        }
      })
    }
}
}

    function edit_jadwal_filter(id) {

                    var jadwal = $("#jadwal2-"+id).val();
                    var jam_mulai = $("#jam_mulai2-"+id).val();
                    var jam_selesai = $("#jam_selesai2-"+id).val();
                    var mapel = $("#mapel2-"+id).val();
                    var kelas = $("#kelas2-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('admin/edit_jadwal') ?>',
                        data : {
                            jam_mulai:jam_mulai,
                            jam_selesai:jam_selesai,
                            mapel:mapel,
                            kelas:kelas,
                            jadwal:jadwal,
                        },
                        success: function(data) {
                            filter_jadwal();
                            $("#alert-edit-jadwal-filter-"+id).slideDown('slow');
                            $("#alert-edit-jadwal-filter-"+id).slideUp('slow');
                        }
                    })
                }

      function hapus_jadwal_filter(id) {

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
                        url : '<?php echo base_url('admin/hapus_jadwal') ?>',
                        data : {id:id},
                        success: function(data) {
                                filter_jadwal();
                                swal("Berhasil Menghapus Data", {
                                    icon: "success",
                                })
                        }
                    })
                }
             });
    }

                tampil_abguru();
                function tampil_abguru() {
                        $.ajax({
                            type : 'ajax',
                            url : '<?=base_url('admin/get_abguru/') . $id?>',
                            success: function(data) {
                                $("#show_abguru").html(data);
                            }
                        })
                    }

                    function filter_abguru() {

                    var ta_abguru = document.getElementById('ta-abguru').value;
                    var smt_abguru = document.getElementById('smt-abguru').value;

                    if (ta_abguru == id_tj && smt_abguru == id_smt) {
                        tampil_abguru();
                    } else {

                    show_filter_abguru();
            function show_filter_abguru() {

                $.ajax({
                    type : 'post',
                    url : '<?=base_url('admin/get_abguru_filter')?>',
                    data : {
                        ta_abguru:ta_abguru,
                        smt_abguru:smt_abguru,
                    },
                    success : function(data) {
                    $('#show_abguru').html(data);
        }
      })
    }
}
}


            function key_sakit(id) {
                if (!isNaN($("#sakit-"+id).val()) && !isNaN($("#izin-"+id).val()) && !isNaN($("#alpha-"+id).val())) {
                  total = parseInt($("#sakit-"+id).val()) + parseInt($("#izin-"+id).val()) + parseInt($("#alpha-"+id).val());
                  $("#jumlah-"+id).val(total);
                }
            }

            function key_izin(id) {
                if (!isNaN($("#sakit-"+id).val()) && !isNaN($("#izin-"+id).val()) && !isNaN($("#alpha-"+id).val())) {
                  total = parseInt($("#sakit-"+id).val()) + parseInt($("#izin-"+id).val()) + parseInt($("#alpha-"+id).val());
                  $("#jumlah-"+id).val(total);
                }
            }

            function key_alpha(id) {
                if (!isNaN($("#sakit-"+id).val()) && !isNaN($("#izin-"+id).val()) && !isNaN($("#alpha-"+id).val())) {
                  total = parseInt($("#sakit-"+id).val()) + parseInt($("#izin-"+id).val()) + parseInt($("#alpha-"+id).val());
                  $("#jumlah-"+id).val(total);
                 }
            }

                function tambah_abguru(id) {
                        $.ajax({
                        type : 'post',
                        url : '<?=base_url('admin/get_tambah_abguru')?>',
                        data : {id:id},
                        success: function(data) {
                            $(".tambah-abguru").html(data);
                        }
                    })
                }

                function edit_abguru(id) {
                        $.ajax({
                        type : 'post',
                        url : '<?=base_url('admin/get_edit_abguru')?>',
                        data : {id:id},
                        success: function(data) {
                            $(".edit-abguru").html(data);
                        }
                    })
                }

                function edit_abguru_filter(id) {
                        $.ajax({
                        type : 'post',
                        url : '<?=base_url('admin/get_edit_abguru_filter')?>',
                        data : {id:id},
                        success: function(data) {
                            $(".edit-abguru").html(data);
                        }
                    })
                }

                function submit_abguru(id) {

                    var sakit = $("#sakit-"+id).val();
                    var izin = $("#izin-"+id).val();
                    var alpha = $("#alpha-"+id).val();
                    var jumlah = $("#jumlah-"+id).val();
                    var guru = '<?=$id?>';
                    var ab = $("#ab-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('admin/tambah_abguru') ?>',
                        data : {
                            sakit:sakit,
                            izin:izin,
                            alpha:alpha,
                            jumlah:jumlah,
                            guru:guru,
                            ab:ab,
                        },
                        success: function(data) {
                            tampil_abguru();
                            $("#alert-tambah-abguru-"+id).slideDown('slow');
                            $("#alert-tambah-abguru-"+id).slideUp('slow');
                        }
                    })
                }

                function ubah_abguru(id) {

                    var abguru = $("#abguru-"+id).val();
                    var sakit = $("#sakit-"+id).val();
                    var izin = $("#izin-"+id).val();
                    var alpha = $("#alpha-"+id).val();
                    var jumlah = $("#jumlah-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('admin/edit_abguru') ?>',
                        data : {
                            sakit:sakit,
                            izin:izin,
                            alpha:alpha,
                            jumlah:jumlah,
                            abguru:abguru,
                        },
                        success: function(data) {
                            tampil_abguru();
                            $("#alert-edit-abguru-"+id).slideDown('slow');
                            $("#alert-edit-abguru-"+id).slideUp('slow');
                        }
                    })
                }

                    function hapus_abguru(id) {

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
                                    url : '<?php echo base_url('admin/hapus_abguru') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        tampil_abguru();
                                            swal("Berhasil Menghapus Data", {
                                                icon: "success",
                                            })
                                    }
                                })
                            }
                         });
                }

                function submit_abguru_filter(id) {

                    var sakit = $("#sakit-"+id).val();
                    var izin = $("#izin-"+id).val();
                    var alpha = $("#alpha-"+id).val();
                    var jumlah = $("#jumlah-"+id).val();
                    var guru = '<?=$id?>';
                    var ab = $("#ab-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('admin/tambah_abguru') ?>',
                        data : {
                            sakit:sakit,
                            izin:izin,
                            alpha:alpha,
                            jumlah:jumlah,
                            guru:guru,
                            ab:ab,
                        },
                        success: function(data) {
                            filter_abguru();
                            $("#alert-tambah-abguru-"+id).slideDown('slow');
                            $("#alert-tambah-abguru-"+id).slideUp('slow');
                        }
                    })
                }

                function ubah_abguru_filter(id) {

                    var abguru = $("#abguru-"+id).val();
                    var sakit = $("#sakit-"+id).val();
                    var izin = $("#izin-"+id).val();
                    var alpha = $("#alpha-"+id).val();
                    var jumlah = $("#jumlah-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('admin/edit_abguru') ?>',
                        data : {
                            sakit:sakit,
                            izin:izin,
                            alpha:alpha,
                            jumlah:jumlah,
                            abguru:abguru,
                        },
                        success: function(data) {
                            filter_abguru();
                            $("#alert-edit-abguru-"+id).slideDown('slow');
                            $("#alert-edit-abguru-"+id).slideUp('slow');
                        }
                    })
                }

                    function hapus_abguru_filter(id) {

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
                                    url : '<?php echo base_url('admin/hapus_abguru') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        filter_abguru();
                                            swal("Berhasil Menghapus Data", {
                                                icon: "success",
                                            })
                                    }
                                })
                            }
                         });
                }

        </script>

    <?php }}?>

