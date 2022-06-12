<div id="page_content">
    <div id="page_content_inner">

	<div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-1-1">

                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-grid">
                            <div class="uk-width-medium-7-10">
                                <h3>Penilaian Sikap</h3>
                            </div>
                            <div class="uk-width-medium-3-10 uk-text-right">
                                <!-- <a href="#" class="md-btn md-btn-danger md-btn-wave-light"><i class="fas fa-print"></i></a> -->
                            </div>
                        </div><hr>

                        <table class="uk-table">
                            <?php foreach ($kelas as $kl) {?>
                                <tr>
                                    <td style="width: 100px;">Kelas</td>
                                    <td>:</td>
                                    <td><?=$kl->nm_kelas?></td>
                                </tr>
                            <?php }?>
                            <?php foreach ($taj as $tj) {?>
                                <tr>
                                    <td>Semester</td>
                                    <td>:</td>
                                    <td><?=$tj->smt?></td>
                                </tr>
                                <tr>
                                    <td>Tahun Ajaran</td>
                                    <td>:</td>
                                    <td><?=$tj->nm_tahunajaran?></td>
                                </tr>
                            <?php }?>
                            </table>

                            <table>
                                <tr>
                                    <th colspan="3" class="uk-text-center"><b>Keterangan</b></th>
                                </tr>
                                <tr>
                                    <th>Nilai Rata-Rata</th>
                                    <th></th>
                                    <th>Predikat</th>
                                </tr>
                                <tr>
                                    <td>3 - 4</td>
                                    <td>:</td>
                                    <td>SB (Sangat Baik)</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>:</td>
                                    <td>B (Baik)</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>:</td>
                                    <td>K (Kurang)</td>
                                </tr>
                            </table>
                    </div>
                </div>


                <div class="md-card">
                <div class="md-card-content">

                    <div class="uk-grid">
                        <div class="uk-width-1-1">

                            <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
                                <li class="uk-active"><a href="#">Sikap Spiritual</a></li>
                                <li><a href="#">Sikap Sosial</a></li>
                            </ul>
                            <ul id="tabs_1" class="uk-switcher uk-margin">
                                <li>

                                    <div id="show_nilai_ki1_b"></div>

        <div class="uk-text-right" id="show_btn_ki1"></div>


        <div style="display: none; margin-top: 5px;" id="alert-tambah-ki1">
            <div class="uk-alert uk-alert-success" data-uk-alert>
                        <a href="#" class="uk-alert-close uk-close"></a>
                                <i class="fas fa-check-circle">&nbsp;</i>
                                Successfully !
                    </div>
        </div>
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
                         <tbody id="show_nilai_ki1"></tbody>
                </table>

            </div>
                                </li>
                                <li>
                                    <div id="show_nilai_ki2_b"></div>

                                    <div class="uk-text-right" id="show_btn_ki2"></div>

                    <div style="display: none; margin-top: 5px;" id="alert-tambah-ki2">
                        <div class="uk-alert uk-alert-success" data-uk-alert>
                                    <a href="#" class="uk-alert-close uk-close"></a>
                                            <i class="fas fa-check-circle">&nbsp;</i>
                                            Successfully !
                                </div>
                    </div>
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
                                     <tbody id="show_nilai_ki2"></tbody>
                            </table>

                        </div>

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


<script>

    // SIKAP SPIRITUAL

        tampil_nilai_ki1();
        function tampil_nilai_ki1() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_nilai_ki1/' . $id . '/' . $ta)?>',
                    success: function(data) {
                        $("#show_nilai_ki1").html(data);
                    }
                })
            }

        tampil_btn_ki1();
        function tampil_btn_ki1() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_btn_ki1/' . $id . '/' . $ta)?>',
                    success: function(data) {
                        $("#show_btn_ki1").html(data);
                    }
                })
            }

            // B

        tampil_nilai_ki1_b();
        function tampil_nilai_ki1_b() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_nilai_ki1_b/' . $id . '/' . $ta)?>',
                    success: function(data) {
                        $("#show_nilai_ki1_b").html(data);
                    }
                })
            }

        tampil_btn_ki1_b();
        function tampil_btn_ki1_b() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_btn_ki1_b/' . $id . '/' . $ta)?>',
                    success: function(data) {
                        $("#show_btn_ki1_b").html(data);
                    }
                })
            }

        tampil_nilai_ki2_b();
        function tampil_nilai_ki2_b() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_nilai_ki2_b/' . $id . '/' . $ta)?>',
                    success: function(data) {
                        $("#show_nilai_ki2_b").html(data);
                    }
                })
            }

        tampil_btn_ki2_b();
        function tampil_btn_ki2_b() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_btn_ki2_b/' . $id . '/' . $ta)?>',
                    success: function(data) {
                        $("#show_btn_ki2_b").html(data);
                    }
                })
            }

    function getSum(total, num) {
      return total + Math.round(num);
    }


<?php
$siswa = $this->db->query("SELECT * FROM tb_siswa WHERE kelas=" . $id . " ")->result();
foreach ($siswa as $sw) {
    ?>
    function cek_predikat_<?=$sw->id_siswa . '_' . $id . '_' . $ta?>(id, no, kl, ta) {
        var i;
        var arr = [];
        for(i = 1; i<=no; i++) {
            arr.push($("#nilai_ki1_"+id+'_'+i+kl+ta).val());
        }

        var lg = arr.length;
        var sum = arr.reduce(getSum, 0);
        var avg = sum/lg;

        if (avg >= 3 && avg <= 4) {
            $("#predikat_ki1_"+id+kl+ta).val("SB");
        } else if (avg >= 2 && avg < 3) {
            $("#predikat_ki1_"+id+kl+ta).val("B");
        } else if (avg < 2) {
            $("#predikat_ki1_"+id+kl+ta).val("K");
        }

    }
<?php }?>

<?php
$ski1 = $this->db->query("SELECT * FROM tb_sikap_ki1 WHERE kelas=" . $id . " AND  ta=" . $ta . " ")->result();
foreach ($ski1 as $sw) {
    ?>
    function cek_predikat_<?=$sw->id_sikap_ki1 . '_' . $id . '_' . $ta?>(id, no, kl, ta) {
        var i;
        var arr = [];
        for(i = 1; i<=no; i++) {
            arr.push($("#nilai_ki1_"+id+'_'+i+kl+ta).val());
        }

        var lg = arr.length;
        var sum = arr.reduce(getSum, 0);
        var avg = sum/lg;

        if (avg >= 3 && avg <= 4) {
            $("#predikat_ki1_"+id+kl+ta).val("SB");
        } else if (avg >= 2 && avg < 3) {
            $("#predikat_ki1_"+id+kl+ta).val("B");
        } else if (avg < 2) {
            $("#predikat_ki1_"+id+kl+ta).val("K");
        }

    }
<?php }?>

<?php
foreach ($siswa as $sw) {
    ?>
    function cek_predikat2_<?=$sw->id_siswa . '_' . $id . '_' . $ta?>(id, no, kl, ta) {
        var i;
        var arr = [];
        for(i = 1; i<=no; i++) {
            arr.push($("#nilai_ki2_"+id+'_'+i+kl+ta).val());
        }

        var lg = arr.length;
        var sum = arr.reduce(getSum, 0);
        var avg = sum/lg;

        if (avg >= 3 && avg <= 4) {
            $("#predikat_ki2_"+id+kl+ta).val("SB");
        } else if (avg >= 2 && avg < 3) {
            $("#predikat_ki2_"+id+kl+ta).val("B");
        } else if (avg < 2) {
            $("#predikat_ki2_"+id+kl+ta).val("K");
        }

    }
<?php }?>

<?php
$ski2 = $this->db->query("SELECT * FROM tb_sikap_ki2 WHERE kelas=" . $id . " AND  ta=" . $ta . " ")->result();
foreach ($ski2 as $sw) {
    ?>
    function cek_predikat2_<?=$sw->id_sikap_ki2 . '_' . $id . '_' . $ta?>(id, no, kl, ta) {
        var i;
        var arr = [];
        for(i = 1; i<=no; i++) {
            arr.push($("#nilai_ki2_"+id+'_'+i+kl+ta).val());
        }

        var lg = arr.length;
        var sum = arr.reduce(getSum, 0);
        var avg = sum/lg;

        if (avg >= 3 && avg <= 4) {
            $("#predikat_ki2_"+id+kl+ta).val("SB");
        } else if (avg >= 2 && avg < 3) {
            $("#predikat_ki2_"+id+kl+ta).val("B");
        } else if (avg < 2) {
            $("#predikat_ki2_"+id+kl+ta).val("K");
        }

    }
<?php }?>


        function submit_nilai_ki1() {
            var kolom_nilai_ki1 = $("input[name='kolom_nilai_ki1[]']").map(function()
            {
              return $(this).val();
            }).get();

            var kriteria_ki1 = $("input[name='kriteria_ki1[]']").map(function()
            {
              return $(this).val();
            }).get();

            var predikat_ki1 = $("input[name='predikat_ki1[]']").map(function()
            {
              return $(this).val();
            }).get();
            var siswa_ki1 = $("input[name='siswa_ki1[]']").map(function()
            {
              return $(this).val();
            }).get();
            var ta_ki1 = $("input[name='ta_ki1[]']").map(function()
            {
              return $(this).val();
            }).get();


            var deskripsi_ki1 = $("textarea[name='deskripsi_ki1[]']").map(function()
            {
              return $(this).val();
            }).get();

            var kelas_ki1 = $("input[name='kelas_ki1[]']").map(function()
            {
              return $(this).val();
            }).get();

            // NILAI KR3

            var siswa_kr3 = $("input[name='siswa_kr3[]']").map(function()
            {
              return $(this).val();
            }).get();
            var ta_kr3 = $("input[name='ta_kr3[]']").map(function()
            {
              return $(this).val();
            }).get();

            var kelas_kr3 = $("input[name='kelas_kr3[]']").map(function()
            {
              return $(this).val();
            }).get();

            // console.log(kolom_nilai_ki1);
            // console.log(kriteria_ki1);
            // console.log(predikat_ki1);
            // console.log(siswa_ki1);
            // console.log(ta_ki1);
            // console.log(smt_ki1);
            // console.log(deskripsi_ki1);
            // console.log(kelas_ki1);

            // console.log(siswa_kr3);
            // console.log(ta_kr3);
            // console.log(smt_kr3);
            // console.log(kelas_kr3);

        $.ajax({
          type : 'post',
            url : ' <?=base_url('proses/tambah_nilai_ki1')?>',
            data : {
                kolom_nilai_ki1:kolom_nilai_ki1,
                predikat_ki1:predikat_ki1,
                siswa_ki1:siswa_ki1,
                ta_ki1:ta_ki1,
                kriteria_ki1:kriteria_ki1,
                deskripsi_ki1:deskripsi_ki1,
                kelas_ki1:kelas_ki1,
                siswa_kr3:siswa_kr3,
                ta_kr3:ta_kr3,
                kelas_kr3:kelas_kr3,
            },
            success: function(data) {
              tampil_nilai_ki1();
              tampil_btn_ki1();
              tampil_nilai_ki1_b();
              $("#alert-tambah-ki1").slideDown("slow");
              $("#alert-tambah-ki1").slideUp("slow");
            }
        })
    }

    function ubah_nilai_ki1() {

            var predikat_ki1_b = $("input[name='predikat_ki1_b[]']").map(function()
            {
              return $(this).val();
            }).get();

            var deskripsi_ki1_b = $("textarea[name='deskripsi_ki1_b[]']").map(function()
            {
              return $(this).val();
            }).get();

            var id_ski1_b = $("input[name='id_ski1_b[]']").map(function()
            {
              return $(this).val();
            }).get();

            // NILAI KR3

            var id_nki_b = $("input[name='id_nki_b[]']").map(function()
            {
              return $(this).val();
            }).get();

            var kolom_nilai_ki1_b = $("input[name='kolom_nilai_ki1_b[]']").map(function()
            {
              return $(this).val();
            }).get();



        $.ajax({
          type : 'post',
            url : '<?=base_url('proses/update_nilai_ki1')?>',
            data : {
                predikat_ki1_b:predikat_ki1_b,
                deskripsi_ki1_b:deskripsi_ki1_b,
                id_ski1_b:id_ski1_b,
                id_nki_b:id_nki_b,
                kolom_nilai_ki1_b:kolom_nilai_ki1_b,
            },
            success: function(data) {
              tampil_nilai_ki1();
              tampil_btn_ki1();
              $("#alert-tambah-ki1").slideDown("slow");
              $("#alert-tambah-ki1").slideUp("slow");
            }
        })
    }

    function hapus_nilai_ki1() {

         var id_a = $("input[name='id_nki_b[]']").map(function()
            {
              return $(this).val();
            }).get();

        var id_b = $("input[name='id_sikap_ki1_b[]']").map(function()
            {
              return $(this).val();
            }).get();

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
                        url : '<?php echo base_url('proses/hapus_nilai_ki1') ?>',
                        data : {
                            id_a:id_a,
                            id_b:id_b,
                        },
                        success: function(data) {
                                swal("Berhasil Menghapus Data", {
                                    icon: "success",
                                })
                                tampil_nilai_ki1();
                                tampil_btn_ki1();
                        }
                    })
                }
             });

    }

    // SIKAP SOSIAL

    tampil_nilai_ki2();
        function tampil_nilai_ki2() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_nilai_ki2/' . $id . '/' . $ta)?>',
                    success: function(data) {
                        $("#show_nilai_ki2").html(data);
                    }
                })
            }

        tampil_btn_ki2();
        function tampil_btn_ki2() {
                $.ajax({
                    type : 'ajax',
                    url : '<?=base_url('proses/get_btn_ki2/' . $id . '/' . $ta)?>',
                    success: function(data) {
                        $("#show_btn_ki2").html(data);
                    }
                })
            }

        function submit_nilai_ki2() {
            var kolom_nilai_ki2 = $("input[name='kolom_nilai_ki2[]']").map(function()
            {
              return $(this).val();
            }).get();

            var kriteria_ki2 = $("input[name='kriteria_ki2[]']").map(function()
            {
              return $(this).val();
            }).get();

            var predikat_ki2 = $("input[name='predikat_ki2[]']").map(function()
            {
              return $(this).val();
            }).get();
            var siswa_ki2 = $("input[name='siswa_ki2[]']").map(function()
            {
              return $(this).val();
            }).get();
            var ta_ki2 = $("input[name='ta_ki2[]']").map(function()
            {
              return $(this).val();
            }).get();


            var deskripsi_ki2 = $("textarea[name='deskripsi_ki2[]']").map(function()
            {
              return $(this).val();
            }).get();

            var kelas_ki2 = $("input[name='kelas_ki2[]']").map(function()
            {
              return $(this).val();
            }).get();

            // NILAI Kr4

            var siswa_kr4 = $("input[name='siswa_kr4[]']").map(function()
            {
              return $(this).val();
            }).get();
            var ta_kr4 = $("input[name='ta_kr4[]']").map(function()
            {
              return $(this).val();
            }).get();

            var kelas_kr4 = $("input[name='kelas_kr4[]']").map(function()
            {
              return $(this).val();
            }).get();

            // console.log(kolom_nilai_ki2);
            // console.log(kriteria_ki2);
            // console.log(predikat_ki2);
            // console.log(siswa_ki2);
            // console.log(ta_ki2);
            // console.log(smt_ki2);
            // console.log(deskripsi_ki2);
            // console.log(kelas_ki2);

            // console.log(siswa_kr4);
            // console.log(ta_kr4);
            // console.log(smt_kr4);
            // console.log(kelas_kr4);

        $.ajax({
          type : 'post',
            url : '<?=base_url('proses/tambah_nilai_ki2')?>',
            data : {
                kolom_nilai_ki2:kolom_nilai_ki2,
                predikat_ki2:predikat_ki2,
                siswa_ki2:siswa_ki2,
                ta_ki2:ta_ki2,
                kriteria_ki2:kriteria_ki2,
                deskripsi_ki2:deskripsi_ki2,
                kelas_ki2:kelas_ki2,
                siswa_kr4:siswa_kr4,
                ta_kr4:ta_kr4,
                kelas_kr4:kelas_kr4,
            },
            success: function(data) {
              tampil_nilai_ki2();
              tampil_btn_ki2();
              tampil_nilai_ki2_b();
              $("#alert-tambah-ki2").slideDown("slow");
              $("#alert-tambah-ki2").slideUp("slow");
            }
        })
    }

    function ubah_nilai_ki2() {

            var predikat_ki2_b = $("input[name='predikat_ki2_b[]']").map(function()
            {
              return $(this).val();
            }).get();

            var deskripsi_ki2_b = $("textarea[name='deskripsi_ki2_b[]']").map(function()
            {
              return $(this).val();
            }).get();

            var id_ski2_b = $("input[name='id_ski2_b[]']").map(function()
            {
              return $(this).val();
            }).get();

            // NILAI Kr4

            var id_nki2_b = $("input[name='id_nki2_b[]']").map(function()
            {
              return $(this).val();
            }).get();

            var kolom_nilai_ki2_b = $("input[name='kolom_nilai_ki2_b[]']").map(function()
            {
              return $(this).val();
            }).get();



        $.ajax({
          type : 'post',
            url : '<?=base_url('proses/update_nilai_ki2')?>',
            data : {
                predikat_ki2_b:predikat_ki2_b,
                deskripsi_ki2_b:deskripsi_ki2_b,
                id_ski2_b:id_ski2_b,
                id_nki2_b:id_nki2_b,
                kolom_nilai_ki2_b:kolom_nilai_ki2_b,
            },
            success: function(data) {
              tampil_nilai_ki2();
              tampil_btn_ki2();
              console.log(data);
              $("#alert-tambah-ki2").slideDown("slow");
              $("#alert-tambah-ki2").slideUp("slow");
            }
        })
    }

    function hapus_nilai_ki2() {

         var id_a = $("input[name='id_nki2_b[]']").map(function()
            {
              return $(this).val();
            }).get();

        var id_b = $("input[name='id_sikap_ki2_b[]']").map(function()
            {
              return $(this).val();
            }).get();

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
                        url : '<?php echo base_url('proses/hapus_nilai_ki2') ?>',
                        data : {
                            id_a:id_a,
                            id_b:id_b,
                        },
                        success: function(data) {
                                swal("Berhasil Menghapus Data", {
                                    icon: "success",
                                })
                                tampil_nilai_ki2();
                                tampil_btn_ki2();
                        }
                    })
                }
             });

    }

</script>

