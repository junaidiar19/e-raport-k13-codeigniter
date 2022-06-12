<?php
$guru  = $this->db->query("SELECT * FROM tb_guru WHERE akun=" . $akun['id_akun'] . " ")->result();
$kelas = $this->db->query("SELECT * FROM tb_kelas LIMIT 6");
?>

<div id="page_content">
    <div id="page_content_inner">

	<div class="uk-grid uk-grid-medium hierarchical_show" data-uk-grid-margin>
            <div class="uk-width-1-1">
<?php foreach ($guru as $gr) {
    if ($gr->kelas == 7 || $gr->kelas == 0) {
        ?>
             <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-3-10">
                                <select id="filter-kelas" data-md-selectize>
                                    <option value="">-Pilih Kelas-</option>
                                    <option value="all">Tampilkan Semua</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                  </select>
                        </div>
                        <div class="uk-width-medium-7-10">
                             <a onclick="tampil_siswa()" class="md-btn md-btn-warning md-btn-wave-light"><i class="fas fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }}?>

                <div id="show_siswa"></div>

                <?php echo $this->session->flashdata('siswa'); ?>

<div id="show_siswa_all">
<?php

foreach ($guru as $gr) {
    foreach ($kelas->result() as $kl) {
        if ($kl->id_kelas == $gr->kelas) {
            ?>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-3-10">
                            <h3>Data Siswa Kelas <?=$kl->nm_kelas?></h3>
                        </div>
                        <div class="uk-width-medium-7-10 uk-text-right">

                            <a data-uk-tooltip="{pos:'top'}" target="blank" title="Report Orang Tua Siswa" href="<?=base_url('cetak/cetak_ortu/' . $kl->id_kelas . '/' . $kl->nm_kelas)?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report</a>

                            <a data-uk-tooltip="{pos:'top'}" target="blank" title="Report Siswa Kelas <?=$kl->nm_kelas?>" href="<?=base_url('cetak/cetak_siswa/' . $kl->id_kelas . '/' . $kl->nm_kelas)?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report</a>

                            <a data-uk-tooltip="{pos:'top'}" title="Leger" href="<?=base_url('admin/leger/' . $kl->id_kelas)?>" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Leger</a>

                            <a data-uk-tooltip="{pos:'top'}" title="Kelola Penilaian KI-3 & KI-4" href="<?=base_url('admin/rekap_nilai/' . $kl->id_kelas . '/' . $gr->jabatan)?>" class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Rekap KI-3 & KI-4</a>

                            <a data-uk-tooltip="{pos:'top'}" title="Kelola Nilai Sikap" href="<?=base_url('admin/nilai_sikap/' . $kl->id_kelas)?>" class="md-btn md-btn-small md-btn-warning md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Nilai Sikap</a>

                            <!-- <a data-uk-tooltip="{pos:'top'}" title="Tambah Siswa" data-uk-modal="{target:'#tambah_siswa_<?=$kl->id_kelas?>'}" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-user"></i></a> -->

                        </div>
                    </div><hr>

                    <div class="table-responsive">
                        <form action="<?php echo base_url('proses/hapus_siswa2') ?>" method="post" id="form-delete-<?=$kl->id_kelas?>">
                        <table id="dt_default" class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <?php if ($akun['level'] == '1') {?>
                                    <th style="width: 10px;">
                                        <div class="checkbox checkbox-fill d-inline">
                                            <input type="checkbox" name="checkbox-fill-1" id="check-all-<?=$kl->id_kelas?>">
                                            <label for="check-all-<?=$kl->id_kelas?>" class="cr"></label>
                                        </div>
                                    </th>
                                <?php }?>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>JK</th>
                                    <th>Agama</th>
                                    <th>Tempat</th>
                                    <th>Tgl Lahir</th>
                                    <th>Jalan</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten</th>
                                    <th>Provinsi</th>
                                    <th>TK</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
$no  = 1;
            $noa = 1;
            $nob = 1;
            foreach ($siswa->result_array() as $sw) {
                if ($sw['kelas'] == $kl->id_kelas) {
                    ?>
                            <tr>
                                <?php if ($akun['level'] == '1') {?>
                                <td>
                                    <div class="checkbox checkbox-fill d-inline">
                                      <input type="checkbox" name="id_siswa[]" value="<?php echo $sw['id_siswa']; ?>" class="check-item-<?=$kl->id_kelas?>" id="check-<?=$noa++?>">
                                        <label for="check-<?=$nob++?>" class="cr"></label>
                                    </div>
                                </td>
                            <?php }?>
                                <td><?=$no++?></td>
                                <td>
                                <a data-uk-tooltip="{pos:'top'}" title="Hapus" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_siswa(<?php echo $sw['id_siswa']; ?>)"><i class="feather icon-trash"></i></a>
                                <a data-uk-tooltip="{pos:'top'}" title="Edit" data-uk-modal="{target:'#edit_siswa_<?php echo $sw['id_siswa']; ?>'}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>
                                <a data-uk-tooltip="{pos:'top'}" title="Detail" href="<?php echo base_url('admin/detailsiswa/') . $sw['id_siswa'] ?>" class="md-btn md-btn-primary md-btn-small md-btn-wave-light"><i class="fas fa-address-card"></i></a>
                                </td>
                                <td><?php echo $sw['nm_siswa']; ?></td>
                                <td><?php echo $sw['nis']; ?></td>
                                <td><?php echo $sw['nisn']; ?></td>
                                <td><?php echo $sw['jk']; ?></td>
                                <td><?php echo $sw['agama']; ?></td>
                                <td><?php echo $sw['tempat']; ?></td>
                                <td><?php

                    if ($sw['tanggal_lahir'] == '0000-00-00') {
                        echo "";
                    } else {
                        echo tgl_indo($sw['tanggal_lahir']);
                    }
                    ?></td>
                                <td><?php echo $sw['jalan']; ?></td>
                                <td><?php echo $sw['kel']; ?></td>
                                <td><?php echo $sw['kec']; ?></td>
                                <td><?php echo $sw['kab']; ?></td>
                                <td><?php echo $sw['prov']; ?></td>
                                <td><?php echo $sw['pdd_sb']; ?></td>
                            </tr>
    <?php }}?>
                    </tbody>
                                                </table>
                                                <?php if ($akun['level'] == '1') {?>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="md-btn md-btn-danger md-btn-wave-light" id="btn-delete-<?=$kl->id_kelas?>" title="Hapus"><i class="feather icon-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            <?php }?>
                                            </form>
                                            </div>

    <script>

         $(document).ready(function(){
            $("#check-all-<?=$kl->id_kelas?>").click(function(){
              if($(this).is(":checked"))
                $(".check-item-<?=$kl->id_kelas?>").prop("checked", true);
              else
                $(".check-item-<?=$kl->id_kelas?>").prop("checked", false);
            });

            $("#btn-delete-<?=$kl->id_kelas?>").click(function(){
                  var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?");
                  if(confirm)
                    $("#form-delete-<?=$kl->id_kelas?>").submit();
                });
          });

    </script>

                    </div>
                </div>
            <?php } elseif ($gr->kelas == 7 || $gr->kelas == 0) {
            ?>

    <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-3-10">
                            <h3>Data Siswa Kelas <?=$kl->nm_kelas?></h3>
                        </div>
                        <div class="uk-width-medium-7-10 uk-text-right">
                            <a data-uk-tooltip="{pos:'top'}" target="blank" title="Report Orang Tua Siswa" href="<?=base_url('cetak/cetak_ortu/' . $kl->id_kelas . '/' . $kl->nm_kelas)?>"  class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report Ortu</a>

                            <a data-uk-tooltip="{pos:'top'}" target="blank" title="Report Siswa Kelas <?=$kl->nm_kelas?>" href="<?=base_url('cetak/cetak_siswa/' . $kl->id_kelas . '/' . $kl->nm_kelas)?>"  class="md-btn md-btn-danger md-btn-small md-btn-wave-light"><i class="fas fa-print">&nbsp;</i>Report Siswa</a>

                            <a data-uk-tooltip="{pos:'top'}" title="Leger" href="<?=base_url('admin/leger/' . $kl->id_kelas)?>" class="md-btn md-btn-small md-btn-success md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Leger</a>

                            <a data-uk-tooltip="{pos:'top'}" title="Kelola Penilaian KI-3 & KI-4" href="<?=base_url('admin/rekap_nilai/' . $kl->id_kelas . '/' . $gr->jabatan)?>" class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Rekap KI-3 & KI-4</a>

                            <a data-uk-tooltip="{pos:'top'}" title="Kelola Nilai Sikap" href="<?=base_url('admin/nilai_sikap/' . $kl->id_kelas)?>" class="md-btn md-btn-small md-btn-warning md-btn-wave-light"><i class="fas fa-plus-circle">&nbsp;</i>Nilai Sikap</a>

                            <a data-uk-tooltip="{pos:'top'}" title="Tambah Siswa" data-uk-modal="{target:'#tambah_siswa_<?=$kl->id_kelas?>'}" class="md-btn md-btn-small md-btn-primary md-btn-wave-light"><i class="fas fa-user"></i></a>

                        </div>
                    </div><hr>

                    <div class="table-responsive">
                        <form action="<?php echo base_url('proses/hapus_siswa2') ?>" method="post" id="form-delete-<?=$kl->id_kelas?>">
                        <table id="dt_default" class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <?php if ($akun['level'] == '1') {?>
                                    <th style="width: 10px;">
                                        <div class="checkbox checkbox-fill d-inline">
                                            <input type="checkbox" name="checkbox-fill-1" id="check-all-<?=$kl->id_kelas?>">
                                            <label for="check-all-<?=$kl->id_kelas?>" class="cr"></label>
                                        </div>
                                    </th>
                                <?php }?>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>JK</th>
                                    <th>Agama</th>
                                    <th>Tempat</th>
                                    <th>Tgl Lahir</th>
                                    <th>Jalan</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten</th>
                                    <th>Provinsi</th>
                                    <th>TK</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php

            $no  = 1;
            $noa = 1;
            $nob = 1;
            foreach ($siswa->result_array() as $sw) {
                if ($sw['kelas'] == $kl->id_kelas) {
                    ?>
                            <tr>
                                <?php if ($akun['level'] == '1') {?>
                                <td>
                                    <div class="checkbox checkbox-fill d-inline">
                                      <input type="checkbox" name="id_siswa[]" value="<?php echo $sw['id_siswa']; ?>" class="check-item-<?=$kl->id_kelas?>" id="check-<?=$noa++?>">
                                        <label for="check-<?=$nob++?>" class="cr"></label>
                                    </div>
                                </td>
                            <?php }?>
                                <td><?=$no++?></td>
                                <td>
                                <a data-uk-tooltip="{pos:'top'}" title="Hapus" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_siswa(<?php echo $sw['id_siswa']; ?>)"><i class="feather icon-trash"></i></a>
                                <a data-uk-tooltip="{pos:'top'}" title="Edit" data-uk-modal="{target:'#edit_siswa_<?php echo $sw['id_siswa']; ?>'}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>
                                <a data-uk-tooltip="{pos:'top'}" title="Detail" href="<?php echo base_url('admin/detailsiswa/') . $sw['id_siswa'] ?>" class="md-btn md-btn-primary md-btn-small md-btn-wave-light"><i class="fas fa-address-card"></i></a>
                                </td>
                                <td><?php echo $sw['nm_siswa']; ?></td>
                                <td><?php echo $sw['nis']; ?></td>
                                <td><?php echo $sw['nisn']; ?></td>
                                <td><?php echo $sw['jk']; ?></td>
                                <td><?php echo $sw['agama']; ?></td>
                                <td><?php echo $sw['tempat']; ?></td>
                                <td><?php

                    if ($sw['tanggal_lahir'] == '0000-00-00') {
                        echo "";
                    } else {
                        echo tgl_indo($sw['tanggal_lahir']);
                    }
                    ?></td>
                                <td><?php echo $sw['jalan']; ?></td>
                                <td><?php echo $sw['kel']; ?></td>
                                <td><?php echo $sw['kec']; ?></td>
                                <td><?php echo $sw['kab']; ?></td>
                                <td><?php echo $sw['prov']; ?></td>
                                <td><?php echo $sw['pdd_sb']; ?></td>
                            </tr>
    <?php }}?>
                    </tbody>
                                                </table>
                                                <?php if ($akun['level'] == '1') {?>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="md-btn md-btn-danger md-btn-wave-light" id="btn-delete-<?=$kl->id_kelas?>" title="Hapus"><i class="feather icon-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            <?php }?>
                                            </form>
                                            </div>

    <script>

         $(document).ready(function(){
            $("#check-all-<?=$kl->id_kelas?>").click(function(){
              if($(this).is(":checked"))
                $(".check-item-<?=$kl->id_kelas?>").prop("checked", true);
              else
                $(".check-item-<?=$kl->id_kelas?>").prop("checked", false);
            });

            $("#btn-delete-<?=$kl->id_kelas?>").click(function(){
              var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?");
              if(confirm)
                $("#form-delete-<?=$kl->id_kelas?>").submit();
            });
          });

    </script>

                    </div>
        <?php }}}?>
        </div>



            </div>
        </div>
    </div>
</div>


<?php foreach ($kelas->result_array() as $kl) {
    ?>

<div class="uk-modal" id="tambah_siswa_<?php echo $kl['id_kelas'] ?>">
      <div class="uk-modal-dialog" style="width: 1000px;">
        <div class="uk-modal-header">
            <div class="uk-grid">
                <div class="uk-width-7-10">
                    <h3 class="uk-modal-title">Tambah Data Siswa Kelas <?php echo $kl['nm_kelas'] ?></h3>
                </div>
                <div class="uk-width-3-10 uk-text-right">
                    <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <hr>
        </div>

        <div style='display: none;' id='alert-tambah-<?php echo $kl['id_kelas'] ?>'>
            <div class='uk-alert uk-alert-success' data-uk-alert>
                        <a href='#' class='uk-alert-close uk-close'></a>
                                <i class='fas fa-check-circle'>&nbsp;</i>
                                Berhasil Menambahkan Data Siswa
                    </div>
        </div>

        <div class="uk-grid">
            <div class="uk-width-5-10">
                <div class="uk-form-row">
                    <label>NIS</label>
                    <input class="md-input" id="nis-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>NISN</label>
                    <input class="md-input" id="nisn-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Nama</label>
                    <input class="md-input" id="nm_siswa-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Jenis Kelamin</label><br>
                        <p style="color: red; display: none;" id="alert-jk-<?php echo $kl['id_kelas'] ?>">Wajib di isi !</p>
                        <span class="icheck-inline">
                            <input type="radio" name="jk-<?php echo $kl['id_kelas'] ?>" id="jk-<?php echo $kl['id_kelas'] ?>" required="" value="L" data-md-icheck required="" />
                            <label class="inline-label">L</label>
                        </span>
                        <span class="icheck-inline">
                            <input type="radio" name="jk-<?php echo $kl['id_kelas'] ?>" id="jk-<?php echo $kl['id_kelas'] ?>" required="" value="P" data-md-icheck required="" />
                            <label class="inline-label">P</label>
                        </span>
                </div>
                <div class="uk-form-row">
                    <label>Agama</label>
                    <input class="md-input" id="agama-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Tempat Lahir</label>
                    <input class="md-input" id="tempat-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>
            </div>
            <div class="uk-width-5-10">
                <div class="uk-form-row">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="md-input" id="tanggal_lahir-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Jalan</label>
                    <input class="md-input" id="jalan-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Kelurahan</label>
                    <input class="md-input" id="kel-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Kecamatan</label>
                    <input class="md-input" id="kec-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Kabupaten</label>
                    <input class="md-input" id="kab-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>
                <div class="uk-form-row">
                    <label>Provinsi</label>
                    <input class="md-input" id="prov-<?php echo $kl['id_kelas'] ?>" autocomplete="off">
                </div>

                <input type="hidden" name="pdd_sb-<?php echo $kl['id_kelas'] ?>" value="">

            </div>
        </div>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="submit_siswa(<?php echo $kl['id_kelas'] ?>)">Simpan</button>
        </div>

    </div>
</div>

<?php }?>

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

            </div>
        </div>
        <div class="uk-text-right">
            <button class="md-btn md-btn-primary" onclick="edit_siswa(<?php echo $sw['id_siswa'] ?>)">Simpan</button>
        </div>

    </div>
</div>

<?php }?>


<script>
    // tampil_siswa();
    function tampil_siswa() {
    $("#show_siswa_all").hide();
    var fk = document.getElementById('filter-kelas').value;
    if (fk == 'all') {
        location.reload();
    } else {
            $.ajax({
                type : 'post',
                data : {fk:fk},
                url : '<?=base_url('proses/get_siswa')?>',
                success: function(data) {
                    $("#show_siswa").html(data);
                }
            })
        }
    }

        function submit_siswa(id) {
            var nis = $("#nis-"+id).val();
            var nisn = $("#nisn-"+id).val();
            var nm_siswa = $("#nm_siswa-"+id).val();
            var jk = $("#jk-"+id+":checked").val();
            var agama = $("#agama-"+id).val();
            var tempat = $("#tempat-"+id).val();
            var tanggal_lahir = $("#tanggal_lahir-"+id).val();
            var jalan = $("#jalan-"+id).val();
            var kel = $("#kel-"+id).val();
            var kec = $("#kec-"+id).val();
            var kab = $("#kab-"+id).val();
            var prov = $("#prov-"+id).val();
            // var pdd_sb = $("#pdd_sb-"+id).val();
            var kelas = id;

            if (jk == undefined) {
                $("#alert-jk-"+id).slideDown('slow');
            }

            // if (pdd_sb == undefined) {
            //     $("#alert-pdd-"+id).slideDown('slow');
            // }

            // console.log(nis+nisn+nm_siswa+jk+agama+tempat+tanggal_lahir+jalan+kel+kec+kab+prov+pdd_sb);

            $.ajax({
                type : 'POST',
                url : '<?=base_url('proses/tambah_siswa')?>',
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
                    // pdd_sb:pdd_sb,
                    kelas:kelas,
                },
                success: function(data) {
                swal("Berhasil Menambahkan Data", {
                   icon: "success",
                }).then(function(){
                    location.reload();
                })
                }
            })
        }

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
            var pdd_sb = $("#pdd_sb2-"+id).val();
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

        function update_siswa(id) {
            var nis = $("#nis-"+id).val();
            var nisn = $("#nisn-"+id).val();
            var nm_siswa = $("#nm_siswa-"+id).val();
            var jk = $("#jk-"+id).val();
            var agama = $("#agama-"+id).val();
            var tempat = $("#tempat-"+id).val();
            var tanggal_lahir = $("#tanggal_lahir-"+id).val();
            var jalan = $("#jalan-"+id).val();
            var kel = $("#kel-"+id).val();
            var kec = $("#kec-"+id).val();
            var kab = $("#kab-"+id).val();
            var prov = $("#prov-"+id).val();
            var pdd_sb = $("#pdd_sb-"+id).val();
            var id_siswa = id;

            $.ajax({
                type : 'POST',
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
                    tampil_siswa();
                    $("#alert-edit-"+id).slideDown('slow');
                    $("#alert-edit-"+id).slideUp('slow');
                }
            })
        }

        function hapus_siswa(id) {

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
                        url : '<?php echo base_url('proses/hapus_siswa') ?>',
                        data : {id:id},
                        success: function(data) {
                            // tampil_siswa();
                                swal("Berhasil Menghapus Data", {
                                    icon: "success",
                                }).then(function(){
                                    location.reload();
                                })
                        }
                    })
                }
             });
    }
</script>
