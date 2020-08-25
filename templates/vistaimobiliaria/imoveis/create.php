<?php $v->layout("layouts/master") ?>

<?php $v->start('content-header') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-home"></i> Criar Imóvel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= url('') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= url('imoveis') ?>">Imóveis</a></li>
                    <li class="breadcrumb-item active">Criar Imóvel</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php $v->end(); ?>

<!-- Default box -->
<div class="card">
    <div class="card-body">
        <form action="<?= url('imoveis') ?>" method="post" class="form-create">
            <div class="form-group">
                <label for="">Proprietário(a):</label>
                <select name="proprietario_id" id="proprietario_id" class="form-control" required>
                    <option value="">SELECIONE</option>

                    <?php foreach ($owners as $owner): ?>
                        <option value="<?= $owner['id'] ?>">#<?= $owner['id'] ?> - <?= $owner['nome'] ?> (<?= $owner['email'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">CEP:</label>
                        <input type="text" name="cep" id="cep" class="form-control" placeholder="000.000-00">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                        <label for="">UF:</label>
                        <select name="uf" id="uf" class="form-control" required>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group">
                        <label for="">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Informe a cidade"
                               required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="">Bairro:</label>
                        <input type="text" name="bairro" id="bairro" class="form-control"
                               placeholder="Informe o bairro" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="">Endereço:</label>
                        <input type="text" name="logradouro" id="logradouro" class="form-control"
                               placeholder="Informe o endereço" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                        <label for="">Nº:</label>
                        <input type="text" name="numero" id="numero" class="form-control" placeholder="Informe o número"
                               required>
                    </div>
                </div>
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
