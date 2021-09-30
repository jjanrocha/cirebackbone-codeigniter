<?= $this->extend('layouts/basico');
$this->section('title') ?> Home <?= $this->endSection()
                                    ?>
<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<!-- Conteúdo -->
<div class="main" id="pagina">

    <div class="container">
        <p>Olá, <?= $nome_usuario ?> </p>
    </div>

</div>

<?= $this->include('layouts/footer') ?>
<?= $this->endSection() ?>