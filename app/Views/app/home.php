<?= $this->extend('layouts/basico');
$this->section('title') ?> <?= $title ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<!-- Conteúdo -->
<div class="main" id="pagina">
    <div class="container">

        <p>Olá, <?= session()->get('nome') ?> </p>

        <h4>Avisos</h4>
        <?php if (session()->get('nivel') == 'ADMINISTRADOR') : ?>
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalInsertAviso">Novo aviso</button>
        <?php endif; ?>

        <?php if (session()->getFlashdata('msg')) : ?>
            <div>
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <div id="atualizacao_avisos" class="mt-1">
            Última atualização em: <label id="horario-ultima-atualizacao"></label>
            <i class="fas fa-redo" onclick="listarAvisos()" id="atualizar-lista-avisos" title="Atualizar"></i>
        </div>

        <div class="row mt-1">
            <div class="col-auto">
                Prioridade:
            </div>
            <div class="col-auto">
                <div class="row">
                    <div class="col-auto">
                        <div id="prioridade_alta"></div>
                    </div>
                    <label for="prioridade_alta">Alta</label>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <div id="prioridade_media"></div>
                    </div>
                    <label for="prioridade_media">Média</label>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <div id="prioridade_baixa"></div>
                    </div>
                    <label for="prioridade_baixa">Baixa</label>
                </div>
            </div>
        </div>

        <div id="avisos_fixados" class="mt-1"></div>
        <div id="avisos_geral" class="mt-5"></div>

        <!-- Modal cadastro -->
        <div class="modal fade" id="modalInsertAviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar novo aviso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?= base_url('/avisos/store') ?>">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="descricao">Descrição:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="descricao" id="descricao" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="prioridade">Prioridade:</label>
                                <div class="col-sm-10">
                                    <select name="prioridade" id="prioridade" class="form-control" required>
                                        <option value="" selected disabled>Selecionar</option>
                                        <option value="Alta">Alta</option>
                                        <option value="Media">Média</option>
                                        <option value="Baixa">Baixa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="fixado" id="fixado" class="form-check-input">
                                <label class="form-check-label" for="fixado">Fixar?</label>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="confirmarInsertLink">Cadastrar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal remoção -->
        <div class="modal fade" id="modalDeleteAviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmar exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>Tem certeza que deseja excluir o aviso?</div>
                        <form id="form_delete_aviso" method="POST" hidden>
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="confirmarDeleteLink">Excluir</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->include('layouts/footer') ?>

<script>
    $(document).ready(function() {
        listarAvisos()
    })

    var count = 0;

    function listarAvisos() {
        count = 0;
        document.getElementById('horario-ultima-atualizacao').innerHTML = Date();
        $.ajax({
            type: "POST",
            url: "<?= base_url('/avisos/listar') ?>",
            dataType: "json",
            success: function(data) {
                document.getElementById('avisos_geral').innerHTML = ''
                document.getElementById('avisos_fixados').innerHTML = ''
                $.each(data.lista_avisos, function(key, value) {
                    let div = ''

                    /** Div principal do alert */
                    let div_principal = document.createElement('div');
                    div_principal.className = "alert alert-" + value.class;

                    /** Div row dentro da div principal do alert */
                    let div_row = document.createElement('div');
                    div_row.className = 'row'

                    /** Ícone para os avisos fixados */
                    let icone_fixado = document.createElement('i');

                    /** Mensagem do aviso */
                    let descricao = document.createElement('div')
                    descricao.className = 'col'
                    descricao.id = 'descricao_' + value.id
                    descricao.append(value.descricao)

                    /** Ícone para edição do aviso */
                    let icone_edit = document.createElement('i');
                    icone_edit.className = 'fas fa-edit mr-1'
                    icone_edit.setAttribute("onclick", 'editar(' + value.id + ', "' + value.descricao + '", "' + value.prioridade + '", ' + value.fixado + ')');

                    /** Ícone para remoção do aviso */
                    let icone_remove = document.createElement('i');
                    icone_remove.className = 'fas fa-trash-alt mr-1'
                    icone_remove.setAttribute("onclick", "remover(" + value.id + ");");
                    icone_remove.setAttribute("data-toggle", "modal");
                    icone_remove.setAttribute("data-target", "#modalDeleteAviso");

                    let icones = document.createElement('div')
                    icones.className = 'col-auto'
                    icones.id = 'icones_' + value.id
                    icones.append(icone_edit)
                    icones.append(icone_remove)

                    /** Div da data/hora e nome do criador do aviso */
                    let criacao_div = document.createElement('div')
                    criacao_div.className = 'row mt-2'

                    /** Tag da data/hora e nome do criador do aviso */
                    let criacao = document.createElement('small')
                    criacao.className = 'col'

                    /** Texto da data/hora e nome criador do aviso */
                    let criacao_texto = document.createTextNode('Criado por ' + value.nome_usuario_criacao + ' em ' + value.created_at)

                    /** Incluir o texto na tag */
                    criacao.appendChild(criacao_texto)

                    /** Incluir o texto e tag na div */
                    criacao_div.appendChild(criacao)

                    if (value.fixado == 1) {
                        icone_fixado.className = 'fas fa-thumbtack col-auto';
                        div = document.getElementById('avisos_fixados')
                    } else {
                        div = document.getElementById('avisos_geral')
                    }

                    div_row.append(icone_fixado, descricao)

                    if (data.nivel_usuario == 'ADMINISTRADOR') {
                        div_row.append(icones)
                    }

                    div_principal.append(div_row)
                    div_principal.append(criacao_div)

                    if (value.nome_usuario_edicao != '') {
                        /** Div da data/hora e nome do criador do aviso */
                        let edicao_div = document.createElement('div')
                        edicao_div.className = 'row mt-1'

                        /** Tag da data/hora e nome do criador do aviso */
                        let edicao = document.createElement('small')
                        edicao.className = 'col'

                        /** Texto da data/hora e nome criador do aviso */
                        let edicao_texto = document.createTextNode('Editado por ' + value.nome_usuario_edicao + ' em ' + value.updated_at)

                        /** Incluir o texto na tag */
                        edicao.appendChild(edicao_texto)

                        /** Incluir o texto e tag na div */
                        edicao_div.appendChild(edicao)

                        div_principal.append(edicao_div)
                    }


                    div.insertBefore(div_principal, div[0])
                })
            }
        })
    }

    function editar(id, descricao, prioridade, fixado) {

        if (count == 0) {
            /** Criar um form de edição */
            let form = document.createElement('form')
            form.action = "<?= base_url('/avisos/') ?>/" + id
            form.method = 'post'

            /** Criar um input hidden para guardar o id do aviso */
            let inputId = document.createElement('input')
            inputId.type = 'hidden'
            inputId.name = 'id'
            inputId.value = id

            /** Criar um input hidden para guardar o método put */
            let inputMethod = document.createElement('input')
            inputMethod.type = 'hidden'
            inputMethod.name = '_method'
            inputMethod.value = 'PUT'

            /** Criar um input para entrada de texto (descricao) */
            let inputDescricao = document.createElement('input')
            inputDescricao.type = 'text'
            inputDescricao.className = 'form-control mt-1'
            inputDescricao.name = 'descricao'
            inputDescricao.placeholder = 'Aviso'
            inputDescricao.value = descricao

            /** Checkbox fixado */
            let divCheckboxFixado = document.createElement('div')
            divCheckboxFixado.className = 'form-group form-check row'

            let checkboxFixado = document.createElement('input')
            checkboxFixado.type = 'checkbox'
            checkboxFixado.name = 'fixado'
            checkboxFixado.id = 'fixado'
            checkboxFixado.class = "form-check-input"
            if (fixado == 1) {
                checkboxFixado.checked = true;
            }

            let labelCheckboxFixado = document.createElement('label')
            labelCheckboxFixado.setAttribute('for', 'fixado')
            labelCheckboxFixado.innerHTML = ' Fixar?'
            labelCheckboxFixado.class = "form-check-label"

            divCheckboxFixado.append(checkboxFixado, labelCheckboxFixado)

            /** Select prioridade */
            let divSelectPrioridade = document.createElement('div')
            divSelectPrioridade.className = 'form-group row mt-1';

            let labelSelectPrioridade = document.createElement('label')
            labelSelectPrioridade.setAttribute('for', 'prioridade')
            labelSelectPrioridade.innerHTML = 'Prioridade:'
            labelSelectPrioridade.className = "col-md-auto col-form-label"

            let selectPrioridade = document.createElement('select')
            selectPrioridade.name = 'prioridade'
            selectPrioridade.id = 'prioridade'
            selectPrioridade.className = 'form-control col-md-5'
            let opt1 = document.createElement("option");
            let opt2 = document.createElement("option");
            let opt3 = document.createElement("option");

            opt1.value = 'Alta';
            opt1.text = 'Alta';
            opt2.value = 'Media';
            opt2.text = 'Média';
            opt3.value = 'Baixa';
            opt3.text = 'Baixa';

            if (prioridade == 'Alta') {
                opt1.selected = true
            } else if (prioridade == 'Media') {
                opt2.selected = true
            } else {
                opt3.selected = true
            }

            selectPrioridade.add(opt1, null);
            selectPrioridade.add(opt2, null);
            selectPrioridade.add(opt3, null);

            divSelectPrioridade.append(labelSelectPrioridade, selectPrioridade)

            /** Criar um button para envio do form */
            let button = document.createElement('button')
            button.type = 'submit'
            button.className = 'btn btn-secondary mt-1'
            button.innerHTML = 'Confirmar'

            form.appendChild(inputMethod)
            form.appendChild(inputId)
            form.appendChild(inputDescricao)
            form.appendChild(divSelectPrioridade)
            form.appendChild(divCheckboxFixado)
            form.appendChild(button)

            /** Alterar a div descrição pelo form para edição */
            let divDescricao = document.getElementById('descricao_' + id)
            divDescricao.innerHTML = ''

            divDescricao.insertBefore(form, divDescricao[0])
            console.log(form)

            count++
        } else {
            alert('A edição de um aviso deve ser finalizada ou cancelada antes do início de outra edição.')
        }
    }

    function remover(id) {
        let form = document.getElementById('form_delete_aviso');
        form.action = "<?= base_url('/avisos/') ?>/" + id
    }

    let form = document.getElementById('form_delete_aviso');
    document.getElementById('confirmarDeleteLink').addEventListener("click", function() {
        form.submit();
    });
</script>

<?= $this->endSection() ?>