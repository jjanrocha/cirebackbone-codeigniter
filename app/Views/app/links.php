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
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalInsertLink"><i class="fas fa-plus"></i> Novo link</button>
        <?php endif; ?>

        <?php if (session()->getFlashdata('msg')) : ?>
            <div>
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($links as $link) : ?>
                <div class="card mt-2 ml-3" id="card-link-<?= $link['id'] ?>" style="width: 18rem;">
                    <div class="card-body" id="card-body-<?= $link['id'] ?>">
                        <h5 class="card-title"><?= $link['titulo'] ?>
                            <?php if (session()->get('nivel') == 'ADMINISTRADOR') : ?>
                                <i class="fas fa-trash-alt float-right ml-1" onclick="remover(<?= $link['id'] ?>, '<?= $link['titulo'] ?>')" data-toggle="modal" data-target="#modalDeleteLink"></i>
                                <i class="fas fa-edit float-right" onclick="editar(<?= $link['id'] ?>, '<?= $link['titulo'] ?>', '<?= $link['link'] ?>')"></i>
                            <?php endif; ?>
                        </h5>
                        <div id="link_<?= $link['id'] ?>">
                            <a href="<?= $link['link'] ?>" class="card-link" target="_blank">Acessar <i class="fas fa-external-link-alt"></i></a>
                            <button class="btn btn-primary" onclick="copiarLink('<?= $link['link'] ?>')"><i class="fas fa-copy"></i> Copiar</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Modal cadastro -->
        <div class="modal fade" id="modalInsertLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inserir novo link</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?= base_url('/links/store') ?>" id="insertLink">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="titulo">Título:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="titulo" id="titulo" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="link">Link:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="link" id="link" class="form-control" required>
                                </div>
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
        <div class="modal fade" id="modalDeleteLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmar exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="mensagem_excluir"></div>
                        <form id="form_delete_link" method="POST" hidden>
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
    function copiarLink(link) {
        var link_copiar = link
        navigator.clipboard.writeText(link_copiar);
    }
</script>

<script>
    document.getElementById('insertLink').addEventListener('submit', function(e) {
        if (document.getElementById('titulo').value.length < 3) {
            document.getElementById('titulo').className = "form-control is-invalid"
            alert('O campo título deve possuir no mínimo 3 caracteres.')
            e.preventDefault()
        }
        if (document.getElementById('link').value.length < 3) {
            document.getElementById('link').className = "form-control is-invalid"
            alert('O campo link deve possuir no mínimo 3 caracteres.')
            e.preventDefault()
        }
    })

    document.getElementById('titulo').addEventListener('change', function(e) {
        if (document.getElementById('titulo').value.length >= 3) {
            document.getElementById('titulo').className = "form-control"
        }
    })

    document.getElementById('link').addEventListener('change', function(e) {
        if (document.getElementById('link').value.length >= 3) {
            document.getElementById('link').className = "form-control"
        }
    })
</script>

<script>
    var count = 0;

    function editar(id, titulo, link) {
        if (count == 0) {
            //criar um form de edição
            let form = document.createElement('form')
            form.action = "<?= base_url('/links/') ?>/" + id
            form.method = 'post'

            //criar um input hidden para guardar o id do link
            let inputId = document.createElement('input')
            inputId.type = 'hidden'
            inputId.name = 'id'
            inputId.value = id

            //criar um input hidden para guardar o método put
            let inputMethod = document.createElement('input')
            inputMethod.type = 'hidden'
            inputMethod.name = '_method'
            inputMethod.value = 'PUT'

            //criar um input para entrada de texto (titulo)
            let inputTitulo = document.createElement('input')
            inputTitulo.type = 'text'
            inputTitulo.className = 'form-control mt-1'
            inputTitulo.name = 'titulo'
            inputTitulo.placeholder = 'Título'
            inputTitulo.value = titulo

            //criar um input para entrada de texto (link)
            let inputLink = document.createElement('input')
            inputLink.type = 'text'
            inputLink.className = 'form-control mt-1'
            inputLink.name = 'link'
            inputLink.placeholder = 'Link'
            inputLink.value = link

            //criar um button para envio do form
            let button = document.createElement('button')
            button.type = 'submit'
            button.className = 'btn btn-info mt-1'
            button.innerHTML = 'Atualizar'

            //criar um button para cancelar a edição
            let button_cancelar = document.createElement('button')
            button_cancelar.type = 'button'
            button_cancelar.className = 'btn btn-danger mt-1 ml-md-1'
            button_cancelar.innerHTML = 'Cancelar'

            button_cancelar.onclick = function() {
                form.remove()
                count = 0
            }

            //incluir inputId no form
            form.appendChild(inputId)

            //incluir inputMethod no form
            form.appendChild(inputMethod)

            //incluir inputTitulo no form
            form.appendChild(inputTitulo)

            //incluir inputLink no form
            form.appendChild(inputLink)

            //incluir button no form
            form.appendChild(button)

            //incluir button no form
            form.appendChild(button_cancelar)

            //selecionar a div do link
            let link_div = document.getElementById('link_' + id)

            //limpar a div dos botões para inclusão do form
            //link_div.innerHTML = ''

            //incluir form na página (com índice 0, será o primeiro elemento filho contido em link_div)
            link_div.insertBefore(form, link_div[0])

            count++
        } else {
            alert('A edição de um link deve ser finalizada ou cancelada antes do início de outra edição.')
        }
    }

    function remover(id, titulo) {
        document.getElementById('mensagem_excluir').innerHTML = 'Tem certeza que deseja excluir o link ' + titulo + '?'
        let form = document.getElementById('form_delete_link');
        form.action = "<?= base_url('/links/') ?>/" + id
    }

    let form = document.getElementById('form_delete_link');
    document.getElementById('confirmarDeleteLink').addEventListener("click", function() {
        form.submit();
    });
</script>

<?= $this->endSection() ?>