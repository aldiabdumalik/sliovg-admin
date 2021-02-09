<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url("assets") ?>/images/favicon.ico">

    <!-- DataTables -->
    <link href="<?= base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?= base_url('assets') ?>/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="<?= base_url('assets') ?>/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets') ?>/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css" />

    <link href="<?= base_url('assets') ?>/plugins/dropify/dropify.css" rel="stylesheet" type="text/css" />

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?= base_url("assets") ?>/css/Chart.min.css">

    <link href="<?= base_url('assets') ?>/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Toastr css -->
    <link href="<?= base_url("assets") ?>/plugins/jquery-toastr/jquery.toast.min.css" rel="stylesheet" />

    <!-- App css -->
    <link href="<?= base_url("assets") ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url("assets") ?>/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url("assets") ?>/css/metismenu.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url("assets") ?>/css/style.css" rel="stylesheet" type="text/css" />

    <script src="<?= base_url("assets") ?>/js/modernizr.min.js"></script>

</head>


<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">

            <div class="slimscroll-menu" id="remove-scroll">

                <!-- LOGO -->
                <div class="topbar-left">
                    <img src="<?= base_url("assets/images/icon/logo.png") ?>" width="150" alt="">
                </div>

                <!-- User box -->
                <div class="user-box" style="margin-top: -19px;">
                    <div class="user-img">
                        <img src="<?= base_url("assets/images/users/" . $this->session->userdata('foto')) ?>" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                    </div>
                    <h5><a href="#"><?= $this->session->userdata('username'); ?></a> </h5>
                    <p class="text-muted"><?= $this->session->userdata('level') ?></p>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul class="metismenu" id="side-menu">

                        <li>
                            <a href="<?= base_url("dashboard") ?>">
                                <i class="fa fa-dashboard"></i> <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url("users") ?>">
                                <i class="fa fa-users"></i> <span> User </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url("video") ?>">
                                <i class="fa fa-file-movie-o"></i> <span> Template Video </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url("footage") ?>">
                                <i class="fa fa-film"></i> <span> Footage </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url("audio") ?>">
                                <i class="fa fa-music"></i> <span> Audio </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url("calendar") ?>">
                                <i class="fa fa-calendar"></i> <span> Calendar </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url("render") ?>">
                                <i class="fa fa-cloud-download"></i> <span> Render </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url("report") ?>">
                                <i class="fa fa-line-chart"></i> <span> Report </span>
                            </a>
                        </li>
                    </ul>

                </div>
                <!-- Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <div class="content-page">

            <!-- Top Bar Start -->
            <div class="topbar">

                <nav class="navbar-custom">

                    <ul class="list-unstyled topbar-right-menu float-right mb-0">
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?= base_url("assets/images/users/" . $this->session->userdata('foto')) ?>" alt="user" class="rounded-circle"> <span class="ml-1"><?= $this->session->userdata('username') ?> <i class="mdi mdi-chevron-down"></i> </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="<?= base_url("login/logout") ?>" class="dropdown-item notify-item">
                                    <i class="fi-power"></i> <span>Logout</span>
                                </a>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left disable-btn">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                        <li>
                            <div class="page-title-box">
                                <h4 class="page-title"><?= $title ?> </h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li class="breadcrumb-item active"><?= $title ?></li>
                                </ol>
                            </div>
                        </li>

                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->



            <!-- Start Page content -->
            <div class="content">
                <div class="container-fluid">
                    <?= $contents ?>
                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer">
                2020 © Sun Life
            </footer>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <div class="baseurl" data-baseurl="<?= base_url() ?>"></div>
    <div class="flashdata" data-flashdata="<?= $this->session->flashdata('msg') ?>"></div>

    <!-- jQuery  -->
    <script src="<?= base_url("assets") ?>/js/jquery.min.js"></script>
    <script src="<?= base_url("assets") ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url("assets") ?>/js/metisMenu.min.js"></script>
    <script src="<?= base_url("assets") ?>/js/waves.js"></script>
    <script src="<?= base_url("assets") ?>/js/jquery.slimscroll.js"></script>

    <!-- Required datatable js -->
    <script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Toastr js -->
    <script src="<?= base_url("assets") ?>/plugins/jquery-toastr/jquery.toast.min.js" type="text/javascript"></script>

    <!-- Dropify -->
    <script src="<?= base_url('assets') ?>/plugins/dropify/dropify.js"></script>

    <!-- plugin js -->
    <script src="<?= base_url('assets') ?>/plugins/moment/moment.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/switchery/switchery.min.js"></script>

    <!-- chartjs -->
    <script src="<?= base_url("assets") ?>/js/Chart.min.js"></script>
    <!-- Dashboard Init -->
    <!-- <script src="<?= base_url("assets") ?>/pages/jquery.dashboard.init.js"></script> -->

    <!-- App js -->
    <script src="<?= base_url("assets") ?>/js/jquery.core.js"></script>
    <script src="<?= base_url("assets") ?>/js/jquery.app.js"></script>
    <script src="<?= base_url('assets') ?>/js/custom/<?= $js ?>.js"></script>
    <script src="<?= base_url('assets') ?>/js/global.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['FACEBOOK', 'TWITTER', 'YOUTUBR', 'INSTAGRAM', 'WHATSAPP', 'LINKEDIN'],
                datasets: [{
                    data: [900, 1000, 1200, 300, 1230, 320, 500],
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontSize: 10
                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                        label: 'views',
                        fill: true,
                        data: [900, 1000, 1200, 300],
                        backgroundColor: [
                            'rgba(0, 0, 0, 0)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'rendering video',
                        fill: true,
                        data: [700, 1100, 500, 200],
                        backgroundColor: [
                            'rgba(0, 0, 0, 0)',
                        ],
                        borderColor: [
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

</body>

</html>