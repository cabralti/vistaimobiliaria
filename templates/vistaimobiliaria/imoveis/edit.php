<?php $v->layout("layouts/master") ?>

<?php $v->start('content-header') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Editar Imóvel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= url('') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= url('/imoveis') ?>">Imóveis</a></li>
                    <li class="breadcrumb-item active">Editar Imóvel</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php $v->end(); ?>

<!-- Default box -->
<div class="card">
    <div class="card-body">
        <form action="<?= url("imoveis/" . $record['id'] . "/editar") ?>" method="post" class="form-edit">
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="">Proprietário(a):</label>
                <select name="proprietario_id" id="proprietario_id" class="form-control" required>
                    <option value="">SELECIONE</option>

                    <?php foreach ($owners as $owner): ?>
                        <option value="<?= $owner['id'] ?>"
                                <?= ($record['proprietario']['id'] == $owner['id']) ? 'selected' : '' ?>>
                            #<?= $owner['id'] ?> - <?= $owner['nome'] ?> (<?= $owner['email'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">CEP:</label>
                        <input type="text" name="cep" id="cep" class="form-control" placeholder="000.000-00" value="<?= $record['cep'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                        <label for="">UF:</label>
                        <select name="uf" id="uf" class="form-control" required>
                            <option value="AC" <?= ($record['uf'] == 'AC') ? 'selected' : '' ?>>Acre</option>
                            <option value="AL" <?= ($record['uf'] == 'AL') ? 'selected' : '' ?>>Alagoas</option>
                            <option value="AP" <?= ($record['uf'] == 'AP') ? 'selected' : '' ?>>Amapá</option>
                            <option value="AM" <?= ($record['uf'] == 'AM') ? 'selected' : '' ?>>Amazonas</option>
                            <option value="BA" <?= ($record['uf'] == 'BA') ? 'selected' : '' ?>>Bahia</option>
                            <option value="CE" <?= ($record['uf'] == 'CE') ? 'selected' : '' ?>>Ceará</option>
                            <option value="DF" <?= ($record['uf'] == 'DF') ? 'selected' : '' ?>>Distrito Federal</option>
                            <option value="ES" <?= ($record['uf'] == 'ES') ? 'selected' : '' ?>>Espírito Santo</option>
                            <option value="GO" <?= ($record['uf'] == 'GO') ? 'selected' : '' ?>>Goiás</option>
                            <option value="MA" <?= ($record['uf'] == 'MA') ? 'selected' : '' ?>>Maranhão</option>
                            <option value="MT" <?= ($record['uf'] == 'MT') ? 'selected' : '' ?>>Mato Grosso</option>
                            <option value="MS" <?= ($record['uf'] == 'MS') ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                            <option value="MG" <?= ($record['uf'] == 'MG') ? 'selected' : '' ?>>Minas Gerais</option>
                            <option value="PA" <?= ($record['uf'] == 'PA') ? 'selected' : '' ?>>Pará</option>
                            <option value="PB" <?= ($record['uf'] == 'PB') ? 'selected' : '' ?>>Paraíba</option>
                            <option value="PR" <?= ($record['uf'] == 'PR') ? 'selected' : '' ?>>Paraná</option>
                            <option value="PE" <?= ($record['uf'] == 'PE') ? 'selected' : '' ?>>Pernambuco</option>
                            <option value="PI" <?= ($record['uf'] == 'PI') ? 'selected' : '' ?>>Piauí</option>
                            <option value="RJ" <?= ($record['uf'] == 'RJ') ? 'selected' : '' ?>>Rio de Janeiro</option>
                            <option value="RN" <?= ($record['uf'] == 'RN') ? 'selected' : '' ?>>Rio Grande do Norte</option>
                            <option value="RS" <?= ($record['uf'] == 'RS') ? 'selected' : '' ?>>Rio Grande do Sul</option>
                            <option value="RO" <?= ($record['uf'] == 'RO') ? 'selected' : '' ?>>Rondônia</option>
                            <option value="RR" <?= ($record['uf'] == 'RR') ? 'selected' : '' ?>>Roraima</option>
                            <option value="SC" <?= ($record['uf'] == 'SC') ? 'selected' : '' ?>>Santa Catarina</option>
                            <option value="SP" <?= ($record['uf'] == 'SP') ? 'selected' : '' ?>>São Paulo</option>
                            <option value="SE" <?= ($record['uf'] == 'SE') ? 'selected' : '' ?>>Sergipe</option>
                            <option value="TO" <?= ($record['uf'] == 'TO') ? 'selected' : '' ?>>Tocantins</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group">
                        <label for="">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Informe a cidade"
                               required value="<?= $record['cidade'] ?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="">Bairro:</label>
                        <input type="text" name="bairro" id="bairro" class="form-control"
                               placeholder="Informe o bairro" required value="<?= $record['bairro'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="">Endereço:</label>
                        <input type="text" name="logradouro" id="logradouro" class="form-control"
                               placeholder="Informe o endereço" required value="<?= $record['logradouro'] ?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                        <label for="">Nº:</label>
                        <input type="text" name="numero" id="numero" class="form-control" placeholder="Informe o número"
                               required value="<?= $record['numero'] ?>">
                    </div>
                </div>
            </div>

            <div class=" form-group">
                <button type="submit" class="btn btn-success" title="Salvar Dados"><i class="fa fa-save"></i> Salvar
                </button>
                <a href="<?= url('imoveis') ?>" class="btn btn-default" title="Cancelar edição"> Cancelar</a>
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

        $('.form-edit').submit(function (e) {
            e.preventDefault();

            var form_action = $(this).attr('action');
            var form_data = $(this).serialize();

            $.ajax({
                url: form_action,
                type: 'PUT',
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
