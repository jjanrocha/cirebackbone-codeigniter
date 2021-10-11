<?= $this->extend('layouts/basico');
$this->section('title') ?> <?= $title ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('layouts/sidebar') ?>

<!-- Conteúdo -->
<div class="main" id="pagina">
  <div class="container">

    <h4>Dashboard</h4>
    <hr>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="dashboard_geral-tab" data-toggle="tab" href="#dashboard_geral" role="tab" aria-controls="dashboard_geral" aria-selected="true">Geral</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="dashboard_operacao-tab" data-toggle="tab" href="#dashboard_operacao" role="tab" aria-controls="dashboard_operacao" aria-selected="false">Operação</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="dashboard_analistas-tab" data-toggle="tab" href="#dashboard_analistas" role="tab" aria-controls="dashboard_analistas" aria-selected="false">Analistas</a>
      </li>
    </ul>

    <div class="tab-content">

      <div class="tab-pane active" id="dashboard_geral" role="tabpanel" aria-labelledby="dashboard_geral-tab">
        <div id="piechart" style="height:450px"></div>
      </div>

      <div class="tab-pane" id="dashboard_operacao" role="tabpanel" aria-labelledby="dashboard_operacao-tab">
        <p class="mt-2">Página em manutenção</p>
      </div>

      <div class="tab-pane" id="dashboard_analistas" role="tabpanel" aria-labelledby="dashboard_analistas-tab">
        <p class="mt-2">Página em manutenção</p>
      </div>

    </div>

  </div>
</div>

<?= $this->include('layouts/footer') ?>

<script type="text/javascript" src="<?= base_url('js/loader.js') ?>"></script>


<script type="text/javascript">
  $(document).ready(function() {
    var response = []
    google.charts.load('current', {
      'packages': ['corechart']
    });
    //google.charts.setOnLoadCallback(drawChart);

    $.ajax({
      type: "POST",
      url: "<?= base_url('/') ?>/dashboard/geral",
      dataType: 'json',

      success: function(response) {
        drawChart(response)
      }
    })

    function drawChart(response) {

      var data = google.visualization.arrayToDataTable([
        ['Tipo de atividade', 'Total'],
        ['Escalonamento Crise', response.total_escalonamento_crise],
        ['Escalonamento Urgente', response.total_escalonamento_urgente],
        ['Atualização Telegram', response.total_atualizacao_telegram],
      ]);

      var options = {
        title: 'Atividades'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }

    $(window).resize(function() {
      drawChart();
    });
  });
</script>

<?= $this->endSection() ?>