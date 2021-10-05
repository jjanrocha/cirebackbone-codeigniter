<?= $this->extend('layouts/basico');
$this->section('title') ?> <?= $title ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<!-- Conteúdo -->
<div class="main" id="pagina">
    <div class="container">

        <div>
            <h4>Controle</h4>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_atividade_id" id="controle_crise" value="controle_crise">
                    <label class="form-check-label" for="controle_crise">
                        ESCALONAMENTO CRISE
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_atividade_id" id="controle_urgente" value="controle_urgente">
                    <label class="form-check-label" for="controle_urgente">
                        ESCALONAMENTO URGENTE
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_atividade_id" id="controle_atualizacao_telegram" value="controle_atualizacao_telegram">
                    <label class="form-check-label" for="controle_atualizacao_telegram">
                        ATUALIZAÇÃO TELEGRAM
                    </label>
                </div>
            </div>
        </div>

        <div id="conteudo">
        </div>

    </div>
</div>
<?= $this->include('layouts/footer') ?>

<script>
    $(document).ready(function() {
        $(document).on('click', "input:radio[name ='tipo_atividade_id']", function() {
            var tipo_carimbo = $("input:radio[name ='tipo_atividade_id']:checked").val()
            $.ajax({
                type: 'POST',
                url: '<?= base_url("/carimbos/controle/formularios/") ?>' + '/' + tipo_carimbo,
                success: function(form) {
                    $("#conteudo").html(form);
                },
                error: function(xhr, textStatus, errorThrown) {
                    $("#conteudo").html('Falha ao tentar carregar o formulário. Caso o erro persista, favor contatar o suporte.');
                }
            });
        });
    });

    $(document).on('submit', '#carimbo_form', function(event) {
        event.preventDefault()
        var tipo_carimbo = $("input:radio[name ='tipo_atividade_id']:checked").val()
        var dados = $(this).serialize()
        $.ajax({
            type: 'POST',
            data: dados,
            url: '<?= base_url("/carimbos/controle/formularios/") ?>' + '/' + tipo_carimbo + '/insert',

            success: function(response) {
                if (response.carimbo) {
                    $('input[name=tipo_atividade_id]').prop('checked', false);
                    var textarea_carimbo = document.createElement("TEXTAREA");
                    textarea_carimbo.className = "form-control col-md-8 mt-1";
                    textarea_carimbo.rows = 27;
                    textarea_carimbo.readOnly = true;
                    textarea_carimbo.innerHTML = response.carimbo;
                    $("#conteudo").html(textarea_carimbo);
                } else {
                    $.each(response.error, function(key, value) {
                        alert(value)
                    });
                }
            },

            error: function(xhr) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    alert(value)
                });
            },
        });
    });
</script>
<?= $this->endSection() ?>