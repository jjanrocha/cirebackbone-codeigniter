<?= $this->extend('layouts/basico');
$this->section('title') ?> <?= $title ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<!-- Conteúdo -->
<div class="main" id="pagina">
    <div class="container">

        <h4>Links</h4>
        <hr>

        <?php if (session()->get('nivel') == 'ADMINISTRADOR') : ?>
            <a type="button" href="" class="btn btn-secondary"><i class="fas fa-plus"></i> Novo link</a>
        <?php endif; ?>

    </div>
</div>

<?= $this->include('layouts/footer') ?>

<?= $this->endSection() ?>