 <?php foreach ($siswa->result_array() as $sw) {
    if ($sw['id_siswa'] == $id) {
        ?>
 <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-1-1">
                    <div class="md-card">

                        <!-- <div class="user_heading">
                            <div class="user_heading_avatar">
                                <div class="thumbnail">
                                    <img src="<?php echo base_url() ?>images/admin.png" alt="user avatar"/>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $sw['nm_siswa']; ?></span><span class="sub-heading"><?php echo $sw['nisn']; ?></span></h2>
                            </div>
                            <a data-uk-tooltip="{pos:'top'}" title="Edit" href="#" data-uk-modal="{target:'#edit_siswa_<?php echo $sw['id_siswa']; ?>'}" class="md-fab md-fab-small md-fab-accent">
                                <i class="material-icons">&#xE150;</i>
                            </a>
                        </div> -->

                         <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                        <form id="edit-foto-siswa">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="<?php echo base_url() ?>images/siswa/<?=$sw['foto_siswa']?>" alt=""/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div class="user_avatar_controls">
                                        <span class="btn-file">
                                            <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                            <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                            <input type="file" name="foto_siswa" id="user_edit_avatar_control">
                                        </span>
                                        <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                                    </div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname"><?php echo $sw['nm_siswa']; ?></span><span class="sub-heading" id="user_edit_position"><?php echo $sw['nisn']; ?></span></h2>
                                </div>

                                <button type="submit" data-uk-tooltip="{pos:'top'}" title="Simpan Foto" style="margin-right: 60px;" class="md-fab md-fab-small md-fab-danger" title="Simpan Foto"><i class="material-icons md-color-white">&#xE161;</i></button>

                                <a data-uk-tooltip="{pos:'top'}" title="Edit Data" href="#" data-uk-modal="{target:'#edit_siswa_<?php echo $sw['id_siswa']; ?>'}" class="md-fab md-fab-small md-fab-accent">
                                <i class="material-icons">&#xE150;</i></a>
                                </form>
                            </div>

                            <script>
                                $('#edit-foto-siswa').submit(function(e) {
                                    e.preventDefault();

                                    $.ajax({
                                        type : "POST",
                                        url : "<?php echo base_url('proses/ganti_foto_siswa/') . $sw['id_siswa'] ?>",
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
                                    <?php echo $this->session->flashdata('siswa'); ?>
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content'}">

                                <li class="uk-active"><a href="#">Profil</a></li>
                                <li><a href="#">Orang Tua</a></li>
                                <li><a href="#">Kondisi Fisik</a></li>
                                <li><a href="#">Ekstrakurikuler</a></li>
                                <li><a href="#">Prestasi</a></li>
                                <li><a href="#">Absen</a></li>
                                <li><a href="#">Nilai Sikap</a></li>
                                <li><a href="#">Nilai KI3 & KI4</a></li>
                                <li><a href="#">Leger</a></li>
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher">
                                <li>
                                <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-large-1-3">
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['nis']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">NIS</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['nisn']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">NISN</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['jk']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Jenis Kelamin</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['agama']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Agama</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['tempat']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Tempat Lahir</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">
                                                            <?php if ($sw['tanggal_lahir'] == '0000-00-00') {echo "";} else {
            echo tgl_indo($sw['tanggal_lahir']);}?>
                                                            </span>
                                                        <span class="uk-text-small uk-text-muted">Tanggal Lahir</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-3">
                                            <ul class="md-list">

                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['jalan']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Jalan</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['kel']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Kelurahan</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['kec']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Kecamatan</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['kab']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Kabupaten</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['prov']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Provinsi</span>
                                                    </div>
                                                </li>
                                                <!-- <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">navigate_next</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $sw['pdd_sb']; ?></span>
                                                        <span class="uk-text-small uk-text-muted">Pendidikan Terakhir (TK)</span>
                                                    </div>
                                                </li> -->
                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-3">
                                            <ul class="md-list">

                                                <li>
                                                    <div class='uk-alert uk-alert-primary' data-uk-alert>
                                                                <i class='fas fa-chevron-right'>&nbsp;</i>
                                                                Cetak Raport
                                                    </div>
                                                    <a data-uk-tooltip="{pos:'top'}" target="_blank" title="Report R-1" href="<?=base_url('cetak/cetak_r1/' . $id . '/' . $sw['nis'])?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report R-1</a>
                                                    <br>
                                                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                                    <table class="uk-table" style="">
                                                        <tr>
                                                            <th>Tahun Ajaran</th>
                                                            <th></th>
                                                            <th>Report</th>
                                                        </tr>
                                                        <?php
$tjr = $this->db->query("SELECT * FROM tb_tahunajaran");
        foreach ($tjr->result() as $ta) {?>
                                                        <tr>
                                                            <td><?=$ta->nm_tahunajaran?></td>
                                                            <td>:</td>
                                                            <td>
                                                                <a data-uk-tooltip="{pos:'top'}" target="_blank" title="Report R-2" href="<?=base_url('cetak/cetak_r2/' . $id . '/' . $sw['nis'] . '/' . $ta->id_tahunajaran)?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report R-2</a>
                                                            </td>
                                                        </tr>
                                                    <?php }?>
                                                    </table>
                                                </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>



                                </li>
                                <li>
                                    <br>
                                    <div class="uk-text-right">
                                        <div id="btn-ortu"></div>
                                    </div>

                                    <div id="form-tambah-ortu" style="display: none;">
                                        <br>

                                        <div class="uk-grid">
                                            <div class="uk-width-medium-5-10">
                                                <table class="uk-table">
                                                    <tr>
                                                        <th colspan="3" style="text-align: center;">AYAH<hr></th>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td><input class="md-input" id="nm_ayah" autocomplete="off"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pendidikan</td>
                                                        <td>:</td>
                                                        <td>

                                                        <div class="uk-form-row">
                                                            <select class="uk-form-width" id="pdd_ayah" data-md-selectize-inline>
                                                                <option value="">-Pendidikan-</option>
                                                                <?php foreach ($pendidikan->result_array() as $kl) {
            ?>
                                                    <option value="<?php echo $kl['id_pendidikan'] ?>"><?php echo $kl['nm_pendidikan'] ?></option>
                                                                <?php }?>
                                                             </select>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pekerjaan</td>
                                                        <td>:</td>
                                                        <td><input class="md-input" id="pj_ayah" autocomplete="off"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>NIK</td>
                                                        <td>:</td>
                                                        <td><input class="md-input" id="nik_ayah" autocomplete="off"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="uk-width-medium-5-10">
                                                <table class="uk-table">
                                                    <tr>
                                                        <th colspan="3" style="text-align: center;">IBU<hr></th>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td><input class="md-input" id="nm_ibu" autocomplete="off"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pendidikan</td>
                                                        <td>:</td>
                                                        <td>
                                                            <div class="uk-form-row">
                                                            <select class="uk-form-width" id="pdd_ibu" data-md-selectize-inline>
                                                                <option value="">-Pendidikan-</option>
                                                                <?php foreach ($pendidikan->result_array() as $kl) {
            ?>
                                                    <option value="<?php echo $kl['id_pendidikan'] ?>"><?php echo $kl['nm_pendidikan'] ?></option>
                                                                <?php }?>
                                                             </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pekerjaan</td>
                                                        <td>:</td>
                                                        <td><input class="md-input" id="pj_ibu" autocomplete="off"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>NIK</td>
                                                        <td>:</td>
                                                        <td><input class="md-input" id="nik_ibu" autocomplete="off"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="uk-width-medium-5-10">
                                                <table class="uk-table">
                                                    <tr>
                                                        <th colspan="3" style="text-align: center;">WALI<hr></th>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td><input class="md-input" id="nm_wali" autocomplete="off"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pendidikan</td>
                                                        <td>:</td>
                                                        <td>
                                                            <div class="uk-form-row">
                                                            <select class="uk-form-width" id="pdd_wali" data-md-selectize-inline>
                                                                <option value="">-Pendidikan-</option>
                                                                <?php foreach ($pendidikan->result_array() as $kl) {
            ?>
                                                    <option value="<?php echo $kl['id_pendidikan'] ?>"><?php echo $kl['nm_pendidikan'] ?></option>
                                                                <?php }?>
                                                             </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pekerjaan</td>
                                                        <td>:</td>
                                                        <td><input class="md-input" id="pj_wali" autocomplete="off"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>NIK</td>
                                                        <td>:</td>
                                                        <td><input class="md-input" id="nik_wali" autocomplete="off"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="uk-text-right">
                                            <button onclick="submit_ortu()" class="md-btn md-btn-primary md-btn-wave-light">Simpan</button>
                                        </div>
                                    </div>

                                    <div id="show-ortu"></div>
                                    <div id="show-edit-ortu" style="display: none;"></div>

                                </li>
                                <li>
                                    <br>
                                    <div class="uk-text-right">
                                        <div id="btn-fisik"></div>
                                    </div>
                                    <table class="uk-table" border="1">
                                        <tr>
                                            <th colspan="4" class="uk-text-center">Kondisi Fisik</th>
                                        </tr>
                                        <tr>
                                            <th>Tahun Ajaran</th>
                                            <th>Tinggi Badan</th>
                                            <th>Berat Badan</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <tbody id="show-fisik"></tbody>
                                    </table>

                                    <br>

                                    <table class="uk-table" border="1">
                                        <tr>
                                            <th colspan="2" class="uk-text-center">Grafik Tinggi dan Berat Badan</th>
                                        </tr>
                                        <tr>
                                            <th class="uk-text-center">Tinggi Badan</th>
                                            <th class="uk-text-center">Berat Baran</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;">
                                                <canvas id="grafik-tb"></canvas>
                                            </td>
                                            <td>
                                                <canvas id="grafik-bb"></canvas>
                                            </td>
                                        </tr>
                                    </table>

                                <script>
                                    var tb = document.getElementById("grafik-tb").getContext('2d');

                                    grafik_tinggi();
                                    function grafik_tinggi() {

                                        $.ajax({
                                            type : 'ajax',
                                            url : '<?=base_url('proses/get_konfisik/' . $id)?>',
                                            dataType : 'json',
                                            success: function(data) {
                                                var thn = [];
                                                var tb_ = [];
                                                for (var i = 0; i<data.length; i++) {
                                                   thn.push(data[i].nm_tahunajaran);
                                                   tb_.push(data[i].tb_1);
                                                }

                                        var perTb = new Chart(tb, {
                                          type: 'bar',
                                          data: {
                                            labels:thn,
                                            datasets: [{
                                              label: 'Tinggi Badan Per Tahun Ajaran ',
                                              data: tb_,
                                              backgroundColor: [
                                              'rgba(255, 99, 132, 0.2)',
                                              'rgba(54, 162, 235, 0.2)',
                                              'rgba(255, 206, 86, 0.2)',
                                              'rgba(75, 192, 192, 0.2)',
                                              'rgba(153, 102, 255, 0.2)',
                                              'rgba(255, 159, 64, 0.2)'
                                              ],
                                              borderColor: [
                                              'rgba(255,99,132,1)',
                                              'rgba(54, 162, 235, 1)',
                                              'rgba(255, 206, 86, 1)',
                                              'rgba(75, 192, 192, 1)',
                                              'rgba(153, 102, 255, 1)',
                                              'rgba(255, 159, 64, 1)'
                                              ],
                                              borderWidth: 1
                                            }]
                                          },
                                          options: {
                                            scales: {
                                              yAxes: [{
                                                ticks: {
                                                  beginAtZero:true
                                                }
                                              }]
                                            }
                                          }
                                        });

                                         }
                                     })
                                }


                                    var bb = document.getElementById("grafik-bb").getContext('2d');
                                    grafik_berat();
                                    function grafik_berat() {

                            $.ajax({
                                        type : 'ajax',
                                        url : '<?=base_url('proses/get_konfisik/' . $id)?>',
                                        dataType : 'json',
                                        success: function(data) {
                                            var thn = [];
                                            var bb_ = [];
                                            for (var i = 0; i<data.length; i++) {
                                               thn.push(data[i].nm_tahunajaran);
                                               bb_.push(data[i].bb_1);
                                            }
                                                    var perBb = new Chart(bb, {
                                                      type: 'bar',
                                                      data: {
                                                        labels:thn,

                                                        datasets: [{
                                                          label: 'Berat Badan Per Tahun Ajaran ',
                                                          data: bb_,
                                                          backgroundColor: [
                                                          'rgba(255, 99, 132, 0.2)',
                                                          'rgba(54, 162, 235, 0.2)',
                                                          'rgba(255, 206, 86, 0.2)',
                                                          'rgba(75, 192, 192, 0.2)',
                                                          'rgba(153, 102, 255, 0.2)',
                                                          'rgba(255, 159, 64, 0.2)'
                                                          ],
                                                          borderColor: [
                                                          'rgba(255,99,132,1)',
                                                          'rgba(54, 162, 235, 1)',
                                                          'rgba(255, 206, 86, 1)',
                                                          'rgba(75, 192, 192, 1)',
                                                          'rgba(153, 102, 255, 1)',
                                                          'rgba(255, 159, 64, 1)'
                                                          ],
                                                          borderWidth: 1
                                                        }]
                                                      },
                                                      options: {
                                                        scales: {
                                                          yAxes: [{
                                                            ticks: {
                                                              beginAtZero:true
                                                            }
                                                          }]
                                                        }
                                                      }
                                                    });
                                                    }
                                                })
                                                }

                                  </script>

                                    <br>
                                    <div class="uk-text-right">
                                        <div id="btn-kesehatan"></div>
                                    </div>
                                    <table class="uk-table" border="1">
                                        <tr>
                                            <th colspan="5" style="text-align: center;">Kondisi Kesehatan</th>
                                        </tr>
                                        <tr>
                                            <th>Tahun Ajaran</th>
                                            <th>Pendengaran</th>
                                            <th>Penglihatan</th>
                                            <th>Gigi</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <tbody id="show-kesehatan"></tbody>
                                    </table>
                                </li>
                                <li>
                                    <br>
                                    <div id="show-ekskul"></div>
                                </li>
                                <li>
                                    <br>
                                    <div id="show-prestasi"></div>
                                </li>
                                <li>
                                    <table>
                                        <tr>
                                            <td style="width: 300px;">
                                    <div class="uk-margin-medium-bottom">
                                        <select class="uk-form-width" id="ta-absiswa" data-md-selectize-inline>
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
                                                <button onclick="filter_absiswa()" class="md-btn md-btn-warning md-btn-wave-light"><i class="fas fa-search"></i></button>
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
                                        <tbody id="show_absiswa"></tbody>
                                    </table>

                                </li>
                                <li>
                                    <table>
                                        <tr>
                                <td style="width: 300px;">
                                    <div class="uk-margin-medium-bottom">

                                        <select class="uk-form-width" id="ta-nilai-sikap" data-md-selectize-inline>
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
                                                <button onclick="filter_nilai_sikap()" class="md-btn md-btn-warning md-btn-wave-light"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php foreach ($tahunajaran->result() as $ta) {
            ?>
                                            <div class="md-card" id="tab-nilai-sikap-<?=$ta->id_tahunajaran?>">
                                                <div class="md-card-content">
                                                            <h5 style="background:<?php if ($ta->stt_tahunajaran == 'Y') {echo "yellow";}?>"><b><?=$ta->nm_tahunajaran?></b></h5>
                                                    <hr>

                            <ul class="uk-tab" data-uk-tab="{connect:'#tabs_nilai_sikap_<?=$ta->id_tahunajaran?>'}">
                                <li class="uk-active"><a href="#">Sikap Spiritual</a></li>
                                <li><a href="#">Sikap Sosial</a></li>
                            </ul>

                            <ul id="tabs_nilai_sikap_<?=$ta->id_tahunajaran?>" class="uk-switcher uk-margin">
                                <li>
                                     <div class="table-responsive">
                                        <table class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%" border="1">
                                            <thead>
                                                <tr>
                                                    <th rowspan="3" style="vertical-align: middle;">No. </th>
                                                    <th rowspan="3" style="vertical-align: middle;">Nama Siswa</th>
                                                </tr>

                                                <tr>
                                                    <th colspan="4" style="text-align: center">Kriteria</th>
                                                    <th rowspan="2" style="vertical-align: middle;">Predikat</th>
                                                    <th rowspan="2" style="vertical-align: middle;">Deskripsi</th>
                                                </tr>

                                                <tr>

                                                <?php
$n = 1;
            foreach ($kr_ki3->result() as $kr3) {?>
                                                    <th style="text-align: center;"><?=$kr3->nm_kriteria?></th>
                                                    <?php $n++;}?>
                                                </tr>

                                            </thead>
                                                 <tbody>
                                                     <?php

            $siswa  = $this->db->query("SELECT * FROM tb_siswa WHERE id_siswa=" . $id . " ");
            $kr_ki3 = $this->m_admin->data_kr_ki3();
            $nki3   = $this->db->query("SELECT * FROM tb_nki1");
            $ski1   = $this->m_admin->data_sikap_ki1();

            $lgt = $this->db->query("SELECT * FROM tb_sikap_ki1 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . "")->num_rows();
            if ($lgt == 0) {
                $no = 1;
                foreach ($siswa->result() as $sw) {
                    if ($sw->id_siswa == $id) {
                        echo
                        '<tr>
                                        <td style="vertical-align: middle;">' . $no++ . '</td>
                                        <td style="vertical-align: middle;">' . $sw->nm_siswa . '</td>';
                        foreach ($kr_ki3->result() as $kr3) {
                            echo '<td><input type="text" name="kolom_nilai_ki1[]" class="md-input" autocomplete="off" readonly/></td>';
                        }
                        echo
                            '<td><input name="predikat_ki1[]" class="md-input" autocomplete="off"></td>
                                        <td><textarea type="text" class="md-input" name="deskripsi_ki1[]" style="width: 200px"; autocomplete="off" readonly/></textarea></td>
                                    </tr>
                                    ';
                    }
                }
            } else {
                $no = 1;
                foreach ($ski1->result() as $sw) {
                    if ($sw->siswa == $id && $sw->ta == $ta->id_tahunajaran) {
                        echo
                        '<tr>
                                <td style="vertical-align: middle;">' . $no++ . '</td>
                                <td style="vertical-align: middle;">' . $sw->nm_siswa . '</td>';
                        foreach ($nki3->result() as $kr3) {
                            if ($kr3->siswa == $sw->id_siswa) {
                                echo '<td><div class="md-input-wrapper md-input-filled"><input type="text" name="kolom_nilai_ki1_b[]" class="md-input"  value="' . $kr3->nilai . '" autocomplete="off" readonly/><span class="md-input-bar"></span></div></td>';
                            }
                        }
                        echo
                        '<td><div class="md-input-wrapper md-input-filled"><input name="predikat_ki1_b[]" class="md-input" value="' . $sw->predikat . '" autocomplete="off"><span class="md-input-bar"></span></div></td>
                 <td><div class="md-input-wrapper md-input-filled"><textarea class="md-input" name="deskripsi_ki1_b[]" style="width: 200px"; autocomplete="off" readonly/>' . $sw->desk . '</textarea><span class="md-input-bar"></span></div></td></tr>';
                    }
                }
            }

            ?>
                                                 </tbody>
                                        </table>

                                    </div>
                                </li>
                                <li>

                                    <div class="table-responsive">
                                        <table class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%" border="1">
                                            <thead>
                                                <tr>
                                                    <th rowspan="3" style="vertical-align: middle;">No. </th>
                                                    <th rowspan="3" style="vertical-align: middle;">Nama Siswa</th>
                                                </tr>

                                                <tr>
                                                    <th colspan="6" style="text-align: center">Kriteria</th>
                                                    <th rowspan="2" style="vertical-align: middle;">Predikat</th>
                                                    <th rowspan="2" style="vertical-align: middle;">Deskripsi</th>
                                                </tr>

                                                <tr>

                                                <?php
$x = 1;
            foreach ($kr_ki4->result() as $kr4) {?>
                                                    <th style="text-align: center;"><?=$kr4->nm_kriteria?></th>
                                                    <?php $x++;}?>
                                                </tr>

                                            </thead>
                                                 <tbody>
                                                     <?php

            $siswa  = $this->db->query("SELECT * FROM tb_siswa WHERE id_siswa=" . $id . " ");
            $kr_ki4 = $this->m_admin->data_kr_ki4();
            $nki4   = $this->db->query("SELECT * FROM tb_nki2");
            $ski2   = $this->m_admin->data_sikap_ki2();

            $lgt = $this->db->query("SELECT * FROM tb_sikap_ki2 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " ")->num_rows();
            if ($lgt == 0) {
                $no = 1;
                foreach ($siswa->result() as $sw) {
                    if ($sw->id_siswa == $id) {
                        echo
                        '<tr>
                                        <td style="vertical-align: middle;">' . $no++ . '</td>
                                        <td style="vertical-align: middle;">' . $sw->nm_siswa . '</td>';
                        foreach ($kr_ki4->result() as $kr3) {
                            echo '<td><input type="text" name="kolom_nilai_ki2[]" class="md-input" autocomplete="off" readonly/></td>';
                        }
                        echo
                            '<td><input name="predikat_ki2[]" class="md-input" autocomplete="off"></td>
                                        <td><textarea type="text" class="md-input" name="deskripsi_ki2[]" style="width: 200px"; autocomplete="off" readonly/></textarea></td>
                                    </tr>
                                    ';
                    }
                }
            } else {
                $no = 1;
                foreach ($ski2->result() as $sw) {
                    if ($sw->siswa == $id && $sw->ta == $ta->id_tahunajaran) {
                        echo
                        '<tr>
                                <td style="vertical-align: middle;">' . $no++ . '</td>
                                <td style="vertical-align: middle;">' . $sw->nm_siswa . '</td>';
                        foreach ($nki4->result() as $kr3) {
                            if ($kr3->siswa == $sw->id_siswa) {
                                echo '<td><div class="md-input-wrapper md-input-filled"><input type="text" name="kolom_nilai_ki2_b[]" class="md-input"  value="' . $kr3->nilai . '" autocomplete="off" readonly/><span class="md-input-bar"></span></div></td>';
                            }
                        }
                        echo
                        '<td><div class="md-input-wrapper md-input-filled"><input name="predikat_ki2_b[]" class="md-input" value="' . $sw->predikat . '" autocomplete="off"><span class="md-input-bar"></span></div></td>
                 <td><div class="md-input-wrapper md-input-filled"><textarea class="md-input" name="deskripsi_ki2_b[]" style="width: 200px"; autocomplete="off" readonly/>' . $sw->desk . '</textarea><span class="md-input-bar"></span></div></td></tr>';
                    }
                }
            }

            ?>
                                                 </tbody>
                                        </table>

                                    </div>

                                </li>
                            </ul>


    </div>
</div>
        <?php }?>
                                </li>
                                <li>
                                     <table>
                                        <tr>
                                <td style="width: 300px;">
                                    <div class="uk-margin-medium-bottom">
                                        <select class="uk-form-width" id="ta-nilai" data-md-selectize-inline>
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
                                                <button onclick="filter_nilai()" class="md-btn md-btn-warning md-btn-wave-light"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                    </table>

                                    <?php foreach ($tahunajaran->result() as $ta) {
            ?>
                                            <div class="md-card" id="tab-nilai-<?=$ta->id_tahunajaran?>">
                                                <div class="md-card-content">
                                                            <h5 style="background:<?php if ($ta->stt_tahunajaran == 'Y') {echo "yellow";}?>"><b><?=$ta->nm_tahunajaran?></b></h5>
                                                    <hr>

                                                    <ul class="uk-tab" data-uk-tab="{connect:'#tabs_nilai_<?=$ta->id_tahunajaran?>'}">
                                                        <li class="uk-active"><a href="#">Pengetahuan</a></li>
                                                        <li><a href="#">Keterampilan</a></li>
                                                    </ul>
                                                    <ul id="tabs_nilai_<?=$ta->id_tahunajaran?>" class="uk-switcher uk-margin">
                                                        <li>
                                                            <div class="table-responsive">
                                                            <table class="uk-table" border="1">
                                                                <tr>
                                                                    <th style="width: 10px;">No</th>
                                                                    <th>Mata Pelajaran</th>
                                                                    <th>Harian</th>
                                                                    <th>UTS</th>
                                                                    <th>UAS</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Rata-Rata</th>
                                                                </tr>
                                                                <?php
$no = 1;
            foreach ($mapel->result() as $mp) {
                echo '
                                                                <tr>
                                                                    <td>' . $no++ . '</td>
                                                                    <td>' . $mp->nm_mapel . '</td>';
                $nph = $this->db->query("SELECT AVG(ph) as total_ph FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . " ")->result();

                $nuts = $this->db->query("SELECT AVG(npts) as total_uts FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . " ")->result();

                $nuas = $this->db->query("SELECT AVG(npas) as total_uas FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . " ")->result();

                $jum = $this->db->query("SELECT (SELECT AVG(ph) FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . ") + (SELECT AVG(npts) FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . ") + (SELECT AVG(npas) FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . ") as jumlah")->result();

                foreach ($nph as $ph) {
                    echo '<td class="center">' . number_format($ph->total_ph, 0) . '</td>';
                }

                foreach ($nuts as $uts) {
                    echo '<td class="center">' . number_format($uts->total_uts, 0) . '</td>';
                }

                foreach ($nuas as $uas) {
                    echo '<td class="center">' . number_format($uas->total_uas, 0) . '</td>';
                }

                foreach ($jum as $j) {
                    echo '<td class="center">' . number_format($j->jumlah, 0) . '</td>';
                    echo '<td class="center">' . number_format($j->jumlah / 3, 1) . '</td>';
                }
                echo '    </tr>';
            }?>
                    <tr>
                        <td colspan="2" class="center"><b>Total Rata-Rata</b></td>
                        <?php

            $jum_ph  = $this->db->query("SELECT AVG(ph) as jumlah_ph FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " ")->result();
            $jum_uts = $this->db->query("SELECT AVG(npts) as jumlah_uts FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " ")->result();
            $jum_uas = $this->db->query("SELECT AVG(npas) as jumlah_uas FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " ")->result();

            $jum_k = $this->db->query("SELECT (SELECT AVG(ph) FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . ") + (SELECT AVG(npts) FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . ") + (SELECT AVG(npas) FROM tb_nki3 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . ") as jumlah_k")->result();

            foreach ($jum_ph as $ph) {
                echo '<td class="center"><b>' . number_format($ph->jumlah_ph, 0) . '</b></td>';
            }

            foreach ($jum_uts as $uts) {
                echo '<td class="center"><b>' . number_format($uts->jumlah_uts, 0) . '</b></td>';
            }

            foreach ($jum_uas as $uas) {
                echo '<td class="center"><b>' . number_format($uas->jumlah_uas, 0) . '</b></td>';
            }

            foreach ($jum_k as $j) {
                echo '<td class="center"><b>' . number_format($j->jumlah_k, 0) . '</b></td>';
                echo '<td class="center"><b>' . number_format($j->jumlah_k / 3, 1) . '</b></td>';
            }

            ?>
                    </tr>
                                                            </table>
                                                            </div>
                                                        </li>
                                                        <li>

                                                            <div class="table-responsive">
                                                            <table class="uk-table" border="1">
                                                                <tr>
                                                                    <th style="width: 10px;">No</th>
                                                                    <th>Mata Pelajaran</th>
                                                                    <th>Harian</th>
                                                                    <th>UTS</th>
                                                                    <th>UAS</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Rata-Rata</th>
                                                                </tr>
                                                                <?php
$no = 1;
            foreach ($mapel->result() as $mp) {
                echo '
                                                                <tr>
                                                                    <td>' . $no++ . '</td>
                                                                    <td>' . $mp->nm_mapel . '</td>';
                $nph = $this->db->query("SELECT AVG(ph) as total_ph FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . " ")->result();

                $nuts = $this->db->query("SELECT AVG(npts) as total_uts FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . " ")->result();

                $nuas = $this->db->query("SELECT AVG(npas) as total_uas FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . " ")->result();

                $jum = $this->db->query("SELECT (SELECT AVG(ph) FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . ") + (SELECT AVG(npts) FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . ") + (SELECT AVG(npas) FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " AND mapel=" . $mp->id_mapel . ") as jumlah")->result();

                foreach ($nph as $ph) {
                    echo '<td class="center">' . number_format($ph->total_ph, 0) . '</td>';
                }

                foreach ($nuts as $uts) {
                    echo '<td class="center">' . number_format($uts->total_uts, 0) . '</td>';
                }

                foreach ($nuas as $uas) {
                    echo '<td class="center">' . number_format($uas->total_uas, 0) . '</td>';
                }

                foreach ($jum as $j) {
                    echo '<td class="center">' . number_format($j->jumlah, 0) . '</td>';

                    echo '<td class="center">' . number_format($j->jumlah / 3, 1) . '</td>';
                }
                echo '    </tr>';
            }?>

            <tr>
                        <td colspan="2" class="center"><b>Total Rata-Rata</b></td>
                        <?php

            $jum_ph  = $this->db->query("SELECT AVG(ph) as jumlah_ph FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " ")->result();
            $jum_uts = $this->db->query("SELECT AVG(npts) as jumlah_uts FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " ")->result();
            $jum_uas = $this->db->query("SELECT AVG(npas) as jumlah_uas FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . " ")->result();

            $jum_k = $this->db->query("SELECT (SELECT AVG(ph) FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . ") + (SELECT AVG(npts) FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . ") + (SELECT AVG(npas) FROM tb_nki4 WHERE siswa=" . $id . " AND ta=" . $ta->id_tahunajaran . ") as jumlah_k")->result();

            foreach ($jum_ph as $ph) {
                echo '<td class="center"><b>' . number_format($ph->jumlah_ph, 0) . '</b></td>';
            }

            foreach ($jum_uts as $uts) {
                echo '<td class="center"><b>' . number_format($uts->jumlah_uts, 0) . '</b></td>';
            }

            foreach ($jum_uas as $uas) {
                echo '<td class="center"><b>' . number_format($uas->jumlah_uas, 0) . '</b></td>';
            }

            foreach ($jum_k as $j) {
                echo '<td class="center"><b>' . number_format($j->jumlah_k, 0) . '</b></td>';
                echo '<td class="center"><b>' . number_format($j->jumlah_k / 3, 1) . '</b></td>';
            }

            ?>
                    </tr>
                                                </table>
                                                </div>

                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            <?php }?>

                                </li>
                                <li>
                                    <table>
                                        <tr>
                                <td style="width: 300px;">
                                    <div class="uk-margin-medium-bottom">
                                        <select class="uk-form-width" id="ta-leger" data-md-selectize-inline>
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
                                                <button onclick="filter_leger()" class="md-btn md-btn-warning md-btn-wave-light"><i class="fas fa-search"></i></button>
                                            </td>
                                        </tr>
                                    </table>

                                    <?php foreach ($tahunajaran->result() as $ta) {
            ?>
                                            <div class="md-card" id="tab-leger-<?=$ta->id_tahunajaran?>">
                                                <div class="md-card-content">
                                                    <h5 style="background:<?php if ($ta->stt_tahunajaran == 'Y') {echo "yellow";}?>"><b><?=$ta->nm_tahunajaran?></b></h5>
                                                    <hr>

                                                    <div class="table-responsive">
                            <table class="uk-table uk-table-striped" border="1">
                                <thead>
                                    <tr>
                                        <th rowspan="4" style="vertical-align: inherit;"><b>No</b></th>
                                        <th rowspan="4" style="vertical-align: inherit; padding-right: 150px;"><b>Nama Siswa</b></th>
                                    </tr>

                                    <tr>
                                        <th><b>ASPEK</b></th>
                                    <?php foreach ($mapel->result() as $mp) {
                if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
                    ?>
                                        <th><b><?=$mp->kode_mapel?></b></th>
                                    <?php }}?>
                                        <th colspan="2" style="text-align: center;"><b>SIKAP</b></th>
                                        <th rowspan="2" style="vertical-align: inherit;"><b>JML</b></th>
                                        <th rowspan="2" style="vertical-align: inherit;"><b>NR</b></th>
                                        <th rowspan="2" style="vertical-align: inherit;"><b>NR P&K</b></th>
                                        <th colspan="3"><b>ABSENSI</b></th>

                                    </tr>

                                    <tr>
                                        <th><b>KKM</b></th>
                                    <?php foreach ($mapel->result() as $mp) {
                if ($mp->id_mapel != 1 && $mp->id_mapel != 2) {
                    ?>
                                        <th><b><?=$mp->ki_3?></b></th>
                                    <?php }}?>
                                        <th><b>Spritual</b></th>
                                        <th><b>Sosial</b></th>
                                        <th><b>S</b></th>
                                        <th><b>I</b></th>
                                        <th><b>A</b></th>
                                    </tr>

                                </thead>
                                <tbody>
                                <?php
$no = 1;
            foreach ($siswa->result() as $sw) {
                if ($sw->id_siswa == $id) {
                    ?>
                                    <tr>
                                        <td rowspan="2"><?=$no++?></td>
                                        <td rowspan="2"><?=$sw->nm_siswa?></td>
                                        <td>Pengetahuan</td>

                                        <?php foreach ($mapel->result() as $mp) {
                        $avg3 = $this->db->query("SELECT AVG(total_na) as avg3 FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND ta=" . $ta->id_tahunajaran . "");
                        if ($avg3->num_rows() == 0) {
                            echo '<td colspan="10">Tidak ada data</td>';
                        } else {
                            foreach ($avg3->result() as $av3) {
                                ?>

                                        <td><?=number_format($av3->avg3, 0)?></td>

                                    <?php }}}?>

                                    <?php foreach ($ki1->result() as $k1) {
                        if ($k1->siswa == $sw->id_siswa && $k1->ta == $ta->id_tahunajaran) {?>
                                    <td rowspan="2" style="vertical-align: inherit; text-align: center;"><?=$k1->predikat?></td>
                                <?php }}?>

                                <?php foreach ($ki2->result() as $k2) {
                        if ($k2->siswa == $sw->id_siswa && $k1->ta == $ta->id_tahunajaran) {?>
                                    <td rowspan="2" style="vertical-align: inherit; text-align: center;"><?=$k2->predikat?></td>
                                <?php }}?>

                                <td>
                                    <?php
$sum3 = $this->db->query("SELECT SUM(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND ta=" . $ta->id_tahunajaran . " ")->result();

                    foreach ($sum3 as $v) {
                        echo $v->jml;
                    }
                    ?>
                                </td>
                                <td>

                                    <?php
$avg3 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND ta=" . $ta->id_tahunajaran . " ")->result();

                    foreach ($avg3 as $v) {
                        echo number_format($v->jml, 2);
                    }
                    ?>
                                </td>
                                <td rowspan="2" style="vertical-align: inherit; text-align: center;">
                                    <?php
$nrpk = $this->db->query("SELECT (SELECT AVG(total_na) FROM tb_nilai_ki3 WHERE siswa=" . $sw->id_siswa . " AND ta=" . $ta->id_tahunajaran . ") + (SELECT AVG(total_na) FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND ta=" . $ta->id_tahunajaran . ") as result ")->result();

                    foreach ($nrpk as $v) {
                        echo number_format($v->result, 2) / 2;
                    }
                    ?>
                                </td>
        <?php
$absen = $this->db->query("SELECT *,SUM(sakit) as t_sakit, SUM(izin) as t_izin, SUM(alpha) as t_alpha FROM tb_absiswa WHERE siswa=" . $sw->id_siswa . " AND ta=" . $ta->id_tahunajaran . " ")->result();
                    foreach ($absen as $ab) {
                        ?>
                                <td rowspan="2" style="vertical-align: inherit; text-align: center;"><?=$ab->t_sakit?></td>
                                <td rowspan="2" style="vertical-align: inherit; text-align: center;"><?=$ab->t_izin?></td>
                                <td rowspan="2" style="vertical-align: inherit; text-align: center;"><?=$ab->t_alpha?></td>
                            <?php }?>

                                    </tr>
                                    <tr>
                                        <td>Keterampilan</td>
                                        <?php foreach ($mapel->result() as $mp) {
                        $avg4 = $this->db->query("SELECT AVG(total_na) as avg4 FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND mapel=" . $mp->id_mapel . " AND ta=" . $ta->id_tahunajaran . "")->result();
                        foreach ($avg4 as $av4) {
                            ?>
                                        <td><?=number_format($av4->avg4, 0)?></td>

                                    <?php }}?>
                                    <td>
                                           <?php
$sum4 = $this->db->query("SELECT SUM(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND ta=" . $ta->id_tahunajaran . " ")->result();

                    foreach ($sum4 as $v) {
                        echo $v->jml;
                    }
                    ?>
                                    </td>
                                    <td>
                                         <?php
$avg4 = $this->db->query("SELECT AVG(total_na) as jml FROM tb_nilai_ki4 WHERE siswa=" . $sw->id_siswa . " AND ta=" . $ta->id_tahunajaran . " ")->result();

                    foreach ($avg4 as $v) {
                        echo number_format($v->jml, 2);
                    }
                    ?>
                                    </td>

                                    </tr>
                                <?php }}?>
                                </tbody>
                            </table>
                        </div>

                                            </div>
                                        </div>
                                    <?php }?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<span style="color: white;" id="clock"></span>

<div class="uk-modal" id="tambah_absiswa">
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

    <div class="tambah-absiswa"></div>
    </div>
</div>

<div class="uk-modal" id="edit_absiswa">
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

    <div class="edit-absiswa"></div>
    </div>
</div>

    <?php foreach ($siswa->result_array() as $sw) {
            ?>
<div class="uk-modal" id="edit_siswa_<?php echo $sw['id_siswa'] ?>">
      <div class="uk-modal-dialog" style="width: 1000px;">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Edit Data Siswa</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>

    <div class="uk-grid">
            <div class="uk-width-5-10">
                <div class="uk-form-row">
                    <label>NIS</label>
                    <input class="md-input" id="nis2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['nis'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>NISN</label>
                    <input class="md-input" id="nisn2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['nisn'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Nama</label>
                    <input class="md-input" id="nm_siswa2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['nm_siswa'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Jenis Kelamin</label><br><br>
                        <span class="icheck-inline">
                            <input type="radio" name="jk2-<?php echo $sw['id_siswa'] ?>" id="jk2-<?php echo $sw['id_siswa'] ?>" <?php if ($sw['jk'] == 'L') {
                echo "checked";
            }?> value="L" data-md-icheck required="" />
                            <label class="inline-label">L</label>
                        </span>
                        <span class="icheck-inline">
                            <input type="radio" name="jk2-<?php echo $sw['id_siswa'] ?>" id="jk2-<?php echo $sw['id_siswa'] ?>" <?php if ($sw['jk'] == 'P') {
                echo "checked";
            }?> value="P" data-md-icheck required="" />
                            <label class="inline-label">P</label>
                        </span>
                </div>
                <div class="uk-form-row">
                    <label>Agama</label>
                    <input class="md-input" id="agama2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['agama'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Tempat Lahir</label>
                    <input class="md-input" id="tempat2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['tempat'] ?>" autocomplete="off">
                </div>
            </div>
            <div class="uk-width-5-10">
                <div class="uk-form-row">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="md-input" id="tanggal_lahir2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['tanggal_lahir'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Jalan</label>
                    <input class="md-input" id="jalan2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['jalan'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Kelurahan</label>
                    <input class="md-input" id="kel2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['kel'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Kecamatan</label>
                    <input class="md-input" id="kec2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['kec'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Kabupaten</label>
                    <input class="md-input" id="kab2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['kab'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Provinsi</label>
                    <input class="md-input" id="prov2-<?php echo $sw['id_siswa'] ?>" value="<?php echo $sw['prov'] ?>" autocomplete="off">
                </div>

                <input type="hidden" name="pdd_sb2-<?php echo $sw['id_siswa'] ?>" value="">

                <!-- <div class="uk-form-row">
                    <label>Pendidikan Sebelumnya (TK)</label><br><br>
                        <span class="icheck-inline">
                            <input type="radio" name="pdd_sb2-<?php echo $sw['id_siswa'] ?>" id="pdd_sb2-<?php echo $sw['id_siswa'] ?>" <?php if ($sw['pdd_sb'] == 'Ya') {
                echo "checked";
            }?> value="Ya" data-md-icheck required="" />
                            <label class="inline-label">Ya</label>
                        </span>
                        <span class="icheck-inline">
                            <input type="radio" name="pdd_sb2-<?php echo $sw['id_siswa'] ?>" id="pdd_sb2-<?php echo $sw['id_siswa'] ?>" <?php if ($sw['pdd_sb'] == 'Tidak') {
                echo "checked";
            }?> value="Tidak" data-md-icheck required="" />
                            <label class="inline-label">Tidak</label>
                        </span>
                </div> -->

            </div>
        </div>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="edit_siswa(<?php echo $sw['id_siswa'] ?>)">Simpan</button>
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

<div class="uk-modal" id="tambah_fisik">
      <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Tambah Data Fisik</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>
        <div class="modal-tambah-fisik"></div>
    </div>
</div>

<div class="uk-modal" id="edit_fisik">
      <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Edit Data Fisik</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>
        <div class="modal-fisik"></div>
    </div>
</div>

<div class="uk-modal" id="tambah_kesehatan">
      <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Tambah Data Kondisi Kesehatan</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>
        <div class="modal-tambah-kesehatan"></div>
    </div>
</div>

<div class="uk-modal" id="edit_kesehatan">
      <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Edit Data Kondisi Kesehatan</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>
        <div class="modal-kesehatan"></div>
    </div>
</div>

<div class="uk-modal" id="tambah_ekskul">
      <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Tambah Data Ekskul</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>
        <div class="modal-tambah-ekskul"></div>
    </div>
</div>

<div class="uk-modal" id="edit_ekskul">
      <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Edit Data Ekskul</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>
        <div class="modal-ekskul"></div>
    </div>
</div>

<div class="uk-modal" id="tambah_prestasi">
      <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Tambah Data Prestasi</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>
        <div class="modal-tambah-prestasi"></div>
    </div>
</div>

<div class="uk-modal" id="edit_prestasi">
      <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Edit Data Prestasi</h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>
        <div class="modal-prestasi"></div>
    </div>
</div>

      <script>

        function edit_siswa(id) {
            var nis = $("#nis2-"+id).val();
            var nisn = $("#nisn2-"+id).val();
            var nm_siswa = $("#nm_siswa2-"+id).val();
            var jk = $("#jk2-"+id+":checked").val();
            var agama = $("#agama2-"+id).val();
            var tempat = $("#tempat2-"+id).val();
            var tanggal_lahir = $("#tanggal_lahir2-"+id).val();
            var jalan = $("#jalan2-"+id).val();
            var kel = $("#kel2-"+id).val();
            var kec = $("#kec2-"+id).val();
            var kab = $("#kab2-"+id).val();
            var prov = $("#prov2-"+id).val();
            var pdd_sb = $("#pdd_sb2-"+id+":checked").val();
            var id_siswa = id;

            $.ajax({
            type : 'post',
            url : '<?=base_url('proses/edit_siswa')?>',
            data : {
                    nis:nis,
                    nisn:nisn,
                    nm_siswa:nm_siswa,
                    jk:jk,
                    agama:agama,
                    tempat:tempat,
                    tanggal_lahir:tanggal_lahir,
                    jalan:jalan,
                    kel:kel,
                    kec:kec,
                    kab:kab,
                    prov:prov,
                    pdd_sb:pdd_sb,
                    id_siswa:id_siswa,
                },
            success: function(data) {
                 swal("Berhasil Mengedit Data", {
                   icon: "success",
                }).then(function(){
                    location.reload();
                })
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



                tampil_absiswa();
                function tampil_absiswa() {
                        $.ajax({
                            type : 'ajax',
                            url : '<?=base_url('proses/get_absiswa/' . $id)?>',
                            success: function(data) {
                                $("#show_absiswa").html(data);
                            }
                        })
                    }

                    function filter_absiswa() {

                    var ta_absiswa = document.getElementById('ta-absiswa').value;

                    if (ta_absiswa == id_tj) {
                        tampil_absiswa();
                    } else {

                    show_filter_absiswa();
            function show_filter_absiswa() {

                $.ajax({
                    type : 'post',
                    url : '<?=base_url('proses/get_absiswa_filter')?>',
                    data : {
                        ta_absiswa:ta_absiswa,
                        // smt_absiswa:smt_absiswa,
                    },
                    success : function(data) {
                    $('#show_absiswa').html(data);
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

                function tambah_absiswa(id) {
                        $.ajax({
                        type : 'post',
                        url : '<?=base_url('proses/get_tambah_absiswa')?>',
                        data : {id:id},
                        success: function(data) {
                            $(".tambah-absiswa").html(data);
                        }
                    })
                }

                function edit_absiswa(id) {
                        $.ajax({
                        type : 'post',
                        url : '<?=base_url('proses/get_edit_absiswa')?>',
                        data : {id:id},
                        success: function(data) {
                            $(".edit-absiswa").html(data);
                        }
                    })
                }

                function edit_absiswa_filter(id) {
                        $.ajax({
                        type : 'post',
                        url : '<?=base_url('proses/get_edit_absiswa_filter')?>',
                        data : {id:id},
                        success: function(data) {
                            $(".edit-absiswa").html(data);
                        }
                    })
                }

                function submit_absiswa(id) {

                    var sakit = $("#sakit-"+id).val();
                    var izin = $("#izin-"+id).val();
                    var alpha = $("#alpha-"+id).val();
                    var jumlah = $("#jumlah-"+id).val();
                    var siswa = '<?=$id?>';
                    var ab = $("#ab-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/tambah_absiswa') ?>',
                        data : {
                            sakit:sakit,
                            izin:izin,
                            alpha:alpha,
                            jumlah:jumlah,
                            siswa:siswa,
                            ab:ab,
                        },
                        success: function(data) {
                            tampil_absiswa();
                            $("#alert-tambah-absiswa-"+id).slideDown('slow');
                            $("#alert-tambah-absiswa-"+id).slideUp('slow');
                        }
                    })
                }

                function ubah_absiswa(id) {

                    var absiswa = $("#absiswa-"+id).val();
                    var sakit = $("#sakit-"+id).val();
                    var izin = $("#izin-"+id).val();
                    var alpha = $("#alpha-"+id).val();
                    var jumlah = $("#jumlah-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/edit_absiswa') ?>',
                        data : {
                            sakit:sakit,
                            izin:izin,
                            alpha:alpha,
                            jumlah:jumlah,
                            absiswa:absiswa,
                        },
                        success: function(data) {
                            tampil_absiswa();
                            $("#alert-edit-absiswa-"+id).slideDown('slow');
                            $("#alert-edit-absiswa-"+id).slideUp('slow');
                        }
                    })
                }

                    function hapus_absiswa(id) {

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
                                    url : '<?php echo base_url('proses/hapus_absiswa') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        tampil_absiswa();
                                            swal("Berhasil Menghapus Data", {
                                                icon: "success",
                                            })
                                    }
                                })
                            }
                         });
                }

                function submit_absiswa_filter(id) {

                    var sakit = $("#sakit-"+id).val();
                    var izin = $("#izin-"+id).val();
                    var alpha = $("#alpha-"+id).val();
                    var jumlah = $("#jumlah-"+id).val();
                    var siswa = '<?=$id?>';
                    var ab = $("#ab-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/tambah_absiswa') ?>',
                        data : {
                            sakit:sakit,
                            izin:izin,
                            alpha:alpha,
                            jumlah:jumlah,
                            siswa:siswa,
                            ab:ab,
                        },
                        success: function(data) {
                            filter_absiswa();
                            $("#alert-tambah-absiswa-"+id).slideDown('slow');
                            $("#alert-tambah-absiswa-"+id).slideUp('slow');
                        }
                    })
                }

                function ubah_absiswa_filter(id) {

                    var absiswa = $("#absiswa-"+id).val();
                    var sakit = $("#sakit-"+id).val();
                    var izin = $("#izin-"+id).val();
                    var alpha = $("#alpha-"+id).val();
                    var jumlah = $("#jumlah-"+id).val();

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/edit_absiswa') ?>',
                        data : {
                            sakit:sakit,
                            izin:izin,
                            alpha:alpha,
                            jumlah:jumlah,
                            absiswa:absiswa,
                        },
                        success: function(data) {
                            filter_absiswa();
                            $("#alert-edit-absiswa-"+id).slideDown('slow');
                            $("#alert-edit-absiswa-"+id).slideUp('slow');
                        }
                    })
                }

                    function hapus_absiswa_filter(id) {

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
                                    url : '<?php echo base_url('proses/hapus_absiswa') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        filter_absiswa();
                                            swal("Berhasil Menghapus Data", {
                                                icon: "success",
                                            })
                                    }
                                })
                            }
                         });
                }

                // ORTU

                    tampil_ortu();
                    function tampil_ortu() {
                        $.ajax({
                            type : 'ajax',
                            url : '<?=base_url('proses/get_ortu/') . $id?>',
                            success: function(data) {
                                $("#show-ortu").html(data);
                            }
                        })
                    }

                    btn_ortu();
                    function btn_ortu() {
                        $.ajax({
                            type : 'ajax',
                            url : '<?=base_url('proses/get_btn_ortu/') . $id?>',
                            success: function(data) {
                                $("#btn-ortu").html(data);
                            }
                        })
                    }

                    function tambah_ortu() {
                        $("#form-tambah-ortu").slideDown();
                        $("#show-ortu").hide();
                    }

                    function edit_ortu(id) {
                        $("#show-ortu").hide();
                        $("#show-edit-ortu").slideDown();
                        $.ajax({
                            type : 'ajax',
                            url : '<?=base_url('proses/get_edit_ortu/' . $id)?>',
                            success: function(data) {
                                $("#show-edit-ortu").html(data);
                            }
                        })
                    }

                    function submit_ortu() {
                        $("#form-tambah-ortu").hide();
                        var nm_ayah = $("#nm_ayah").val();
                        var pdd_ayah = $("#pdd_ayah").val();
                        var pj_ayah = $("#pj_ayah").val();
                        var nik_ayah = $("#nik_ayah").val();

                        var nm_ibu = $("#nm_ibu").val();
                        var pdd_ibu = $("#pdd_ibu").val();
                        var pj_ibu = $("#pj_ibu").val();
                        var nik_ibu = $("#nik_ibu").val();

                        var nm_wali = $("#nm_wali").val();
                        var pdd_wali = $("#pdd_wali").val();
                        var pj_wali = $("#pj_wali").val();
                        var nik_wali = $("#nik_wali").val();

                        var siswa = <?=$id?>;

                        $.ajax({
                            type : 'post',
                            url : '<?=base_url('proses/tambah_ortu')?>',
                            data : {
                                nm_ayah:nm_ayah,
                                pdd_ayah:pdd_ayah,
                                pj_ayah:pj_ayah,
                                nik_ayah:nik_ayah,
                                nm_ibu:nm_ibu,
                                pdd_ibu:pdd_ibu,
                                pj_ibu:pj_ibu,
                                nik_ibu:nik_ibu,
                                nm_wali:nm_wali,
                                pdd_wali:pdd_wali,
                                pj_wali:pj_wali,
                                nik_wali:nik_wali,
                                siswa:siswa,
                            }, success: function(data) {
                                $("#show-ortu").show();
                                tampil_ortu();
                                btn_ortu();
                            }
                        })
                    }

                    function update_ortu(id) {
                        $("#show-edit-ortu").hide();
                        var nm_ayah = $("#nm_ayah_"+id).val();
                        var pdd_ayah = $("#pdd_ayah_"+id).val();
                        var pj_ayah = $("#pj_ayah_"+id).val();
                        var nik_ayah = $("#nik_ayah_"+id).val();

                        var nm_ibu = $("#nm_ibu_"+id).val();
                        var pdd_ibu = $("#pdd_ibu_"+id).val();
                        var pj_ibu = $("#pj_ibu_"+id).val();
                        var nik_ibu = $("#nik_ibu_"+id).val();

                        var nm_wali = $("#nm_wali_"+id).val();
                        var pdd_wali = $("#pdd_wali_"+id).val();
                        var pj_wali = $("#pj_wali_"+id).val();
                        var nik_wali = $("#nik_wali_"+id).val();

                        var id_ortu = id;

                        $.ajax({
                            type : 'post',
                            url : '<?=base_url('proses/edit_ortu')?>',
                            data : {
                                nm_ayah:nm_ayah,
                                pdd_ayah:pdd_ayah,
                                pj_ayah:pj_ayah,
                                nik_ayah:nik_ayah,
                                nm_ibu:nm_ibu,
                                pdd_ibu:pdd_ibu,
                                pj_ibu:pj_ibu,
                                nik_ibu:nik_ibu,
                                nm_wali:nm_wali,
                                pdd_wali:pdd_wali,
                                pj_wali:pj_wali,
                                nik_wali:nik_wali,
                                id_ortu:id_ortu,
                            }, success: function(data) {
                                $("#show-ortu").show();
                                tampil_ortu();
                                btn_ortu();
                            }
                        })
                    }

                    function hapus_ortu(id) {

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
                                    url : '<?php echo base_url('proses/hapus_ortu') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        tampil_ortu();
                                        $("#show-ortu").show();
                                        $("#show-edit-ortu").hide();
                                        btn_ortu();
                                            swal("Berhasil Menghapus Data", {
                                                icon: "success",
                                            })
                                    }
                                })
                            }
                         });
                }

                // FISIK



                    tampil_fisik();
                    function tampil_fisik() {
                        $.ajax({
                            type : 'ajax',
                            url : '<?=base_url('proses/get_fisik/') . $id?>',
                            success: function(data) {
                                $("#show-fisik").html(data);
                            }
                        })
                    }

                    function edit_fisik(id) {
                        $.ajax({
                            type : 'post',
                            url : '<?=base_url('proses/get_modal_fisik')?>',
                            data : {id:id},
                            success: function(data) {
                                $(".modal-fisik").html(data);
                            }
                        })
                    }

                    function tambah_fisik(id) {
                        $.ajax({
                            type : 'post',
                            url : '<?=base_url('proses/get_modal_tambah_fisik')?>',
                            data : {id:id},
                            success: function(data) {
                                $(".modal-tambah-fisik").html(data);
                            }
                        })
                    }

                    function submit_fisik(id) {

                    var tb_1 = $("#tb_1-"+id).val();
                    var bb_1 = $("#bb_1-"+id).val();
                    var ta = id;
                    var siswa = '<?=$id?>';

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/tambah_fisik') ?>',
                        data : {
                            tb_1:tb_1,
                            bb_1:bb_1,
                            ta:ta,
                            siswa:siswa,
                        },
                        success: function(data) {
                            tampil_fisik();
                            grafik_tinggi();
                            grafik_berat();
                            $("#alert-tambah-fisik-"+id).slideDown('slow');
                            $("#alert-tambah-fisik-"+id).slideUp('slow');
                        }
                    })
                }

                function ubah_fisik(id) {

                    var tb_1 = $("#tb_1-"+id).val();
                    var tb_2 = $("#tb_2-"+id).val();
                    var bb_1 = $("#bb_1-"+id).val();
                    var bb_2 = $("#bb_2-"+id).val();
                    var fisik = id;

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/edit_fisik') ?>',
                        data : {
                            tb_1:tb_1,
                            tb_2:tb_2,
                            bb_1:bb_1,
                            bb_2:bb_2,
                            fisik:fisik,
                        },
                        success: function(data) {
                            tampil_fisik();
                            grafik_tinggi();
                            grafik_berat();
                            $("#alert-edit-fisik-"+id).slideDown('slow');
                            $("#alert-edit-fisik-"+id).slideUp('slow');
                        }
                    })
                }

                    function hapus_fisik(id) {

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
                                    url : '<?php echo base_url('proses/hapus_fisik') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        tampil_fisik();
                                            swal("Berhasil Menghapus Data", {
                                                icon: "success",
                                            })
                                    }
                                })
                            }
                         });
                }

                // KESEHATAN

                    tampil_kesehatan();
                    function tampil_kesehatan() {
                        $.ajax({
                            type : 'ajax',
                            url : '<?=base_url('proses/get_kesehatan/') . $id?>',
                            success: function(data) {
                                $("#show-kesehatan").html(data);
                            }
                        })
                    }

                    function edit_kesehatan(id) {
                        $.ajax({
                            type : 'post',
                            url : '<?=base_url('proses/get_modal_kes')?>',
                            data : {id:id},
                            success: function(data) {
                                $(".modal-kesehatan").html(data);
                            }
                        })
                    }

                    function tambah_kesehatan(id) {
                        $.ajax({
                            type : 'post',
                            url : '<?=base_url('proses/get_modal_tambah_kes')?>',
                            data : {id:id},
                            success: function(data) {
                                $(".modal-tambah-kesehatan").html(data);
                            }
                        })
                    }

                    function submit_kesehatan(id) {

                    var pendengaran = $("#pendengaran-"+id).val();
                    var penglihatan = $("#penglihatan-"+id).val();
                    var gigi = $("#gigi-"+id).val();
                    var siswa = '<?=$id?>';
                    var ta = id;

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/tambah_kesehatan') ?>',
                        data : {
                            pendengaran:pendengaran,
                            penglihatan:penglihatan,
                            gigi:gigi,
                            siswa:siswa,
                            ta:ta,
                        },
                        success: function(data) {
                            tampil_kesehatan();
                            $("#alert-tambah-kesehatan-"+id).slideDown('slow');
                            $("#alert-tambah-kesehatan-"+id).slideUp('slow');
                        }
                    })
                }

                function ubah_kesehatan(id) {

                    var pendengaran = $("#pendengaran-"+id).val();
                    var penglihatan = $("#penglihatan-"+id).val();
                    var gigi = $("#gigi-"+id).val();
                    var kesehatan = id;

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/edit_kesehatan') ?>',
                        data : {
                            pendengaran:pendengaran,
                            penglihatan:penglihatan,
                            gigi:gigi,
                            kesehatan:kesehatan,
                        },
                        success: function(data) {
                            tampil_kesehatan();
                            $("#alert-edit-kesehatan-"+id).slideDown('slow');
                            $("#alert-edit-kesehatan-"+id).slideUp('slow');
                        }
                    })
                }

                    function hapus_kesehatan(id) {

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
                                    url : '<?php echo base_url('proses/hapus_kesehatan') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        tampil_kesehatan();
                                            swal("Berhasil Menghapus Data", {
                                                icon: "success",
                                            })
                                    }
                                })
                            }
                         });
                }

            // EKSKUL
            tampil_ekskul();
            function tampil_ekskul() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_ekskul/') . $id?>',
                    success: function(data) {
                        $("#show-ekskul").html(data);
                    }
                })
            }

                    function edit_ekskul(id) {
                        $.ajax({
                            type : 'post',
                            url : '<?=base_url('proses/get_modal_eks')?>',
                            data : {id:id},
                            success: function(data) {
                                $(".modal-ekskul").html(data);
                            }
                        })
                    }

                    function tambah_ekskul(id) {
                        $.ajax({
                            type : 'post',
                            url : '<?=base_url('proses/get_modal_tambah_ekskul')?>',
                            data : {id:id},
                            success: function(data) {
                                $(".modal-tambah-ekskul").html(data);
                            }
                        })
                    }

                    function submit_ekskul(id) {

                    var eks = $("#eks-"+id).val();
                    var ket = $("#ket-"+id).val();
                    var ta = id;
                    var siswa = '<?=$id?>';

                    console.log(eks)

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/tambah_ekskul') ?>',
                        data : {
                            eks:eks,
                            ket:ket,
                            ta:ta,
                            siswa:siswa,
                        },
                        success: function(data) {
                            tampil_ekskul();
                            $("#alert-tambah-ekskul-"+id).slideDown('slow');
                            $("#alert-tambah-ekskul-"+id).slideUp('slow');
                        }
                    })
                }

                function ubah_ekskul(id) {

                    var eks = $("#eks-"+id).val();
                    var ket = $("#ket-"+id).val();
                    var ekskul = id;

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/edit_ekskul') ?>',
                        data : {
                            eks:eks,
                            ket:ket,
                            ekskul:ekskul,
                        },
                        success: function(data) {
                            tampil_ekskul();
                            $("#alert-edit-ekskul-"+id).slideDown('slow');
                            $("#alert-edit-ekskul-"+id).slideUp('slow');
                        }
                    })
                }

                    function hapus_ekskul(id) {

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
                                    url : '<?php echo base_url('proses/hapus_ekskul') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        tampil_ekskul();
                                            swal("Berhasil Menghapus Data", {
                                                icon: "success",
                                            })
                                    }
                                })
                            }
                         });
                }

                // PRESTASI
            tampil_prestasi();
            function tampil_prestasi() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_prestasi/') . $id?>',
                    success: function(data) {
                        $("#show-prestasi").html(data);
                    }
                })
            }

            function edit_prestasi(id) {
                $.ajax({
                    type : 'post',
                    url : '<?=base_url('proses/get_modal_prestasi')?>',
                    data : {id:id},
                    success: function(data) {
                        $(".modal-prestasi").html(data);
                    }
                })
            }

            function tambah_prestasi(id) {
                $.ajax({
                    type : 'post',
                    url : '<?=base_url('proses/get_modal_tambah_prestasi')?>',
                    data : {id:id},
                    success: function(data) {
                        $(".modal-tambah-prestasi").html(data);
                    }
                })
            }

                    function submit_prestasi(id) {

                    var jp = $("#jp-"+id).val();
                    var pres = $("#pres-"+id).val();
                    var ta = id;
                    var siswa = '<?=$id?>';

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/tambah_prestasi') ?>',
                        data : {
                            jp:jp,
                            pres:pres,
                            ta:ta,
                            siswa:siswa,
                        },
                        success: function(data) {
                            tampil_prestasi();
                            $("#alert-tambah-prestasi-"+id).slideDown('slow');
                            $("#alert-tambah-prestasi-"+id).slideUp('slow');
                        }
                    })
                }

                function ubah_prestasi(id) {

                    var jp = $("#jp-"+id).val();
                    var pres = $("#pres-"+id).val();
                    var prestasi = id;

                    $.ajax({
                        type : 'POST',
                        url : '<?php echo base_url('proses/edit_prestasi') ?>',
                        data : {
                            jp:jp,
                            pres:pres,
                            prestasi:prestasi,
                        },
                        success: function(data) {
                            tampil_prestasi();
                            $("#alert-edit-prestasi-"+id).slideDown('slow');
                            $("#alert-edit-prestasi-"+id).slideUp('slow');
                        }
                    })
                }

                    function hapus_prestasi(id) {

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
                                    url : '<?php echo base_url('proses/hapus_prestasi') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        tampil_prestasi();
                                            swal("Berhasil Menghapus Data", {
                                                icon: "success",
                                            })
                                    }
                                })
                            }
                         });
                }

                // NILAI SIKAP

                function filter_nilai_sikap() {

                    var id = document.getElementById('ta-nilai-sikap').value;
                $('html, body').animate({
                      scrollTop: $("#tab-nilai-sikap-"+id).offset().top
                  }, 1500);

                }

                // NILAI KI3-KI4

                function filter_nilai() {

                    var id = document.getElementById('ta-nilai').value;
                $('html, body').animate({
                      scrollTop: $("#tab-nilai-"+id).offset().top
                  }, 1500);

                }
                // LEGER

                function filter_leger() {

                    var id = document.getElementById('ta-leger').value;
                $('html, body').animate({
                      scrollTop: $("#tab-leger-"+id).offset().top
                  }, 1500);

                }

                function scrool_up() {
                  $('html, body').animate({
                      scrollTop: $("#page_content").offset().top
                  }, 1000);
                }


        </script>

        <div class="md-fab-wrapper">
            <a data-uk-tooltip="{pos:'top'}" title="Scrool Up" onclick="scrool_up()" class="md-fab md-fab-danger md-fab-wave">
                <i class="material-icons">arrow_upward</i>
            </a>
        </div>

    <?php }}?>

