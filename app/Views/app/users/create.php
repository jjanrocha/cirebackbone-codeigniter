<?= $this->extend('layouts/basico');
$this->section('title') ?> <?= $title ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<!-- Conteúdo -->
<div class="main" id="pagina">

    <div class="container">

        <div id="users-header">
            <h4>Cadastrar novo usuário</h4>
            <hr>
        </div>

        <div class="mb-3">
            <a type="button" href="<?php echo (base_url('/')) ?>/usuarios" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>

        <?php $validation = \Config\Services::validation(); ?>
        <form action="<?php echo (base_url('/')) ?>/usuarios/store" method="POST">
            <?= csrf_field() ?>
            <div class="form-group row">
                <label for="nome" class="col-sm-1 col-form-label">Nome:</label>
                <div class="col-sm-6">
                    <input type="text" name="nome" id="nome" value="<?= old('nome') ?>" class="form-control <?php if ($validation->getError('nome')) : ?>is-invalid<?php endif ?>">
                    <?php if ($validation->getError('nome')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nome') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="id" class="col-sm-1 col-form-label">RE:</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="id" value="<?= old('id') ?>" class="form-control <?php if ($validation->getError('id')) : ?>is-invalid<?php endif ?>">
                    <?php if ($validation->getError('id')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="nivel" class="col-sm-1 col-form-label">Nível:</label>
                <div class="col-sm-6">
                    <select type="text" name="nivel" id="nivel" class="form-control <?php if ($validation->getError('nivel')) : ?>is-invalid<?php endif ?>">
                        <option value="">Selecione o tipo de usuário</option>
                        <option value="ANALISTA" <?php if (old('nivel') == "ANALISTA") : ?>selected<?php endif ?>>Analista</option>
                        <option value="ADMINISTRADOR" <?php if (old('nivel') == "ADMINISTRADOR") : ?>selected<?php endif ?>>Administrador</option>
                    </select>
                    <?php if ($validation->getError('nivel')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nivel') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <button type="submit" id="btnEnviar" class="btn btn-success my-1">Confirmar</button>
            <button type="reset" id="btnReset" class="btn btn-danger my-1">Limpar</button>

        </form>

    </div>
</div>


<?= $this->include('layouts/footer') ?>

<?= $this->endSection() ?>