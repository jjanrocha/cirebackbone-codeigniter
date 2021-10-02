<?= $this->extend('layouts/basico');
$this->section('title') ?> <?= $title ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<div class="main" id="pagina">
    <div class="container">

        <div>
            <h4>Visulizar Usuário</h4>
            <hr>
        </div>
        <div class="mb-3">
            <a type="button" href="<?= base_url('/usuarios') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Lista de Usuários</a>
        </div>
        <?php if (session()->getFlashdata('msg')) : ?>
            <div>
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <div>
            <b>Nome: </b><?= $usuario['nome'] ?>
        </div>

        <div>
            <b>RE: </b><?= $usuario['id'] ?>
        </div>

        <div>
            <b>Nível: </b><?= $usuario['nivel'] ?>
        </div>

        <div class="my-1">
            <a type="button" href="<?= base_url('/usuarios/edit/' . $usuario['id']) ?>" class="btn btn-info my-1"><i class="fas fa-edit"></i> Editar</a>
            <button type="button" class="btn btn-danger my-1" data-toggle="modal" data-target="#modalDeleteUsuario"><i class="fas fa-trash"></i> Remover</button>
        </div>
        <hr>
        <div>
            <h5>Últimas atividades</h5>
            <div>
                <i class="fas fa-redo" id="atualizar-lista-atividades-usuarios" title="Atualizar"></i>
            </div>
            <div class="table-responsive-sm">
                <table id="lista_atividades_usuarios" class="table table-striped table-dark" style="width:100%">
                    <thead>
                        <tr>
                            <th>TA</th>
                            <th>Tipo de Carimbo</th>
                            <th>Data/hora</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalDeleteUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmar exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir o usuário de RE <?= $usuario['id'] ?>?
                        <form id="form_deletar_usuario" method="post" action="<?= base_url('/usuarios/' . $usuario['id']) ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" form="form_deletar_usuario" id="confirmarDeleteUsuario">Excluir</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->include('layouts/footer') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.11.2/dataRender/datetime.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>


<script type="text/javascript">
    $('#atualizar-lista-atividades-usuarios').on('click', function() {
        $('#lista_atividades_usuarios').DataTable().ajax.reload();
    });

    $(document).ready(function() {

        var id = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);

        $('#lista_atividades_usuarios').DataTable({

            "ajax": {
                "url": "<?= base_url('/listar_atividades_usuario') ?>",
                "type": "POST",
                "datatype": "JSON",
                "data": {
                    id
                },
                "dataSrc": function(users_tasks) {
                    return users_tasks.data;
                },
            },
            "columns": [{
                    "data": [0],
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a href='https://sigitm.vivo.com.br/app/app.jsp#TA=" + oData[0] + "'target='_blank'>" + oData[0] + "</a>");
                    }
                },
                {
                    "data": [1]
                },
                {
                    "data": [2],
                    render: $.fn.dataTable.render.moment('YYYY-MM-DD HH:mm:ss', 'DD/MM/YYYY HH:mm:ss')
                }
            ],
            "processing": true,
            language: {
                url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json'
            },
            order: [
                [2, "desc"]
            ]
        });
    });
</script>

<?= $this->endSection() ?>