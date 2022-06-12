
<div id="page_content">
    <div id="page_content_inner">

	<div class="uk-grid uk-grid-medium hierarchical_show" data-uk-grid-margin>
            <div class="uk-width-1-1">

                <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-7-10">
                            <h3>Data Guru</h3>
                        </div>
                        <div class="uk-width-medium-3-10 uk-text-right">
                       <!-- <a data-uk-modal="{target:'#tambah_akun'}" class="md-btn md-btn-warning md-btn-wave-light"><i class="fas fa-plus-circle"></i>&nbsp; Akun</a> -->
                            <a target="_blank" data-uk-tooltip="{pos:'top'}" title="Report Guru" href="<?=base_url('cetak/cetak_guru')?>" class="md-btn md-btn-danger md-btn-wave-light"><i class="fas fa-print"></i></a>
                        </div>
                    </div><hr>

                    <?php echo $this->session->flashdata('guru') ?>
                                            <div class="table-responsive">
                                                <form action="<?php echo base_url('admin/hapus_guru2') ?>" method="post" id="form-delete">
                                                <table class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px;">
                                                                <div class="checkbox checkbox-fill d-inline">
                                                                    <input type="checkbox" name="checkbox-fill-1" id="check-all">
                                                                    <label for="check-all" class="cr"></label>
                                                                </div>
                                                            </th>
                                                            <th>No</th>
                                                            <th>Aksi</th>
                                                            <th>Nama Guru</th>
                                                            <th>NIP</th>
                                                            <th>Wali Kelas</th>
                                                            <th>NUPTK</th>
                                                            <th>NOMOR PESERTA SERTIFIKAT PENDIDIK</th>
                                                            <th>Golongan</th>
                                                            <th>TMT SK PERTAMA KALI DI ANGKAT</th>
                                                            <th>TMT SK UNIT KERJA SEKARANG</th>
                                                            <th>Mengajar di Kelas</th>
                                                            <th>Jabatan</th>
                                                            <th>TMT JABATAN KEPSEK</th>
                                                            <th>SERTIFIKASI YA/TIDAK</th>
                                                            <th>Telepon</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
					    <tbody>
					    	<?php
$no  = 1;
$noa = 1;
$nob = 1;
foreach ($guru->result_array() as $gr) {
    if ($gr['akun'] != 1) {
        ?>
					    	<tr style="background: <?php if ($gr['jabatan'] == 1) {echo "yellow";}?>">
					    		<td>
					                <div class="checkbox checkbox-fill d-inline">
					                  <input type="checkbox" name="id_guru[]" value="<?php echo $gr['id_guru']; ?>" class="check-item" id="check-<?=$noa++?>">
					                    <label for="check-<?=$nob++?>" class="cr"></label>
					                </div>
					            </td>
					            <td><?=$no++?></td>
					    		<td>
					            <a data-uk-tooltip="{pos:'top'}" title="Hapus" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_guru(<?php echo $gr['id_guru']; ?>)"><i class="feather icon-trash"></i></a>
					            <a data-uk-tooltip="{pos:'top'}" title="Edit" href="#" data-uk-modal="{target:'#edit_guru_<?php echo $gr['id_guru']; ?>'}" class="md-btn md-btn-success md-btn-small md-btn-wave-light"><i class="feather icon-edit"></i></a>
					            <a data-uk-tooltip="{pos:'top'}" title="Detail" href="<?php echo base_url('admin/detailguru/') . $gr['id_guru'] ?>" class="md-btn md-btn-primary md-btn-small md-btn-wave-light"><i class="fas fa-address-card"></i></a>
                                <?php
if ($gr['akun'] == 0) {
            ?>
                                <a data-uk-modal="{target:'#tambah_akun_<?php echo $gr['id_guru']; ?>'}" class="md-btn md-btn-small md-btn-warning md-btn-wave-light"><i class="fas fa-plus-circle"></i>&nbsp; Akun</a>
                                <?php } else {?>
                                <a data-uk-modal="{target:'#edit_akun_<?php echo $gr['id_guru']; ?>'}" class="md-btn md-btn-small md-btn-danger md-btn-wave-light"><i class="fas fa-edit"></i>&nbsp; Akun</a>
                                <?php }?>
					            </td>
					    		<td><?php echo $gr['nm_guru']; ?></td>
					            <td><?php echo $gr['nip']; ?></td>
					            <td><?php if ($gr['wali_kelas'] == 0) {echo "-";} else {echo $gr['wali_kelas'];}?></td>
					            <td><?php echo $gr['nuptk']; ?></td>
					            <td><?php echo $gr['npsp']; ?></td>
					            <td><?php echo $gr['gol']; ?></td>
					            <td><?=($gr['sk_pertama'] == '') ? '' : tgl_indo($gr['sk_pertama'])?></td>
					            <td><?=($gr['sk_uk'] == '') ? '' : tgl_indo($gr['sk_uk'])?></td>
					    		<td><?php if ($gr['kelas'] == 0) {echo "-";} elseif ($gr['kelas'] == 7) {
            echo "Semua Kelas";
        } else {echo $gr['kelas'];}?></td>
					    		<td><?php if ($gr['jabatan'] == 1) {echo "KEPALA SEKOLAH";} else {echo "Guru " . $gr['nm_mapel'];}?></td>
					    		<td><?=($gr['th_jbkepsek'] == '') ? '' : tgl_indo($gr['th_jbkepsek'])?></td>
					    		<td><?php echo $gr['stfk_guru']; ?></td>
					            <td><?php echo $gr['no_telp']; ?></td>
					            <td><?php echo $gr['stt_guru']; ?></td>
					    	</tr>
	<?php }}?>
					</tbody>
                                                </table>
	                                                <table>
	                                                    <tr>
	                                                        <td>
	                                                            <a href="#" class="md-btn md-btn-danger md-btn-wave-light" id="btn-delete" title="Hapus"><i class="feather icon-trash"></i></a>
	                                                        </td>
	                                                    </tr>
	                                                </table>
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

<div class="md-fab-wrapper">
    <a data-uk-tooltip="{pos:'top'}" title="Tambah Guru" data-uk-modal="{target:'#tambah_guru'}" class="md-fab md-fab-primary md-fab-wave">
        <i class="material-icons">person_add</i>
    </a>
</div>

 <div class="uk-modal" id="tambah_guru">
                          <div class="uk-modal-dialog" style="width: 1000px;">
                            <div class="uk-modal-header">
                                <div class="uk-grid">
                                    <div class="uk-width-7-10">
                                        <h3 class="uk-modal-title">Tambah Data Guru</h3>
                                    </div>
                                    <div class="uk-width-3-10 uk-text-right">
                                        <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <form id="tambah-guru">

                            	<div class="uk-grid">
                            		<div class="uk-width-5-10">
                            			<div class="uk-form-row">
                            				<label>Nama</label>
                            				<input class="md-input" name="nm_guru" autocomplete="off">
                            			</div>
                            			<div class="uk-form-row">
                            				<label>NIP</label>
                            				<input class="md-input" name="nip" autocomplete="off">
                            			</div>
                            			<div class="uk-form-row">
                            				<label>NUPTK</label>
                            				<input class="md-input" name="nuptk" autocomplete="off">
                            			</div>
                            			<div class="uk-form-row">
                            				<label>NOMOR PESERTA SERTIFIKAT PENDIDIK</label>
                            				<input class="md-input" name="npsp" autocomplete="off">
                            			</div>
                            			<div class="uk-form-row">
                            				<label>GOLONGAN</label>
                            				<input class="md-input" name="gol" autocomplete="off">
                            			</div>
										<div class="uk-form-row">
                            				<label>TMT SK PERTAMA KALI DI ANGKAT</label>
                            				<input type="date" class="md-input" name="sk_pertama" autocomplete="off">
                            			</div>
                            			<div class="uk-form-row">
                            				<label>TMT SK UNIT KERJA SEKARANG</label>
                            				<input type="date" class="md-input" name="sk_uk" autocomplete="off">
                            			</div>
                            		</div>
                            		<div class="uk-width-5-10">
                            			<div class="uk-margin-medium-bottom">
                                            <select name="jabatan" class="uk-form-width" data-md-selectize-inline>
                                                <option value="">- Jabatan -</option>
                                                <?php foreach ($mapel->result_array() as $mp) {
    ?>
                                                <option value="<?php echo $mp['id_mapel'] ?>"><?php echo $mp['nm_mapel'] ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                            			<div class="uk-form-row">
                            				<label>TMT JABATAN KEPSEK</label>
                            				<input type="date" class="md-input" name="th_jbkepsek" autocomplete="off">
                            			</div>
                            			<div class="uk-form-row">
                            				<label>SERTIFIKASI</label><br><br>
			                            		<span class="icheck-inline">
			                                        <input type="radio" name="stfk_guru" id="ya" value="YA" data-md-icheck required="" />
			                                        <label for="ya" class="inline-label">YA</label>
			                                    </span>
			                                    <span class="icheck-inline">
			                                        <input type="radio" name="stfk_guru" id="tidak" value="TIDAK" data-md-icheck required="" />
			                                        <label for="tidak" class="inline-label">TIDAK</label>
			                                    </span>
                            			</div>

                            			<div class="uk-form-row">
                            				<label>STATUS</label><br><br>
			                            		<span class="icheck-inline">
			                                        <input type="radio" name="stt_guru" id="PNS" value="PNS" data-md-icheck required="" />
			                                        <label for="PNS" class="inline-label">PNS</label>
			                                    </span>
			                                    <span class="icheck-inline">
			                                        <input type="radio" name="stt_guru" id="HONOR" value="HONOR" data-md-icheck required="" />
			                                        <label for="HONOR" class="inline-label">HONOR</label>
			                                    </span>
                            			</div>

                            			<div class="uk-form-row">
                            				<label>TELPON</label>
                            				<input class="md-input" name="no_telp" autocomplete="off">
                            			</div>

                            			<br>

                            			<div class="uk-margin-medium-bottom">
					                        <select name="kelas" class="uk-form-width" data-md-selectize-inline>
					                            <option value="">-Mengajar di Kelas-</option>
					                            <?php foreach ($kelas->result_array() as $mp) {?>
					                            <option value="<?php echo $mp['id_kelas'] ?>"><?php echo $mp['nm_kelas'] ?></option>
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
                            <form action="<?php echo base_url('admin/edit_guru') ?>" method="post">
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
                            			<div class="uk-form-row">
                            				<label>TELEPON</label>
                            				<input class="md-input" name="no_telp" value="<?php echo $gr['no_telp']; ?>" autocomplete="off">
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


   <?php foreach ($guru->result() as $gr) {
    ?>
      <div class="uk-modal" id="tambah_akun_<?php echo $gr->id_guru; ?>">
        <div class="uk-modal-dialog" style="width: 800px;">
            <div class="uk-modal-header">
                <div class="uk-grid">
                    <div class="uk-width-7-10">
                        <h3 class="uk-modal-title">Tambah Akun Guru</h3>
                    </div>
                    <div class="uk-width-3-10 uk-text-right">
                        <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <hr>
            </div>
            <form action="<?php echo base_url('admin/tambah_akun_guru/' . $gr->id_guru) ?>" method="post">
            	<table class="uk-table" border="1">
            		<tr>
            			<th style="width: 300px;">Nama</th>
            			<th>Username</th>
            			<th>Password</th>
            		</tr>

            		<tr>
            			<td><?=$gr->nm_guru?></td>
            			<td><input class="md-input" name="username" autocomplete="off"></td>
            			<td><input class="md-input" name="password" autocomplete="off"></td>
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

<?php foreach ($guru->result() as $gr) {
    ?>
      <div class="uk-modal" id="edit_akun_<?php echo $gr->id_guru; ?>">
        <div class="uk-modal-dialog" style="width: 800px;">
            <div class="uk-modal-header">
                <div class="uk-grid">
                    <div class="uk-width-7-10">
                        <h3 class="uk-modal-title">Edit Akun Guru</h3>
                    </div>
                    <div class="uk-width-3-10 uk-text-right">
                        <button class="md-btn md-btn-flat md-btn-wave uk-modal-close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <hr>
            </div>
            <form action="<?php echo base_url('admin/edit_akun_guru') ?>" method="post">

                <table class="uk-table" border="1">
                    <tr>
                        <th style="width: 300px;">Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                    </tr>
<?php
$tb_akun = $this->db->query("SELECT * FROM tb_akun")->result();
    foreach ($tb_akun as $ak) {
        if ($ak->id_akun == $gr->akun) {?>
                    <tr>
                        <td><?=$gr->nm_guru?></td>
                        <td><input class="md-input" name="username" value="<?=$ak->username?>" autocomplete="off"></td>
                        <td><input class="md-input" name="pass_baru" autocomplete="off"></td>
                        <input type="hidden" name="pass_lama" value="<?=$ak->password?>">
                        <input type="hidden" name="id_akun" value="<?=$ak->id_akun?>">
                    </tr>
                <?php }}?>
                    </table>
                    <div class="uk-text-right">
                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                        <input type="submit" class="md-btn md-btn-primary" value="Simpan">
                    </div>
                </form>

        </div>
    </div>
<?php }?>


        <script>
        	$("#tambah-guru").submit(function(e) {
	            e.preventDefault()
	                $.ajax({
	                    type : 'POST',
	                    url : '<?php echo base_url('admin/tambah_guru') ?>',
	                    data : new FormData(this),
		                    processData:false,
		                     contentType:false,
		                     cache:false,
		                     async:false,
	                    	success: function(data) {
	                        swal("Berhasil Menambahkan Data", {
	                            icon: "success",
	                        }).then(function() {
                                location.reload();
                            })
	                    }
	                })
	    })

      function hapus_guru(id) {

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
                        url : '<?php echo base_url('admin/hapus_guru') ?>',
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




