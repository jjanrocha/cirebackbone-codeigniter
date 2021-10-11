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
        <!-- <i class="fas fa-redo mt-2" id="atualizar-grafico-geral" onclick="drawChart()" title="Atualizar"></i> -->
        <div class="mt-2">
          <button class="btn btn-secondary" onclick="drawChart()"><i class="fas fa-redo"></i> Atualizar</button>
        </div>
        <div id="piechart"></div>
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
  // Load the Visualization API and the piechart package.
  google.charts.load('current', {
    'packages': ['corechart']
  });

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var jsonData = $.ajax({
      type: "POST",
      url: "<?= base_url('/') ?>/dashboard/geral",
      dataType: "json",
      async: false
    }).responseText;

    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(jsonData);

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, {
      //width: 600,
      height: 400
    });
  }

  $(window).resize(function() {
    drawChart();
  });
</script>

<?= $this->endSection() ?>