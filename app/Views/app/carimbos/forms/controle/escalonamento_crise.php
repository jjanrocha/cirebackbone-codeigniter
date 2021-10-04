<div id="form_controle_escalonamento_crise" class="my-3">

    <b>Escalonamento CRISE</b>
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

            <select class="custom-select my-1 mr-sm-2 ml-md-1" name="tipo_carimbo" required>
                <option value="" disabled selected>Selecione o tipo</option>
                <option value="INICIAL">CRISE INICIAL</option>
                <option value="LOOP">CRISE LOOP</option>
                <option value="DUPLA FALHA">DUPLA FALHA</option>
                <option value="TRIPLA FALHA">TRIPLA FALHA</option>
            </select>
        </div>

        <div class="my-2">
            <b>CIRE ATENTO</b>
            <br>
            <div class="form-group row">
                <label for="nome_control_desk_um_cire_atento" class="col-form-label col-lg-2">Control Desk:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_control_desk_um_cire_atento" id="nome_control_desk_um_cire_atento" placeholder="Control Desk (CIRE ATENTO)" value="Cristina Gomes" required>
                <select class="custom-select col-lg-2" name="forma_contato_control_desk_um_cire_atento" required>
                    <option value="via telegram" selected>Telegram</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <!--div class="form-group row">
                <label for="nome_control_desk_dois_cire_atento" class="col-form-label col-lg-2">Control Desk:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_control_desk_dois_cire_atento" id="nome_control_desk_dois_cire_atento" placeholder="Control Desk (CIRE ATENTO)" required>
                <select class="custom-select col-lg-2" name="forma_contato_control_desk_dois_cire_atento" required>
                    <option value="via telegram">Telegram</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div -->
            <div class="form-group row">
                <label for="nome_supervisao_cire_atento" class="col-form-label col-lg-2">Supervisor(a):</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_supervisao_cire_atento" id="nome_supervisao_cire_atento" placeholder="Supervisor(a) (CIRE ATENTO)" value="Evelyn Bezerra" required>
                <select class="custom-select col-lg-2" name="forma_contato_supervisao_cire_atento" required>
                    <option value="via telegram">Telegram</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="nome_coordenacao_cire_atento" class="col-form-label col-lg-2">Coordenador(a):</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_coordenacao_cire_atento" id="nome_coordenacao_cire_atento" placeholder="Coordenador(a) (CIRE ATENTO)" value="Railson Farias" required>
                <select class="custom-select col-lg-2" name="forma_contato_coordenacao_cire_atento" required>
                    <option value="via telegram">Telegram</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via fone">Fone</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="nome_gestao_cire_atento" class="col-form-label col-lg-2">Gestor(a):</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_gestao_cire_atento" id="nome_gestao_cire_atento" placeholder="Gestor(a) (CIRE ATENTO)" value="Erick Paim" required>
                <select class="custom-select col-lg-2" name="forma_contato_gestao_cire_atento" required>
                    <option value="via telegram">Telegram</option>
                    <option disabled value="">Meio</option>
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
                <label for="nome_coordenacao_eps" class="col-form-label col-lg-2">Coordenador(a):</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_coordenacao_eps" id="nome_coordenacao_eps" placeholder="Coordenador(a) (EPS)" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_coordenacao_eps" required>
                <select class="custom-select col-lg-2" name="forma_contato_coordenacao_eps" required>
                    <option value="via fone">Fone</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via telegram">Telegram</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="nome_gerente_eps" class="col-form-label col-lg-2">Gerente:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_gerente_eps" id="nome_gerente_eps" placeholder="Gerente (EPS)" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_gerente_eps" required>
                <select class="custom-select col-lg-2" name="forma_contato_gerente_eps" required>
                    <option value="via fone">Fone</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via telegram">Telegram</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
        </div>

        <div class="my-2">
            <b>REDE EXTERNA</b>
            <br>
            <div class="form-group row">
                <label for="nome_coordenacao_rede_externa" class="col-form-label col-lg-2">Coordenador(a):</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_coordenacao_rede_externa" id="nome_coordenacao_rede_externa" placeholder="Coordenador(a) (REDE EXTERNA)" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_coordenacao_rede_externa" required>
                <select class="custom-select col-lg-2" name="forma_contato_coordenacao_rede_externa" required>
                    <option value="via fone">Fone</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via telegram">Telegram</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="nome_gerente_secao_rede_externa" class="col-form-label col-lg-2">Gerente Seção:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_gerente_secao_rede_externa" id="nome_gerente_secao_rede_externa" placeholder="Gerente Seção (REDE EXTERNA)" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_gerente_secao_rede_externa" required>
                <select class="custom-select col-lg-2" name="forma_contato_gerente_secao_rede_externa" required>
                    <option value="via fone">Fone</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via telegram">Telegram</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="nome_gerente_divisao_rede_externa" class="col-form-label col-lg-2">Gerente Divisão:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_gerente_divisao_rede_externa" id="nome_gerente_divisao_rede_externa" placeholder="Gerente Divisão (REDE EXTERNA)" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_gerente_divisao_rede_externa" required>
                <select class="custom-select col-lg-2" name="forma_contato_gerente_divisao_rede_externa" required>
                    <option value="via fone">Fone</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via telegram">Telegram</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="nome_direcao_rede_externa" class="col-form-label col-lg-2">Diretor(a):</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_direcao_rede_externa" id="nome_direcao_rede_externa" placeholder="Diretor(a) (REDE EXTERNA)" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_direcao_rede_externa" required>
                <select class="custom-select col-lg-2" name="forma_contato_direcao_rede_externa" required>
                    <option value="via fone">Fone</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via telegram">Telegram</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
        </div>

        <div class="my-2">
            <b>CIRE VIVO</b>
            <br>
            <div class="form-group row">
                <label for="nome_gestao_cire_vivo" class="col-form-label col-lg-2">Gestor(a):</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_gestao_cire_vivo" id="nome_gestao_cire_vivo" placeholder="Gestor(a) (CIRE VIVO)" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_gestao_cire_vivo" required>
                <select class="custom-select col-lg-2" name="forma_contato_gestao_cire_vivo" required>
                    <option value="via fone">Fone</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via telegram">Telegram</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="nome_coordenacao_cire_vivo" class="col-form-label col-lg-2">Coordenador(a):</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_coordenacao_cire_vivo" id="nome_coordenacao_cire_vivo" placeholder="Coordenador(a) (CIRE VIVO)" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_coordenacao_cire_vivo" required>
                <select class="custom-select col-lg-2" name="forma_contato_coordenacao_cire_vivo" required>
                    <option value="via fone">Fone</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via telegram">Telegram</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="nome_gerente_cire_vivo" class="col-form-label col-lg-2">Gerente:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_gerente_cire_vivo" id="nome_gerente_cire_vivo" placeholder="Gerente (CIRE VIVO)" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_gerente_cire_vivo" required>
                <select class="custom-select col-lg-2" name="forma_contato_gerente_cire_vivo" required>
                    <option value="via fone">Fone</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via telegram">Telegram</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="nome_gerente_divisao_cire_vivo" class="col-form-label col-lg-2">Gerente Divisão:</label>
                <input type="text" class="form-control mr-lg-1 col-lg-4" name="nome_gerente_divisao_cire_vivo" id="nome_gerente_divisao_cire_vivo" placeholder="Gerente Divisão (CIRE VIVO)" required>
                <input type="time" class="form-control mr-lg-1 col-lg-2" name="horario_contato_gerente_divisao_cire_vivo" required>
                <select class="custom-select col-lg-2" name="forma_contato_gerente_divisao_cire_vivo" required>
                    <option value="via fone">Fone</option>
                    <option disabled value="">Meio</option>
                    <option value="via caixa postal">Caixa postal</option>
                    <option value="via telegram">Telegram</option>
                    <option value="não possui caixa postal">Sem caixa postal</option>
                </select>
            </div>
        </div>
        <button type="submit" id="btnEnviar" class="btn btn-success my-1">Gerar Carimbo</button>
        <button type="reset" id="btnReset" class="btn btn-danger my-1">Limpar</button>
    </form>

</div>
