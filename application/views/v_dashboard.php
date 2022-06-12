
<div id="page_content">
    <div id="page_content_inner">


<div class="uk-grid uk-grid-medium hierarchical_show" data-uk-grid-margin>
    <?php foreach ($sklh->result_array() as $sh) {
    ?>
    <div class="uk-width-3-10">

                    <div class="md-card md-card-hover-img">
                        <div class="md-card-head uk-text-center uk-position-relative" style="border-bottom: none;">
                            <img class="md-card-head-img" src="<?php echo base_url() ?>images/<?=$sh['logo']?>" alt=""/>
                        </div>
                        <div class="md-card-content">
                            <h4 class="uk-text-center"><?=$sh['nama_sklh']?></h4><hr>
                            <p>Kepala Sekolah :</p>
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
                           <p><b>Tahun Ajaran :</b></p>
                            <table class="uk-table">
                                <tr>
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td><b id="tahun-ta"></b></td>
                                </tr>
                                <tr>
                                    <td>Semester</td>
                                    <td>:</td>
                                    <td><b id="smt-ta"></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

                <script>
                    tampil_ta();
                    function tampil_ta() {
                        $.ajax({
                            type : 'ajax',
                            url : '<?=base_url('guru/get_ta')?>',
                            async : false,
                            dataType : 'json',
                            success : function(ta) {
                                var t;
                                for (t=0; t<ta.length; t++) {
                                    if (ta[t].stt_tahunajaran == 'Y') {
                                        document.getElementById("tahun-ta").innerHTML = ta[t].nm_tahunajaran;
                                    }
                                }
                            }
                        });
                        setTimeout(function() {
                            tampil_ta();
                        }, 500)
                    }
                    tampil_smt();
                    function tampil_smt() {
                        $.ajax({
                            type : 'ajax',
                            url : '<?=base_url('guru/get_smt')?>',
                            async : false,
                            dataType : 'json',
                            success : function(smt) {
                                var t;
                                for (t=0; t<smt.length; t++) {
                                    if (smt[t].stt_smt == 'Y') {
                                        document.getElementById("smt-ta").innerHTML = smt[t].nm_smt;
                                    }
                                }
                            }
                        });
                        setTimeout(function() {
                            tampil_smt();
                        }, 500)
                    }
                </script>

    <div class="uk-width-7-10">
        <div class="md-card">
                        <div class="md-card-content">
                            <ul id="user_edit_tabs" class="uk-tab" data-uk-tab="{connect:'#user_edit_tabs_content'}">
                                    <li class="uk-active"><a href="#">Profil</a></li>
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


                            </ul>


                        </div>

                    </div>

            </div>
 <?php }?>
            </div>



        <div class="uk-grid uk-grid-medium hierarchical_show" data-uk-grid-margin>
            <div class="uk-width-1-1">

                <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-7-10">
                            <h3>Mata Pelajaran</h3>
                        </div>
                        <div class="uk-width-medium-3-10 uk-text-right">

                        </div>
                    </div><hr>

                                            <div class="table-responsive">
                                                <table id="dt_default" class="uk-table uk-table-striped" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Mata Pelajaran</th>
                                                            <th>Kode</th>
                                                            <th>KKM KI-3</th>
                                                            <th>KKM KI-4</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="show_mapel">

                                                </tbody>
                                                </table>
                                            </div>

                  </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script>
        tampil_mapel();

        function tampil_mapel(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url('guru/get_mapel') ?>',
                async : false,
                dataType : 'json',
                success : function(mp){
                    var html = '';
                    var i;
                    var no = 1;
                    var a = "'";
                    for(i=0; i<mp.length; i++){

                        html += '<tr>'+
                                '<td>'+no+++'. </td>'+
                                '<td>'+mp[i].nm_mapel+'</td>'+
                                '<td>'+mp[i].kode_mapel+'</td>'+
                                '<td>'+mp[i].ki_3+'</td>'+
                                '<td>'+mp[i].ki_4+'</td>'+
                                '</tr>';
                    }
                    $('#show_mapel').html(html);
                }

            });
        }

</script>
