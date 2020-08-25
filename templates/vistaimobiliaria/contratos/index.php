<?php $v->layout("layouts/master") ?>

<?php $v->start('content-header') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-file-contract"></i> Contratos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= url('') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Contratos</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php $v->end(); ?>

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Listagem de Contratos</h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                    <a class="btn btn-primary" href="<?= url('contratos/criar') ?>">
                        <i class="fa fa-plus"></i> Criar
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped data-table">
            <thead>
            <tr>
                <th>Contrato Nº</th>
                <th>Locador</th>
                <th>Locatário</th>
                <th>Início</th>
                <th>Vigência</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?= $record['id'] ?></td>
                    <td>
                        <a href="<?= url("proprietarios/" . $record->proprietario->id . "/editar") ?>">
                            <?= $record->proprietario->nome ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?= url("clientes/" . $record->cliente->id . "/editar") ?>">
                            <?= $record->cliente->nome ?>
                        </a>
                    </td>
                    <td><?= $record['data_inicio'] ?></td>
                    <td><?= $record['vigencia'] ?> meses</td>
                    <td>
                        <a href="<?= url("contratos/" . $record['id'] . "/visualizar") ?>"
                           class="btn btn-default btn-sm">
                            <i class="fa fa-eye"></i> Visualizar
                        </a>
                        <button data-action="<?= url("contratos/" . $record['id'] . "/excluir") ?>"
                                class="btn btn-danger btn-sm btn-destroy">
                            <i class="fa fa-trash"></i> Excluir
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->

<?php $v->start('scripts') ?>

<script>
    $(function () {
        $('.data-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('.btn-destroy').on('click', function (e) {
            e.preventDefault();

            var url_action = $(this).data('action');

            Swal.fire({
                title: 'Você tem certeza?',
                text: "Essa ação não poderá ser revertida!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url_action,
                        type: 'DELETE',
                        dataType: 'json',
                        beforeSend: function () {

                        },
                        success: function (response) {
                            Swal.fire({
                                title: response.title,
                                text: response.msg,
                                icon: response.type
                            }).then((result) => {
                                if (result.value) {
                                    if (response.redirect) {
                                        window.location = response.redirect;
                                    } else {
                                        return false;
                                    }
                                }
                            });
                        },
                        error: function (response) {

                        }
                    });
                }
            });
        });

    });
</script>

<?php $v->end(); ?>
