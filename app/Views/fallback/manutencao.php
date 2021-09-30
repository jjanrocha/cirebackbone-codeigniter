<?= $this->extend('layouts/basico');
$this->section('title') ?> Home <?= $this->endSection()
                                    ?>
<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<!-- Conteúdo -->
<div class="main" id="pagina">
    <div class="container">

        <div>
            <h4>Página em manutenção</h4>
            <hr>
        </div>
        
        <p><a href="<?=base_url('/') ?>">Clique aqui</a> para retornar à página inicial.</p>

    </div>
</div>
<?= $this->include('layouts/footer') ?>
<?= $this->endSection() ?>