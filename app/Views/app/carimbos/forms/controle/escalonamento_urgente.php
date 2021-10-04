<div id="form_controle_escalonamento_urgente" class="my-3">

    <b>Escalonamento URGENTE</b>
    <form method="POST" id="carimbo_form" action="#">
        <?= csrf_field() ?>
        <div class="form-inline">
            <input type="text" name="numero_ta" class="form-control" placeholder="Digite o TA" required>
            <select class="custom-select my-1 mr-sm-2 ml-md-1" name="nome_eps" required>
                <option value="" disabled selected>Selecione a EPS</option>
                <?php foreach ($contratadas as $contratada) { ?>
                    <option value="<?= $contratada['nome'] ?>"><?= $contratada['nome'] ?></option>
                <?php } ?>
            </select>
            <input type="text" name="escalonamento_horas" class="form-control" placeholder="Escalonamento xx horas" required>
        </div>

        <div class="my-2">
            <b>VIVO REDE</b>
            <br>
            <div class="form-group row">
                <label for="n1_vivo_rede" class="col-form-label col-lg-1">N1:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n1_vivo_rede" id="n1_vivo_rede" placeholder="Sobreaviso/Coordenador" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n1_vivo_rede" required>
                <select class="custom-select col-lg-2" name="forma_contato_n1_vivo_rede" required>
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="n2_vivo_rede" class="col-form-label col-lg-1">N2:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n2_vivo_rede" id="n2_vivo_rede" placeholder="Gerencia Seção" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n2_vivo_rede" required>
                <select class="custom-select col-lg-2" name="forma_contato_n2_vivo_rede" required>
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="n3_vivo_rede" class="col-form-label col-lg-1">N3:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n3_vivo_rede" id="n3_vivo_rede" placeholder="Gerencia Sênior" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n3_vivo_rede" required>
                <select class="custom-select col-lg-2" name="forma_contato_n3_vivo_rede" required>
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="n4_vivo_rede" class="col-form-label col-lg-1">N4:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n4_vivo_rede" id="n4_vivo_rede" placeholder="Diretor" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n4_vivo_rede" required>
                <select class="custom-select col-lg-2" name="forma_contato_n4_vivo_rede" required>
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="n5_vivo_rede" class="col-form-label col-lg-1">N5:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n5_vivo_rede" id="n5_vivo_rede" placeholder="N5: se autorizado">
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n5_vivo_rede">
                <select class="custom-select col-lg-2" name="forma_contato_n5_vivo_rede">
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
        </div>

        <div class="my-2">
            <b>VIVO CIRE</b>
            <br>
            <div class="form-group row">
                <label for="n1_vivo_cire" class="col-form-label col-lg-1">N1:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n1_vivo_cire" id="n1_vivo_cire" placeholder="Sobreaviso/Coordenador" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n1_vivo_cire" required>
                <select class="custom-select col-lg-2" name="forma_contato_n1_vivo_cire" required>
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="n2_vivo_cire" class="col-form-label col-lg-1">N2:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n2_vivo_cire" id="n2_vivo_cire" placeholder="Gerencia Seção" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n2_vivo_cire" required>
                <select class="custom-select col-lg-2" name="forma_contato_n2_vivo_cire" required>
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="n3_vivo_cire" class="col-form-label col-lg-1">N3:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n3_vivo_cire" id="n3_vivo_cire" placeholder="Gerencia Sênior" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n3_vivo_cire" required>
                <select class="custom-select col-lg-2" name="forma_contato_n3_vivo_cire" required>
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="n4_vivo_cire" class="col-form-label col-lg-1">N4:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n4_vivo_cire" id="n4_vivo_cire" placeholder="Diretor" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n4_vivo_cire" required>
                <select class="custom-select col-lg-2" name="forma_contato_n4_vivo_cire" required>
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="n5_vivo_cire" class="col-form-label col-lg-1">N5:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n5_vivo_cire" id="n5_vivo_cire" placeholder="N5: se autorizado">
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n5_vivo_cire">
                <select class="custom-select col-lg-2" name="forma_contato_n5_vivo_cire">
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
        </div>

        <div class="my-2">
            <b>EPS</b>
            <br>
            <div class="form-group row">
                <label for="n1_eps" class="col-form-label col-lg-1">N1:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n1_eps" id="n1_eps" placeholder="N1 EPS" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n1_eps" required>
                <select class="custom-select col-lg-2" name="forma_contato_n1_eps" required>
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="n2_eps" class="col-form-label col-lg-1">N2:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="n2_eps" id="n2_eps" placeholder="N2 EPS" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_n2_eps" required>
                <select class="custom-select col-lg-2" name="forma_contato_n2_eps" required>
                    <option disabled value="" selected>Meio</option>
                    <option value="via telegram">Telegram</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
        </div>
        <button type="#" id="btnEnviar" class="btn btn-success my-1">Gerar Carimbo</button>
        <button type="reset" id="btnReset" class="btn btn-danger my-1">Limpar</button>
    </form>

</div>