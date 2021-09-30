<?= $this->extend('layouts/basico');
$this->section('title') ?> <?= $title ?> <?= $this->endSection() ?>
<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<!-- Conteúdo -->
<div class="main" id="pagina">
    <div class="container">

        <div>
            <h4>Usuários</h4>
            <hr>
        </div>
        <div class="mb-3">
            <a type="button" href="" class="btn btn-secondary"><i class="fas fa-user-plus"></i> Novo usuário</a>
        </div>
        <?php if (session()->getFlashdata('msg')) : ?>
            <div>
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <div>
            <i class="fas fa-redo" id="atualizar-lista-usuarios" title="Atualizar"></i>
        </div>
        <small>*Clique no RE para visualizar o usuário</small>
        <div class="table-responsive-sm">
            <table id="lista_usuarios" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>RE</th>
                        <th>Nome</th>
                        <th>Nível</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>

<?= $this->include('layouts/footer') ?>

<script type="text/javascript">
    $('#atualizar-lista-usuarios').on('click', function() {
        $('#lista_usuarios').DataTable().ajax.reload();
    });

    $(document).ready(function() {
        $('#lista_usuarios').DataTable({
            "ajax": {
                "data": {
                    "_token": "{{ csrf_token() }}"
                },
                "url": "{{route('usuarios.listar')}}",
                "type": "POST",
                "datatype": "JSON",
                "dataSrc": function(users) {
                    return users.data;
                },
            },
            "columns": [{
                    "data": "id",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a href='usuarios/" + oData.id + "'>" + oData.id + "</a>");
                    }
                },
                {
                    "data": "nome"
                },
                {
                    "data": "nivel"
                },
            ],
            "processing": true,
            language: {
                url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json'
            },
            order: [
                [1, "asc"]
            ]
        });
    });
</script>

<?= $this->endSection() ?>