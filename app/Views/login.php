<?= $this->extend('layouts/basico');
$this->section('title') ?> Login <?= $this->endSection()
                                    ?>
<?= $this->section('content') ?>

<div class="background-gray90">
    <div class="container d-flex h-100">
        <div class="row justify-content-center row align-self-center w-100">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4 align-self-end" style="font-weight: bold">
                                Login
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <img src="<?php echo base_url(); ?>/img/logo.png" height="88" width="84">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo base_url(); ?>/login">
                            <div class="form-group row">
                                <label for="id" class="col-sm-3 col-form-label">RE:</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="id" id="id" class="form-control">
                                    </div>
                                    <?php if (session()->getFlashdata('msg')) : ?>
                                        <div>
                                            <?= session()->getFlashdata('msg') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-5">
                                    <button type="submit" class="btn btn-secondary">
                                        Entrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    html {
        height: 100%;
    }
</style>

<?= $this->include('layouts/footer') ?>
<?= $this->endSection() ?>