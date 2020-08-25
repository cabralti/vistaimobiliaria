<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | Vista Imobiliária</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= url("AdminLTE/plugins/fontawesome-free/css/all.min.css") ?>">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= url("AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css") ?> ">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= url("AdminLTE/plugins/toastr/toastr.min.css") ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= url("AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") ?>">
    <link rel="stylesheet"
          href="<?= url("AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= url("AdminLTE/dist/css/adminlte.min.css") ?>">
    <link rel="stylesheet" href="<?= url("style.css") ?>">
</head>
<body class="hold-transition sidebar-mini">

<div class="ajax_load">
    <div>
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <p class="ajax_load_box_title">Aguarde, carregando...</p>
        </div>
    </div>
</div>

<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= include('partials/sidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <?= $v->section("content-header"); ?>

        <!-- Main content -->
        <section class="content">

            <?= $v->section("content") ?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>Copyright &copy; <?= date('Y') ?></strong>
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= url("AdminLTE/plugins/jquery/jquery.min.js") ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= url("AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<!-- AdminLTE App -->
<script src="<?= url("AdminLTE/dist/js/adminlte.min.js") ?>"></script>
<!-- SweetAlert2 -->
<script src="<?= url("AdminLTE/plugins/sweetalert2/sweetalert2.min.js") ?>"></script>
<!-- Toastr -->
<script src="<?= url("AdminLTE/plugins/toastr/toastr.min.js") ?>"></script>

<!-- DataTables -->
<script src="<?= url("AdminLTE/plugins/datatables/jquery.dataTables.min.js") ?>"></script>
<script src="<?= url("AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") ?>"></script>
<script src="<?= url("AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js") ?>"></script>
<script src="<?= url("AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") ?>"></script>

<?= $v->section('scripts') ?>

</body>
</html>
