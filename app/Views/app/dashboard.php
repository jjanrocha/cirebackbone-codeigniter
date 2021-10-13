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

    <!-- Conteúdo das Abas -->
    <div class="tab-content">

      <!-- Aba Geral -->
      <div class="tab-pane active" id="dashboard_geral" role="tabpanel" aria-labelledby="dashboard_geral-tab">

        <form method="POST" id="filtro_geral" class="form-inline">
          <label class="my-1 mr-2" for="data_inicio_geral">Data Início:</label>
          <input type="date" class="form-control my-1 mr-sm-2" name="data_inicio_geral" id="data_inicio_geral">
          <label class="my-1 mr-2" for="data_fim_geral">Data Fim:</label>
          <input type="date" class="form-control my-1 mr-sm-2" name="data_fim_geral" id="data_fim_geral">
          <button type="submit" class="btn btn-secondary my-1"><i class="fas fa-filter"></i> Filtrar</button>
        </form>

        <input id="data_inicio_geral_atualizacao" hidden></input>
        <input id="data_fim_geral_atualizacao" hidden></input>
        <div class="mt-2">
          <button class="btn btn-secondary" onclick="atualizarGraficoGeral()"><i class="fas fa-redo"></i> Atualizar</button>
        </div>

        <label id="label_filtro_geral"></label>
        <br>
        <label id="total_resultados"></label>

        <div class="mt-2" id="piechart"></div>

      </div> <!-- Fim aba Geral -->

      <!-- Aba Operação -->
      <div class="tab-pane" id="dashboard_operacao" role="tabpanel" aria-labelledby="dashboard_operacao-tab">
        <p class="mt-2">Página em manutenção</p>
      </div> <!-- Fim aba Geral -->

      <!-- Aba Analistas -->
      <div class="tab-pane" id="dashboard_analistas" role="tabpanel" aria-labelledby="dashboard_analistas-tab">
        <p class="mt-2">Página em manutenção</p>
      </div> <!-- Fim aba Analistas -->

    </div> <!-- Fim do conteúdo das abas -->

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

  var form = document.getElementById('filtro_geral');
  var data_inicio_geral = document.getElementById('data_inicio_geral');
  var data_fim_geral = document.getElementById('data_fim_geral');

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    if (data_inicio_geral.value == "" || data_fim_geral.value == "") {
      alert('Tanto a data início quanto data fim devem ser definidas.')
      return
    }

    if (data_inicio_geral.value > data_fim_geral.value) {
      alert('A data inicial não pode ser maior que a final.')
      return
    }

    drawChart(data_inicio_geral.value, data_fim_geral.value)

  });

  function atualizarGraficoGeral() {
    var data_inicio_geral = $('#data_inicio_geral_atualizacao').val() != "" ? $('#data_inicio_geral_atualizacao').val() : '2021-01-01';
    var data_fim_geral = $('#data_fim_geral_atualizacao').val() != "" ? $('#data_fim_geral_atualizacao').val() : '2021-21-31';

    drawChart(data_inicio_geral, data_fim_geral)
  }

  function drawChart(data_inicio_geral, data_fim_geral) {
    var jsonData = $.ajax({
      type: "POST",
      data: {
        'data_inicio_geral': data_inicio_geral,
        'data_fim_geral': data_fim_geral
      },
      url: "<?= base_url('/') ?>/dashboard/geral",
      dataType: "json",
      async: false,
      success: function(response) {
        $('#label_filtro_geral').html('Filtrado de: ' + response.data_inicio + ' a ' + response.data_fim + '.')
        $('#total_resultados').html('Total de atividades no período: ' + response.total_atividades + '.')
        $('#data_inicio_geral_atualizacao').val(response.data_inicio)
        $('#data_fim_geral_atualizacao').val(response.data_fim)
      }
    }).responseText;

    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(jsonData);

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, {
      title: 'Atividades',
      is3D: true,
      //width: 600,
      height: 400
    });
  }

  $(window).resize(function() {
    drawChart();
  });
</script>

<?= $this->endSection() ?>