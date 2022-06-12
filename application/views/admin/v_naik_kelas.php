<div id="page_content">
    <div id="page_content_inner">

	<div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-1-1">
                <div class="uk-grid">
                    <div class="uk-width-medium-5-10">

                        <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-5-10">
                            <h3>Kenaikan Kelas</h3>
                        </div>
                        <div class="uk-width-medium-5-10 uk-text-right">
                            <a href="#" data-uk-tooltip="{pos:'top'}" title="Turun Kelas" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" id="btn-turun" title="Hapus"><i class="feather icon-arrow-down-left"></i>&nbsp;Turun</a>

                            <a href="#" data-uk-tooltip="{pos:'top'}" title="Naik Kelas" class="md-btn md-btn-small md-btn-primary md-btn-wave-light" id="btn-naik" title="Hapus"><i class="feather icon-arrow-up-right"></i>&nbsp;Naik</a>
                        </div>
                    </div><hr>

                    <?php echo $this->session->flashdata('nk'); ?>

                    <div class="table-responsive">
                        <table id="dt_default" class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">
                                        <div class="checkbox checkbox-fill d-inline">
                                            <input type="checkbox" name="checkbox-fill-1" id="check-all">
                                            <label for="check-all" class="cr"></label>
                                        </div>
                                    </th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Kelas</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$no  = 1;
$noa = 1;
$nob = 1;
foreach ($siswa->result_array() as $sw) {
    if ($sw['kelas'] < 7) {
        ?>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-fill d-inline">
                                          <input type="checkbox" id="id_siswa" value="<?php echo $sw['id_siswa']; ?>" class="check-item" id="check-<?=$noa++?>">
                                            <label for="check-<?=$nob++?>" class="cr"></label>
                                        </div>
                                    </td>
                                    <td><?=$no++?></td>
                                    <td><?php echo $sw['nm_siswa']; ?></td>
                                    <td><?php echo $sw['nis']; ?></td>
                                    <td><?php echo $sw['nm_kelas']; ?></td>
                                    <!-- <td>
                                    <a data-uk-tooltip="{pos:'top'}" title="Berhenti Sekolah" href="#" class="md-btn md-btn-small md-btn-danger md-btn-wave-light" onclick="hapus_siswa(<?php echo $sw['id_siswa']; ?>)"><i class="feather icon-trash"></i></a>
                                    </td> -->
                                </tr>
        <?php }}?>
                            </tbody>
                        </table>
                    </div>


                    </div>
                </div>

                    </div>

                    <div class="uk-width-medium-5-10">

                        <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-7-10">
                            <h3>Alumni</h3>
                        </div>
                        <div class="uk-width-medium-3-10 uk-text-right">

                        </div>
                    </div><hr>


                    <div class="table-responsive">
                        <table id="dt_default" class="uk-table uk-table-striped dt_default" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$no  = 1;
$noa = 1;
$nob = 1;
foreach ($siswa->result_array() as $sw) {
    if ($sw['kelas'] >= 7) {
        ?>
                                <tr>
                                    <td><?=$no++?></td>
                                    <td><?php echo $sw['nm_siswa']; ?></td>
                                    <td><?php echo $sw['nis']; ?></td>
                                </tr>
        <?php }}?>
                            </tbody>
                        </table>
                    </div>


                    </div>
                </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


        <script>
             $(document).ready(function(){
                $("#check-all").click(function(){
                  if($(this).is(":checked"))
                    $(".check-item").prop("checked", true);
                  else
                    $(".check-item").prop("checked", false);
                });

                var i = 0;
                $("#btn-naik").click(function(){
                    var id = [];
                    $('#id_siswa:checked').each(function() {
                        id[i++] = $(this).val();
                    })
                    console.log(id);
                    swal({
                            title: "Yakin Menaikan Kelas?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    type : 'POST',
                                    url : '<?php echo base_url('proses/naik_kelas') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        if (id == 0) {
                                             swal("Pilih siswa dulu", {
                                                icon: "warning",
                                            })
                                        } else {
                                             swal("Successfully", {
                                                icon: "success",
                                            }).then(function(){
                                                location.reload();
                                            })

                                    }
                                        }
                                })
                            }
                         });
                });

                 $("#btn-turun").click(function(){
                    var id = [];
                    $('#id_siswa:checked').each(function() {
                        id[i++] = $(this).val();
                    })
                    console.log(id);
                    swal({
                            title: "Yakin Turun Kelas?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    type : 'POST',
                                    url : '<?php echo base_url('proses/turun_kelas') ?>',
                                    data : {id:id},
                                    success: function(data) {
                                        if (id == 0) {
                                             swal("Pilih siswa dulu", {
                                                icon: "warning",
                                            })
                                        } else {
                                             swal("Successfully", {
                                                icon: "success",
                                            }).then(function(){
                                                location.reload();
                                            })

                                    }
                                        }
                                })
                            }
                         });
                });

              });
        </script>
