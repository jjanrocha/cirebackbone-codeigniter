<?= $this->extend('layouts/basico');
$this->section('title') ?> <?= $title ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<!-- Conteúdo -->
<div class="main" id="pagina">

    <div class="container">
        <p>Olá, <?= session()->get('nome') ?> </p>
    </div>

</div>

<?= $this->include('layouts/footer') ?>
<?= $this->endSection() ?>