 <?php foreach ($guru->result_array() as $gr) {
    if ($gr['id_guru'] == $akun['id_guru']) {
        ?>
 <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-7-10">
                    <div class="md-card">

                        <div class="user_heading">
                            <div class="user_heading_avatar">
                                <div class="thumbnail">
                                    <img src="<?php echo base_url('images/guru/' . $gr['foto_guru']) ?>" alt="user avatar"/>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $gr['nm_guru']; ?></span><span class="sub-heading"><?php echo $gr['jabatan']; ?></span></h2>
                            </div>
                            <div class="md-fab-wrapper">
                                    <div class="md-fab md-fab-toolbar md-fab-small md-fab-accent">
                                        <i class="material-icons">&#xE8BE;</i>
                                        <div class="md-fab-toolbar-actions">
                                            <button data-uk-tooltip="{pos:'top'}" title="Edit" href="#" data-uk-modal="{target:'#edit_guru_<?php echo $gr['id_guru']; ?>'}"><i class="material-icons md-color-white">create</i></button>
                                            <button data-uk-tooltip="{pos:'top'}" title="Ganti Password" href="#" data-uk-modal="{target:'#ganti_pass_<?php echo $gr['id_guru']; ?>'}"><i class="material-icons md-color-white">vpn_key</i></button>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="user_content">
                                    <?php echo $this->session->flashdata('guru'); ?>
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#">Profil</a></li>
                                <li><a href="#">Jadwal Mengajar</a></li>
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

                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-2">
                                            <ul class="md-list">
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
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $gr['jabatan']; ?></span>
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
                                            </ul>
                                        </div>
                                    </div>

                                </li>
                                <li>
                            <div id="show_jadwal"></div>
                                </li>
                            </ul>
                        </div>
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


    <?php }}?>

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
                            <form action="<?php echo base_url('guru/edit_guru') ?>" method="post" enctype="multipart/form-data">
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
                                        <div class="uk-form-row">
                                            <label>JABATAN</label>
                                            <input class="md-input" name="jabatan" value="<?php echo $gr['jabatan']; ?>" autocomplete="off">
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
            url : '<?=base_url('guru/ganti_pass')?>',
            data : {
                pass_lama:pass_lama,
                pass_baru:pass_baru,
                pass_baru2:pass_baru2,
                id:id,
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

    $("#alert-jadwal").hide();
            tampil_jadwal();
            function tampil_jadwal() {

                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('guru/get_hari')?>',
                    async : false,
                    dataType : 'json',
                    success : function(hr) {
                        var h;
                        var a = "'";
                        var html = '';
                        for(h=0; h<hr.length; h++) {

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
                                                    '<th>Mata Pelajar</th>'+
                                                '</tr>'+
                                                '<tbody>';
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('guru/get_jadwal')?>',
                    async : false,
                    dataType : 'json',
                    success : function(jd) {
                        var i;
                        for(i=0; i<jd.length; i++) {
                            $("#alert-edit-jadwal-"+jd[i].id_jadwal).hide();
                            if (jd[i].hari == hr[h].id_hari && jd[i].guru == <?=$akun['id_guru']?>) {
                                var ja = jd[i].jam_mulai;
                                var jb = jd[i].jam_selesai;
                                            html += '<tr>'+
                                                    '<td>'+ja.substr(0, 5)+' - '+jb.substr(0, 5)+'</td>'+
                                                    '<td>'+jd[i].nm_kelas+'</td>'+
                                                    '<td>'+jd[i].nm_mapel+'</td>'+
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

            sedang_mengajar()
            function sedang_mengajar() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('guru/get_jadwal')?>',
                    async : false,
                    dataType : 'json',
                    success : function(jd) {
                        var waktu = document.getElementById("clock").innerHTML;
                        var i;
                        var a = "'";
                        var html = '';
                        for(i=0; i<jd.length; i++) {
                             if (jd[i].guru == <?=$akun['id_guru']?> && jd[i].nm_hari == thisDay) {
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


        </script>