<div id="form_controle_atualizacao_telegram" class="my-3">

    <b>Atualização Telegram</b>
    <form method="POST" id="form_atualizacao_telegram">
        <?= csrf_field() ?>

        <div class="form-inline">
            <input type="text" name="numero_ta" id="numero_ta" class="form-control" placeholder="Digite o TA" required>
            <button type="button" id="pesquisar_ta" class="btn btn-secondary ml-1">Carregar</button>
        </div>

        <div class="form-inline">
            <select class="custom-select my-1 mr-sm-2" name="tipo_bilhete" id="tipo_bilhete" required>
                <option value="" disabled selected>Tipo de Bilhete</option>
                <option value="NACIONAL VIVO 1">NACIONAL V1</option>
                <option value="NACIONAL VIVO 2">NACIONAL V2</option>
                <option value="REGIONAL VIVO 1">REGIONAL V1</option>
                <option value="REGIONAL VIVO 2">REGIONAL V2</option>
            </select>
        </div>

        <div class="form-inline row mt-1">
            <label class="col-form-label col-md-1">Rota:</label>
            <input type="text" class="form-control mr-lg-1 col-lg-3" name="rota_ponta_a" id="rota_ponta_a" placeholder="Ponta A" required>
            <label class="col-form-label col-md-auto">X</label>
            <input type="text" class="form-control mr-lg-1 col-lg-3" name="rota_ponta_b" id="rota_ponta_b" placeholder="Ponta B">
            <i class="fas fa-question-circle" title='Caso possua apenas uma informação, digite no campo "Ponta A" e deixe o campo "Ponta B" vazio.'></i>
        </div>

        <div class="form-inline row mt-1">
            <label class="col-form-label col-md-1">Trecho:</label>
            <input type="text" class="form-control mr-lg-1 col-lg-3" name="trecho_ponta_a" id="trecho_ponta_a" placeholder="Ponta A" required>
            <label class="col-form-label col-md-auto">X</label>
            <input type="text" class="form-control mr-lg-1 col-lg-3" name="trecho_ponta_b" id="trecho_ponta_b" placeholder="Ponta B">
            <i class="fas fa-question-circle" title='Caso possua apenas uma informação, digite no campo "Ponta A" e deixe o campo "Ponta B" vazio.'></i>
        </div>

        <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" name="possui_draco" id="possui_draco" value="sim">
            <label class="form-check-label" for="possui_draco">
                Possui DRACO afetado
            </label>
            <i class="fas fa-question-circle" title='Caso haja afetação de DRACO, marque a caixinha.'></i>
        </div>

        <br>
        Equipamento(s) V1: <i class="fas fa-question-circle" title='Caso haja afetação de equipamento Vivo 1, mova-o para a direita.'></i>
        <div class="row">
            <div class="col-md-4">
                <select name="lista_equipamentos_v1[]" id="lista_equipamentos_v1" class="form-control" size="8" multiple="multiple">
                    <?php foreach ($equipamentos as $equipamento) { ?>
                        <option value="<?= $equipamento['fabricante'] ?>"> <?= $equipamento['fabricante'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" id="lista_equipamentos_v1_rightAll" class="btn btn-block"><i class="fas fa-angle-double-right"></i></button>
                <button type="button" id="lista_equipamentos_v1_rightSelected" class="btn btn-block"><i class="fas fa-angle-right"></i></button>
                <button type="button" id="lista_equipamentos_v1_leftSelected" class="btn btn-block"><i class="fas fa-angle-left"></i></button>
                <button type="button" id="lista_equipamentos_v1_leftAll" class="btn btn-block"><i class="fas fa-angle-double-left"></i></button>
            </div>
            <div class="col-md-4">
                <select name="lista_equipamentos_v1_to[]" id="lista_equipamentos_v1_to" class="form-control" size="8" multiple="multiple"></select>
            </div>
        </div>

        <br>
        Equipamento(s) V2: <i class="fas fa-question-circle" title='Caso haja afetação de equipamento Vivo 2, mova-o para a direita.'></i>
        <div class="row">
            <div class="col-md-4">
                <select name="lista_equipamentos_v2[]" id="lista_equipamentos_v2" class="form-control" size="8" multiple="multiple">
                    <?php foreach ($equipamentos as $equipamento) { ?>
                        <option value="<?= $equipamento['fabricante'] ?>"> <?= $equipamento['fabricante'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" id="lista_equipamentos_v2_rightAll" class="btn btn-block"><i class="fas fa-angle-double-right"></i></button>
                <button type="button" id="lista_equipamentos_v2_rightSelected" class="btn btn-block"><i class="fas fa-angle-right"></i></button>
                <button type="button" id="lista_equipamentos_v2_leftSelected" class="btn btn-block"><i class="fas fa-angle-left"></i></button>
                <button type="button" id="lista_equipamentos_v2_leftAll" class="btn btn-block"><i class="fas fa-angle-double-left"></i></button>
            </div>
            <div class="col-md-4">
                <select name="lista_equipamentos_v2_to[]" id="lista_equipamentos_v2_to" class="form-control" size="8" multiple="multiple"></select>
            </div>
        </div>

        <div class="form-group row mt-2">
            <label class="col-form-label col-md-auto" for="redundancias_v2">Redundância(s) V2:</label>
            <input type="text" class="form-control mr-lg-1 col-lg-3" name="redundancias_v2" id="redundancias_v2" placeholder="Digite a quantidade">
        </div>

        <br>
        Operadora(s): <i class="fas fa-question-circle" title='Caso haja afetação de operadora, mova-a para a direita.'></i>
        <div class="row">
            <div class="col-md-4">
                <select name="lista_operadoras[]" id="lista_operadoras" class="form-control" size="8" multiple="multiple">
                    <?php foreach ($operadoras as $operadora) { ?>
                        <option value="<?= $operadora['nome'] ?>"> <?= $operadora['nome'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" id="lista_operadoras_rightAll" class="btn btn-block"><i class="fas fa-angle-double-right"></i></button>
                <button type="button" id="lista_operadoras_rightSelected" class="btn btn-block"><i class="fas fa-angle-right"></i></button>
                <button type="button" id="lista_operadoras_leftSelected" class="btn btn-block"><i class="fas fa-angle-left"></i></button>
                <button type="button" id="lista_operadoras_leftAll" class="btn btn-block"><i class="fas fa-angle-double-left"></i></button>
            </div>
            <div class="col-md-4">
                <select name="lista_operadoras_to[]" id="lista_operadoras_to" class="form-control" size="8" multiple="multiple"></select>
            </div>
        </div>

        <div class="form-inline">
            <input type="text" name="afetacao_erbs" id="afetacao_erbs" class="form-control mt-2 mr-1 col-md-2" placeholder="ERB">
            <input type="text" name="afetacao_voz" id="afetacao_voz" class="form-control mt-2 mr-1 col-md-2" placeholder="Voz">
            <input type="text" name="afetacao_speedy" id="afetacao_speedy" class="form-control mt-2 mr-1 col-md-2" placeholder="Speedy">
            <input type="text" name="afetacao_clientes" id="afetacao_clientes" class="form-control mt-2 mr-1 col-md-2" placeholder="Clientes">
            <input type="text" name="afetacao_fttx" id="afetacao_fttx" class="form-control mt-2 mr-1 col-md-2" placeholder="FTTX">
            <input type="text" name="afetacao_iptv" id="afetacao_iptv" class="form-control mt-2 mr-1 col-md-2" placeholder="IPTV">
        </div>

        <div class="form-group form-inline mt-2">
            <input type="text" name="lp" id="lp" class="form-control mt-2 col-md-7" placeholder="LP">
            <i class="fas fa-question-circle ml-lg-1" title='Caso haja afetação de LP, digite o nome do cliente.'></i>
        </div>

        <div class="form-group row mt-2">
            <label class="col-form-label col-md-auto" for="horario_acionamento">Horário do Acionamento (EPS):</label>
            <input type="datetime-local" class="form-control mr-lg-1 col-lg-3" name="horario_acionamento" id="horario_acionamento" required>
        </div>

        <div class="form-group row mt-2">
            <label class="col-form-label col-md-auto">TTMC:</label>
            <input type="text" class="form-control mr-lg-1 col-lg-2" name="ttmc_numero" id="ttmc_numero" placeholder="Número">
            <select class="form-control mr-lg-1 col-lg-3" name="ttmc_tipo" id="ttmc_tipo">
                <option value="" selected disabled>Tipo</option>
                <option value="Backbone Nacional">Backbone Nacional</option>
                <option value="Backbone Regional">Backbone Regional</option>
            </select>
            <select class="form-control col-lg-3" name="ttmc_rede" id="ttmc_rede">
                <option value="" selected disabled>Rede</option>
                <option value="Rede Móvel">Rede Móvel</option>
                <option value="Rede Fixa">Rede Fixa</option>
            </select>
        </div>


        <div class="mt-2">
            <label class="col-form-label">Status:</label>
            <textarea class="form-control col-md-10" rows="6" name="status" id="status" required></textarea>
        </div>

        <div class="form-group row mt-2">
            <label class="col-form-label col-md-auto">Escalonamento:</label>
            <input type="text" class="form-control mr-lg-1 col-lg-5" name="escalonamento" id="escalonamento" required>
        </div>

        <button type="submit" id="btnEnviar" class="btn btn-success my-1">Gerar Carimbo</button>
        <button type="reset" id="btnReset" class="btn btn-danger my-1">Limpar</button>

    </form>

</div>

<script type="text/javascript" src="<?php echo base_url(); ?>/js/multiselect.min.js"></script>

<!--
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
$(document).ready(function(){
  $('#ttmc_numero').mask('0.000/0000');
});
</script>
-->

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#lista_equipamentos_v1').multiselect();
        $('#lista_equipamentos_v2').multiselect();
        $('#lista_operadoras').multiselect();
    });
</script>

<script type="text/javascript">
    $(document).on('click', '#pesquisar_ta', function(event) {
        event.preventDefault()
        var numero_ta = $('#numero_ta').val()
        $.ajax({
            type: 'POST',
            data: {
                'numero_ta': numero_ta
            },
            dataType: "json",
            url: '<?= base_url("/carimbos/controle/formularios/controle_atualizacao_telegram/read") ?>',
            success: function(response) {
                $('#tipo_bilhete').val(response.tipo_bilhete);
                $("#rota_ponta_a").val(response.rota_ponta_a);
                $("#rota_ponta_b").val(response.rota_ponta_b);
                $("#trecho_ponta_a").val(response.trecho_ponta_a);
                $("#trecho_ponta_b").val(response.trecho_ponta_b);

                if (response.possui_draco == "sim") {
                    $('#possui_draco').prop('checked', true);
                }

                $("#lista_equipamentos_v1_to option").remove();
                if (response.equipamentos_v1 != "") {
                    $.each(response.equipamentos_v1, function(key, value) {
                        $("#lista_equipamentos_v1_to").append($('<option>', {
                            value: value,
                            text: value
                        }));
                        $("#lista_equipamentos_v1 option[value=\"" + value + "\"]").remove();
                    });
                }

                $("#lista_equipamentos_v2_to option").remove();
                if (response.equipamentos_v2 != "") {
                    $.each(response.equipamentos_v2, function(key, value) {
                        $("#lista_equipamentos_v2_to").append($('<option>', {
                            value: value,
                            text: value
                        }));
                        $("#lista_equipamentos_v2 option[value=\"" + value + "\"]").remove();
                    });
                }

                $("#redundancias_v2").val(response.redundancias_v2);

                $("#lista_operadoras_to option").remove();
                if (response.operadoras != "") {
                    $.each(response.operadoras, function(key, value) {
                        $("#lista_operadoras_to").append($('<option>', {
                            value: value,
                            text: value
                        }));
                        $("#lista_operadoras option[value=\"" + value + "\"]").remove();
                    });
                }

                $("#afetacao_erbs").val(response.afetacao_erbs);
                $("#afetacao_voz").val(response.afetacao_voz);
                $("#afetacao_speedy").val(response.afetacao_speedy);
                $("#afetacao_clientes").val(response.afetacao_clientes);
                $("#afetacao_fttx").val(response.afetacao_fttx);
                $("#afetacao_iptv").val(response.afetacao_iptv);
                $("#lp").val(response.lp);
                $("#horario_acionamento").val(response.horario_acionamento);

                if (response.ttmc_numero != "") {
                    $("#ttmc_numero").val(response.ttmc_numero);
                    $("#ttmc_tipo").val(response.ttmc_tipo);
                    $("#ttmc_rede").val(response.ttmc_rede);
                }
                //$("#status").val(response.status);
                $("#escalonamento").val(response.escalonamento);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).on('submit', '#form_atualizacao_telegram', function(event) {
        event.preventDefault()
        var dados = $(this).serialize()
        $.ajax({
            type: 'POST',
            data: dados,
            url: '<?= base_url("/carimbos/controle/formularios/controle_atualizacao_telegram/insert") ?>',
            beforeSend: function() {
                $("#btnEnviar").hide();
            },
            success: function(response) {
                $('input[name=tipo_atividade_id]').prop('checked', false);
                var textarea_carimbo = document.createElement("TEXTAREA");
                textarea_carimbo.className = "form-control col-md-9 mt-1";
                textarea_carimbo.rows = 27;
                textarea_carimbo.readOnly = true;
                textarea_carimbo.innerHTML = (
                    response.informacoes_basicas +
                    response.rota +
                    response.trecho_localidade +
                    "AFETAÇÃO:" +
                    response.afetacao +
                    "ACIONAMENTO: " +
                    response.horario_acionamento +
                    response.ttmc +
                    response.status +
                    response.escalonamento +
                    response.analista_cire
                );
                $("#conteudo").html(textarea_carimbo);
            },
            error: function(xhr) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    alert(value)
                });
            },
        });
    });
</script>