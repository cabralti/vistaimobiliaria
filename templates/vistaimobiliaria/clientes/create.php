<?php $v->layout("layouts/master") ?>

<?php $v->start('content-header') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Criar Cliente</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= url('') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= url('clientes') ?>">Clientes</a></li>
                    <li class="breadcrumb-item active">Criar Cliente</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php $v->end(); ?>

<!-- Default box -->
<div class="card">
    <div class="card-body">
        <form action="<?= url('clientes') ?>" method="post" class="form-create">
            <div class="form-group">
                <label for="">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" placeholder="Informe o nome completo"
                       required>
            </div>
            <div class="form-group">
                <label for="">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Informe o e-mail"
                       required>
            </div>
            <div class="form-group">
                <label for="">Telefone:</label>
                <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(xx) xxxxx-xxxx">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" title="Salvar Dados"><i class="fa fa-save"></i> Salvar
                </button>
                <button type="reset" class="btn btn-default" title="Limpar Formulário"> Limpar</button>
            </div>
        </form>
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

        $('.form-create').submit(function (e) {
            e.preventDefault();

            var form_action = $(this).attr('action');
            var form_data = $(this).serialize();

            $.ajax({
                url: form_action,
                type: 'POST',
                dataType: 'json',
                data: form_data,
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

        });

    });

</script>

<?php $v->end(); ?>
