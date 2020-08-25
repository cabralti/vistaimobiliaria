<?php $v->layout("layouts/master") ?>

<?php $v->start('content-header') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-file-contract"></i> Criar Contrato</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= url('') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= url('contratos') ?>">Contratos</a></li>
                    <li class="breadcrumb-item active">Criar Contrato</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php $v->end(); ?>

<form action="<?= url('contratos') ?>" method="post" class="form-create">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Das Partes</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="">Proprietário:</label>
                        <select name="proprietario_id" id="proprietario_id" class="form-control"
                                data-action="<?= url('contratos/obter-dados-proprietario') ?>"
                                required>
                            <option value="">SELECIONE</option>

                            <?php foreach ($owners as $owner): ?>
                                <option value="<?= $owner['id'] ?>">#<?= $owner['id'] ?> - <?= $owner['nome'] ?>
                                    (<?= $owner['email'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="">Locatário:</label>
                        <select name="cliente_id" id="cliente_id" class="form-control" required>
                            <option value="">SELECIONE</option>

                            <?php foreach ($clients as $client): ?>
                                <option value="<?= $client['id'] ?>">#<?= $client['id'] ?> - <?= $client['nome'] ?>
                                    (<?= $client['email'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Parâmetros do Contrato</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">

            <div class="form-group">
                <label for="">Imóvel</label>
                <select name="imovel_id" id="imovel_id" class="form-control" required>
                    <option value="">SELECIONE</option>
                </select>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="">Data Início:</label>
                        <input type="text" name="data_inicio" id="data_inicio" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="">Dia Vencimento:</label>
                        <input type="text" name="dia_vencimento" id="dia_vencimento" class="form-control" value="1"
                               required readonly>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="">Vigência:</label>
                        <select name="vigencia" id="vigencia" class="form-control" required>
                            <option value="">SELECIONE</option>
                            <option value="12">12 meses</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="">Taxa de Administração:</label>
                        <input type="text" name="taxa_administracao" id="taxa_administracao" class="form-control"
                               placeholder="0,00" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="">Valor do Aluguel:</label>
                        <input type="text" name="valor_aluguel" id="valor_aluguel" class="form-control"
                               placeholder="0,00" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="">Valor do Condomínio:</label>
                        <input type="text" name="valor_condominio" id="valor_condominio" class="form-control"
                               placeholder="0,00" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="">Valor IPTU:</label>
                        <input type="text" name="valor_iptu" id="valor_iptu" class="form-control" placeholder="0,00"
                               required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <button type="submit" class="btn btn-success" title="Salvar Dados"><i class="fa fa-save"></i> Salvar
                </button>
                <button type="reset" class="btn btn-default" title="Limpar Formulário"> Limpar</button>
            </div>
        </div>
    </div>
</form>

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

        $('select[name="proprietario_id"]').change(function () {
            var owner = $(this);

            $.ajax({
                url: owner.data('action'),
                type: 'POST',
                dataType: 'json',
                data: {record: owner.val()},
                beforeSend: function (){
                    $('select[name="imovel_id"]').prop('disabled', true).html('<option>Carregando...</option>');
                },
                success: function (response) {
                    setFieldOwner(response);
                }
            });
        });

        function setFieldOwner(response) {
            // Imóveis
            $('select[name="imovel_id"]').prop('disabled', false).html('');
            if (response.properties != null && response.properties.length) {
                $('select[name="imovel_id"]').append($('<option>', {
                    value: '',
                    text: 'Não informado'
                }));

                $.each(response.properties, function (key, value) {
                    $('select[name="imovel_id"]').append($('<option>', {
                        value: value.id,
                        text: value.description,
                    }));
                });

            } else {
                $('select[name="imovel_id"]').append($('<option>', {
                    value: '',
                    text: 'Não informado'
                }));
            }
        }
    });

</script>

<?php $v->end(); ?>
