<?= $this->extend('layouts/basico');
$this->section('title') ?> <?= $title ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<!-- Conteúdo -->
<div class="main" id="pagina">

    <div class="container">

        <div id="users-header">
            <h4>Editar usuário</h4>
            <hr>
        </div>

        <div class="mb-3">
            <a type="button" href="<?= base_url('/usuarios/' . $usuario['id']) ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>

        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="mb-1">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <?php $validation = \Config\Services::validation(); ?>
        <form action="<?= base_url('/usuarios/' . $usuario['id']) ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT" />

            <div class="form-group row">
                <label for="nome" class="col-sm-1 col-form-label">Nome:</label>
                <div class="col-sm-6">
                    <input type="text" name="nome" id="nome" value="<?= old('nome') ?? $usuario['nome'] ?>" class="form-control <?php if ($validation->getError('nome')) : ?>is-invalid<?php endif ?>">
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
                    <input type="text" name="id" id="id" value="<?= $usuario['id'] ?>" class="form-control" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="nivel" class="col-sm-1 col-form-label">Nível:</label>
                <div class="col-sm-6">
                    <select type="text" name="nivel" id="nivel" class="form-control" <?php if ($validation->getError('select')) : ?>is-invalid<?php endif ?>>
                        <?php if ($usuario['nivel'] == 'ANALISTA') : ?>
                            <option value="ANALISTA" <?= old('nivel') == 'ANALISTA' ? 'selected' : '' ?>>Analista</option>
                            <option value="ADMINISTRADOR" <?= old('nivel') == 'ADMINISTRADOR' ? 'selected' : '' ?>>Administrador</option>
                        <?php elseif ($usuario['nivel'] == 'ADMINISTRADOR') : ?>
                            <option value="ADMINISTRADOR" <?= old('nivel') == 'ADMINISTRADOR' ? 'selected' : '' ?>>Administrador</option>
                            <option value="ANALISTA" <?= old('nivel') == 'ANALISTA' ? 'selected' : '' ?>>Analista</option>
                        <?php endif ?>
                    </select>
                    <?php if ($validation->getError('nivel')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nivel') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <button type="submit" id="btnEnviar" class="btn btn-success my-1"><i class="far fa-save"></i> Salvar</button>

        </form>

    </div>
</div>


<?= $this->include('layouts/footer') ?>

<?= $this->endSection() ?>