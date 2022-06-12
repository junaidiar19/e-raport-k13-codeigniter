<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo base_url() ?>/images/logo-sd.png">
    <title>E-Raport K-13</title>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/bower_components/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/assets/icons/flags/flags.min.css" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/assets/css/main.min.css" media="all">

     <!-- fontawesome icon -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/feather/css/feather.css">
        <script type="text/javascript" src="<?php echo base_url() ?>assets/jquery/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/Chart.js"></script>
            <!-- kendo UI -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/kendo-ui/styles/kendo.common-material.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/kendo-ui/styles/kendo.material.min.css"/> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/select2.min.css" media="all">
    <style>

        .table-responsive {
            overflow-x:auto;
        }
        .center {
          text-align: center;
        }

        .my-custom-scrollbar {
            position: relative;
            height: 200px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }

        .top-menu-title {
            padding-left: 1.5rem;
            padding-top: 1rem;
        }

    </style>
<?php $guru = $this->db->query("SELECT * FROM tb_guru WHERE akun=" . $akun['id_akun'] . " ")->result();?>

<?php
function tgl_indo($date) {
    $BulanIndo = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    $tahun  = substr($date, 0, 4);
    $bulan  = substr($date, 5, 2);
    $tgl    = substr($date, 8, 2);
    $result = $tgl . "-" . $BulanIndo[(int) $bulan - 1] . "-" . $tahun;
    return ($result);
}

?>
<?php

function hari_ini() {
    $hari = date("D");

    switch ($hari) {
        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jum'at";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        case 'Sun':
            $hari_ini = "Minggu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return $hari_ini;
}

function array_rank($in) {
    # Keep input array "x" and replace values with rank.
    # This preserves the order. Working on a copy called $x
    # to set the ranks.
    // print "input\n";
    // print_r($in);
    $x = $in;
    arsort($x);
    // print "sorted\n";
    // print_r($x);
    # Initival values
    $rank       = 0;
    $hiddenrank = 0;
    $hold       = null;
    foreach ($x as $key => $val) {
        # Always increade hidden rank
        $hiddenrank += 1;
        # If current value is lower than previous:
        # set new hold, and set rank to hiddenrank.
        if (is_null($hold) || $val < $hold) {
            $rank = $hiddenrank;
            $hold = $val;
        }
        # Set rank $rank for $in[$key]
        $in[$key] = $rank;
    }
    // print "ranking result\n";
    // print_r($in);
    return $in;
}

?>

</head>
<?php foreach ($guru as $gr) {
    if ($gr->akun == $akun['id_akun']) {?>
    <body class=" sidebar_main_open sidebar_main_swipe" onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">

    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">

                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>

                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>
                    <div id="menu_top_dropdown" class="uk-float-left uk-hidden-small">
                        <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                            <a href="#" class="top_menu_toggle"><i class="material-icons md-24">&#xE8F0;</i></a>
                            <div class="uk-dropdown uk-dropdown-width-3">
                                <div class="uk-grid uk-dropdown-grid" data-uk-grid-margin>
                                    <div class="uk-width-2-3">
                                        <div class="uk-grid uk-grid-width-medium-1-3 uk-margin-top uk-margin-bottom uk-text-center" data-uk-grid-margin>
                                            <a href="page_mailbox.html">
                                                <i class="material-icons md-36">&#xE158;</i>
                                                <span class="uk-text-muted uk-display-block">Mailbox</span>
                                            </a>
                                            <a href="page_invoices.html">
                                                <i class="material-icons md-36">&#xE53E;</i>
                                                <span class="uk-text-muted uk-display-block">Invoices</span>
                                            </a>
                                            <a href="page_chat.html">
                                                <i class="material-icons md-36 md-color-red-600">&#xE0B9;</i>
                                                <span class="uk-text-muted uk-display-block">Chat</span>
                                            </a>
                                            <a href="page_scrum_board.html">
                                                <i class="material-icons md-36">&#xE85C;</i>
                                                <span class="uk-text-muted uk-display-block">Scrum Board</span>
                                            </a>
                                            <a href="page_snippets.html">
                                                <i class="material-icons md-36">&#xE86F;</i>
                                                <span class="uk-text-muted uk-display-block">Snippets</span>
                                            </a>
                                            <a href="page_user_profile.html">
                                                <i class="material-icons md-36">&#xE87C;</i>
                                                <span class="uk-text-muted uk-display-block">User profile</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-3">
                                        <ul class="uk-nav uk-nav-dropdown uk-panel">
                                            <li class="uk-nav-header">Components</li>
                                            <li><a href="components_accordion.html">Accordions</a></li>
                                            <li><a href="components_buttons.html">Buttons</a></li>
                                            <li><a href="components_notifications.html">Notifications</a></li>
                                            <li><a href="components_sortable.html">Sortable</a></li>
                                            <li><a href="components_tabs.html">Tabs</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>

                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image">
                            <?php if ($gr->akun == 1) {?>
                                <img class="md-user-image" src="<?php echo base_url() ?>images/admin.png" alt=""/>
                                <?php } else {?>
                                <img class="md-user-image" src="<?php echo base_url() ?>images/guru/<?=$gr->foto_guru?>" alt=""/>
                            <?php }?>
                            </a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="<?php echo base_url('login/logout') ?>">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form">
                <input type="text" class="header_main_search_input" />
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
            </form>
        </div>
    </header><!-- main header end -->
    <!-- main sidebar -->
    <aside id="sidebar_main">

        <!-- <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <a href="#" class="sSidebar_hide"><b><h4 style="color: ;">SDN PASAR LAMA 6</h4></b></a>
                <a href="#" class="sSidebar_show"><img src="<?php echo base_url() ?>/assets/assets/img/logo_main_small.png" alt="" height="32" width="32"/></a>
            </div>
        </div> -->

        <div class="menu_section">
            <div class="top-menu-title">
                <h4>E-Raport K-13</h4>
            </div>
            <ul>

                <li class="<?=($active == 'dashboard') ? 'current_section' : ''?>">
                    <a href="<?php echo base_url('admin') ?>">
                        <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                        <span class="menu_title">Dashboard</span>
                    </a>
                </li>

            <?php if ($akun['level'] == '1') {?>
                <li class="<?=($active == 'mapel') ? 'current_section' : ''?>">
                    <a href="<?php echo base_url('admin/mapel') ?>">
                        <span class="menu_icon"><i class="material-icons">list</i></span>
                        <span class="menu_title">Mata Pelajaran</span>
                    </a>
                </li>
            <?php }?>

            <?php if ($akun['level'] == '1') {?>
                <li class="<?=($active == 'ekskul_siswa') ? 'current_section' : ''?>">
                    <a href="<?php echo base_url('admin/ekskul_siswa') ?>">
                        <span class="menu_icon"><i class="material-icons">list</i></span>
                        <span class="menu_title">Ekstrakurikuler Siswa</span>
                    </a>
                </li>
            <?php }?>

            <?php if ($akun['level'] == '1') {?>
                <li class="<?=($active == 'guru') ? 'current_section' : ''?>">
                    <a href="<?php echo base_url('admin/guru') ?>">
                        <span class="menu_icon"><i class="material-icons">group</i></span>
                        <span class="menu_title">Guru</span>
                    </a>
                </li>
            <?php }?>

<?php if ($akun['level'] == '2') {?>
            <li class="<?=($active == 'guru') ? 'current_section' : ''?>">
                    <a href="<?php echo base_url('admin/detailguru/' . $gr->id_guru) ?>">
                        <span class="menu_icon"><i class="material-icons">account_circle</i></span>
                        <span class="menu_title">Profil</span>
                    </a>
                </li>
            <?php }?>

                <li class="<?=($active == 'siswa') ? 'current_section' : ''?>">
                    <a href="<?php echo base_url('admin/siswa') ?>">
                        <span class="menu_icon"><i class="material-icons">group</i></span>
                        <span class="menu_title">Siswa</span>
                    </a>
                </li>

                <li class="<?=($active == 'naikkelas') ? 'current_section' : ''?>">
                    <a href="<?php echo base_url('admin/naikkelas') ?>">
                        <span class="menu_icon"><i class="material-icons">trending_up</i></span>
                        <span class="menu_title">Kenaikan Kelas</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">list</i></span>
                        <span class="menu_title">Deskripsi Kompetensi</span>
                    </a>
                    <ul>
                        <li class="<?=($active == 'desk_ki3') ? 'act_item' : ''?>">
                            <a href="<?=base_url('admin/menu_desk_ki3')?>"><span class="menu_icon"><i class="material-icons">keyboard_arrow_right</i></span>&nbsp;KI-3 Pengetahuan</a>
                        </li>
                        <li class="<?=($active == 'desk_ki4') ? 'act_item' : ''?>">
                            <a href="<?=base_url('admin/menu_desk_ki4')?>"><span class="menu_icon"><i class="material-icons">keyboard_arrow_right</i></span>&nbsp;KI-4 Keterampilan</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>

    </aside><!-- main sidebar end -->
    <?php }}?>
